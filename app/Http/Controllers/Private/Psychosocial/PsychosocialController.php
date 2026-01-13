<?php

namespace App\Http\Controllers\Private\Psychosocial;

use App\Models\Campaign;
use App\Models\User;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Gate;

class PsychosocialController
{
    public function dashboard(?Campaign $campaign = null)
    {
        if($campaign) Gate::forUser(AuthenticationService::user())->authorize('psychosocialDashboard', $campaign);
        return view('private.psychosocial.dashboard.index', ['campaign'=> $campaign]);
    }

    public function indicators()
    {
        Gate::forUser(AuthenticationService::user())->authorize('psychosocialIndicators', [User::class]);
        return view('private.psychosocial.indicator.index');
    }

    public function absences()
    {
        Gate::forUser(AuthenticationService::user())->authorize('psychosocialIndicators', [User::class]);
        return view('private.psychosocial.absence.index');
    }

    public function controlActions()
    {
        Gate::forUser(AuthenticationService::user())->authorize('psychosocialControlActions', [User::class]);
        return view('private.psychosocial.control-action.index');
    }
}
