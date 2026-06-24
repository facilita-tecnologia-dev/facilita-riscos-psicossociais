<?php

namespace App\Services\Subscription;

use App\Models\Campaign;
use App\Models\Company;
use App\Models\CompanyAbsence;

class TrialCleanupService
{
    public static function cleanup(Company $company): void {
        Campaign::query()->where('company_id', $company->id)->delete();
        CompanyAbsence::query()->where('company_id', $company->id)->delete();
        $company->allUsers()->detach();
    }
}