<?php

namespace App\Services;

use App\Models\Risk;
use App\Services\User\UserFilterService;

class PsychosocialService
{
    public static function dashboard()
    {
        session('auth:company', [session('auth:company')->load('metrics')]);

        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $groupedRisks = $campaign->collection()->risks()
            ->withQuestionAvg($campaign)
            ->get()
            ->groupBy('group');


        $dashboard = $groupedRisks->mapWithKeys(function($risks, $group) {
            $groupEvaluated = $risks->mapWithKeys(function($risk) {                
                $questionAverages = $risk->questions
                                        ->each(fn($question) => $question->inverted 
                                            ? $question->average = self::invertAnswerScore($question->average) 
                                            : $question)
                                        ->pluck('average');

                $riskAverage = round($questionAverages->sum() / $questionAverages->count(), 1);
    
                $evaluated = RiskService::evaluate($risk, $riskAverage);
                
                return [$risk->type => $evaluated];
            });

            return [$group => $groupEvaluated];
        });

        return $dashboard;
    }

    public static function departments(Risk $risk)
    {
        session('auth:company', [session('auth:company')->load('metrics')]);

        $campaign = session('auth:company')->latestPsychosocialCampaign();

        // $groupedRisks = $campaign->collection()->risks()
        //     ->with('questions', fn($query) => 
        //         $query->with('answers', fn($q) => 
        //             $q->where('campaign_id', $campaign->id)
        //         )
        //     )
        //     ->get()
        //     ->groupBy('group');

        $groupedRisks = $campaign->collection()->risks()
            ->with(['questions' => function ($query) use ($campaign) {
                $query->with(['answers' => function ($q) use ($campaign) {
                    $q->from('user_answers')
                    ->select('question_id')
                    ->selectRaw('AVG(user_answers.value) as average, users.department')
                    ->join('users', 'user_answers.user_id', '=', 'users.id')
                    ->where('user_answers.campaign_id', $campaign->id)
                    ->groupBy('question_id', 'users.department');
                }]);
            }])
            ->get()
            ->groupBy('group');
        
        

        dd($groupedRisks['work-organization'][0]['questions'][0]['answers']->sum('average') / $groupedRisks['work-organization'][0]['questions'][0]['answers']->count());
        // $departments = $groupedRisks->mapWithKeys(function($risks, $group) use($campaign) {
        //     $groupEvaluated = $risks->mapWithKeys(function($risk) use($campaign) {       
        //         dd($risk);
        //         $divided = 

        //         // $questionAverages = $risk->questions
        //         //                         ->each(fn($question) => $question->inverted 
        //         //                             ? $question->average = self::invertAnswerScore($question->average) 
        //         //                             : $question)
        //         //                         ->pluck('average');

        //         // $riskAverage = round($questionAverages->sum() / $questionAverages->count(), 1);
    
        //         // $evaluated = RiskService::evaluate($risk, $riskAverage);
                
        //         // return [$risk->type => $evaluated];
        //     });

        //     return [$group => $groupEvaluated];
        // });

        dd($departments);

        
        dd('departments', $groupedRisks['work-organization'][0]);
    }

    public static function participation()
    {
        $companyUsers = UserFilterService::apply(session('auth:company')->users()->getQuery())->get()
            ->groupBy('department')
            ->map(fn($department) => $department->pluck('id'))
            ->sortKeys();

        $campaignUsers = session('auth:company')->latestPsychosocialCampaign()->userCollections()->whereHas('user', fn($q) => UserFilterService::apply($q))->with('user')->get()
                    ->groupBy('user.department')
                    ->map(fn($department) => $department->pluck('user.id'))
                    ->sortKeys();

        $departmentParticipation = $companyUsers->mapWithKeys(function($users, $department) use($campaignUsers) {
            $users = $users->count();
            $answered = $campaignUsers->get($department, collect())->count();
            
            return [$department => [
                'count' => $answered,
                'percentage' => $users ? ceil(($answered /$users) * 100) : 0,
            ]];
        });

        $globalParticipation = collect(['Geral' => [
            'count' => $departmentParticipation->sum('count'),
            'percentage' => ceil($departmentParticipation->sum('percentage') / $departmentParticipation->count('percentage')),
        ]]);

        return $globalParticipation->merge($departmentParticipation);
    }

    private static function invertAnswerScore(float $score)
    {
        return 6 - $score;
    }
}
