<?php

namespace App\Services;

use App\Enums\HSE\HSEEvaluationType;
use App\Enums\RiskInventory\RiskInventoryFormat;
use App\Enums\RiskInventory\RiskInventoryType;
use App\Exports\HSEReportDepartmentExport;
use App\Exports\HSEReportOccupationExport;
use App\Exports\PROARTReportDepartmentExport;
use App\Exports\PROARTReportOccupationExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PsychosocialReportService
{
    public static function report(string $type, string $format)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        $risks = $type === RiskInventoryType::DEPARTMENT->value 
                        ? (session('auth:company')->usesHSE() ? self::HSEDepartments() : self::PROARTDepartments()) 
                        : (session('auth:company')->usesHSE() ? self::HSEOccupations() : self::PROARTOccupations());
        
        $absences = $type === RiskInventoryType::DEPARTMENT->value 
                        ? (session('auth:company')->usesHSE() ? self::HSEAbsences(HSEEvaluationType::DEPARTMENT) : null) 
                        : (session('auth:company')->usesHSE() ? self::HSEAbsences(HSEEvaluationType::OCCUPATION) : null);

        if($format === RiskInventoryFormat::PDF->value){
            $view = $type === RiskInventoryType::DEPARTMENT->value ?
                                'pdf.psychosocial-report.department' :
                                'pdf.psychosocial-report.occupation';
    
            $pdf = Pdf::loadView($view, [
                'risks' => $risks,
                'absences' => session('auth:company')->usesHSE() ? $absences : null,
            ])->setPaper('a4', 'portrait');
    
            $fileName = session('auth:company')->name . ' - Inventário de Riscos Psicossociais (' . ($type === RiskInventoryType::DEPARTMENT->value ? 'Setor' : 'Funcao') . ').pdf';
    
            return $pdf->download($fileName);
        }

        if($format === RiskInventoryFormat::EXCEL->value){
            $fileName = session('auth:company')->name . ' - Inventário de Riscos Psicossociais (' . ($type === RiskInventoryType::DEPARTMENT->value ? 'Setor' : 'Funcao') . ').xlsx';
            
            if($type === RiskInventoryType::DEPARTMENT->value){
                return session('auth:company')->usesHSE() 
                        ? Excel::download(new HSEReportDepartmentExport($risks, $absences), $fileName) 
                        : Excel::download(new PROARTReportDepartmentExport($risks), $fileName);
            }

            if($type === RiskInventoryType::OCCUPATION->value){
                return session('auth:company')->usesHSE() 
                        ? Excel::download(new HSEReportOccupationExport($risks, $absences), $fileName) 
                        : Excel::download(new PROARTReportOccupationExport($risks), $fileName);
            }
            
        }
    }

    public static function PROARTDepartments()
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $campaign = session('auth:company')->latestPsychosocialCampaign();
        
        $risks = $campaign->collection()->hazards()
            ->with([
                'questions' => fn($query) => 
                    $query->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ]
                    )
            ])
            ->get()
            ->map(fn($risk) => 
                tap($risk, function ($r) {
                    $r->questions->each(fn($question) => 
                        tap($question, function ($q) {
                            $q->setRelation('answers', $q->answers->groupBy('user.department'));
                        })
                    );
                }
            )) // Agrupar respostas por department
            ->mapWithKeys(function($risk) {
                $riskAverages = $risk->questions
                                        ->map(function($question) {
                                            $evaluatedAnswers = $question->answers->mapWithKeys(function($answers, $department) use($question) {
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
                
                $riskEvaluated = collect($riskAverages)
                                ->mapWithKeys(function($averages, $department) use($risk) { 
                                    $average = round(collect($averages)->sum() / collect($averages)->count());
                                    $evaluated = PROARTRiskService::evaluate($risk, $average);
                                    return [$department => [
                                        'risk' => $evaluated,
                                        'control_actions' => session('auth:company')->actionPlan
                                                                                    ->controlActions
                                                                                    ->where('hazard_id', $risk->id)
                                                                                    ->where('gravity', $evaluated['evaluated']->value)
                                                                                    ->groupBy('type.type')
                                    ]];
                                }); 
                
                return [$risk->type => $riskEvaluated];
            });

        $evaluatedRisks = collect();

        $risks->each(function($departments, $risk) use($evaluatedRisks) {
            $departments->each(function($evaluated, $department) use($evaluatedRisks, $risk, $departments){
                if(! $evaluatedRisks->has($department)) {
                    $evaluatedRisks->put($department, collect());
                }

                $evaluatedRisks[$department]->put($risk, $departments[$department]);
            });
        });

        return $evaluatedRisks;
    }

    public static function HSEDepartments()
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $campaign = session('auth:company')->latestPsychosocialCampaign();
        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ])
                        ->get()
                        ->groupBy('group')
                        ->map(fn($questions) =>
                            $questions->each(fn($question) => 
                                tap($question, function ($q) {
                                    $q->setRelation('answers', $q->answers->groupBy('user.department'));
                                })
                            )
                        )
                        ->mapWithKeys(function($questions, $group) use($hazards){
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
                                        ->mapWithKeys(function($averages, $department) use($group, $hazards) { 
                                            $average = round(collect($averages)->sum() / collect($averages)->count());

                                            $groupRisks = $hazards[$group]->mapWithKeys(function($hazard) use($average, $department) {
                                                $evaluated = HSERiskService::evaluate($hazard, $average, HSEEvaluationType::DEPARTMENT, $department);
                                                
                                                return [$hazard->type => [
                                                    'risk' => $evaluated,
                                                    'control_actions' => session('auth:company')->actionPlan
                                                                                                ->controlActions
                                                                                                ->where('hazard_id', $hazard->id)
                                                                                                ->where('gravity', $evaluated['evaluated']->value)
                                                ]];
                                            });

                                            return [$department => $groupRisks];
                                        }); 
                            return [$group => $riskEvaluated];
                        });

        $evaluatedRisks = collect();

        $risks->each(function($departments, $group) use($evaluatedRisks) {
            $departments->each(function($risks, $department) use($evaluatedRisks) {
                if(! $evaluatedRisks->has($department)) {
                    $evaluatedRisks->put($department, collect());
                }
         
                $risks->each(fn($evaluated, $risk) => $evaluatedRisks[$department][$risk] = $evaluated);
            });
        });

        return $evaluatedRisks;
    }

    public static function PROARTOccupations()
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());
   
        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $risks = $campaign->collection()->hazards()
            ->with([
                'questions' => fn($query) => 
                    $query->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ]
                    )
            ])
            ->get()
            ->map(fn($risk) => 
                tap($risk, function ($r) {
                    $r->questions->each(fn($question) => 
                        tap($question, function ($q) {
                            $q->setRelation('answers', $q->answers->groupBy('user.occupation'));
                        })
                    );
                })
            )->mapWithKeys(function($risk) {
                $riskAverages = $risk->questions
                                        ->map(function($question) {
                                            $evaluatedAnswers = $question->answers->mapWithKeys(function($answers, $occupation) use($question) {                                                
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
                
                $riskEvaluated = collect($riskAverages)
                                ->mapWithKeys(function($averages, $occupation) use($risk) { 
                                    $average = round(collect($averages)->sum() / collect($averages)->count());
                                    $evaluated = PROARTRiskService::evaluate($risk, $average);
                                    return [$occupation => [
                                        'risk' => $evaluated,
                                        'control_actions' => session('auth:company')->actionPlan
                                                                                    ->controlActions
                                                                                    ->where('hazard_id', $risk->id)
                                                                                    ->where('gravity', $evaluated['evaluated']->value)
                                                                                    ->groupBy('type.type')
                                    ]];
                                }); 
                
                return [$risk->type => $riskEvaluated];
            });
        
        $evaluatedRisks = collect();

        $risks->each(function($occupations, $risk) use($evaluatedRisks) {
            $occupations->each(function($evaluated, $occupation) use($evaluatedRisks, $risk, $occupations){
                if(! $evaluatedRisks->has($occupation)) {
                    $evaluatedRisks->put($occupation, collect());
                }

                $evaluatedRisks[$occupation]->put($risk, $occupations[$occupation]);
            });
        });

        return $evaluatedRisks;
    }

    public static function HSEOccupations()
    {
        session('auth:company', [session('auth:company')->load(['proartIndicators', 'reports', 'actionPlan'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());

        $campaign = session('auth:company')->latestPsychosocialCampaign();
        $hazards = $campaign->collection()->hazards->groupBy('group');

        $risks = $campaign->collection()
                        ->questions()
                        ->with(['answers' => fn($q) => 
                            $q->where('campaign_id', $campaign->id)->with('user')
                        ])
                        ->get()
                        ->groupBy('group')
                        ->map(fn($questions) =>
                            $questions->each(fn($question) => 
                                tap($question, function ($q) {
                                    $q->setRelation('answers', $q->answers->groupBy('user.occupation'));
                                })
                            )
                        )
                        ->mapWithKeys(function($questions, $group) use($hazards){
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
                                        ->mapWithKeys(function($averages, $occupation) use($group, $hazards) { 
                                            $average = round(collect($averages)->sum() / collect($averages)->count());

                                            $groupRisks = $hazards[$group]->mapWithKeys(function($hazard) use($average, $occupation) {
                                                $evaluated = HSERiskService::evaluate($hazard, $average, HSEEvaluationType::OCCUPATION, $occupation);

                                                return [$hazard->type => [
                                                    'risk' => $evaluated,
                                                    'control_actions' => session('auth:company')->actionPlan
                                                                                                ->controlActions
                                                                                                ->where('hazard_id', $hazard->id)
                                                                                                ->where('gravity', $evaluated['evaluated']->value)
                                                ]];
                                            });

                                            return [$occupation => $groupRisks];
                                        }); 
                            return [$group => $riskEvaluated];
                        });

        $evaluatedRisks = collect();

        $risks->each(function($occupations, $group) use($evaluatedRisks) {
            $occupations->each(function($risks, $occupation) use($evaluatedRisks) {
                if(! $evaluatedRisks->has($occupation)) {
                    $evaluatedRisks->put($occupation, collect());
                }
         
                $risks->each(fn($evaluated, $risk) => $evaluatedRisks[$occupation][$risk] = $evaluated);
            });
        });

        return $evaluatedRisks;
    }

    public static function HSEAbsences(HSEEvaluationType $evaluationType)
    {
        return session('auth:company')->CIDabsences()->with('cid')->get()->groupBy($evaluationType->value);
    }
}
