<?php

namespace App\Evaluators;

use App\Enums\FinalRiskTypes;
use App\Models\Risk;
use App\Services\RiskService;

class emotionalExhaustion
{
    public static function evaluate(Risk $risk, float $average)
    {
        $initialRating = self::initialRating($average);
        $needsWeightedAverage = self::needsWeightedAverage($initialRating);
        
        if(!$needsWeightedAverage){
            return self::determineRisk($initialRating);
        }

        $weightedAverage = self::weightedAverage($initialRating);
        
        return self::determineRisk($weightedAverage);
    }

    private static function initialRating(float $average): int
    {
        return match(true) {
            $average > 3.5 => 4,
            $average >= 3 => 3,
            $average >= 2.5 => 2,
            $average < 2.5 => 1
        };
    }

    private static function needsWeightedAverage(int $initialRating): bool
    {
        if($initialRating === 1){
            $indicators = [
                // todo: queixas
                session('auth:company')->absenteeism() < 10,
                session('auth:company')->absences() < 10,
            ];
        }
        
        if($initialRating === 2){
            $indicators = [
                // todo: queixas
                session('auth:company')->absenteeism() >= 10 && session('auth:company')->absenteeism() < 25,
                session('auth:company')->absences() >= 10 && session('auth:company')->absences() < 25,
            ];
        }

        if($initialRating === 3){
            $indicators = [
                // todo: queixas
                session('auth:company')->absenteeism() >= 25 && session('auth:company')->absenteeism() < 40,
                session('auth:company')->absences() >= 25 && session('auth:company')->absences() < 30,
            ];
        }

        if($initialRating === 4){
            $indicators = [
                // todo: queixas
                session('auth:company')->absenteeism() > 40,
                session('auth:company')->absences() > 30,
            ];
        }

        if(count(array_filter($indicators, fn($i) => !$i)) >= 2){
            return true;
        }

        return false;
    }

    private static function weightedAverage(int $initialRating): int
    {
        // $scoreWeight = 0.625;
        $scoreWeight = 0.75;
        $metricWeight = 0.125;

        $metrics = [
            // todo: queixas
            session('auth:company')->absenteeism(),
            session('auth:company')->absences(),
        ];

        foreach($metrics as $metric){
            if(is_null($metric)) $scoreWeight += $metricWeight;
        }

        $weightedAverage = ($scoreWeight * $initialRating) +
                  ($metricWeight * ($metrics[0] ? RiskService::metricToProbabilityScale($metrics[0], 4) : 0)) +
                  ($metricWeight * ($metrics[1] ? RiskService::metricToProbabilityScale($metrics[1], 4) : 0));
        
        return round($weightedAverage); // Voltar para escaça de a 1
    }

    private static function determineRisk(int $rating): FinalRiskTypes
    {
        return match($rating) {
            1 => FinalRiskTypes::LOW,
            2 => FinalRiskTypes::MEDIUM,
            3 => FinalRiskTypes::HIGH,
            4 => FinalRiskTypes::CRITICAL,
        };
    }
}