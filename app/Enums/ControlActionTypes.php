<?php

namespace App\Enums;

enum ControlActionTypes: string
{
    case REDUCTION = 'reduction';
    case PROTECTION = 'protection';
    case PREVENTION = 'prevention';
    case LEGISLATION = 'legislation';

    public function label(): string
    {
        return match ($this) {
            self::REDUCTION => 'Redução/Eliminação',
            self::PROTECTION => 'Proteção',
            self::PREVENTION => 'Prevenção',
            self::LEGISLATION => 'Legislação',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}