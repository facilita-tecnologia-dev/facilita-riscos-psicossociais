<?php

namespace Database\Seeders\Campaigns;

use App\Enums\CollectionTypes;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function($company){
            $campaign = $company->campaigns()->create([
                'collection_id' => 1,
                'type' => CollectionTypes::BASE,
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
                )
            ]);

            $company->users()->each(function($user) use ($campaign, $company) {
                $willAnswer = rand(0, 1);

                if ($willAnswer) {
                    $userCollection = $campaign->userCollections()->create([
                        'user_id' => $user->id,
                        'company_id' => $company->id,
                        'collection_id' => $campaign->collection_id, // ✅ corrigido
                        'type' => CollectionTypes::BASE,
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
                            'question_type' => CollectionTypes::BASE,
                            'value' => rand(1, 5)
                        ]);
                    });
                }
            });
            // $company->campaigns()->create([
            //     'collection_id' => 1,
            //     'type' => CollectionTypes::BASE,
            //     'name' => 'Campanha de Riscos Psicossociais',
            //     'start_date' => Carbon::createFromTimestamp(
            //         rand(
            //             Carbon::create(now()->year, 3, 1)->timestamp,
            //             Carbon::create(now()->year, 5, 31)->timestamp,
            //         )
            //     ),
            //     'end_date' => Carbon::createFromTimestamp(
            //         rand(
            //             Carbon::create(now()->year, 6, 1)->timestamp,
            //             Carbon::create(now()->year, 8, 31)->timestamp,
            //         )
            //     )
            // ])->each(function($campaign) use($company) {
            //     $company->users()->each(function($user) use($campaign, $company) {
            //         $willAnswer = rand(0, 1);

            //         if($willAnswer){
            //             $userCollection = $campaign->userCollections()->create([
            //                 'user_id' => $user->id,
            //                 'company_id' => $company->id,
            //                 'collection_id' => $campaign->collection_id,
            //                 'type' => CollectionTypes::BASE,
            //                 'score' => rand(1, 5)
            //             ]);
                        
            //             $campaign->collection->questions->each(function($question) use($userCollection, $user, $company, $campaign){
            //                 $userCollection->answers()->create([
            //                     'user_id' => $user->id,
            //                     'company_id' => $company->id,
            //                     'campaign_id' => $campaign->id,
            //                     'question_id' => $question->id,
            //                     'question_type' => CollectionTypes::BASE,
            //                     'value' => rand(1, 5)
            //                 ]);
            //             });
            //         }
            //     });
            // });
        });
    }
}
