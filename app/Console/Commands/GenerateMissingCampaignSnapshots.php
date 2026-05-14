<?php

namespace App\Console\Commands;

use App\Actions\Private\Campaign\SnapshotCampaignEngagementAction;
use App\Enums\Campaign\CampaignStatus;
use App\Models\Campaign;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateMissingCampaignSnapshots extends Command
{
    protected $signature = 'campaigns:generate-missing-snapshots';
    protected $description = 'Generate missing engagement snapshots';

    public function handle(): void
    {
        Campaign::query()
            ->where('status', CampaignStatus::COMPLETED)
            ->whereNull('engagement_percentage')
            ->chunkById(100, function ($campaigns) {
                foreach ($campaigns as $campaign) {
                    try {
                        app(SnapshotCampaignEngagementAction::class)->execute($campaign->company, $campaign);
                        $this->info("Snapshot gerado para campanha {$campaign->id}");
                    } catch (\Throwable $th) {
                        Log::error('Erro ao gerar snapshot da campanha', ['campaign_id' => $campaign->id, 'error' => $th->getMessage(),]);
                        $this->error("Erro campanha {$campaign->id}");
                    }
                }
            });
    }
}
