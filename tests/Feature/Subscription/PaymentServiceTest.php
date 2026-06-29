<?php

use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\Subscription\Billing\PaymentService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->subscription = Subscription::factory()->active()->create();
});

describe('createPayment()', function () {
    it('creates a pending payment for the subscription', function () {
        $payment = PaymentService::createPayment($this->subscription);

        expect($payment->status)->toBe(PaymentStatus::PENDING);
        expect($payment->subscription_id)->toBe($this->subscription->id);
        expect($payment->amount)->toBe($this->subscription->amount);
        expect($payment->kind)->toBe(PaymentKind::INITIAL);
        expect($payment->external_reference)->not->toBeNull();
    });

    it('sets due date 3 days from now', function () {
        $payment = PaymentService::createPayment($this->subscription);

        expect($payment->due_date->toDateString())->toBe(now()->addDays(3)->toDateString());
    });

    it('creates renewal payment with correct kind', function () {
        $payment = PaymentService::createPayment($this->subscription, PaymentKind::RENEWAL);

        expect($payment->kind)->toBe(PaymentKind::RENEWAL);
    });
});

describe('createPlanChangePayment()', function () {
    it('creates a new plan change payment', function () {
        $payment = PaymentService::createPlanChangePayment(
            $this->subscription, 80000, 100, $this->subscription->type
        );

        expect($payment->status)->toBe(PaymentStatus::PENDING);
        expect($payment->kind)->toBe(PaymentKind::PLAN_CHANGE);
        expect($payment->amount)->toBe(80000);
        expect($payment->metadata['employees_count'])->toBe(100);
        expect($payment->metadata['amount'])->toBe(80000);
    });

    it('reuses an existing pending plan change payment', function () {
        $first = PaymentService::createPlanChangePayment(
            $this->subscription, 80000, 100, $this->subscription->type
        );

        $second = PaymentService::createPlanChangePayment(
            $this->subscription, 100000, 200, $this->subscription->type
        );

        expect($second->id)->toBe($first->id);
        expect($second->amount)->toBe(100000);
        expect($second->metadata['employees_count'])->toBe(200);
    });
});

describe('markAsPaid()', function () {
    it('marks payment as paid with gateway data', function () {
        $payment = Payment::factory()->create(['subscription_id' => $this->subscription->id]);

        $payload = [
            'charges' => [
                ['amount' => ['value' => 50000], 'status' => 'PAID'],
            ],
        ];

        PaymentService::markAsPaid($payment, $payload);

        $payment->refresh();

        expect($payment->status)->toBe(PaymentStatus::PAID);
        expect($payment->paid_at)->not->toBeNull();
        expect($payment->paid_amount)->toBe(50000);
        expect($payment->gateway_status)->toBe('PAID');
    });

    it('uses payment amount when payload has no amount', function () {
        $payment = Payment::factory()->create([
            'subscription_id' => $this->subscription->id,
            'amount'          => 60000,
        ]);

        PaymentService::markAsPaid($payment, []);

        $payment->refresh();
        expect($payment->paid_amount)->toBe(60000);
    });
});

describe('markAsPaidFromDirectCharge()', function () {
    it('marks payment as paid with direct charge data', function () {
        $payment = Payment::factory()->create(['subscription_id' => $this->subscription->id]);

        $chargeData = ['amount' => ['value' => 50000], 'status' => 'PAID'];

        PaymentService::markAsPaidFromDirectCharge($payment, $chargeData);

        $payment->refresh();

        expect($payment->status)->toBe(PaymentStatus::PAID);
        expect($payment->paid_at)->not->toBeNull();
        expect($payment->paid_amount)->toBe(50000);
        expect($payment->checkout_url)->toBeNull();
    });
});

describe('markAsFailed()', function () {
    it('marks payment as failed', function () {
        $payment = Payment::factory()->create(['subscription_id' => $this->subscription->id]);

        $payload = [
            'charges' => [
                ['status' => 'DECLINED'],
            ],
        ];

        PaymentService::markAsFailed($payment, $payload);

        $payment->refresh();

        expect($payment->status)->toBe(PaymentStatus::FAILED);
        expect($payment->gateway_status)->toBe('DECLINED');
    });
});
