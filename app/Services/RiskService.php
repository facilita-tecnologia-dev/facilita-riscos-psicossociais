<?php

namespace App\Services;

use App\Evaluators\anxietyOrStress;
use App\Evaluators\deteriorationOfPersonalLife;
use App\Evaluators\difficultyConcentrating;
use App\Evaluators\discrimination;
use App\Evaluators\emotionalExhaustion;
use App\Evaluators\excessiveManagementPressure;
use App\Evaluators\frequentAbsenteeism;
use App\Evaluators\frustrationOrDemotivation;
use App\Evaluators\individualisticManagement;
use App\Evaluators\irritability;
use App\Evaluators\lackOfManagerialSupport;
use App\Evaluators\lackOfRecognition;
use App\Evaluators\lackOfResources;
use App\Evaluators\managementConflicts;
use App\Evaluators\monotony;
use App\Evaluators\moralHarassment;
use App\Evaluators\organizationalRigidity;
use App\Evaluators\otherFormsOfViolence;
use App\Evaluators\perceivedInjustice;
use App\Evaluators\physicalDamage;
use App\Evaluators\psychologicalDamage;
use App\Evaluators\psychosomaticProblems;
use App\Evaluators\roleConflict;
use App\Evaluators\sexualHarassment;
use App\Evaluators\sleepDisorders;
use App\Evaluators\socialIsolation;
use App\Evaluators\unpredictability;
use App\Evaluators\workOverload;
use App\Models\Risk;

class RiskService
{
    protected static array $evaluators = [
        "organizational-rigidity" => organizationalRigidity::class,
        "work-overload" => workOverload::class,
        "lack-of-resources" => lackOfResources::class,
        "unpredictability" => unpredictability::class,
        "monotony" => monotony::class,
        "role-conflict" => roleConflict::class,
        "individualistic-management" => individualisticManagement::class,
        "lack-of-recognition" => lackOfRecognition::class,
        "management-conflicts" => managementConflicts::class,
        "lack-of-managerial-support" => lackOfManagerialSupport::class,
        "perceived-injustice" => perceivedInjustice::class,
        "excessive-management-pressure" => excessiveManagementPressure::class,
        "emotional-exhaustion" => emotionalExhaustion::class,
        "anxiety-or-stress" => anxietyOrStress::class,
        "social-isolation" => socialIsolation::class,
        "frustration-or-demotivation" => frustrationOrDemotivation::class,
        "irritability" => irritability::class,
        "difficulty-concentrating" => difficultyConcentrating::class,
        "physical-damage" => physicalDamage::class,
        "psychological-damage" => psychologicalDamage::class,
        "frequent-absenteeism" => frequentAbsenteeism::class,
        "sleep-disorders" => sleepDisorders::class,
        "psychosomatic-problems" => psychosomaticProblems::class,
        "deterioration-of-personal-life" => deteriorationOfPersonalLife::class,
        "moral-harassment" => moralHarassment::class,
        "sexual-harassment" => sexualHarassment::class,
        "discrimination" => discrimination::class,
        "other-forms-of-violence" => otherFormsOfViolence::class
    ];

    public static function evaluate(Risk $risk, float $average) 
    {
        if(!isset(self::$evaluators[$risk->type])) return false;

        $class = self::$evaluators[$risk->type];

        return $class::evaluate($risk, $average);
    }

    public static function metricToProbabilityScale(float $percentage, int $scale)
    {
        return ($percentage / 100) * ($scale - 1) + 1;
    }
}
