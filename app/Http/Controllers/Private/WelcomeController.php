<?php

namespace App\Http\Controllers\Private;

use App\Enums\RoleEnum;

class WelcomeController
{
    public function welcomeCompany()
    {
        $neededActions = true;
        $currentStep = 1;
        
        $companyLogo = session('auth:company')->logo;
        $companyUsers = session('auth:company')->users->count();
        $companyManager = session('auth:company')->roles->where('type', RoleEnum::MANAGER->value)->isNotEmpty();
        $companyMetrics = session('auth:company')->metrics()->where('value', '!=', null)->exists();
        $campaigns = session('auth:company')->campaigns()->exists();

        if($companyLogo){$currentStep++;}
        if($companyUsers){$currentStep++;}
        if($companyManager){$currentStep++;}
        if($companyMetrics){$currentStep++;}
        if($campaigns){$neededActions = false;}

        return view('private.welcome.company', [
            'neededActions' => $neededActions,
            'currentStep' => $currentStep,
        ]);
    }

    public function welcomeUser()
    {
        $hasAnsweredPsychosocial = session('auth:user')->collections->where('campaign_id',  session('auth:company')->latestPsychosocialCampaign()?->id)->isNotEmpty();
        $hasAnsweredOrganizational = session('auth:user')->collections->where('campaign_id',  session('auth:company')->latestOrganizationalCampaign()?->id)->isNotEmpty();

        return view('private.welcome.user', compact('hasAnsweredPsychosocial', 'hasAnsweredOrganizational'));
    }

}
