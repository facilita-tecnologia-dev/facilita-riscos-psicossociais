<?php

namespace App\Enums\HSE;

enum HSEHazard: string
{
    case WORK_OVERLOAD = 'hse-work-overload';
    case DEADLINE_PRESSURE = 'hse-deadline-pressure';
    case LONG_WORKING_HOURS = 'hse-long-working-hours';
    case CONSTANT_INTERRUPTIONS = 'hse-constant-interruptions';
    case INSUFFICIENT_RESOURCES = 'hse-insufficient-resources';
    case HIGH_EMOTIONAL_DEMANDS = 'hse-high-emotional-demands';
    case LOW_AUTONOMY = 'hse-low-autonomy';
    case MICROMANAGEMENT = 'hse-micromanagement';
    case LOW_SCHEDULE_FLEXIBILITY = 'hse-low-schedule-flexibility';
    case RIGID_PROCEDURES = 'hse-rigid-procedures';
    case LACK_OF_FEEDBACK = 'hse-lack-of-feedback';
    case TOXIC_LEADERSHIP = 'hse-toxic-leadership';
    case INSUFFICIENT_TRAINING = 'hse-insufficient-training';
    case SOCIAL_ISOLATION = 'hse-social-isolation';
    case CHRONIC_TEAM_CONFLICTS = 'hse-chronic-team-conflicts';
    case MORAL_HARASSMENT = 'hse-moral-harassment';
    case SEXUAL_HARASSMENT = 'hse-sexual-harassment';
    case INCIVILITY = 'hse-incivility';
    case DISCRIMINATION = 'hse-discrimination';
    case VIOLENCE = 'hse-violence';
    case ROLE_AMBIGUITY = 'hse-role-ambiguity';
    case ROLE_CONFLICT = 'hse-role-conflict';
    case RESPONSIBILITY_WITHOUT_AUTHORITY = 'hse-responsibility-without-authority';
    case FREQUENT_PRIORITY_CHANGES = 'hse-frequent-priority-changes';
    case POOR_CHANGE_COMMUNICATION = 'hse-poor-change-communication';
    case JOB_INSECURITY = 'hse-job-insecurity';
    case RESTRUCTURING = 'hse-restructuring';
    case NEW_TECHNOLOGY_WITHOUT_TRAINING = 'hse-new-technology-without-training';
    case LOSS_OF_BENEFITS = 'hse-loss-of-benefits';


    public function label(): string
    {
        return match ($this) {
            self::WORK_OVERLOAD => 'Sobrecarga de Trabalho',
            self::DEADLINE_PRESSURE => 'Pressão por prazos/ritmo',
            self::LONG_WORKING_HOURS => 'Jornadas extensas/plantões sem recuperação',
            self::CONSTANT_INTERRUPTIONS => 'Interrupções constantes/multitarefa',
            self::INSUFFICIENT_RESOURCES => 'Recursos insuficientes',
            self::HIGH_EMOTIONAL_DEMANDS => 'Exigências emocionais elevadas',
            self::LOW_AUTONOMY => 'Baixa autonomia',
            self::MICROMANAGEMENT => 'Microgestão',
            self::LOW_SCHEDULE_FLEXIBILITY => 'Baixa flexibilidade de horário/local',
            self::RIGID_PROCEDURES => 'Procedimentos excessivamente rígidos',
            self::LACK_OF_FEEDBACK => 'Falta de feedback/reconhecimento',
            self::TOXIC_LEADERSHIP => 'Liderança tóxica',
            self::INSUFFICIENT_TRAINING => 'Treinamento/recursos de trabalho insuficientes',
            self::SOCIAL_ISOLATION => 'Isolamento social',
            self::CHRONIC_TEAM_CONFLICTS => 'Conflitos crônicos de equipe',
            self::MORAL_HARASSMENT => 'Assédio moral',
            self::SEXUAL_HARASSMENT => 'Assédio sexual',
            self::INCIVILITY => 'Incivilidade/humilhações',
            self::DISCRIMINATION => 'Discriminação',
            self::VIOLENCE => 'Violência/ameaças',
            self::ROLE_AMBIGUITY => 'Ambiguidade de papel',
            self::ROLE_CONFLICT => 'Conflito de papéis/metas contraditórias',
            self::RESPONSIBILITY_WITHOUT_AUTHORITY => 'Responsabilidade sem autoridade',
            self::FREQUENT_PRIORITY_CHANGES => 'Mudança frequente de prioridades',
            self::POOR_CHANGE_COMMUNICATION => 'Comunicação deficiente de mudanças',
            self::JOB_INSECURITY => 'Insegurança no emprego',
            self::RESTRUCTURING => 'Reestruturações/fusões',
            self::NEW_TECHNOLOGY_WITHOUT_TRAINING => 'Tecnologia nova sem capacitação',
            self::LOSS_OF_BENEFITS => 'Perda de benefícios/alteração de jornada',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}