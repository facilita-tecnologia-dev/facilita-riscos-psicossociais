<?php

namespace App\Repositories;

use App\Enums\CampaignStatusTypes;
use App\Enums\CollectionTypes;
use App\Jobs\UpdateCampaignStatusJob;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CampaignRepository
{
    public function store(array $data): Campaign
    {
        return DB::transaction(function () use ($data) {
            $collectionInfo = explode('_', $data['collection_id']);
            $collectionType = $collectionInfo[0];
            $collectionID = $collectionInfo[1];
  
            $campaign = session('auth:company')->campaigns()->create([
                'collection_id' => $collectionID,
                'type' => CollectionTypes::from($collectionType)->value,
                'name' => $data['name'],
                'description' => $data['description'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'status' => CampaignStatusTypes::SCHEDULED
            ]);

            UpdateCampaignStatusJob::dispatch($campaign, CampaignStatusTypes::IN_PROGRESS)->delay(Carbon::parse($data['start_date']));
            UpdateCampaignStatusJob::dispatch($campaign, CampaignStatusTypes::COMPLETED)->delay(Carbon::parse($data['end_date']));

            session(['company' => session('auth:company')->load('campaigns')]);

            return $campaign;
        });
    }

    public function update(Campaign $campaign, array $data): Campaign
    {
        // DB::table('jobs')    
        // ->where('payload', 'like', "%update-campaign-status-{$campaign->id}%")
        // ->delete();

        return DB::transaction(function () use ($campaign, $data) {
            $collectionInfo = explode('_', $data['collection_id']);
            $collectionType = $collectionInfo[0];
            $collectionID = $collectionInfo[1];

            $campaign->update([
                'collection_id' => $collectionID,
                'type' => CollectionTypes::from($collectionType)->value,
                'name' => $data['name'],
                'description' => $data['description'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ]);

            UpdateCampaignStatusJob::dispatch($campaign, CampaignStatusTypes::IN_PROGRESS)->delay(Carbon::parse($data['start_date']));
            UpdateCampaignStatusJob::dispatch($campaign, CampaignStatusTypes::COMPLETED)->delay(Carbon::parse($data['end_date']));

            session(['company' => session('auth:company')->load('campaigns')]);
            
            return $campaign;
        });
    }

    public function destroy(Campaign $campaign): mixed
    {
        return $campaign->delete();
    }
}
