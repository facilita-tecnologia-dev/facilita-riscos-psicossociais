<?php

namespace App\Jobs;

use App\Actions\Private\Campaign\SnapshotCampaignEngagementAction;
use App\Enums\Campaign\CampaignStatus;
use App\Models\Campaign;
use App\Models\Company;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateCampaignStatusJob implements ShouldQueue
{
    use Queueable;

    protected Company $company;
    protected Campaign $campaign;
    protected CampaignStatus $status;

    public function __construct(Company $company, Campaign $campaign, CampaignStatus $status)
    {
        $this->company = $company;
        $this->campaign = $campaign;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->status === CampaignStatus::IN_PROGRESS && $this->campaign->start_date->isSameMinute(now())) {
            $this->campaign->status = $this->status->value;
        }

        if($this->status === CampaignStatus::COMPLETED && $this->campaign->end_date->isSameMinute(now())) {
            $this->campaign->status = $this->status->value;

            $this->campaign->load('company');

            app(SnapshotCampaignEngagementAction::class)->execute($this->company, $this->campaign);
        } 
        
        $this->campaign->save();
    }
}
