<?php

namespace App\Enums;

enum GravityTypes: string
{
    case LOW = '1';
    case MEDIUM = '2';
    case HIGH = '3';
    case CRITICAL = '4';

    
    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Baixo',
            self::MEDIUM => 'Médio',
            self::HIGH => 'Alto',
            self::CRITICAL => 'Crítico',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
