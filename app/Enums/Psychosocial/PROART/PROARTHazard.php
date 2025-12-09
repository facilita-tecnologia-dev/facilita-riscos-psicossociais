<?php

namespace App\Enums\Psychosocial\PROART;

enum PROARTHazard: string
{
    case ORGANIZATIONAL_RIGIDITY ='organizational-rigidity';
    case WORK_OVERLOAD ='work-overload';
    case LACK_OF_RESOURCES ='lack-of-resources';
    case UNPREDICTABILITY ='unpredictability';
    case MONOTONY ='monotony';
    case ROLE_CONFLICT ='role-conflict';
    case INDIVIDUALISTIC_MANAGEMENT ='individualistic-management';
    case LACK_OF_RECOGNITION ='lack-of-recognition';
    case MANAGEMENT_CONFLICTS ='management-conflicts';
    case LACK_OF_MANAGERIAL_SUPPORT ='lack-of-managerial-support';
    case PERCEIVED_INJUSTICE ='perceived-injustice';
    case EXCESSIVE_MANAGEMENT_PRESSURE ='excessive-management-pressure';
    case EMOTIONAL_EXHAUSTION ='emotional-exhaustion';
    case ANXIETY_OR_STRESS ='anxiety-or-stress';
    case SOCIAL_ISOLATION ='social-isolation';
    case FRUSTRATION_OR_DEMOTIVATION ='frustration-or-demotivation';
    case IRRITABILITY ='irritability';
    case DIFFICULTY_CONCENTRATING ='difficulty-concentrating';
    case PHYSICAL_DAMAGE ='physical-damage';
    case PSYCHOLOGICAL_DAMAGE ='psychological-damage';
    case FREQUENT_ABSENTEEISM ='frequent-absenteeism';
    case SLEEP_DISORDERS ='sleep-disorders';
    case PSYCHOSOMATIC_PROBLEMS ='psychosomatic-problems';
    case DETERIORATION_OF_PERSONAL_LIFE ='deterioration-of-personal-life';
    case MORAL_HARASSMENT ='moral-harassment';
    case SEXUAL_HARASSMENT ='sexual-harassment';
    case DISCRIMINATION ='discrimination';
    case OTHER_FORMS_OF_VIOLENCE ='other-forms-of-violence';

    public function label(): string
    {
        return match ($this) {
            self::ORGANIZATIONAL_RIGIDITY => 'Rigidez Organizacional',
            self::WORK_OVERLOAD => 'Sobrecarga de Trabalho',
            self::LACK_OF_RESOURCES => 'Falta de Recursos',
            self::UNPREDICTABILITY => 'Imprevisibilidade',
            self::MONOTONY => 'Monotonia',
            self::ROLE_CONFLICT => 'Conflito de Papéis',
            self::INDIVIDUALISTIC_MANAGEMENT => 'Gestão Individualista',
            self::LACK_OF_RECOGNITION => 'Falta de Reconhecimento',
            self::MANAGEMENT_CONFLICTS => 'Conflitos com a Gestão',
            self::LACK_OF_MANAGERIAL_SUPPORT => 'Falta de Suporte Gerencial',
            self::PERCEIVED_INJUSTICE => 'Injustiça Percebida',
            self::EXCESSIVE_MANAGEMENT_PRESSURE => 'Pressão Excessiva da Gestão',
            self::EMOTIONAL_EXHAUSTION => 'Esgotamento Emocional',
            self::ANXIETY_OR_STRESS => 'Ansiedade ou Estresse',
            self::SOCIAL_ISOLATION => 'Isolamento Social',
            self::FRUSTRATION_OR_DEMOTIVATION => 'Frustração ou Desmotivação',
            self::IRRITABILITY => 'Irritabilidade',
            self::DIFFICULTY_CONCENTRATING => 'Dificuldade de Concentração',
            self::PHYSICAL_DAMAGE => 'Danos Físicos',
            self::PSYCHOLOGICAL_DAMAGE => 'Danos Psicológicos',
            self::FREQUENT_ABSENTEEISM => 'Afastamentos Frequentes',
            self::SLEEP_DISORDERS => 'Distúrbios do Sono',
            self::PSYCHOSOMATIC_PROBLEMS => 'Problemas Psicossomáticos',
            self::DETERIORATION_OF_PERSONAL_LIFE => 'Deterioração da Vida Pessoal',
            self::MORAL_HARASSMENT => 'Assédio Moral',
            self::SEXUAL_HARASSMENT => 'Assédio Sexual',
            self::DISCRIMINATION => 'Discriminação',
            self::OTHER_FORMS_OF_VIOLENCE => 'Outras Formas de Violência',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}