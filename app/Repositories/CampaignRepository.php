<?php

namespace App\Repositories;

use App\Enums\Campaign\CampaignStatus;
use App\Enums\Campaign\CollectionCategory;
use App\Jobs\UpdateCampaignStatusJob;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CampaignRepository
{
    public static function store(array $data): mixed
    {
        return DB::transaction(function() use($data) {
            [$collection_type, $collection_id] = explode('_', $data['collection_id']);

            $campaign = session('auth:company')->campaigns()->create([
                'collection_id' => $collection_id,
                'type' => CollectionCategory::from($collection_type)->value,
                'name' => $data['name'],
                'description' => $data['description'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'status' => CampaignStatus::SCHEDULED
            ]);

            UpdateCampaignStatusJob::dispatch(session('auth:company'), $campaign, CampaignStatus::IN_PROGRESS)->delay(Carbon::parse($data['start_date']));
            UpdateCampaignStatusJob::dispatch(session('auth:company'), $campaign, CampaignStatus::COMPLETED)->delay(Carbon::parse($data['end_date']));
        });
    }

    public static function update(Campaign $campaign, array $data): mixed
    {
        return DB::transaction(function () use ($campaign, $data) {
            $campaign->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ]);

            UpdateCampaignStatusJob::dispatch(session('auth:company'), $campaign, CampaignStatus::IN_PROGRESS)->delay(Carbon::parse($data['start_date']));
            UpdateCampaignStatusJob::dispatch(session('auth:company'), $campaign, CampaignStatus::COMPLETED)->delay(Carbon::parse($data['end_date']));
        });
    }

    public static function delete(Campaign $campaign): mixed
    {
        return DB::transaction(function () use ($campaign) {
            $campaign->delete();
        });
    }
}
