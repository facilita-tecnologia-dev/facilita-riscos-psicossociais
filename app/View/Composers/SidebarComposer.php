<?php

namespace App\View\Composers;

use App\Enums\CampaignStatusTypes;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view): void
    {
        if (session('auth:guard') === 'user') {
            $companies = session('auth:user')->companies->map(fn($company) => ['id' => $company->id, 'name' => $company->name]);

            $hasActivePsychosocialCampaign = session('auth:company')->hasCampaignThisYear(1, CampaignStatusTypes::IN_PROGRESS->value);
            $hasActiveOrganizationalCampaign = session('auth:company')->hasCampaignThisYear(2, CampaignStatusTypes::IN_PROGRESS->value);
            
            $hasAnsweredPsychosocial = session('auth:user')->collections->where('campaign_id',  session('auth:company')->latestPsychosocialCampaign()?->id)->isNotEmpty();
            $hasAnsweredOrganizational = session('auth:user')->collections->where('campaign_id',  session('auth:company')->latestOrganizationalCampaign()?->id)->isNotEmpty();
           
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
