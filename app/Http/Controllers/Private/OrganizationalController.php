<?php

namespace App\Http\Controllers\Private;

use App\Services\OrganizationalService;
use Illuminate\Http\Request;

class OrganizationalController
{
    public function dashboard()
    {
        return view('private.dashboard.organizational.index', [
            'dashboard' => OrganizationalService::dashboard(),
            // 'organizationalTestsParticipation' => $organizationalTestsParticipation,
            // 'companyHasTests' => session('auth:company')->users()->has('collections')->exists(),
            // 'filtersApplied' => $filtersApplied,
            // 'filteredUserCount' => count($this->scopedTestResults) > 0 ? count($this->scopedTestResults) : null,
        ]);
    }
    
    public function answers()
    {
        dd('answers');
    }
}
