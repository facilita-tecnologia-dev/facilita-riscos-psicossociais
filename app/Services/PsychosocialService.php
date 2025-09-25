<?php

namespace App\Services;

use App\Enums\FinalRiskTypes;
use App\Enums\RiskTypes;
use App\Models\Risk;
use App\Services\User\UserFilterService;

class PsychosocialService
{
    public static function dashboard()
    {
        session('auth:company', [session('auth:company')->load(['metrics', 'reports'])]);

        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $groupedRisks = $campaign->collection()->risks()
            ->with([
                'questions' => function ($q) use ($campaign) {
                    $q->withAvg([
                        'answers as average' => function ($query) use ($campaign) {
                            $query->where('campaign_id', $campaign->id)->whereHas('user', fn($user) => UserFilterService::apply($user));
                        }
                    ], 'value');
                }
            ])
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
    
                $evaluated = RiskService::evaluate(RiskTypes::from($risk->type), $riskAverage);
                
                return [$risk->type => $evaluated];
            });

            return [$group => $groupEvaluated];
        });

        return $dashboard;
    }

    public static function departments(Risk $risk)
    {
        session('auth:company', [session('auth:company')->load(['metrics', 'reports'])]);

        $departments = $risk->questions()
            ->with(['answers' => fn($q) => 
                $q->where('campaign_id', session('auth:company')->latestPsychosocialCampaign()->id)
                    ->with('user')
            ])
            ->get()
            ->flatMap(fn($question) => $question->answers)
            ->groupBy(['user.department', 'user.id'])
            ->mapWithKeys(function($user, $department) use($risk) { // Calcula o risco de cada usuário
                $userEvaluated = $user->mapWithKeys(function($answers, $user) use($risk) {
                    $average = round($answers->sum('value') / $answers->count(), 1);
                    $evaluated = RiskService::evaluate(RiskTypes::from($risk->type), $average);

                    return [$user => $evaluated];
                });

                return [$department => $userEvaluated];
            })
            ->map(function ($items) { // Agrupa por risco
                return $items->sortByDesc(fn($enum) => $enum->value) // Ordena os níveis de risco
                            ->groupBy(fn($enum) => $enum->label()) // Agrupa por nível de risco
                            ->map(function ($users) use ($items) { // Calcula a porcentagem
                                return floor(($users->count() / $items->count()) * 100);
                            });
            });


        return $departments;
    }

    public static function list(Risk $risk, string $department)
    {
        session('auth:company', [session('auth:company')->load(['metrics', 'reports'])]);

        $list = $risk->questions()
            ->with(['answers' => fn($q) => 
                $q->where('campaign_id', session('auth:company')->latestPsychosocialCampaign()->id)
                    ->with('user:id,department,occupation')
                    ->whereHas('user', fn($u) => $u->where('department', $department))
            ])
            ->get()
            ->flatMap(fn($question) => $question->answers)
            ->groupBy('user.id')
            ->map(function($answers, $user) use($risk) {
                $average = round($answers->sum('value') / $answers->count(), 1);
                $evaluated = RiskService::evaluate(RiskTypes::from($risk->type), $average);

                $user = $answers->first()->user;
                $user->setRelation('evaluated', $evaluated);
                
                return $user;
            })
            ->sortByDesc(fn($user) => $user->evaluated->value);

        return $list;
    }

    public static function risks()
    {
        session('auth:company', [session('auth:company')->load(['metrics', 'reports'])]);

        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $groupedRisks = $campaign->collection()->risks()
            ->with([
                'questions' => function ($q) use ($campaign) {
                    $q->withAvg([
                        'answers as average' => function ($query) use ($campaign) {
                            $query->where('campaign_id', $campaign->id)->whereHas('user', fn($user) => UserFilterService::apply($user));
                        }
                    ], 'value');
                },
                'controlActions'
            ])
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
    
                $evaluated = RiskService::evaluate(RiskTypes::from($risk->type), $riskAverage);
                
                return [$risk->type => [
                    'evaluated' => $evaluated,
                    // 'control_actions' => $risk->controlActions
                    'control_actions' => [
                        'oi',
                        'tchau'
                    ]
                ]];
            })
            ->filter(fn($risk) => $risk['evaluated'] === FinalRiskTypes::HIGH ||
                                 $risk['evaluated'] === FinalRiskTypes::CRITICAL); // Filtra só os altos e críticos

            return [$group => $groupEvaluated];
        });

        return $dashboard;
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

    public static function invertAnswerScore(float $score)
    {
        return 6 - $score;
    }
}
