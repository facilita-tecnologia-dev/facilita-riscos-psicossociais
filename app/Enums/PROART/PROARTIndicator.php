<?php

namespace App\Enums\PROART;

enum PROARTIndicator: string
{
    case ABSENCES = 'absences';
    case ABSENTEEISM = 'absenteeism';
    case ACCIDENTS = 'accidents';
    case EXTRA_HOURS = 'extra-hours';
    case TURNOVER = 'turnover';

    public function label(): string
    {
        return match ($this) {
            self::ABSENCES => 'Afastamentos',
            self::ABSENTEEISM => 'Absenteísmo',
            self::ACCIDENTS => 'Acidentes',
            self::EXTRA_HOURS => 'Horas Extra',
            self::TURNOVER => 'Rotatividade',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}