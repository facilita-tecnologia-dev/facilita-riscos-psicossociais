<?php

namespace App\Services\Organizational;

use App\Enums\Filters\AdmissionRange;
use App\Enums\OC\OCEvaluation;
use App\Enums\OC\OCVisualization;
use App\Jobs\GenerateOrganizationalReportJob;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class OrganizationalService
{
    public static function dashboard(Campaign $campaign, string $evaluation_type, string $visualization_type, array $filters = [])
   {    
        if(!$campaign->userCollections()->count()) return [];

        $allowedDepartments = [];

        if (session('auth:guard') === 'user') {
            $allowedDepartments = session('auth:user')->getDepartmentScopes(session('auth:user'));
        }

        $dashboard = $visualization_type === OCVisualization::GENERAL->value 
                        ? self::OrganizationalGeneral($campaign, $evaluation_type, $allowedDepartments, $filters)
                        : self::OrganizationalAnswers($campaign, $evaluation_type, $allowedDepartments, $filters);

        return $dashboard;
   }

    public static function report(Campaign $campaign, string $evaluation_type, string $visualization_type, string $cache_key)
   {    
        if(!$campaign->userCollections()->count()) return [];

        try {
            $company = session('auth:company');
            
            Cache::forget("{$cache_key}:progress");
            Cache::forget("{$cache_key}:file-path");
            Cache::forget("{$cache_key}:dashboard");

            $allowedDepartments = [];

            if (session('auth:guard') === 'user') {
                $allowedDepartments = session('auth:user')->getDepartmentScopes(session('auth:user'));
            }

            $dashboard = $visualization_type === OCVisualization::GENERAL->value 
                            ? self::OrganizationalGeneral($campaign, $evaluation_type, $allowedDepartments)
                            : self::OrganizationalAnswers($campaign, $evaluation_type, $allowedDepartments);

            Cache::put("{$cache_key}:dashboard", $dashboard);

            dispatch(new GenerateOrganizationalReportJob($company->id, $evaluation_type, $visualization_type, $cache_key));
        } catch (\Throwable $th) {
            Cache::forget("{$cache_key}:risks");
            Cache::forget("{$cache_key}:absences");

             throw $th;
        }
   }

   public static function OrganizationalGeneral(Campaign $campaign, string $evaluation_type, ?array $allowedDepartments = null, ?array $filters = null)
   {
        $allowedDepartments = [];

        if (session('auth:guard') === 'user') {
            $allowedDepartments = session('auth:user')->departmentScopes
                ->where('allowed', 1)
                ->pluck('department')
                ->toArray();
        }

        $results = $campaign->collection()
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
                            tap($question, function ($question) use($evaluation_type) {
                                $transformedAnswers = $question->answers->transform(function ($answer) {
                                    $answer->value = self::multiplyAnswer($answer->value);
                                    return $answer;
                                });

           
                                $groupedAnswers = $transformedAnswers
                                                ->groupBy(function ($answer) use ($evaluation_type) {
                                                    if ($evaluation_type === OCEvaluation::ADMISSION_RANGE->value) {
                                                        return $answer->user->admission ? self::getAdmissionRange($answer->user->admission)->value . ' anos' : "Sem informação";
                                                    }
                                                    return data_get($answer, "user.$evaluation_type");
                                                })
                                                ->mapWithKeys(fn($answers, $divisionFactor) => 
                                                    [$divisionFactor => round($answers->sum('value') / $answers->count())]
                                                )
                                                ->sortKeys();

                                $question->setRelation('answers', $groupedAnswers);

                                $question->average = $question->answers->sum() / $question->answers->count();
                            })
                        )
                    );

        $generalSatisfactionByGroup = $results->mapWithKeys(function($groupQuestions, $group){
            $groupScoreSum = $groupQuestions->reduce(fn($acc, $question) => $acc + $question->average);
            $groupSatisfaction = round($groupScoreSum / $groupQuestions->count());

            return [$group => $groupSatisfaction];
        });

        $divisionFactorSatisfactionByGroup = $results->mapWithKeys(function($groupQuestions, $group){
            $groupDivisionFactorsScoreByQuestion = $groupQuestions->mapWithKeys(fn($question) => [$question->id => $question->answers]);

            $groupSatisfaction = $groupDivisionFactorsScoreByQuestion->reduce(function($acc, $question){
                $acc = $acc instanceof Collection ? $acc : collect($acc);

                foreach ($question as $divisionFactor => $satisfaction) {
                    $generalSatisfactionInThisGroup = $acc->get('Geral', ['sum' => 0, 'count' => 0]);

                    $generalSatisfactionInThisGroup['sum']   += $satisfaction;
                    $generalSatisfactionInThisGroup['count'] += 1;

                    $divisionFactorSatisfaction = $acc->get($divisionFactor, ['sum' => 0, 'count' => 0]);

                    $divisionFactorSatisfaction['sum']   += $satisfaction;
                    $divisionFactorSatisfaction['count'] += 1;

                    $acc->put($divisionFactor, $divisionFactorSatisfaction);
                    $acc->put('Geral', $generalSatisfactionInThisGroup);
                }

                return $acc;
            }, collect())
            ->mapWithKeys(fn ($data, $divisionFactor) => [$divisionFactor => round($data['sum'] / $data['count'])])
            ->sortBy(function ($_, $key) {
                return $key === 'Geral' ? 0 : 1;
            });

            return [$group => $groupSatisfaction];
        });

        return [
            'general-satisfaction-by-group' => $generalSatisfactionByGroup,
            'division-factor-satisfaction-by-group' => $divisionFactorSatisfactionByGroup
        ];
   }

   public static function OrganizationalAnswers(Campaign $campaign, string $evaluation_type, ?array $allowedDepartments = null, ?array $filters = null)
   {
        $allowedDepartments = [];

        if (session('auth:guard') === 'user') {
            $allowedDepartments = session('auth:user')->departmentScopes
                ->where('allowed', 1)
                ->pluck('department')
                ->toArray();
        }


        $results = $campaign->collection()
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
                            tap($question, function ($question) use($evaluation_type) {
                                $transformedAnswers = $question->answers->transform(function ($answer) {
                                    $answer->value = self::multiplyAnswer($answer->value);
                                    return $answer;
                                });

                                $groupedAnswers = $transformedAnswers
                                                ->groupBy(function ($answer) use ($evaluation_type) {
                                                    if ($evaluation_type === OCEvaluation::ADMISSION_RANGE->value) {
                                                        return $answer->user->admission ? self::getAdmissionRange($answer->user->admission)->value . ' anos' : "Sem informação";
                                                    }
                                                    return data_get($answer, "user.$evaluation_type");
                                                })
                                                ->mapWithKeys(fn($answers, $divisionFactor) => 
                                                    [$divisionFactor => round($answers->sum('value') / $answers->count())]
                                                )
                                                ->sortKeys();

                                $question->setRelation('answers', $groupedAnswers);

                                $question->average = $question->answers->sum() / $question->answers->count();
                            })
                        )
                    );

        $generalSatisfactionByGroup = $results->mapWithKeys(function($groupQuestions, $group){
            $groupScoreSum = $groupQuestions->reduce(fn($acc, $question) => $acc + $question->average);
            $groupSatisfaction = round($groupScoreSum / $groupQuestions->count());

            return [$group => $groupSatisfaction];
        });

        $divisionFactorSatisfactionByGroup = $results->mapWithKeys(function($groupQuestions, $group) use($results) {
            $groupQuestionsSatisfaction = $groupQuestions->map(function($question){
                $questionGeneralSum = $question->answers->reduce(fn($acc, $answer) => $acc + $answer);
                $questionGeneralSatisfaction = round($questionGeneralSum / $question->answers->count());

                return [
                    'statement' => $question->statement,
                    'satisfaction' => collect([
                        'Geral' => $questionGeneralSatisfaction,
                        ...$question->answers
                    ])
                ];
            });

            return [$group => $groupQuestionsSatisfaction];
        });
        
        return [
            'general-satisfaction-by-group' => $generalSatisfactionByGroup,
            'division-factor-satisfaction-by-group' => $divisionFactorSatisfactionByGroup
        ];
   }

    public static function getAdmissionRange(string $admissionDate): AdmissionRange
    {
        $years = Carbon::parse($admissionDate)->age;

        return match (true) {
            $years <= 1  => AdmissionRange::NEW_EMPLOYEE,
            $years <= 4  => AdmissionRange::EARLY_EMPLOYEE,
            $years <= 10 => AdmissionRange::ESTABLISHED_EMPLOYEE,
            default      => AdmissionRange::VETERAN_EMPLOYEE,
        };
    }
   
    // public static function engagement(Campaign $campaign, string $evaluation_type)
    // {
    //     $allowedDepartments = [];

    //     if (session('auth:guard') === 'user') {
    //         $allowedDepartments = session('auth:user')->getDepartmentScopes(session('auth:user'));
    //     }

    //     $companyUsers = session('auth:company')
    //         ->activeUsers()
    //         ->when(
    //             session('auth:guard') === 'user', 
    //             fn($q) => $q->whereIn('department', $allowedDepartments)->whereNotNull('department')->where('department', '!=', '')
    //         )
    //         ->select('users.id', 'users.department', 'users.occupation', 'users.gender', 'users.work_shift', 'users.admission')
    //         ->get();

    //     $userCollections = $campaign->userCollections()
    //         ->when(
    //             session('auth:guard') === 'user',
    //             fn($q) => $q->whereHas('user', fn ($u) => $u->whereIn('department', $allowedDepartments)->whereNotNull('department')->where('department', '!=', ''))
    //         )
    //         ->with('user:id,department,occupation,gender,work_shift,admission')
    //         ->get();
        
    //     if($evaluation_type === OCEvaluation::DEPARTMENT->value){
    //         $campaignRespondentsDivided = $userCollections->groupBy(fn ($userCollection) => $userCollection->user->department ?? "Sem informação");
    //         $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->department ?? "Sem informação");
    //     }

    //     if($evaluation_type === OCEvaluation::OCCUPATION->value){
    //         $campaignRespondentsDivided = $userCollections->groupBy(fn ($userCollection) => $userCollection->user->occupation ?? "Sem informação");
    //         $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->occupation ?? "Sem informação");
    //     }

    //     if($evaluation_type === OCEvaluation::GENDER->value){
    //         $campaignRespondentsDivided = $userCollections->groupBy(fn ($userCollection) => $userCollection->user->gender ?? "Sem informação");
    //         $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->gender ?? "Sem informação");
    //     }

    //     if($evaluation_type === OCEvaluation::WORK_SHIFT->value){
    //         $campaignRespondentsDivided = $userCollections->groupBy(fn ($userCollection) => $userCollection->user->work_shift ?? "Sem informação");
    //         $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->work_shift ?? "Sem informação");
    //     }

    //     if($evaluation_type === OCEvaluation::ADMISSION_RANGE->value){
    //         $campaignRespondentsDivided = $userCollections->groupBy(fn ($userCollection) => $userCollection->user->admission ? self::getAdmissionRange($userCollection->user->admission)->value . ' anos' : "Sem informação");
    //         $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->admission ? self::getAdmissionRange($user->admission)->value . ' anos' : "Sem informação");
    //     }

    //     $engagementDivided = [];

    //     foreach($companyUsersDivided as $divisionFactor => $users){
    //         $totalDividedUsers = $users->count();
    //         $respondents = $campaignRespondentsDivided[$divisionFactor] ?? collect();
    //         $totalRespondents = $respondents->count();

    //         $percent = $totalDividedUsers > 0 ? round(($totalRespondents / $totalDividedUsers) * 100) : 0;

    //         $engagementDivided[$divisionFactor] = [
    //             'total_users' => $totalDividedUsers,
    //             'respondents' => $totalRespondents,
    //             'engagement' => $percent,
    //         ];
    //     }

    //     $totalCompanyUsers = array_sum(array_column($engagementDivided, 'total_users'));
    //     $totalCompanyRespondents = array_sum(array_column($engagementDivided, 'respondents'));

    //     $generalEngagement =  $totalCompanyUsers > 0 ? round(($totalCompanyRespondents / $totalCompanyUsers) * 100) : 0;
        
    //     return collect([
    //         'general' => $generalEngagement,
    //         'divided' => collect($engagementDivided)->sortByDesc('engagement')->toArray()
    //     ]);
    // }

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
            ->select('users.id', 'users.department', 'users.occupation', 'users.gender', 'users.work_shift', 'users.admission')
            ->get();

        $respondentIds = $campaign
            ->userCollections()
            ->pluck('user_id')
            ->flip();

        if ($evaluation_type === OCEvaluation::DEPARTMENT->value) {
            $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->department ?? 'Sem informação');
        }

        if ($evaluation_type === OCEvaluation::OCCUPATION->value) {
            $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->occupation ?? 'Sem informação');
        }

        if ($evaluation_type === OCEvaluation::GENDER->value) {
            $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->gender ?? 'Sem informação');
        }

        if ($evaluation_type === OCEvaluation::WORK_SHIFT->value) {
            $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->work_shift ?? 'Sem informação');
        }

        if ($evaluation_type === OCEvaluation::ADMISSION_RANGE->value) {
            $companyUsersDivided = $companyUsers->groupBy(fn ($user) => $user->admission ? self::getAdmissionRange($user->admission)->value . ' anos' : 'Sem informação');
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
