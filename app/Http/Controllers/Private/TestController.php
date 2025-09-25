<?php

namespace App\Http\Controllers\Private;

use App\Enums\BaseCollectionTypes;
use App\Models\Campaign;
use App\Services\PsychosocialService;
use App\Services\TestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController
{
    protected $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function show(Campaign $campaign)
    {        
        return view('private.tests.index', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $answers = $request->validate(self::generateValidationRules($campaign));

        if(self::storeCollection($campaign, $answers)){
            session(['auth:user' => session('auth:user')->load('collections')]);
            
            if($campaign->collection()->type === BaseCollectionTypes::ORGANIZATIONAL) return to_route('feedback.create');

            return to_route('complete-tests.thanks');
        }

        return back();
    }

    private static function storeCollection(Campaign $campaign, array $answers): bool
    {
        try {
            DB::transaction(function() use($campaign, $answers) {
                $userCollection = $campaign->userCollections()->create([
                    'user_id' => session('auth:user')->id,
                    'company_id' => session('auth:company')->id,
                    'collection_id' => $campaign->collection_id,
                    'type' => $campaign->type,
                ]);

                $campaign->collection()->questions->each(function($question) use($campaign, $answers, $userCollection) {
                    $userCollection->answers()->create([
                        'user_id' => session('auth:user')->id,
                        'company_id' => session('auth:company')->id,
                        'campaign_id' => $campaign->id,
                        'question_id' => $question->id,
                        'question_type' => $campaign->type,
                        'value' => $answers[$question->id],
                    ]);
                });
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private static function generateValidationRules(Campaign $campaign): array
    {
        return $campaign->collection()->questions->mapWithKeys(fn($question) => [$question->id => 'required|min:1|max:5'])->toArray();
    }   
}
