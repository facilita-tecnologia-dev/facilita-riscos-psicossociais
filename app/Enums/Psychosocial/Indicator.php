<?php

namespace App\Enums\Psychosocial;

enum Indicator: string
{
    case EXTRA_HOURS = 'extra-hours';
    case ABSENTEEISM = 'absenteeism';
    case TURNOVER = 'turnover';
    case REPORTS = 'reports';

    public function label(): string
    {
        return match ($this) {
            self::EXTRA_HOURS => 'Horas Extra',
            self::ABSENTEEISM => 'Absenteísmo',
            self::TURNOVER => 'Rotatividade',
            self::REPORTS => 'Denúncias',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}