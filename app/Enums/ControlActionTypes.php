<?php

namespace App\Enums;

enum ControlActionTypes: string
{
    case REDUCTION = 'reduction';
    case ADMINISTRATIVE = 'administrative';
    case PROTECTION = 'protection';
    case PREVENTION = 'prevention';

    public function label(): string
    {
        return match ($this) {
            self::REDUCTION => 'Redução/Eliminação',
            self::ADMINISTRATIVE => 'Controles Administrativos',
            self::PROTECTION => 'Proteção',
            self::PREVENTION => 'Prevenção',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}