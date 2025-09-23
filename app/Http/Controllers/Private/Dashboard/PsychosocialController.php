<?php

namespace App\Http\Controllers\Private\Dashboard;

use App\Models\Risk;
use App\Services\PsychosocialService;
use App\Services\User\UserFilterService;
use Illuminate\Http\Request;

class PsychosocialController
{
    public function dashboard()
    {
        return view('private.dashboard.psychosocial.index', [
            'dashboard' => session('auth:company')->latestPsychosocialCampaign() ? PsychosocialService::dashboard() : false,
            'participation' => session('auth:company')->latestPsychosocialCampaign() ? PsychosocialService::participation() : false,
            'filters' => collect(request()->query())->filter()
        ]);
    }

    public function departments(Risk $risk)
    {
        return view('private.dashboard.psychosocial.index', [
            'departments' => PsychosocialService::departments($risk),
        ]);
    }
    
    public function list()
    {}
}
