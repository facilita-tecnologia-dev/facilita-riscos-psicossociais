<?php

namespace App\Http\Controllers\Private;

use App\Services\DemographicsService;
use Illuminate\Support\Facades\Gate;

class DemographicsController
{
    public function demographics()
    {
        Gate::authorize('demographics-dashboard-view');

        return view('private.dashboard.demographics.index', [
            'proartIndicators' => DemographicsService::metrics(),
            'demographics' => DemographicsService::demographics(),
        ]);
    }
}
