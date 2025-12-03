<?php

namespace App\Services\Psychosocial;

use App\Enums\PROART\PROARTHazard;
use App\Enums\Psychosocial\EvaluationTypes;
use App\Evaluators\PROART\anxietyOrStress;
use App\Evaluators\PROART\deteriorationOfPersonalLife;
use App\Evaluators\PROART\difficultyConcentrating;
use App\Evaluators\PROART\discrimination;
use App\Evaluators\PROART\emotionalExhaustion;
use App\Evaluators\PROART\excessiveManagementPressure;
use App\Evaluators\PROART\frequentAbsenteeism;
use App\Evaluators\PROART\frustrationOrDemotivation;
use App\Evaluators\PROART\individualisticManagement;
use App\Evaluators\PROART\irritability;
use App\Evaluators\PROART\lackOfManagerialSupport;
use App\Evaluators\PROART\lackOfRecognition;
use App\Evaluators\PROART\lackOfResources;
use App\Evaluators\PROART\managementConflicts;
use App\Evaluators\PROART\monotony;
use App\Evaluators\PROART\moralHarassment;
use App\Evaluators\PROART\organizationalRigidity;
use App\Evaluators\PROART\otherFormsOfViolence;
use App\Evaluators\PROART\perceivedInjustice;
use App\Evaluators\PROART\physicalDamage;
use App\Evaluators\PROART\psychologicalDamage;
use App\Evaluators\PROART\psychosomaticProblems;
use App\Evaluators\PROART\roleConflict;
use App\Evaluators\PROART\sexualHarassment;
use App\Evaluators\PROART\sleepDisorders;
use App\Evaluators\PROART\socialIsolation;
use App\Evaluators\PROART\unpredictability;
use App\Evaluators\PROART\workOverload;
use App\Models\Hazard;

class PROARTRiskService
{
    protected static array $evaluators = [
        PROARTHazard::ORGANIZATIONAL_RIGIDITY->value => organizationalRigidity::class,
        PROARTHazard::WORK_OVERLOAD->value => workOverload::class,
        PROARTHazard::LACK_OF_RESOURCES->value => lackOfResources::class,
        PROARTHazard::UNPREDICTABILITY->value => unpredictability::class,
        PROARTHazard::MONOTONY->value => monotony::class,
        PROARTHazard::ROLE_CONFLICT->value => roleConflict::class,
        PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value => individualisticManagement::class,
        PROARTHazard::LACK_OF_RECOGNITION->value => lackOfRecognition::class,
        PROARTHazard::MANAGEMENT_CONFLICTS->value => managementConflicts::class,
        PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value => lackOfManagerialSupport::class,
        PROARTHazard::PERCEIVED_INJUSTICE->value => perceivedInjustice::class,
        PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value => excessiveManagementPressure::class,
        PROARTHazard::EMOTIONAL_EXHAUSTION->value => emotionalExhaustion::class,
        PROARTHazard::ANXIETY_OR_STRESS->value => anxietyOrStress::class,
        PROARTHazard::SOCIAL_ISOLATION->value => socialIsolation::class,
        PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value => frustrationOrDemotivation::class,
        PROARTHazard::IRRITABILITY->value => irritability::class,
        PROARTHazard::DIFFICULTY_CONCENTRATING->value => difficultyConcentrating::class,
        PROARTHazard::PHYSICAL_DAMAGE->value => physicalDamage::class,
        PROARTHazard::PSYCHOLOGICAL_DAMAGE->value => psychologicalDamage::class,
        PROARTHazard::FREQUENT_ABSENTEEISM->value => frequentAbsenteeism::class,
        PROARTHazard::SLEEP_DISORDERS->value => sleepDisorders::class,
        PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value => psychosomaticProblems::class,
        PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value => deteriorationOfPersonalLife::class,
        PROARTHazard::MORAL_HARASSMENT->value => moralHarassment::class,
        PROARTHazard::SEXUAL_HARASSMENT->value => sexualHarassment::class,
        PROARTHazard::DISCRIMINATION->value => discrimination::class,
        PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value => otherFormsOfViolence::class
    ];

    public static function evaluate(Hazard $hazard, float $average) 
    {
        if(!isset(self::$evaluators[$hazard->type])) return false;

        $class = self::$evaluators[$hazard->type];                                        
        
        return $class::evaluate($hazard, $average);
    }

    public static function metricToProbabilityScale(float $percentage, int $scale)
    {
        return ($percentage / 100) * ($scale - 1) + 1;
    }
}
