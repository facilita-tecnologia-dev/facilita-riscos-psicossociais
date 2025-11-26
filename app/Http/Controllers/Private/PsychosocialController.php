<?php

namespace App\Http\Controllers\Private;

use App\Models\Hazard;
use App\Services\HSEService;
use App\Services\PROARTService;
use App\Services\PsychosocialReportService;
use Illuminate\Support\Facades\Gate;

class PsychosocialController
{
    public function dashboard()
    {
        return view('private.dashboard.psychosocial.index');
    }

    // public function dashboard()
    // {
    //     Gate::authorize('psychosocial-dashboard-view');
    //     if(!session('auth:company')->latestPsychosocialCampaign()  || !session('auth:company')->latestPsychosocialCampaign()->userCollections()->exists()) return back();
        
    //     return view('private.dashboard.psychosocial.index', [
    //         'dashboard' => session('auth:company')->latestPsychosocialCampaign() ? 
    //                     (session('auth:company')->usesHSE() ? HSEService::dashboard() : PROARTService::dashboard()) :
    //                      false,
    //         'participation' => session('auth:company')->latestPsychosocialCampaign() ? HSEService::participation() : false,
    //         'filters' => collect(request()->query())->filter()
    //     ]);
    // }

    public function departments(Hazard $hazard)
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();
        
        return view('private.dashboard.psychosocial.department', [
            'hazard' => $hazard,
            'departments' => session('auth:company')->latestPsychosocialCampaign() ? 
                        (session('auth:company')->usesHSE() ? HSEService::departments($hazard) : PROARTService::departments($hazard)) :
                         false,
        ]);
    }
    
    public function list(Hazard $hazard, string $department)
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();
        
        return view('private.dashboard.psychosocial.list', [
            'hazard' => $hazard,
            'department' => $department,
            'list' => session('auth:company')->latestPsychosocialCampaign() ? 
                    (session('auth:company')->usesHSE() ? HSEService::list($hazard, $department) : PROARTService::list($hazard, $department)) :
                        false,
        ]);
    }

    public function risks()
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();

        return view('private.dashboard.psychosocial.risks', [
            'risks' => session('auth:company')->latestPsychosocialCampaign() ? 
                    (session('auth:company')->usesHSE() ? HSEService::risks(onlyHigh: true) : PROARTService::risks(onlyHigh: true)) :
                        false,
        ]);
    }

    public function report(string $type, string $format)
    {
        Gate::authorize('psychosocial-dashboard-view');
        if(!session('auth:company')->latestPsychosocialCampaign()  || session('auth:company')->latestPsychosocialCampaign()->userCollections->isEmpty()) return back();

        return PsychosocialReportService::report($type, $format);
    }
}
