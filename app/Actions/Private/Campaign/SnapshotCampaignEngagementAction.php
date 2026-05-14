<?php

namespace App\Actions\Private\Campaign;

use App\Enums\Campaign\EvaluationTypes;
use App\Models\Campaign;
use App\Models\Company;
use App\Services\Psychosocial\PsychosocialService;
use Illuminate\Support\Facades\Log;

class SnapshotCampaignEngagementAction
{
    public function execute(Company $company, Campaign $campaign)
    {
        $engagement = PsychosocialService::engagement($company, $campaign, EvaluationTypes::DEPARTMENT->value);
        $campaign->engagement_percentage = $engagement['general'];    
        $campaign->save();
    }
}