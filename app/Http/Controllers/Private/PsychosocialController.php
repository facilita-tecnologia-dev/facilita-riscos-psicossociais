<?php

namespace App\Http\Controllers\Private;

use App\Models\Hazard;
use App\Services\PsychosocialReportService;
use App\Services\PsychosocialService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class PsychosocialController
{
    public function dashboard()
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || !session('auth:company')->latestPsychosocialCampaign()->userCollections()->exists()) return back();
        
        return view('private.dashboard.psychosocial.index', [
            'dashboard' => session('auth:company')->latestPsychosocialCampaign() ? PsychosocialService::dashboard() : false,
            'participation' => session('auth:company')->latestPsychosocialCampaign() ? PsychosocialService::participation() : false,
            'filters' => collect(request()->query())->filter()
        ]);
    }

    public function departments(Risk $risk)
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();
        
        return view('private.dashboard.psychosocial.department', [
            'risk' => $risk,
            'departments' => PsychosocialService::departments($risk),
        ]);
    }
    
    public function list(Risk $risk, string $department)
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();
        
        return view('private.dashboard.psychosocial.list', [
            'risk' => $risk,
            'department' => $department,
            'list' => PsychosocialService::list($risk, $department),
        ]);
    }

    public function risks()
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();

        return view('private.dashboard.psychosocial.risks', [
            'risks' => PsychosocialService::risks(onlyHigh: true),
        ]);
    }

    public function report(string $type, string $format)
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();

        return PsychosocialReportService::report($type, $format);
    }
}
