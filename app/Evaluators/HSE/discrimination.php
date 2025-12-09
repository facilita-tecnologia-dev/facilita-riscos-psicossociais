<?php

namespace App\Evaluators\HSE;

use App\Enums\Campaign\EvaluationTypes;
use App\Enums\Psychosocial\HSE\HSERisk;
use App\Models\Hazard;
use App\Services\Psychosocial\HSERiskService;

class discrimination
{
     public static function evaluate(Hazard $hazard, float $score, EvaluationTypes $evaluationType = EvaluationTypes::DEPARTMENT, ?string $evaluationFactor = null)
    {
        $probability = self::determineProbability($hazard, $score, $evaluationType, $evaluationFactor);
        $gravity = $hazard->gravity;

        $risk = HSERiskService::riskMatrix($probability['probability'], $gravity);

        if(session('auth:company')->has_cids && !$probability['hasCIDAbsences']){
            $risk = HSERisk::from($risk->value - 1);
        };
        
        return [
            'evaluated' => $risk,
            'probability' => $probability['probability'],
            'gravity' => $gravity
        ];
    }

    public static function determineProbability(Hazard $hazard, float $score, EvaluationTypes $evaluationType = EvaluationTypes::DEPARTMENT, ?string $evaluationFactor = null)
    {
        $initialProbability = HSERiskService::scoreToProbability($score, inverted: true);

        $baseline = 0;
        $modifiers = 0;
        $hasCIDAbsences = false;

        if(session('auth:company')->has_cids){
            $cids = $hazard->cids->keyBy('id');
            $absences = session('auth:company')->CIDAbsences->filter(fn ($absence) => $cids->has($absence->cid_id));
            
            $baseline = $absences->isNotEmpty() ? $hazard->baseline : 0;
            $modifiers = HSERiskService::modifiers($absences, $evaluationType, $evaluationFactor); 

            if($absences->isNotEmpty()) $hasCIDAbsences = true;
        }

        $probability = min(5, $initialProbability + $baseline +  $modifiers);

        return [
            'probability' => $probability,
            'hasCIDAbsences' => $hasCIDAbsences
        ];
    }
}