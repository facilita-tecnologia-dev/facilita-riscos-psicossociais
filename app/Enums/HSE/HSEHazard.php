<?php

namespace App\Enums\HSE;

enum HSEHazard: string
{
    case WORK_OVERLOAD ='work-overload';
    case DEADLINE_PRESSURE = 'deadline-pressure';
    case LONG_WORKING_HOURS = 'long-working-hours';
    case CONSTANT_INTERRUPTIONS = 'constant-interruptions';
    case INSUFFICIENT_RESOURCES = 'insufficient-resources';
    case HIGH_EMOTIONAL_DEMANDS = 'high-emotional-demands';
    case LOW_AUTONOMY = 'low-autonomy';
    case MICROMANAGEMENT = 'micromanagement';
    case LOW_SCHEDULE_FLEXIBILITY = 'low-schedule-flexibility';
    case RIGID_PROCEDURES = 'rigid-procedures';
    case LACK_OF_FEEDBACK = 'lack-of-feedback';
    case TOXIC_LEADERSHIP = 'toxic-leadership';
    case INSUFFICIENT_TRAINING = 'insufficient-training';
    case SOCIAL_ISOLATION = 'social-isolation';
    case CHRONIC_TEAM_CONFLICTS = 'chronic-team-conflicts';
    case MORAL_HARASSMENT = 'moral-harassment';
    case SEXUAL_HARASSMENT = 'sexual-harassment';
    case INCIVILITY = 'incivility';
    case DISCRIMINATION = 'discrimination';
    case VIOLENCE = 'violence';
    case ROLE_AMBIGUITY = 'role-ambiguity';
    case ROLE_CONFLICT = 'role-conflict';
    case RESPONSIBILITY_WITHOUT_AUTHORITY = 'responsibility-without-authority';
    case FREQUENT_PRIORITY_CHANGES = 'frequent-priority-changes';
    case POOR_CHANGE_COMMUNICATION = 'poor-change-communication';
    case JOB_INSECURITY = 'job-insecurity';
    case RESTRUCTURING = 'restructuring';
    case NEW_TECHNOLOGY_WITHOUT_TRAINING = 'new-technology-without-training';
    case LOSS_OF_BENEFITS = 'loss-of-benefits';


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