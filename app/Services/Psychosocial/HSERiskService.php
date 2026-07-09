<?php

namespace App\Services\Psychosocial;

use App\Enums\Psychosocial\HSE\HSEHazard;
use App\Enums\Psychosocial\HSE\HSERisk;
use App\Enums\Campaign\EvaluationTypes;
use App\Enums\Psychosocial\HSE\HSERiskMatrix;
use App\Evaluators\HSE\chronicTeamConflicts;
use App\Evaluators\HSE\constantInterruptions;
use App\Evaluators\HSE\deadlinePressure;
use App\Evaluators\HSE\discrimination;
use App\Evaluators\HSE\frequentPriorityChanges;
use App\Evaluators\HSE\highEmotionalDemands;
use App\Evaluators\HSE\incivility;
use App\Evaluators\HSE\insufficientResources;
use App\Evaluators\HSE\insufficientTraining;
use App\Evaluators\HSE\jobInsecurity;
use App\Evaluators\HSE\lackOfFeedback;
use App\Evaluators\HSE\longWorkingHours;
use App\Evaluators\HSE\lossOfBenefits;
use App\Evaluators\HSE\lowAutonomy;
use App\Evaluators\HSE\lowScheduleFlexibility;
use App\Evaluators\HSE\micromanagement;
use App\Evaluators\HSE\moralHarassment;
use App\Evaluators\HSE\newTechnologyWithoutTraining;
use App\Evaluators\HSE\poorChangeCommunication;
use App\Evaluators\HSE\responsibilityWithoutAuthority;
use App\Evaluators\HSE\restructuring;
use App\Evaluators\HSE\rigidProcedures;
use App\Evaluators\HSE\roleAmbiguity;
use App\Evaluators\HSE\roleConflict;
use App\Evaluators\HSE\sexualHarassment;
use App\Evaluators\HSE\socialIsolation;
use App\Evaluators\HSE\toxicLeadership;
use App\Evaluators\HSE\violence;
use App\Evaluators\HSE\workOverload;
use App\Models\Hazard;
use Illuminate\Database\Eloquent\Collection;

class HSERiskService
{
    protected static array $evaluators = [
        HSEHazard::WORK_OVERLOAD->value => workOverload::class,
        HSEHazard::DEADLINE_PRESSURE->value => deadlinePressure::class,
        HSEHazard::LONG_WORKING_HOURS->value => longWorkingHours::class,
        HSEHazard::CONSTANT_INTERRUPTIONS->value => constantInterruptions::class,
        HSEHazard::INSUFFICIENT_RESOURCES->value => insufficientResources::class,
        HSEHazard::HIGH_EMOTIONAL_DEMANDS->value => highEmotionalDemands::class,
        HSEHazard::LOW_AUTONOMY->value => lowAutonomy::class,
        HSEHazard::MICROMANAGEMENT->value => micromanagement::class,
        HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value => lowScheduleFlexibility::class,
        HSEHazard::RIGID_PROCEDURES->value => rigidProcedures::class,
        HSEHazard::LACK_OF_FEEDBACK->value => lackOfFeedback::class,
        HSEHazard::TOXIC_LEADERSHIP->value => toxicLeadership::class,
        HSEHazard::INSUFFICIENT_TRAINING->value => insufficientTraining::class,
        HSEHazard::SOCIAL_ISOLATION->value => socialIsolation::class,
        HSEHazard::CHRONIC_TEAM_CONFLICTS->value => chronicTeamConflicts::class,
        HSEHazard::MORAL_HARASSMENT->value => moralHarassment::class,
        // HSEHazard::SEXUAL_HARASSMENT->value => sexualHarassment::class,
        HSEHazard::INCIVILITY->value => incivility::class,
        HSEHazard::DISCRIMINATION->value => discrimination::class,
        HSEHazard::VIOLENCE->value => violence::class,
        HSEHazard::ROLE_AMBIGUITY->value => roleAmbiguity::class,
        HSEHazard::ROLE_CONFLICT->value => roleConflict::class,
        HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value => responsibilityWithoutAuthority::class,
        HSEHazard::FREQUENT_PRIORITY_CHANGES->value => frequentPriorityChanges::class,
        HSEHazard::POOR_CHANGE_COMMUNICATION->value => poorChangeCommunication::class,
        HSEHazard::JOB_INSECURITY->value => jobInsecurity::class,
        HSEHazard::RESTRUCTURING->value => restructuring::class,
        HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value => newTechnologyWithoutTraining::class,
        HSEHazard::LOSS_OF_BENEFITS->value => lossOfBenefits::class
    ];

    public static function evaluate(Hazard $hazard, float $average, EvaluationTypes $evaluationType = EvaluationTypes::DEPARTMENT, ?string $evaluationFactor = null) 
    {
        if(!isset(self::$evaluators[$hazard->type])) return false;

        $class = self::$evaluators[$hazard->type];

        return $class::evaluate($hazard, $average, $evaluationType, $evaluationFactor);
    }

    public static function modifiers(Collection $absences, EvaluationTypes $evaluationType = EvaluationTypes::DEPARTMENT, ?string $evaluationFactor = null)
    {
        $hasLeave = $absences->where($evaluationType->value, $evaluationFactor)->isNotEmpty();
        $hasFifteenDaysLeave = $absences->where($evaluationType->value, $evaluationFactor)->where('duration', '>=', 15)->isNotEmpty();

        $sum = 0;
        if($hasLeave) {$sum += 1;} else {$sum -= 1;}
        if($hasFifteenDaysLeave) $sum += 1;
        
        return $sum;
    }

    public static function scoreToProbability(float $score, ?bool $inverted = false)
    {
        if($inverted) {
            $score = 4 - $score;

            return match(true) {
                $score <= 1.5 => 1,
                $score <= 2.0  => 2,
                $score <= 3.0  => 3,
                $score < 4  => 4,
                default => 5,
            };
        }

        // Normal
        return match(true) {
            $score <= 1.5 => 5,
            $score <= 2.0  => 4,
            $score <= 3.0  => 3,
            $score < 4  => 2,
            default => 1,
        };
    }

    public static function riskMatrix(int $probability, int $severity)
    {
        $company = session('auth:company');

        // TODO: temporário — reverter assim que o caso da empresa 47 com a matriz AIHA for resolvido.
        $forceDefaultMatrix = app()->environment('production') && $company->id === 47;

        $usesAIHAMatrix = $company->risk_matrix == HSERiskMatrix::AIHA && ! $forceDefaultMatrix;

        if($usesAIHAMatrix){
            $matrix = [
                1 => [1, 1, 1, 1, 2], // Muito improvável
                2 => [1, 2, 2, 3, 3], // Improvável
                3 => [1, 2, 3, 3, 3], // Possível
                4 => [1, 2, 3, 4, 4], // Provável
                5 => [2, 3, 3, 4, 5], // Muito provável
            ];
        } else {
            $matrix = [
                1 => [1, 1, 2, 3, 3], // Muito improvável
                2 => [1, 2, 3, 3, 4], // Improvável
                3 => [1, 2, 3, 4, 5], // Possível
                4 => [2, 2, 3, 4, 5], // Provável
                5 => [2, 3, 4, 5, 5], // Muito provável
            ];
        }
        

        $risk = HSERisk::from($matrix[$probability][$severity - 1]);

        return $risk;
    }
}
