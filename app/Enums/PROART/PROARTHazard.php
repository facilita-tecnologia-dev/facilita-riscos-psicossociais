<?php

namespace App\Enums\PROART;

enum PROARTHazard: string
{
    case ORGANIZATIONAL_RIGIDITY ='proart-organizational-rigidity';
    case WORK_OVERLOAD ='proart-work-overload';
    case LACK_OF_RESOURCES ='proart-lack-of-resources';
    case UNPREDICTABILITY ='proart-unpredictability';
    case MONOTONY ='proart-monotony';
    case ROLE_CONFLICT ='proart-role-conflict';
    case INDIVIDUALISTIC_MANAGEMENT ='proart-individualistic-management';
    case LACK_OF_RECOGNITION ='proart-lack-of-recognition';
    case MANAGEMENT_CONFLICTS ='proart-management-conflicts';
    case LACK_OF_MANAGERIAL_SUPPORT ='proart-lack-of-managerial-support';
    case PERCEIVED_INJUSTICE ='proart-perceived-injustice';
    case EXCESSIVE_MANAGEMENT_PRESSURE ='proart-excessive-management-pressure';
    case EMOTIONAL_EXHAUSTION ='proart-emotional-exhaustion';
    case ANXIETY_OR_STRESS ='proart-anxiety-or-stress';
    case SOCIAL_ISOLATION ='proart-social-isolation';
    case FRUSTRATION_OR_DEMOTIVATION ='proart-frustration-or-demotivation';
    case IRRITABILITY ='proart-irritability';
    case DIFFICULTY_CONCENTRATING ='proart-difficulty-concentrating';
    case PHYSICAL_DAMAGE ='proart-physical-damage';
    case PSYCHOLOGICAL_DAMAGE ='proart-psychological-damage';
    case FREQUENT_ABSENTEEISM ='proart-frequent-absenteeism';
    case SLEEP_DISORDERS ='proart-sleep-disorders';
    case PSYCHOSOMATIC_PROBLEMS ='proart-psychosomatic-problems';
    case DETERIORATION_OF_PERSONAL_LIFE ='proart-deterioration-of-personal-life';
    case MORAL_HARASSMENT ='proart-moral-harassment';
    case SEXUAL_HARASSMENT ='proart-sexual-harassment';
    case DISCRIMINATION ='proart-discrimination';
    case OTHER_FORMS_OF_VIOLENCE ='proart-other-forms-of-violence';

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