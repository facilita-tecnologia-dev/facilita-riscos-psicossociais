<?php

namespace App\Services;

use App\Enums\RiskInventory\RiskInventoryFormat;
use App\Enums\RiskInventory\RiskInventoryType;
use App\Exports\PsychosocialReportDepartmentExport;
use App\Exports\PsychosocialReportOccupationExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PsychosocialReportService
{
    public static function report(string $type, string $format)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        $risks = $type === RiskInventoryType::DEPARTMENT->value ?
                                                self::departments() :
                                                self::occupations();

        if($format === RiskInventoryFormat::PDF->value){
            $view = $type === RiskInventoryType::DEPARTMENT->value ?
                                'pdf.psychosocial-report.department' :
                                'pdf.psychosocial-report.occupation';
    
            $pdf = Pdf::loadView($view, [
                'risks' => $risks,
            ])->setPaper('a4', 'portrait');
    
            $fileName = session('auth:company')->name . ' - Inventário de Riscos Psicossociais (' . ($type === RiskInventoryType::DEPARTMENT->value ? 'Setor' : 'Funcao') . ').pdf';
    
            return $pdf->download($fileName);
        }

        if($format === RiskInventoryFormat::EXCEL->value){
            $fileName = session('auth:company')->name . ' - Inventário de Riscos Psicossociais (' . ($type === RiskInventoryType::DEPARTMENT->value ? 'Setor' : 'Funcao') . ').xlsx';
            
            if($type === RiskInventoryType::DEPARTMENT->value){
                return Excel::download(new PsychosocialReportDepartmentExport($risks), $fileName);
            }

            if($type === RiskInventoryType::OCCUPATION->value){
                return Excel::download(new PsychosocialReportOccupationExport($risks), $fileName);
            }
            
        }
    }

    public static function departments()
    {
        session('auth:company', [session('auth:company')->load(['metrics', 'reports'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());
   
        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $risks = $campaign->collection()->risks()
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
                })
            )->mapWithKeys(function($risk) {
                $riskAverages = $risk->questions
                                        ->map(function($question) {
                                            $evaluatedAnswers = $question->answers->mapWithKeys(function($answers, $department) use($question) {
                                                $processedAnswers = $answers->map(function($answer) use($question){
                                                    $answer->value = $question->inverted 
                                                                    ? PsychosocialService::invertAnswerScore($answer->value) 
                                                                    : $answer->value;
                                                    return $answer;
                                                });
                                                
                                                $average = round($processedAnswers->sum('value') / $processedAnswers->count());

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
                                    $evaluated = RiskService::evaluate($risk, $average);
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

    public static function occupations()
    {
        session('auth:company', [session('auth:company')->load(['metrics', 'reports'])]);
        session('auth:company')->setRelation('reports', session('auth:company')->getReports());
   
        $campaign = session('auth:company')->latestPsychosocialCampaign();

        $risks = $campaign->collection()->risks()
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
                                                $processedAnswers = $answers->map(function($answer) use($question){
                                                    $answer->value = $question->inverted 
                                                                    ? PsychosocialService::invertAnswerScore($answer->value) 
                                                                    : $answer->value;
                                                    return $answer;
                                                });
                                                
                                                $average = round($processedAnswers->sum('value') / $processedAnswers->count());

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
                                    $evaluated = RiskService::evaluate($risk, $average);
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

}
