<?php

namespace App\Evaluators\HSE;

use App\Enums\Campaign\EvaluationTypes;
use App\Models\Hazard;
use App\Services\Psychosocial\HSERiskService;

class deadlinePressure
{
     public static function evaluate(Hazard $hazard, float $score, EvaluationTypes $evaluationType = EvaluationTypes::DEPARTMENT, ?string $evaluationFactor = null)
    {
        $probability = self::determineProbability($hazard, $score, $evaluationType, $evaluationFactor);
        $gravity = $hazard->gravity;
        
        return [
            'evaluated' => HSERiskService::riskMatrix($probability, $gravity),
            'probability' => $probability,
            'gravity' => $gravity
        ];
    }

    public static function determineProbability(Hazard $hazard, float $score, EvaluationTypes $evaluationType = EvaluationTypes::DEPARTMENT, ?string $evaluationFactor = null)
    {
        $cids = $hazard->cids->keyBy('id');
        $absences = session('auth:company')->CIDAbsences->filter(fn ($absence) => $cids->has($absence->cid_id));
        
        $initialProbability = HSERiskService::scoreToProbability($score, inverted: true);
        $baseline = $absences->isNotEmpty() ? $hazard->baseline : 0;
        $modifiers = HSERiskService::modifiers($absences, $evaluationType, $evaluationFactor); 

        $probability = max(1, min(5, $initialProbability + $baseline + $modifiers));

        return $probability;
    }
}