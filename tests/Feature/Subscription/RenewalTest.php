<?php

use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\Subscription\SubscriptionRenewalService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;

uses(DatabaseTransactions::class);

beforeEach(function () {
    Mail::fake();

    $company = Company::factory()->create();
    $this->subscription = Subscription::factory()->active()->create([
        'company_id' => $company->id,
    ]);
});

it('creates a renewal payment for an active subscription', function () {
    $result = SubscriptionRenewalService::generateRenewal($this->subscription);

    expect($result['created'])->toBeTrue();
    expect($result['payment'])->toBeInstanceOf(Payment::class);
    expect($result['payment']->kind)->toBe(PaymentKind::RENEWAL);
    expect($result['payment']->status)->toBe(PaymentStatus::PENDING);
    expect($result['payment']->subscription_id)->toBe($this->subscription->id);
});

it('returns existing pending payment without creating a new one', function () {
    $existing = Payment::factory()->renewal()->create([
        'subscription_id' => $this->subscription->id,
        'status'          => PaymentStatus::PENDING,
    ]);

    $result = SubscriptionRenewalService::generateRenewal($this->subscription);

    expect($result['created'])->toBeFalse();
    expect($result['payment']->id)->toBe($existing->id);
    expect($this->subscription->payments()->count())->toBe(1);
});

it('throws exception for non-active subscriptions', function () {
    $this->subscription->update(['status' => SubscriptionStatus::ENDED]);

    expect(fn () => SubscriptionRenewalService::generateRenewal($this->subscription))
        ->toThrow(\Exception::class, 'Subscription is not active.');
});

it('throws exception for pending subscriptions', function () {
    $this->subscription->update(['status' => SubscriptionStatus::PENDING]);

    expect(fn () => SubscriptionRenewalService::generateRenewal($this->subscription))
        ->toThrow(\Exception::class, 'Subscription is not active.');
});
