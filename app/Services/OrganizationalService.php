<?php

namespace App\Services;

use App\Enums\PROART\PROARTRisk;
use App\Enums\PROART\PROARTHazard;
use App\Models\Hazard;
use App\Services\User\UserFilterService;
use Barryvdh\DomPDF\Facade\Pdf;

class OrganizationalService
{
   public static function dashboard()
   {
        $campaign = session('auth:company')->latestOrganizationalCampaign();
        $groupedQuestions = $campaign->collection()->questions()
                                                ->with('answers.user')
                                                ->get()
                                                ->map(function($question) { 
                                                    $question->answers->transform(function ($answer) {
                                                        $answer->value = self::multiplyAnswer($answer->value);
                                                        return $answer;
                                                    });

                                                    $departments = $question->answers->groupBy('user.department')->mapWithKeys(fn($answers, $department) => 
                                                        [$department => $answers->sum('value') / $answers->count()]
                                                    );

                                                    $question->setRelation('answers', $departments);
                                                    
                                                    $question->average = $question->answers->sum() / $question->answers->count();

                                                    return $question;
                                                })
                                                ->groupBy('group');
        // $evaluated = $groupedQuestions->map(fn($group) => 
        // )
        // dd($groupedQuestions);
   }

   private static function multiplyAnswer(int $answer)
   {
        return match($answer){
            1 => 0,
            2 => 25,
            3 => 50,
            4 => 75,
            5 => 100,
        };
   }
}
