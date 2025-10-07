<?php

namespace App\Jobs;

use App\Enums\CampaignStatus;
use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateCampaignStatusJob implements ShouldQueue
{
    use Queueable;

    protected Campaign $campaign;
    protected CampaignStatus $status;

    public function __construct(Campaign $campaign, CampaignStatus $status)
    {
        $this->campaign = $campaign;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->status === CampaignStatus::IN_PROGRESS && $this->campaign->start_date->isSameMinute(now())) $this->campaign->status = $this->status->value;
        if($this->status === CampaignStatus::COMPLETED && $this->campaign->end_date->isSameMinute(now())) $this->campaign->status = $this->status->value;
        
        $this->campaign->save();
    }
}
