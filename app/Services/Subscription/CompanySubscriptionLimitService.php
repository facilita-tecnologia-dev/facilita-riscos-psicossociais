<?php

namespace App\Services\Subscription;

use App\Models\Company;
use App\Models\Subscription;

class CompanySubscriptionLimitService
{
   public static function canAddEmployee(Company $company): bool {
        if ($company->usesExternalBilling()) return true;

        $subscription = Subscription::query()->where('company_id', $company->id)->latest()->first();

        if (! $subscription) {
            return false;
        }

        if (! $subscription) return false;

        $activeEmployees = $company->activeUsers()->count();

        $limit = SubscriptionPricingService::maxEmployees($subscription->employees_count);

        return $activeEmployees < $limit;
    }

    public static function canImportEmployees(Company $company, int $employeesToImport): bool {
        if ($company->usesExternalBilling()) return true;

        $subscription = Subscription::query()->where('company_id', $company->id)->latest()->first();

        if (! $subscription) {
            return false;
        }

        $activeEmployees = $company->activeUsers()->count();

        $limit = SubscriptionPricingService::maxEmployees($subscription->employees_count
        );

        return ($activeEmployees + $employeesToImport) <= $limit;
    }

    public static function availableSlots(Company $company): int {
        if ($company->usesExternalBilling()) {
            return PHP_INT_MAX;
        }

        $subscription = Subscription::query()->where('company_id', $company->id)->latest()->first();

        if (! $subscription) {
            return false;
        }

        $activeEmployees = $company->activeUsers()->count();

        $limit = SubscriptionPricingService::maxEmployees($subscription->employees_count);

        return max(0, $limit - $activeEmployees);
    }
}