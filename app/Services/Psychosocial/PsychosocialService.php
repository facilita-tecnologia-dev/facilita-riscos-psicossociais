<?php

namespace App\Services\Psychosocial;

use App\Enums\Psychosocial\EvaluationTypes;
use App\Jobs\GeneratePsychosocialReportJob;
use App\Models\Campaign;
use Illuminate\Support\Facades\Cache;

class PsychosocialService
{
    public static function dashboard(Campaign $campaign, string $evaluation_type, ?string $element = null, array $filters = [])
    {
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $dashboard = $evaluation_type === EvaluationTypes::DEPARTMENT->value 
                        ? (session('auth:company')->usesHSE() ? self::HSEDepartments($campaign, $element, $filters) : self::PROARTDepartments($campaign, $element, $filters)) 
                        : (session('auth:company')->usesHSE() ? self::HSEOccupations($campaign, $element, $filters) : self::PROARTOccupations($campaign, $element, $filters));
                
        return $dashboard;
    }

    public static function report(Campaign $campaign, string $evaluation_type, string $format, string $cache_key)
    {
        try {
            $company = session('auth:company');
            $report = $company->actionPlan;

            Cache::forget("{$cache_key}:progress");
            Cache::forget("{$cache_key}:file-path");
            Cache::forget("{$cache_key}:risks");
            Cache::forget("{$cache_key}:absences");
    
            $risks = $evaluation_type === EvaluationTypes::DEPARTMENT->value 
                            ? ($company->usesHSE() ? PsychosocialService::HSEDepartments($campaign, null, null) : PsychosocialService::PROARTDepartments($campaign, null, null)) 
                            : ($company->usesHSE() ? PsychosocialService::HSEOccupations($campaign, null, null) : PsychosocialService::PROARTOccupations($campaign, null, null));
            
            $absences = $evaluation_type === EvaluationTypes::DEPARTMENT->value 
                            ? ($company->usesHSE() ? PsychosocialService::HSEAbsences(EvaluationTypes::DEPARTMENT) : null) 
                            : ($company->usesHSE() ? PsychosocialService::HSEAbsences(EvaluationTypes::OCCUPATION) : null);
    
            Cache::put("{$cache_key}:risks", $risks);
            Cache::put("{$cache_key}:absences", $absences);

            dispatch(new GeneratePsychosocialReportJob($company->id, $report->id, $evaluation_type, $format, $cache_key));
        } catch (\Throwable $th) {
            Cache::forget("{$cache_key}:risks");
            Cache::forget("{$cache_key}:absences");

            throw $th;
        }
    }

