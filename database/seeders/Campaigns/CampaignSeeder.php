<?php

namespace Database\Seeders\Campaigns;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Campaign\CampaignStatus;
use App\Enums\Campaign\CollectionCategory;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function($company){
            $psychosocialCampaign = $company->campaigns()->create([
                'collection_id' => $company->psychosocial_collection_type === MetodologyType::HSE->value ? '2' : '1',
                'type' => CollectionCategory::BASE,
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

            $organizationalCampaign = $company->campaigns()->create([
                'collection_id' => '3',
                'type' => CollectionCategory::BASE,
                'name' => 'Campanha de Clima Organizacional',
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

            $company->users()->each(function($user) use ($psychosocialCampaign, $organizationalCampaign, $company) {
                $willAnswer = rand(0, 1);

                if ($willAnswer) {
                    $psychosocialUserCollection = $psychosocialCampaign->userCollections()->create([
                        'user_id' => $user->id,
                        'company_id' => $company->id,
                        'collection_id' => $psychosocialCampaign->collection_id,
                        'type' => CollectionCategory::BASE,
                        'created_at' => Carbon::createFromTimestamp(
                            rand(
                                Carbon::create(now()->year, 6, 31)->timestamp,
                                Carbon::create(now()->year, 8, 31)->timestamp,
                            )
                        )
                    ]);
                    
                    $psychosocialCampaign->collection()->questions->each(function($question) use ($psychosocialUserCollection, $user, $company, $psychosocialCampaign) {
                        $psychosocialUserCollection->answers()->create([
                            'user_id' => $user->id,
                            'company_id' => $company->id,
                            'campaign_id' => $psychosocialCampaign->id,
                            'question_id' => $question->id,
                            'question_type' => CollectionCategory::BASE,
                            'value' => rand(1, 5)
                        ]);
                    });


                    $organizationalUserCollection = $organizationalCampaign->userCollections()->create([
                        'user_id' => $user->id,
                        'company_id' => $company->id,
                        'collection_id' => $organizationalCampaign->collection_id,
                        'type' => CollectionCategory::BASE,
                        'created_at' => Carbon::createFromTimestamp(
                            rand(
                                Carbon::create(now()->year, 6, 31)->timestamp,
                                Carbon::create(now()->year, 8, 31)->timestamp,
                            )
                        )
                    ]);
                    
                    $organizationalCampaign->collection()->questions->each(function($question) use ($organizationalUserCollection, $user, $company, $organizationalCampaign) {
                        $organizationalUserCollection->answers()->create([
                            'user_id' => $user->id,
                            'company_id' => $company->id,
                            'campaign_id' => $organizationalCampaign->id,
                            'question_id' => $question->id,
                            'question_type' => CollectionCategory::BASE,
                            'value' => rand(1, 5)
                        ]);
                    });
                }
            });
        });
    }
}
