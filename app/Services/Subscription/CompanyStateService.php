<?php

namespace App\Services\Subscription;

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use Carbon\Carbon;

class CompanyStateService
{
    public static function activate(Company $company): void
    {
        $company->update([
            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status' => AccessStatus::ACTIVE,
            'trial_started_at' => null,
            'trial_ends_at' => null,
            'trial_expired_at' => null,
            'trial_expired_reason' => null,
        ]);

        session()->put('auth:company', $company->fresh());
    }

    public static function trial(Company $company, Carbon $trialEndsAt): void
    {
        $company->update([
            'subscription_status' =>SubscriptionStatus::TRIALING,
            'access_status' => AccessStatus::ACTIVE,
            'trial_started_at' => now(),
            'trial_ends_at' => $trialEndsAt,
            'trial_expired_at' => null,
            'trial_expired_reason' => null,
        ]);

        session()->put('auth:company', $company->fresh());
    }

    public static function markPending(Company $company): void
    {
        $company->update([
            'subscription_status' =>
                SubscriptionStatus::PENDING,
        ]);

        session()->put('auth:company', $company->fresh());
    }

    public static function markPastDue(Company $company): void
    {
        $company->update([
            'subscription_status' => SubscriptionStatus::PAST_DUE,
            'access_status' => AccessStatus::BLOCKED,
        ]);

        session()->put('auth:company', $company->fresh());
    }

    public static function end(Company $company): void
    {
        $company->update(['subscription_status' => SubscriptionStatus::ENDED, 'access_status' => AccessStatus::BLOCKED,]);

        session()->put('auth:company', $company->fresh());
    }
}