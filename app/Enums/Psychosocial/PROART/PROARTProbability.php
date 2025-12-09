<?php

namespace App\Enums\Psychosocial\PROART;

enum PROARTProbability: string
{
    case UNLIKELY = '1';
    case POSSIBLE = '2';
    case LIKELY = '3';
    case VERY_LIKELY = '4';

    
    public function label(): string
    {
        return match ($this) {
            self::UNLIKELY => 'Improvável',
            self::POSSIBLE => 'Possível',
            self::LIKELY => 'Provável',
            self::VERY_LIKELY => 'Muito Provável',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
