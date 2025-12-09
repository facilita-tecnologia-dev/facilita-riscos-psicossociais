<?php

namespace App\Enums\OC;

enum OCGroup: string
{
    case WORK_CONDITIONS = 'work-conditions';
    case WORK_SOCIAL_RELATIONS = 'work-social-relations';
    case MOTIVATION_VALUES_AND_PURPOSES = 'motivation-values-and-purposes';
    case DEVELOPMENT_CARREER_RECOGNITION = 'development-carreer-recognition';
    case COMMUNICATION_AND_INFORMATION = 'communication-and-information';
    case ENGAGEMENT_AND_PRIDE = 'engagement-and-pride';

    public function label(): string
    {
        return match ($this) {
            self::WORK_CONDITIONS => 'Condições e Organização do Trabalho',
            self::WORK_SOCIAL_RELATIONS => 'Liderança e Relações Interpessoais',
            self::MOTIVATION_VALUES_AND_PURPOSES => 'Motivação e Valorização',
            self::DEVELOPMENT_CARREER_RECOGNITION => 'Remuneração e Carreira',
            self::COMMUNICATION_AND_INFORMATION => 'Comunicação',
            self::ENGAGEMENT_AND_PRIDE => 'Engajamento e Participação',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::WORK_CONDITIONS => '#FFB080',
            self::WORK_SOCIAL_RELATIONS => '#CC80FF',
            self::MOTIVATION_VALUES_AND_PURPOSES => '#80A4FF',
            self::DEVELOPMENT_CARREER_RECOGNITION => '#9DD466',
            self::COMMUNICATION_AND_INFORMATION => '#FF8080',
            self::ENGAGEMENT_AND_PRIDE => '#FF80E8',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}