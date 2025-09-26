<?php

namespace App\Http\Controllers\Private\Dashboard;

use App\Services\DemographicsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DemographicsController
{
    public function demographics()
    {
        Gate::authorize('demographics-dashboard-view');

        return view('private.dashboard.demographics.index', [
            'metrics' => DemographicsService::metrics(),
            'demographics' => DemographicsService::demographics(),
        ]);
    }
}
