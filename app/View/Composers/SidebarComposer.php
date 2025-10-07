<?php

namespace App\View\Composers;

use App\Enums\CampaignStatus;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view): void
    {
        if (session('auth:guard') === 'user') {
            $companies = session('auth:user')->companies->map(fn($company) => ['id' => $company->id, 'name' => $company->name]);

            $hasActivePsychosocialCampaign = session('auth:company')->hasCampaignThisYear(session('auth:company')->psychosocialCollection()->id, CampaignStatus::IN_PROGRESS->value);
            $hasActiveOrganizationalCampaign = session('auth:company')->hasCampaignThisYear(session('auth:company')->organizationalCollection()->id, CampaignStatus::IN_PROGRESS->value);
            
            $hasAnsweredPsychosocial = session('auth:user')->hasAnsweredCampaign(session('auth:company')->latestPsychosocialCampaign()?->id);
            $hasAnsweredOrganizational = session('auth:user')->hasAnsweredCampaign(session('auth:company')->latestOrganizationalCampaign()?->id);
            
            $view->with([
                'companies' => $companies,
                'hasAnsweredPsychosocial' => $hasAnsweredPsychosocial,
                'hasAnsweredOrganizational' => $hasAnsweredOrganizational,
                'hasActivePsychosocialCampaign' => $hasActivePsychosocialCampaign,
                'hasActiveOrganizationalCampaign' => $hasActiveOrganizationalCampaign,
            ]);
        }
    }
}
