<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\Subscription;
use App\Services\Subscription\SubscriptionLifecycleService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;

uses(DatabaseTransactions::class);

beforeEach(function () {
    Mail::fake();

    $this->company = Company::factory()->create([
        'access_status'       => AccessStatus::BLOCKED,
        'subscription_status' => null,
    ]);
});

describe('activate()', function () {
    it('sets subscription status to active', function () {
        $subscription = Subscription::factory()->create([
            'company_id' => $this->company->id,
            'type'       => PaymentType::YEARLY,
        ]);

        SubscriptionLifecycleService::activate($subscription);

        $subscription->refresh();

        expect($subscription->status)->toBe(SubscriptionStatus::ACTIVE);
    });

    it('sets current_period_end to one year for yearly subscriptions', function () {
        $subscription = Subscription::factory()->create([
            'company_id' => $this->company->id,
            'type'       => PaymentType::YEARLY,
        ]);

        SubscriptionLifecycleService::activate($subscription);
        $subscription->refresh();

        expect($subscription->current_period_end->toDateString())
            ->toBe(now()->addYear()->toDateString());
    });

    it('sets current_period_end to one month for monthly subscriptions', function () {
        $subscription = Subscription::factory()->monthly()->create([
            'company_id' => $this->company->id,
        ]);

        SubscriptionLifecycleService::activate($subscription);
        $subscription->refresh();

        expect($subscription->current_period_end->toDateString())
            ->toBe(now()->addMonth()->toDateString());
    });

    it('activates the company access status', function () {
        $subscription = Subscription::factory()->create([
            'company_id' => $this->company->id,
        ]);

        SubscriptionLifecycleService::activate($subscription);

        $this->company->refresh();

        expect($this->company->subscription_status)->toBe(SubscriptionStatus::ACTIVE);
        expect($this->company->access_status)->toBe(AccessStatus::ACTIVE);
    });

    it('sets next_billing_at equal to current_period_end', function () {
        $subscription = Subscription::factory()->create([
            'company_id' => $this->company->id,
            'type'       => PaymentType::YEARLY,
        ]);

        SubscriptionLifecycleService::activate($subscription);
        $subscription->refresh();

        expect($subscription->next_billing_at->toDateString())
            ->toBe($subscription->current_period_end->toDateString());
    });
});

describe('renew()', function () {
    it('keeps subscription active after renewal', function () {
        $subscription = Subscription::factory()->active()->create([
            'company_id' => $this->company->id,
            'type'       => PaymentType::YEARLY,
        ]);

        SubscriptionLifecycleService::renew($subscription);
        $subscription->refresh();

        expect($subscription->status)->toBe(SubscriptionStatus::ACTIVE);
    });

    it('advances billing period by one year for yearly type', function () {
        $periodEnd = now()->addDays(1);
        $subscription = Subscription::factory()->active()->create([
            'company_id'         => $this->company->id,
            'type'               => PaymentType::YEARLY,
            'current_period_end' => $periodEnd,
        ]);

        SubscriptionLifecycleService::renew($subscription);
        $subscription->refresh();

        expect($subscription->current_period_start->toDateString())
            ->toBe($periodEnd->toDateString());
        expect($subscription->current_period_end->toDateString())
            ->toBe($periodEnd->copy()->addYear()->toDateString());
    });

    it('advances billing period by one month for monthly type', function () {
        $periodEnd = now()->addDays(1);
        $subscription = Subscription::factory()->active()->monthly()->create([
            'company_id'         => $this->company->id,
            'current_period_end' => $periodEnd,
        ]);

        SubscriptionLifecycleService::renew($subscription);
        $subscription->refresh();

        expect($subscription->current_period_end->toDateString())
            ->toBe($periodEnd->copy()->addMonth()->toDateString());
    });

    it('clears past_due_at on renewal', function () {
        $subscription = Subscription::factory()->pastDue()->create([
            'company_id'         => $this->company->id,
            'current_period_end' => now()->addDay(),
        ]);

        SubscriptionLifecycleService::renew($subscription);
        $subscription->refresh();

        expect($subscription->past_due_at)->toBeNull();
    });

    it('applies scheduled type change on renewal', function () {
        $subscription = Subscription::factory()->active()->yearly()->create([
            'company_id'       => $this->company->id,
            'scheduled_type'   => PaymentType::MONTHLY,
            'current_period_end' => now()->addDay(),
        ]);

        SubscriptionLifecycleService::renew($subscription);
        $subscription->refresh();

        expect($subscription->type)->toBe(PaymentType::MONTHLY);
        expect($subscription->scheduled_type)->toBeNull();
    });
});

