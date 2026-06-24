<?php

namespace App\Enums\Psychosocial\HSE;

enum HSEProbability: string
{
    case VERY_UNLIKELY = '1';
    case UNLIKELY = '2';
    case POSSIBLE = '3';
    case LIKELY = '4';
    case VERY_LIKELY = '5';

    
    public function default(): string
    {
        return match ($this) {
            self::VERY_UNLIKELY => 'Muito improvável',
            self::UNLIKELY => 'Improvável',
            self::POSSIBLE => 'Possível',
            self::LIKELY => 'Provável',
            self::VERY_LIKELY => 'Muito provável',
        };
    }

    public function aiha(): string
    {
        return match ($this) {
            self::VERY_UNLIKELY => 'Não há exposição',
            self::UNLIKELY => 'Exposição a níveis baixos',
            self::POSSIBLE => 'Exposição moderada',
            self::LIKELY => 'Exposição elevada',
            self::VERY_LIKELY => 'Exposição elevadíssima',
        };
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
