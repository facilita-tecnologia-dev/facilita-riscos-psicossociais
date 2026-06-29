<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\Subscription\Billing\BillingWebhookService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;

uses(DatabaseTransactions::class);

function makePagSeguroPayload(string $referenceId, string $status, int $amount = 50000): array
{
    return [
        'charges' => [
            [
                'reference_id' => $referenceId,
                'status'       => $status,
                'amount'       => ['value' => $amount],
            ],
        ],
    ];
}

beforeEach(function () {
    Mail::fake();

    $this->company = Company::factory()->create([
        'access_status'       => AccessStatus::BLOCKED,
        'subscription_status' => null,
    ]);

    $this->subscription = Subscription::factory()->create([
        'company_id' => $this->company->id,
    ]);

    $this->webhookService = app(BillingWebhookService::class);
});

describe('PAID webhook', function () {
    it('marks initial payment as paid and activates subscription', function () {
        $payment = Payment::factory()->create([
            'subscription_id'    => $this->subscription->id,
            'kind'               => \App\Enums\Subscription\PaymentKind::INITIAL,
            'external_reference' => 'ref_initial_001',
        ]);

        $this->webhookService->handlePagSeguroWebhook(
            makePagSeguroPayload('ref_initial_001', 'PAID')
        );

        $payment->refresh();
        $this->subscription->refresh();
        $this->company->refresh();

        expect($payment->status)->toBe(PaymentStatus::PAID);
        expect($this->subscription->status)->toBe(SubscriptionStatus::ACTIVE);
        expect($this->company->subscription_status)->toBe(SubscriptionStatus::ACTIVE);
    });

    it('marks renewal payment as paid and renews subscription', function () {
        $periodEnd = now()->addDay();
        $this->subscription->update([
            'status'               => SubscriptionStatus::ACTIVE,
            'current_period_end'   => $periodEnd,
            'current_period_start' => now()->subMonth(),
            'next_billing_at'      => $periodEnd,
        ]);

        $payment = Payment::factory()->renewal()->create([
            'subscription_id'    => $this->subscription->id,
            'external_reference' => 'ref_renewal_001',
        ]);

        $this->webhookService->handlePagSeguroWebhook(
            makePagSeguroPayload('ref_renewal_001', 'PAID')
        );

        $payment->refresh();
        $this->subscription->refresh();

        expect($payment->status)->toBe(PaymentStatus::PAID);
        expect($this->subscription->status)->toBe(SubscriptionStatus::ACTIVE);
        expect($this->subscription->current_period_start->toDateString())
            ->toBe($periodEnd->toDateString());
    });

    it('marks plan change payment as paid and changes plan', function () {
        $this->subscription->update([
            'status'               => SubscriptionStatus::ACTIVE,
            'employees_count'      => 50,
            'amount'               => 50000,
            'current_period_start' => now()->subMonth(),
            'current_period_end'   => now()->addMonth(),
            'next_billing_at'      => now()->addMonth(),
        ]);

        $payment = Payment::factory()->planChange(100, 80000)->create([
            'subscription_id'    => $this->subscription->id,
            'external_reference' => 'ref_plan_001',
        ]);

        $this->webhookService->handlePagSeguroWebhook(
            makePagSeguroPayload('ref_plan_001', 'PAID')
        );

        $payment->refresh();
        $this->subscription->refresh();

        expect($payment->status)->toBe(PaymentStatus::PAID);
        expect($this->subscription->employees_count)->toBe(100);
        expect($this->subscription->amount)->toBe(80000);
    });

    it('is idempotent and does not double-process paid payment', function () {
        $payment = Payment::factory()->paid()->create([
            'subscription_id'    => $this->subscription->id,
            'external_reference' => 'ref_already_paid',
        ]);

        $initialPaidAt = $payment->paid_at;

        $this->webhookService->handlePagSeguroWebhook(
            makePagSeguroPayload('ref_already_paid', 'PAID')
        );

        $payment->refresh();

        expect($payment->paid_at->toDateTimeString())
            ->toBe($initialPaidAt->toDateTimeString());
    });
});

describe('DECLINED webhook', function () {
    it('marks payment as failed', function () {
        $this->subscription->update([
            'status'               => SubscriptionStatus::ACTIVE,
            'current_period_start' => now()->subMonth(),
            'current_period_end'   => now()->addMonth(),
            'next_billing_at'      => now()->addMonth(),
        ]);

        $payment = Payment::factory()->create([
            'subscription_id'    => $this->subscription->id,
            'external_reference' => 'ref_declined_001',
        ]);

        $this->webhookService->handlePagSeguroWebhook(
            makePagSeguroPayload('ref_declined_001', 'DECLINED')
        );

        $payment->refresh();

        expect($payment->status)->toBe(PaymentStatus::FAILED);
    });

    it('marks active subscription as past_due when payment declined', function () {
        $this->subscription->update([
            'status'               => SubscriptionStatus::ACTIVE,
            'current_period_start' => now()->subMonth(),
            'current_period_end'   => now()->addMonth(),
            'next_billing_at'      => now()->addMonth(),
        ]);

        $payment = Payment::factory()->create([
            'subscription_id'    => $this->subscription->id,
            'external_reference' => 'ref_declined_002',
        ]);

        $this->webhookService->handlePagSeguroWebhook(
            makePagSeguroPayload('ref_declined_002', 'DECLINED')
        );

        $this->subscription->refresh();

        expect($this->subscription->status)->toBe(SubscriptionStatus::PAST_DUE);
    });

    it('is idempotent and does not double-process failed payment', function () {
        $payment = Payment::factory()->failed()->create([
            'subscription_id'    => $this->subscription->id,
            'external_reference' => 'ref_already_failed',
        ]);

        $this->subscription->update([
            'status'               => SubscriptionStatus::PAST_DUE,
            'current_period_start' => now()->subMonth(),
            'current_period_end'   => now()->subDay(),
        ]);

        $statusBefore = $this->subscription->status;

        $this->webhookService->handlePagSeguroWebhook(
            makePagSeguroPayload('ref_already_failed', 'DECLINED')
        );

        $this->subscription->refresh();
        expect($this->subscription->status)->toBe($statusBefore);
    });
});

describe('invalid payloads', function () {
    it('ignores payload without charges', function () {
        expect(fn () => $this->webhookService->handlePagSeguroWebhook([]))
            ->not->toThrow(\Throwable::class);
    });

    it('ignores payload with unknown status', function () {
        $payment = Payment::factory()->create([
            'subscription_id'    => $this->subscription->id,
            'external_reference' => 'ref_unknown_status',
        ]);

        $payload = makePagSeguroPayload('ref_unknown_status', 'PROCESSING');

        expect(fn () => $this->webhookService->handlePagSeguroWebhook($payload))
            ->not->toThrow(\Throwable::class);

        $payment->refresh();
        expect($payment->status)->toBe(PaymentStatus::PENDING);
    });
});