describe('changePlan()', function () {
    it('updates employees_count and amount', function () {
        $subscription = Subscription::factory()->active()->create([
            'company_id'      => $this->company->id,
            'employees_count' => 50,
            'amount'          => 50000,
        ]);

        SubscriptionLifecycleService::changePlan($subscription, 100, 80000);
        $subscription->refresh();

        expect($subscription->employees_count)->toBe(100);
        expect($subscription->amount)->toBe(80000);
    });
});

describe('scheduleTypeChange()', function () {
    it('sets scheduled_type', function () {
        $subscription = Subscription::factory()->active()->yearly()->create([
            'company_id' => $this->company->id,
        ]);

        SubscriptionLifecycleService::scheduleTypeChange($subscription, PaymentType::MONTHLY);
        $subscription->refresh();

        expect($subscription->scheduled_type)->toBe(PaymentType::MONTHLY);
    });
});

describe('cancelScheduledTypeChange()', function () {
    it('clears scheduled_type', function () {
        $subscription = Subscription::factory()->active()->create([
            'company_id'     => $this->company->id,
            'scheduled_type' => PaymentType::MONTHLY,
        ]);

        SubscriptionLifecycleService::cancelScheduledTypeChange($subscription);
        $subscription->refresh();

        expect($subscription->scheduled_type)->toBeNull();
    });
});

describe('markPastDue()', function () {
    it('sets subscription status to past_due', function () {
        $subscription = Subscription::factory()->active()->create([
            'company_id' => $this->company->id,
        ]);

        SubscriptionLifecycleService::markPastDue($subscription);
        $subscription->refresh();

        expect($subscription->status)->toBe(SubscriptionStatus::PAST_DUE);
        expect($subscription->past_due_at)->not->toBeNull();
    });

    it('sets company access_status to blocked', function () {
        $subscription = Subscription::factory()->active()->create([
            'company_id' => $this->company->id,
        ]);

        SubscriptionLifecycleService::markPastDue($subscription);
        $this->company->refresh();

        expect($this->company->access_status)->toBe(AccessStatus::BLOCKED);
    });
});

describe('scheduleCancelation()', function () {
    it('sets cancel_at_period_end and scheduled_cancel_at', function () {
        $periodEnd = now()->addMonth();
        $subscription = Subscription::factory()->active()->create([
            'company_id'         => $this->company->id,
            'current_period_end' => $periodEnd,
        ]);

        SubscriptionLifecycleService::scheduleCancelation($subscription);
        $subscription->refresh();

        expect($subscription->cancel_at_period_end)->toBeTrue();
        expect($subscription->scheduled_cancel_at->toDateString())
            ->toBe($periodEnd->toDateString());
    });
});

describe('finalizeCancellation()', function () {
    it('sets subscription status to ended', function () {
        $subscription = Subscription::factory()->active()->create([
            'company_id'          => $this->company->id,
            'cancel_at_period_end' => true,
        ]);

        SubscriptionLifecycleService::finalizeCancellation($subscription);
        $subscription->refresh();

        expect($subscription->status)->toBe(SubscriptionStatus::ENDED);
        expect($subscription->ended_at)->not->toBeNull();
        expect($subscription->cancel_at_period_end)->toBeFalse();
    });
});

describe('reactivate()', function () {
    it('reactivates subscription and clears cancellation fields', function () {
        $subscription = Subscription::factory()->active()->create([
            'company_id'          => $this->company->id,
            'cancel_at_period_end' => true,
            'scheduled_cancel_at' => now()->addDays(5),
        ]);

        SubscriptionLifecycleService::reactivate($subscription);
        $subscription->refresh();

        expect($subscription->status)->toBe(SubscriptionStatus::ACTIVE);
        expect($subscription->cancel_at_period_end)->toBeFalse();
        expect($subscription->scheduled_cancel_at)->toBeNull();
    });
});
