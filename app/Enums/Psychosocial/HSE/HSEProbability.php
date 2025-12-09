<?php

namespace App\Enums\Psychosocial\HSE;

enum HSEProbability: string
{
    case VERY_UNLIKELY = '1';
    case UNLIKELY = '2';
    case POSSIBLE = '3';
    case LIKELY = '4';
    case VERY_LIKELY = '5';

    
    public function label(): string
    {
        return match ($this) {
            self::VERY_UNLIKELY => 'Muito improvável',
            self::UNLIKELY => 'Improvável',
            self::POSSIBLE => 'Possível',
            self::LIKELY => 'Provável',
            self::VERY_LIKELY => 'Muito provável',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
