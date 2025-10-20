<?php

namespace App\Services;

use App\Enums\HSE\HSERisk;
use App\Models\Hazard;
use App\Services\User\UserFilterService;

class HSEService
{
    public static function dashboard()
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());
        
        $campaign = session('auth:company')->latestPsychosocialCampaign();
        $hazards = $campaign->collection()->hazards()->with('cids')->get()->groupBy('group');
       
        $dashboard = $campaign->collection()
                                ->questions()
                                ->withAvg([
                                    'answers as average' => function ($query) use ($campaign) {
                                        $query->where('campaign_id', $campaign->id)->whereHas('user', fn($user) => UserFilterService::apply($user));
                                    }
                                ], 'value')
                                ->get()
                                ->groupBy('group')
                                ->mapWithKeys(function($questions, $group) use($hazards) {
                                    $questionAverages = $questions->pluck('average');
                                    $groupScore = $questionAverages->sum() / $questionAverages->count();
                                    
                                    $groupRisks = $hazards[$group]->mapWithKeys(fn($hazard) => 
                                        [$hazard->type => HSERiskService::evaluate($hazard, $groupScore)['evaluated']]
                                    );
                                    
                                    return [$group => $groupRisks];
                                });                            
        return $dashboard;
    }

    public static function departments(Hazard $hazard)
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $departments = $campaign->collection()
                                ->questions()
                                ->where('group', $hazard->group)
                                ->with(['answers' => fn($q) => 
                                    $q->where('campaign_id', session('auth:company')->latestPsychosocialCampaign()->id)
                                        ->with('user')
                                ])
                                ->get()
                                ->flatMap(fn($question) => $question->answers)
                                ->groupBy(['user.department', 'user.id'])
                                ->mapWithKeys(function($users, $department) use($hazard) { // Calcula o risco de cada usuário
                                    $userEvaluated = $users->mapWithKeys(function($answers, $user) use($hazard) {
                                        $userScore = $answers->sum('value') / $answers->count();
                                        $evaluated = HSERiskService::evaluate($hazard, $userScore);

                                        return [$user => $evaluated['evaluated']];
                                    });

                                    return [$department => $userEvaluated];
                                })
                                ->map(function ($departmentUsers) { // Agrupa por risco
                                    return $departmentUsers->sortByDesc(fn($risk) => $risk->value)
                                        ->groupBy(fn($risk) => $risk->label())
                                        ->map(function ($users) use ($departmentUsers) { // Calcula a porcentagem
                                            return floor(($users->count() / $departmentUsers->count()) * 100);
                                        });
                                });
        return $departments;
    }

    public static function list(Hazard $hazard, string $department)
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $list = $campaign->collection()
                                ->questions()
                                ->with(['answers' => fn($q) => 
                                    $q->where('campaign_id', session('auth:company')->latestPsychosocialCampaign()->id)
                                        ->with('user:id,department,occupation')
                                        ->whereHas('user', fn($u) => $u->where('department', $department))
                                ])
                                ->get()
                                ->flatMap(fn($question) => $question->answers)
                                ->groupBy('user.id')
                                ->map(function($answers, $user) use($hazard) {
                                    $userScore = round($answers->sum('value') / $answers->count(), 1);
                                    $evaluated = HSERiskService::evaluate($hazard, $userScore);

                                    $user = $answers->first()->user;
                                    $user->setRelation('evaluated', $evaluated['evaluated']);
                                    
                                    return $user;
                                })
                                ->sortByDesc(fn($user) => $user->evaluated->value);
        return $list;
    }

    public static function risks($onlyHigh = false)
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());
      
        $campaign = session('auth:company')->latestPsychosocialCampaign();
        $hazards = $campaign->collection()->hazards->groupBy('group');
       
        $evaluatedRisks = $campaign->collection()
                                ->questions()
                                ->withAvg([
                                    'answers as average' => function ($query) use ($campaign) {
                                        $query->where('campaign_id', $campaign->id)->whereHas('user', fn($user) => UserFilterService::apply($user));
                                    }
                                ], 'value')
                                ->get()
                                ->groupBy('group')
                                ->mapWithKeys(function($questions, $group) use($hazards, $onlyHigh) {
                                    $questionAverages = $questions->pluck('average');
                                    $groupScore = $questionAverages->sum() / $questionAverages->count();
                                    
                                    $groupRisks = $hazards[$group]->mapWithKeys(function ($hazard) use($groupScore) {
                                        $evaluated = HSERiskService::evaluate($hazard, $groupScore);
                                        return [$hazard->type => [
                                            'risk' => $evaluated,
                                            'control_actions' => session('auth:company')->actionPlan
                                                                                ->controlActions
                                                                                ->where('hazard_id', $hazard->id)
                                                                                ->where('gravity', $evaluated['evaluated']->value)
                                        ]];
                                    })
                                    ->filter(fn($hazard) => 
                                        $onlyHigh 
                                        ? $hazard['risk']['evaluated'] === HSERisk::SUBSTANTIAL || $hazard['risk']['evaluated'] === HSERisk::INTOLERABLE 
                                        : $hazard
                                    ); // Filtra só os altos e críticos;
                                    
                                    return [$group => $groupRisks];
                                })
                                ->filter(fn($group) => $group->isNotEmpty()); // Filtra os grupos com riscos substancial ou intolerável;       

        return $evaluatedRisks;
    }

    public static function participation()
    {
        $companyUsers = UserFilterService::apply(session('auth:company')->users())->get()
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
        return 4 - $score;
    }
}
