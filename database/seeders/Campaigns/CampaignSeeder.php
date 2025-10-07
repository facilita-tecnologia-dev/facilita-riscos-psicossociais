<?php

namespace Database\Seeders\Campaigns;

use App\Enums\CampaignStatus;
use App\Enums\CollectionType;
use App\Models\Company;
use App\Services\PsychosocialService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->except(Company::latest('id')->value('id'))->each(function($company){
            $campaign = $company->campaigns()->create([
                'collection_id' => 1,
                'type' => CollectionType::BASE,
                'name' => 'Campanha de Riscos Psicossociais',
                'start_date' => Carbon::createFromTimestamp(
                    rand(
                        Carbon::create(now()->year, 3, 1)->timestamp,
                        Carbon::create(now()->year, 5, 31)->timestamp,
                    )
                ),
                'end_date' => Carbon::createFromTimestamp(
                    rand(
                        Carbon::create(now()->year, 6, 1)->timestamp,
                        Carbon::create(now()->year, 8, 31)->timestamp,
                    )
                ),
                'status' => CampaignStatus::COMPLETED
            ]);

            $company->users()->each(function($user) use ($campaign, $company) {
                $willAnswer = rand(0, 1);

                if ($willAnswer) {
                    $userCollection = $campaign->userCollections()->create([
                        'user_id' => $user->id,
                        'company_id' => $company->id,
                        'collection_id' => $campaign->collection_id, // ✅ corrigido
                        'type' => CollectionType::BASE,
                        'created_at' => Carbon::createFromTimestamp(
                            rand(
                                Carbon::create(now()->year, 6, 31)->timestamp,
                                Carbon::create(now()->year, 8, 31)->timestamp,
                            )
                        )
                    ]);
                    
                    $campaign->collection()->questions->each(function($question) use ($userCollection, $user, $company, $campaign) {
                        $userCollection->answers()->create([
                            'user_id' => $user->id,
                            'company_id' => $company->id,
                            'campaign_id' => $campaign->id,
                            'question_id' => $question->id,
                            'question_type' => CollectionType::BASE,
                            'value' => rand(1, 5)
                        ]);
                    });
                }
            });
        });
    }
}
