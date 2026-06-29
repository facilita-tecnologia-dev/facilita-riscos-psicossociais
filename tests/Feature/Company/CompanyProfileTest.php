<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

function companySession(User $user, Company $company): array
{
    return [
        'auth:user'    => $user,
        'auth:company' => $company,
        'auth:guard'   => 'user',
    ];
}

describe('company profile page', function () {
    it('redirects unauthenticated access to home', function () {
        $company = Company::factory()->create();
        $this->get(route('company.show', $company))
            ->assertRedirect(route('site.home'));
    });
});

describe('Company model methods', function () {
    it('hasActiveSubscription returns true when status is ACTIVE', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::ACTIVE,
        ]);

        expect($company->hasActiveSubscription())->toBeTrue();
    });

    it('hasActiveSubscription returns false for non-active status', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::PENDING,
        ]);

        expect($company->hasActiveSubscription())->toBeFalse();
    });

    it('hasActiveTrial returns false when trial not started', function () {
        $company = Company::factory()->create();

        expect($company->hasActiveTrial())->toBeFalse();
    });

    it('hasActiveTrial returns true within trial period', function () {
        $company = Company::factory()->create([
            'trial_started_at' => now()->subDays(7),
            'trial_ends_at'    => now()->addDays(7),
        ]);

        expect($company->hasActiveTrial())->toBeTrue();
    });

    it('hasActiveTrial returns false after trial period ended', function () {
        $company = Company::factory()->create([
            'trial_started_at' => now()->subDays(20),
            'trial_ends_at'    => now()->subDays(6),
        ]);

        expect($company->hasActiveTrial())->toBeFalse();
    });

    it('hasActiveTrial returns false if trial was explicitly expired', function () {
        $company = Company::factory()->create([
            'trial_started_at'  => now()->subDays(7),
            'trial_ends_at'     => now()->addDays(7),
            'trial_expired_at'  => now()->subDay(),
        ]);

        expect($company->hasActiveTrial())->toBeFalse();
    });

    it('canAccessSystem returns true for active subscription', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status'       => AccessStatus::ACTIVE,
        ]);

        expect($company->canAccessSystem())->toBeTrue();
    });

    it('canAccessSystem returns true for active trial', function () {
        $company = Company::factory()->create([
            'access_status'    => AccessStatus::ACTIVE,
            'trial_started_at' => now()->subDay(),
            'trial_ends_at'    => now()->addDays(13),
        ]);

        expect($company->canAccessSystem())->toBeTrue();
    });

    it('canAccessSystem returns false when access_status is BLOCKED', function () {
        $company = Company::factory()->create([
            'access_status'       => AccessStatus::BLOCKED,
            'subscription_status' => SubscriptionStatus::PENDING,
        ]);

        expect($company->canAccessSystem())->toBeFalse();
    });
});

describe('Subscription model predicates', function () {
    it('isTrial returns true for TRIALING status', function () {
        $sub = \App\Models\Subscription::factory()->create([
            'company_id' => Company::factory()->create()->id,
            'status'     => \App\Enums\Subscription\SubscriptionStatus::TRIALING,
        ]);

        expect($sub->isTrial())->toBeTrue();
    });

    it('isActive returns true for ACTIVE status', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id' => Company::factory()->create()->id,
        ]);

        expect($sub->isActive())->toBeTrue();
        expect($sub->isTrial())->toBeFalse();
    });

    it('canBeCanceled returns true only for active non-canceling subscription', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id'          => Company::factory()->create()->id,
            'cancel_at_period_end' => false,
        ]);

        expect($sub->canBeCanceled())->toBeTrue();
    });

    it('canBeCanceled returns false when cancel already scheduled', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id'          => Company::factory()->create()->id,
            'cancel_at_period_end' => true,
        ]);

        expect($sub->canBeCanceled())->toBeFalse();
    });

    it('canBeReactivated returns true when cancel is scheduled', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id'          => Company::factory()->create()->id,
            'cancel_at_period_end' => true,
        ]);

        expect($sub->canBeReactivated())->toBeTrue();
    });

    it('willCancel reflects cancel_at_period_end flag', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id'          => Company::factory()->create()->id,
            'cancel_at_period_end' => true,
        ]);

        expect($sub->willCancel())->toBeTrue();
    });

    it('shouldBeCanceled returns true when scheduled cancel date has passed', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id'          => Company::factory()->create()->id,
            'cancel_at_period_end' => true,
            'scheduled_cancel_at' => now()->subDay(),
        ]);

        expect($sub->shouldBeCanceled())->toBeTrue();
    });

    it('shouldBeCanceled returns false when scheduled cancel date is in the future', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id'          => Company::factory()->create()->id,
            'cancel_at_period_end' => true,
            'scheduled_cancel_at' => now()->addDay(),
        ]);

        expect($sub->shouldBeCanceled())->toBeFalse();
    });

    it('hasScheduledTypeChange returns true when scheduled_type is set', function () {
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id'     => Company::factory()->create()->id,
            'scheduled_type' => \App\Enums\Subscription\PaymentType::MONTHLY,
        ]);

        expect($sub->hasScheduledTypeChange())->toBeTrue();
    });

    it('employeesLimit returns correct ceiling for tier', function () {
        $sub = \App\Models\Subscription::factory()->create([
            'company_id'      => Company::factory()->create()->id,
            'employees_count' => 50,
        ]);

        expect($sub->employeesLimit())->toBe(50);
    });

    it('pendingPayment returns the latest pending payment', function () {
        $company = Company::factory()->create();
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id' => $company->id,
        ]);

        \App\Models\Payment::factory()->paid()->create(['subscription_id' => $sub->id]);
        $pending = \App\Models\Payment::factory()->create(['subscription_id' => $sub->id]);

        expect($sub->pendingPayment()->id)->toBe($pending->id);
    });

    it('pendingPayment returns null when no pending payments', function () {
        $company = Company::factory()->create();
        $sub = \App\Models\Subscription::factory()->active()->create([
            'company_id' => $company->id,
        ]);

        \App\Models\Payment::factory()->paid()->create(['subscription_id' => $sub->id]);

        expect($sub->pendingPayment())->toBeNull();
    });
});
