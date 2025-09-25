<?php

namespace App\Evaluators;

use App\Enums\FinalRiskTypes;
use App\Enums\RiskTypes;
use App\Models\Risk;
use App\Services\RiskService;

class workOverload
{
  public static function evaluate(float $average)
    {
        $initialRating = self::initialRating($average);
        
        $reports = session('auth:company')->getReports()->first(fn($_, $risk) => $risk === RiskTypes::WORK_OVERLOAD->value);
        
        $needsWeightedAverage = self::needsWeightedAverage($initialRating, $reports);

        if(!$needsWeightedAverage){
            return self::determineRisk($initialRating);
        }

        $weightedAverage = self::weightedAverage($initialRating, $reports);
        
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

    private static function needsWeightedAverage(int $initialRating, $reports): bool
    {
        if($initialRating === 1){
            $indicators = [
                $reports && $reports < 5,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() < 10,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() < 10,
                session('auth:company')->absences() && session('auth:company')->absences() < 10,
            ];
        }
        
        if($initialRating === 2){
            $indicators = [
                $reports && $reports >= 5 && $reports < 10,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() >= 10 && session('auth:company')->extraHours() < 25,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() >= 10 && session('auth:company')->absenteeism() < 25,
                session('auth:company')->absences() && session('auth:company')->absences() >= 10 && session('auth:company')->absences() < 25,
            ];
        }

        if($initialRating === 3){
            $indicators = [
                $reports && $reports >= 10 && $reports < 15,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() >= 25 && session('auth:company')->extraHours() < 40,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() >= 25 && session('auth:company')->absenteeism() < 40,
                session('auth:company')->absences() && session('auth:company')->absences() >= 25 && session('auth:company')->absences() < 30,
            ];
        }

        if($initialRating === 4){
            $indicators = [
                $reports && $reports > 15,
                session('auth:company')->extraHours() && session('auth:company')->extraHours() > 40,
                session('auth:company')->absenteeism() && session('auth:company')->absenteeism() > 40,
                session('auth:company')->absences() && session('auth:company')->absences() > 30,
            ];
        }

        if(count(array_filter($indicators, fn($i) => !$i)) >= 2){
            return true;
        }

        return false;
    }

    private static function weightedAverage(int $initialRating, $reports): int
    {
        $scoreWeight = 0.5;
        $metricWeight = 0.125;

        $metrics = [
            $reports,
            session('auth:company')->absenteeism(),
            session('auth:company')->extraHours(),
            session('auth:company')->absences(),
        ];

        foreach($metrics as $metric){
            if(is_null($metric)) $scoreWeight += $metricWeight;
        }        

        $weightedAverage = 
                  ($scoreWeight * $initialRating) +
                  ($metricWeight * ($metrics[0] ? RiskService::metricToProbabilityScale($metrics[0], 4) : 0)) +
                  ($metricWeight * ($metrics[1] ? RiskService::metricToProbabilityScale($metrics[1], 4) : 0)) +
                  ($metricWeight * ($metrics[2] ? RiskService::metricToProbabilityScale($metrics[2], 4) : 0));      
                  ($metricWeight * ($metrics[3] ? RiskService::metricToProbabilityScale($metrics[3], 4) : 0));      

          
        return round($weightedAverage);
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