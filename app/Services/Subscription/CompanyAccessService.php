<?php

namespace App\Services\Subscription;

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Enums\Subscription\TrialExpiredReason;
use App\Models\Company;

class CompanyAccessService
{
    public function canAccess(Company $company): bool
    {
        if ($company->usesExternalBilling()) return true;

        $this->validateTrialExpiration($company);
        return $company->canAccessSystem();
    }

    public function mustBlock(Company $company): bool
    {
        return !$this->canAccess($company);
    }

    public function getBlockingReason(Company $company): ?string {
        if ($company->usesExternalBilling()) return null;

        if ($company->access_status === AccessStatus::BLOCKED) {
            if ($company->trial_expired_at !== null) {
                return match ($company->trial_expired_reason) {
                    TrialExpiredReason::TIME_LIMIT =>'trial_time_expired',
                    TrialExpiredReason::USAGE_LIMIT =>'trial_usage_expired',
                    default => 'trial_expired',
                };
            }

            return match ($company->subscription_status) {
                SubscriptionStatus::PENDING =>'subscription_pending',
                SubscriptionStatus::PAST_DUE =>'subscription_past_due',
                SubscriptionStatus::CANCELED =>'subscription_canceled',
                SubscriptionStatus::ENDED =>'subscription_ended',
                default => 'access_blocked',
            };
        }

        return null;
    }

    public function validateTrialExpiration(Company $company): void {
        if (! $company->hasActiveTrial()) {return;}

        if (now()->greaterThan($company->trial_ends_at)) {
            $company->expireTrial(TrialExpiredReason::TIME_LIMIT);
            return;
        }

        if ($company->hasFullyConsumedTrial()) {
            $company->expireTrial(TrialExpiredReason::USAGE_LIMIT);
        }
    }
}
