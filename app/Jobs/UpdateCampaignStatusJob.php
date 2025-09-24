<?php

namespace App\Jobs;

use App\Enums\CampaignStatusTypes;
use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateCampaignStatusJob implements ShouldQueue
{
    use Queueable;

    protected Campaign $campaign;
    protected CampaignStatusTypes $status;

    public function __construct(Campaign $campaign, CampaignStatusTypes $status)
    {
        $this->campaign = $campaign;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->status === CampaignStatusTypes::IN_PROGRESS && $this->campaign->start_date->isSameMinute(now())) $this->campaign->status = $this->status->value;
        if($this->status === CampaignStatusTypes::COMPLETED && $this->campaign->end_date->isSameMinute(now())) $this->campaign->status = $this->status->value;
        
        $this->campaign->save();
    }
}
