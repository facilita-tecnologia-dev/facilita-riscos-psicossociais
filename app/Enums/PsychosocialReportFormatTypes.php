<?php

namespace App\Enums;

enum PsychosocialReportFormatTypes: string
{
    case PDF = 'pdf';
    case EXCEL = 'excel';

    public function label(): string
    {
        return match ($this) {
            self::PDF => 'PDF',
            self::EXCEL => 'Excel',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
