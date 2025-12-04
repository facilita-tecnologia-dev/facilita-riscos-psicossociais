<?php

namespace App\Evaluators\PROART;

use App\Enums\PROART\PROARTRisk;
use App\Enums\PROART\PROARTHazard;
use App\Models\Hazard;
use App\Services\Psychosocial\PROARTRiskService;

class deteriorationOfPersonalLife
{
    public static function evaluate(Hazard $risk, float $average)
    {
        $initialRating = self::initialRating($average);

        $reports = session('auth:company')->reports->first(fn($_, $risk) => $risk === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value);
    
        $needsWeightedAverage = self::needsWeightedAverage($initialRating, $reports);

        if(!$needsWeightedAverage){
            return self::determineRisk($initialRating);
        }

        $weightedAverage = self::weightedAverage($initialRating, $reports);
        
        return [
            'evaluated' => self::determineRisk($weightedAverage),
            'probability' => $needsWeightedAverage ? $weightedAverage : $initialRating,
            'gravity' => $risk->gravity
        ];
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

    private static function needsWeightedAverage(int $initialRating, $reports): bool
    {
        if($initialRating === 1){
            $indicators = [
                $reports && $reports < 5,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() < 10,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() < 10,
            ];
        }
        
        if($initialRating === 2){
            $indicators = [
                $reports && $reports >= 5 && $reports < 10,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() >= 10 && session('auth:company')->absenteeism() < 25,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() >= 10 && session('auth:company')->extraHours() < 25,
            ];
        }

        if($initialRating === 3){
            $indicators = [
                $reports && $reports >= 10 && $reports < 15,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() >= 25 && session('auth:company')->absenteeism() < 40,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() >= 25 && session('auth:company')->extraHours() < 40,
            ];
        }

        if($initialRating === 4){
            $indicators = [
                $reports && $reports > 15,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() > 40,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() > 40,
            ];
        }

        if(count(array_filter($indicators, fn($i) => !$i)) >= 2){
            return true;
        }

        return false;
    }

    private static function weightedAverage(int $initialRating, $reports): int
    {
        $scoreWeight = 0.625;
        $metricWeight = 0.125;

        $metrics = [
            $reports,
            session('auth:company')->absenteeism(),
            session('auth:company')->extraHours(),
        ];

        foreach($metrics as $metric){
            if(is_null($metric)) $scoreWeight += $metricWeight;
        }

        $weightedAverage = ($scoreWeight * $initialRating) +
                  ($metricWeight * ($metrics[0] ? PROARTRiskService::metricToProbabilityScale($metrics[0], 4) : 0)) +
                  ($metricWeight * ($metrics[1] ? PROARTRiskService::metricToProbabilityScale($metrics[1], 4) : 0));
                  ($metricWeight * ($metrics[2] ? PROARTRiskService::metricToProbabilityScale($metrics[2], 4) : 0));
        
        return round($weightedAverage);
    }

    private static function determineRisk(int $rating): PROARTRisk
    {
        return match($rating) {
            1 => PROARTRisk::LOW,
            2 => PROARTRisk::MEDIUM,
            3 => PROARTRisk::HIGH,
            4 => PROARTRisk::CRITICAL,
        };
    }
}