    public static function HSEDepartments(Campaign $campaign, ?string $element = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ])
                        ->get()
                        ->groupBy('group')
                        ->when(filled($filters['group'] ?? null), function ($groups) use ($filters) {
                            return $groups->filter(fn($_, $group) => $group === $filters['group']);
                        })
                        ->map(fn($questions) =>
                            $questions->each(fn($question) => 
                                tap($question, function ($q) {
                                    $q->setRelation('answers', $q->answers->groupBy('user.department'));
                                })
                            )
                        )
                        ->mapWithKeys(function($questions, $group) use($hazards, $element, $filters){
                            $groupScore = $questions
                                        ->map(function($question) {
                                            $evaluatedAnswers = $question->answers->mapWithKeys(function($answers, $department) {
                                                $average = round($answers->sum('value') / $answers->count());
                                                return [$department => $average];
                                            });

                                            return $evaluatedAnswers;
                                        })
                                        ->reduce(function ($average, $question) {
                                            foreach ($question as $department => $value) {
                                                $average[$department][] = $value;
                                            }

                                            return $average;
                                        }, []);
                
                            $riskEvaluated = collect($groupScore)
                                        ->when($element, fn ($collection) =>
                                            $collection->filter(fn($_, $department) => $department === $element)
                                        )
                                        ->mapWithKeys(function($averages, $department) use($group, $hazards, $filters) { 
                                            $average = round(collect($averages)->sum() / collect($averages)->count());

                                            $groupRisks = $hazards[$group]->mapWithKeys(function($hazard) use($average, $department, $filters) {
                                                $evaluated = HSERiskService::evaluate($hazard, $average, EvaluationTypes::DEPARTMENT, $department);
                                                
                                                if (filled($filters['risk_level'] ?? null) && $evaluated['evaluated']->value !== $filters['risk_level']) {return [];}

                                                return [$hazard->type => [
                                                    'risk' => $evaluated,
                                                    'control_actions' => session('auth:company')->actionPlan
                                                                                                ->controlActions
                                                                                                ->where('hazard_id', $hazard->id)
                                                                                                ->where('gravity', $evaluated['evaluated']->value)
                                                                                                 ->toArray()
                                                                                            
                                                ]];
                                            });

                                            return [$department => $groupRisks];
                                        }); 
                            return [$group => $riskEvaluated];
                        });

        $evaluatedRisks = collect();

        $risks->each(function ($departments, $group) use ($evaluatedRisks) {
            $departments->each(function ($risks, $department) use ($evaluatedRisks, $group) {
                if (! $evaluatedRisks->has($department)) {
                    $evaluatedRisks->put($department, collect());
                }

                if (! $evaluatedRisks[$department]->has($group)) {
                    $evaluatedRisks[$department]->put($group, collect());
                }

                $risks->each(function ($evaluated, $risk) use ($evaluatedRisks, $department, $group) {
                    $evaluatedRisks[$department][$group][$risk] = $evaluated;
                });
            });
        });

        return $evaluatedRisks;
    }

    public static function HSEOccupations(Campaign $campaign, ?string $element = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ])
                        ->get()
                        ->groupBy('group')
                        ->when(filled($filters['group'] ?? null), function ($groups) use ($filters) {
                            return $groups->filter(fn($_, $group) => $group === $filters['group']);
                        })
                        ->map(fn($questions) =>
                            $questions->each(fn($question) => 
                                tap($question, function ($q) {
                                    $q->setRelation('answers', $q->answers->groupBy('user.occupation'));
                                })
                            )
                        )
                        ->mapWithKeys(function($questions, $group) use($hazards, $element, $filters){
                            $groupScore = $questions
                                        ->map(function($question) {
                                            $evaluatedAnswers = $question->answers->mapWithKeys(function($answers, $occupation) {
                                                $average = round($answers->sum('value') / $answers->count());

                                                return [$occupation => $average];
                                            });

                                            return $evaluatedAnswers;
                                        })
                                        ->reduce(function ($average, $question) {
                                            foreach ($question as $occupation => $value) {
                                                $average[$occupation][] = $value;
                                            }

                                            return $average;
                                        }, []);
                
                            $riskEvaluated = collect($groupScore)
                                        ->when($element, fn ($collection) =>
                                            $collection->filter(fn($_, $occupation) => $occupation === $element)
                                        )
                                        ->mapWithKeys(function($averages, $occupation) use($group, $hazards, $filters) { 
                                            $average = round(collect($averages)->sum() / collect($averages)->count());

                                            $groupRisks = $hazards[$group]->mapWithKeys(function($hazard) use($average, $occupation, $filters) {
                                                $evaluated = HSERiskService::evaluate($hazard, $average, EvaluationTypes::OCCUPATION, $occupation);

                                                if (filled($filters['risk_level'] ?? null) && $evaluated['evaluated']->value !== $filters['risk_level']) {return [];}

                                                return [$hazard->type => [
                                                    'risk' => $evaluated,
                                                    'control_actions' => session('auth:company')->actionPlan
                                                                                                ->controlActions
                                                                                                ->where('hazard_id', $hazard->id)
                                                                                                ->where('gravity', $evaluated['evaluated']->value)
                                                                                                ->toArray()
                                                ]];
                                            });

                                            return [$occupation => $groupRisks];
                                        }); 
                            return [$group => $riskEvaluated];
                        });

        $evaluatedRisks = collect();

        $risks->each(function ($occupations, $group) use ($evaluatedRisks) {
            $occupations->each(function ($risks, $occupation) use ($evaluatedRisks, $group) {
                if (! $evaluatedRisks->has($occupation)) {
                    $evaluatedRisks->put($occupation, collect());
                }

                if (! $evaluatedRisks[$occupation]->has($group)) {
                    $evaluatedRisks[$occupation]->put($group, collect());
                }

                $risks->each(function ($evaluated, $risk) use ($evaluatedRisks, $occupation, $group) {
                    $evaluatedRisks[$occupation][$group][$risk] = $evaluated;
                });
            });
        });

        return $evaluatedRisks;
    }

    public static function HSEAbsences(EvaluationTypes $evaluation_type)
    {
        return session('auth:company')->CIDabsences()->with('cid')->get()->groupBy($evaluation_type->value);
    }

    public static function PROARTDepartments(Campaign $campaign, ?string $element = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ])
                        ->get()
                        ->groupBy('group')
                        ->when(filled($filters['group'] ?? null), function ($groups) use ($filters) {
                            return $groups->filter(fn($_, $group) => $group === $filters['group']);
                        })
                        ->map(fn($questions) =>
                            $questions->each(fn($question) => 
                                tap($question, function ($q) {
                                    $q->setRelation('answers', $q->answers->groupBy('user.department'));
                                })
                            )
                        )
                        ->mapWithKeys(function($questions, $group) use($hazards, $element, $filters){
                            $groupScore = $questions
                                        ->map(function($question) {
                                            $evaluatedAnswers = $question->answers->mapWithKeys(function($answers, $department) {
                                                $average = round($answers->sum('value') / $answers->count());
                                                return [$department => $average];
                                            });

                                            return $evaluatedAnswers;
                                        })
                                        ->reduce(function ($average, $question) {
                                            foreach ($question as $department => $value) {
                                                $average[$department][] = $value;
                                            }

                                            return $average;
                                        }, []);

                            $riskEvaluated = collect($groupScore)
                                        ->when($element, fn ($collection) =>
                                            $collection->filter(fn($_, $department) => $department === $element)
                                        )
                                        ->mapWithKeys(function($averages, $department) use($group, $hazards, $filters) { 
                                            $average = round(collect($averages)->sum() / collect($averages)->count());
                                            $groupRisks = $hazards[$group]->mapWithKeys(function($hazard) use($average, $filters) {
                                                $evaluated = PROARTRiskService::evaluate($hazard, $average);
                                                
                                                if (filled($filters['risk_level'] ?? null) && $evaluated['evaluated']->value !== $filters['risk_level']) {return [];}
    
                                                return [$hazard->type => [
                                                    'risk' => $evaluated,
                                                    'control_actions' =>  session('auth:company')->actionPlan
                                                                                ->controlActions()
                                                                                ->where('hazard_id', $hazard->id)
                                                                                ->where('gravity', $evaluated['evaluated']->value)
                                                                                ->with('type')
                                                                                ->get()
                                                                                ->groupBy('type.type')
                                                                                ->all()
                                                ]];
                                            });

                                            return [$department => $groupRisks];
                                        }); 
                            return [$group => $riskEvaluated];
                        });

        $evaluatedRisks = collect();

        $risks->each(function ($departments, $group) use ($evaluatedRisks) {
            $departments->each(function ($risks, $department) use ($evaluatedRisks, $group) {
                if (! $evaluatedRisks->has($department)) {
                    $evaluatedRisks->put($department, collect());
                }

                if (! $evaluatedRisks[$department]->has($group)) {
                    $evaluatedRisks[$department]->put($group, collect());
                }

                $risks->each(function ($evaluated, $risk) use ($evaluatedRisks, $department, $group) {
                    $evaluatedRisks[$department][$group][$risk] = $evaluated;
                });
            });
        });

        return $evaluatedRisks;
    }

    public static function PROARTOccupations(Campaign $campaign, ?string $element = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ])
                        ->get()
                        ->groupBy('group')
                        ->when(filled($filters['group'] ?? null), function ($groups) use ($filters) {
                            return $groups->filter(fn($_, $group) => $group === $filters['group']);
                        })
                        ->map(fn($questions) =>
                            $questions->each(fn($question) => 
                                tap($question, function ($q) {
                                    $q->setRelation('answers', $q->answers->groupBy('user.occupation'));
                                })
                            )
                        )
                        ->mapWithKeys(function($questions, $group) use($hazards, $element, $filters){
                            $groupScore = $questions
                                        ->map(function($question) {
                                            $evaluatedAnswers = $question->answers->mapWithKeys(function($answers, $occupation) {
                                                $average = round($answers->sum('value') / $answers->count());
                                                return [$occupation => $average];
                                            });

                                            return $evaluatedAnswers;
                                        })
                                        ->reduce(function ($average, $question) {
                                            foreach ($question as $occupation => $value) {
                                                $average[$occupation][] = $value;
                                            }

                                            return $average;
                                        }, []);

                            $riskEvaluated = collect($groupScore)
                                        ->when($element, fn ($collection) =>
                                            $collection->filter(fn($_, $occupation) => $occupation === $element)
                                        )
                                        ->mapWithKeys(function($averages, $occupation) use($group, $hazards, $filters) { 
                                            $average = round(collect($averages)->sum() / collect($averages)->count());
                                            $groupRisks = $hazards[$group]->mapWithKeys(function($hazard) use($average, $filters) {
                                                $evaluated = PROARTRiskService::evaluate($hazard, $average);
                                                
                                                if (filled($filters['risk_level'] ?? null) && $evaluated['evaluated']->value !== $filters['risk_level']) {return [];}

                                                return [$hazard->type => [
                                                    'risk' => $evaluated,
                                                    'control_actions' => session('auth:company')->actionPlan
                                                                                            ->controlActions()
                                                                                            ->where('hazard_id', $hazard->id)
                                                                                            ->where('gravity', $evaluated['evaluated']->value)
                                                                                            ->with('type')
                                                                                            ->get()
                                                                                            ->groupBy('type.type')
                                                                                            ->all()
                                                ]];
                                            });

                                            return [$occupation => $groupRisks];
                                        }); 
                            return [$group => $riskEvaluated];
                        });

        $evaluatedRisks = collect();

        $risks->each(function ($occupations, $group) use ($evaluatedRisks) {
            $occupations->each(function ($risks, $occupation) use ($evaluatedRisks, $group) {
                if (! $evaluatedRisks->has($occupation)) {
                    $evaluatedRisks->put($occupation, collect());
                }

                if (! $evaluatedRisks[$occupation]->has($group)) {
                    $evaluatedRisks[$occupation]->put($group, collect());
                }

                $risks->each(function ($evaluated, $risk) use ($evaluatedRisks, $occupation, $group) {
                    $evaluatedRisks[$occupation][$group][$risk] = $evaluated;
                });
            });
        });

        return $evaluatedRisks;
    }

    public static function engagement(Campaign $campaign, string $evaluation_type)
    {
        if($evaluation_type === EvaluationTypes::DEPARTMENT->value){
            $campaignRespondentsDivided = $campaign->userCollections()->with('user:id,department')->get()->groupBy('user.department');
            $companyUsersDivided = session('auth:company')->users()->select('users.id', 'users.department')->get()->groupBy('department');
        }

        if($evaluation_type === EvaluationTypes::OCCUPATION->value){
            $campaignRespondentsDivided = $campaign->userCollections()->with('user:id,occupation')->get()->groupBy('user.occupation');
            $companyUsersDivided = session('auth:company')->users()->select('users.id', 'users.occupation')->get()->groupBy('occupation');
        }

        $engagementDivided = [];

        foreach($companyUsersDivided as $divisionFactor => $users){
            $totalDividedUsers = $users->count();
            $respondents = $campaignRespondentsDivided[$divisionFactor] ?? collect();
            $totalRespondents = $respondents->count();

            $percent = $totalDividedUsers > 0 ? round(($totalRespondents / $totalDividedUsers) * 100) : 0;

            $engagementDivided[$divisionFactor] = [
                'total_users' => $totalDividedUsers,
                'respondents' => $totalRespondents,
                'engagement' => $percent,
            ];
        }

        $totalCompanyUsers = array_sum(array_column($engagementDivided, 'total_users'));
        $totalCompanyRespondents = array_sum(array_column($engagementDivided, 'respondents'));

        $generalEngagement =  $totalCompanyUsers > 0 ? round(($totalCompanyRespondents / $totalCompanyUsers) * 100) : 0;
        
        return collect([
            'general' => $generalEngagement,
            'divided' => collect($engagementDivided)->sortByDesc('engagement')->toArray()
        ]);
    }

}
