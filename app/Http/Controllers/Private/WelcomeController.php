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
        $companyManager = session('auth:company')->users()->wherePivot('role_id', RoleEnum::MANAGER->value)->exists();
        $companyMetrics = session('auth:company')->usesHSE()
                ? session('auth:company')->CIDAbsences()->exists()    
                : session('auth:company')->proartIndicators()->where('value', '!=', null)->exists();
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
        return view('private.welcome.user');
    }
}
