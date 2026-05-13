<?php

namespace App\Services\Psychosocial;

use App\Enums\Campaign\EvaluationTypes;
use App\Jobs\GeneratePsychosocialReportJob;
use App\Models\Campaign;
use Illuminate\Support\Facades\Cache;

class PsychosocialService
{
    public static function dashboard(Campaign $campaign, string $evaluation_type, ?string $element = null, array $filters = [])
    {
        if(!$campaign->userCollections()->count()) return collect();
        
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $allowedDepartments = [];

        if (session('auth:guard') === 'user') {
            $allowedDepartments = session('auth:user')->getDepartmentScopes(session('auth:user'));
        }

        $dashboard = $evaluation_type === EvaluationTypes::DEPARTMENT->value 
                        ? (session('auth:company')->usesHSE() ? self::HSEDepartments($campaign, $element, $allowedDepartments, $filters) : self::PROARTDepartments($campaign, $element, $allowedDepartments, $filters)) 
                        : (session('auth:company')->usesHSE() ? self::HSEOccupations($campaign, $element, $allowedDepartments, $filters) : self::PROARTOccupations($campaign, $element, $allowedDepartments, $filters));

        return $dashboard;
    }

    public static function report(Campaign $campaign, string $evaluation_type, string $format, string $cache_key)
    {
        if(!$campaign->userCollections()->count()) return collect();

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

    public static function HSEDepartments(Campaign $campaign, ?string $element = null, ?array $allowedDepartments = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['actionPlan', 'CIDAbsences'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->when(
                            session('auth:guard') === 'user',
                            fn($q) => self::filterDepartmentScopes($q, $allowedDepartments, session('auth:company')->id, $campaign->id),
                            fn($q) => $q->with(['answers' => fn($a) =>
                                    $a->where('campaign_id', $campaign->id)->where('company_id', session('auth:company')->id)->with('user')
                            ])
                        )
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

    public static function HSEOccupations(Campaign $campaign, ?string $element = null, ?array $allowedDepartments = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['actionPlan', 'CIDAbsences'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->when(
                            session('auth:guard') === 'user',
                            fn($q) => self::filterDepartmentScopes($q, $allowedDepartments, session('auth:company')->id, $campaign->id),
                            fn($q) => $q->with(['answers' => fn($a) =>
                                    $a->where('campaign_id', $campaign->id)->where('company_id', session('auth:company')->id)->with('user')
                            ])
                        )
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

    public static function PROARTDepartments(Campaign $campaign, ?string $element = null, ?array $allowedDepartments = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->when(
                            session('auth:guard') === 'user',
                            fn($q) => self::filterDepartmentScopes($q, $allowedDepartments, session('auth:company')->id, $campaign->id),
                            fn($q) => $q->with(['answers' => fn($a) =>
                                    $a->where('campaign_id', $campaign->id)->where('company_id', session('auth:company')->id)->with('user')
                            ])
                        )
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

    public static function PROARTOccupations(Campaign $campaign, ?string $element = null, ?array $allowedDepartments = null, ?array $filters = null)
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->when(
                            session('auth:guard') === 'user',
                            fn($q) => self::filterDepartmentScopes($q, $allowedDepartments, session('auth:company')->id, $campaign->id),
                            fn($q) => $q->with(['answers' => fn($a) =>
                                    $a->where('campaign_id', $campaign->id)->where('company_id', session('auth:company')->id)->with('user')
                            ])
                        )
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
        $allowedDepartments = [];

        if (session('auth:guard') === 'user') {
            $allowedDepartments = session('auth:user')->getDepartmentScopes(session('auth:user'));
        }

        $companyUsers = session('auth:company')
            ->activeUsers()
            ->when(
                session('auth:guard') === 'user',
                fn ($query) => $query->whereIn('department', $allowedDepartments)->whereNotNull('department')->where('department', '!=', '')
            )
            ->select('users.id', 'users.department', 'users.occupation')
            ->get();

        $respondentIds = $campaign
            ->userCollections()
            ->pluck('user_id')
            ->flip();


        if ($evaluation_type === EvaluationTypes::DEPARTMENT->value) {
            $companyUsersDivided = $companyUsers->groupBy('department');
        }

        if ($evaluation_type === EvaluationTypes::OCCUPATION->value) {
            $companyUsersDivided = $companyUsers->groupBy('occupation');
        }
        
        $engagementDivided = [];

        foreach ($companyUsersDivided as $divisionFactor => $users) {
            $totalDividedUsers = $users->count();
            $totalRespondents = $users->filter(fn ($user) => isset($respondentIds[$user->id]))->count();

            $percent = $totalDividedUsers > 0 ? floor(($totalRespondents / $totalDividedUsers) * 100) : 0;

            $engagementDivided[$divisionFactor] = [
                'total_users' => $totalDividedUsers,
                'respondents' => $totalRespondents,
                'engagement' => $percent,
            ];
        }

        $totalCompanyUsers = array_sum(array_column($engagementDivided, 'total_users'));
        $totalCompanyRespondents = array_sum(array_column($engagementDivided, 'respondents'));

        $generalEngagement = $totalCompanyUsers > 0 ? floor(($totalCompanyRespondents / $totalCompanyUsers) * 100) : 0;

        return collect([
            'general' => $generalEngagement,
            'divided' => collect($engagementDivided)->sortByDesc('engagement')->toArray()
        ]);
    }

    public static function filterDepartmentScopes($query, array $allowedDepartments, int $company_id, int $campaign_id)
    {
        return $query
            ->whereHas('answers', function ($a) use ($company_id, $campaign_id, $allowedDepartments) {
                $a->where('company_id', $company_id)
                ->where('campaign_id', $campaign_id)
                ->whereHas('user', function ($u) use ($allowedDepartments) {
                    $u->whereIn('department', $allowedDepartments)
                        ->whereNotNull('department')
                        ->where('department', '!=', '');
                });
            })
            ->with([
                'answers' => function ($a) use ($company_id, $campaign_id, $allowedDepartments) {
                    $a->where('company_id', $company_id)
                    ->where('campaign_id', $campaign_id)
                    ->whereHas('user', function ($u) use ($allowedDepartments) {
                        $u->whereIn('department', $allowedDepartments)
                            ->whereNotNull('department')
                            ->where('department', '!=', '');
                    })
                    ->with([
                        'user' => fn($u) =>
                            $u->whereIn('department', $allowedDepartments)
                                ->whereNotNull('department')
                                ->where('department', '!=', ''),
                    ]);
                }
            ]);
    }
}
