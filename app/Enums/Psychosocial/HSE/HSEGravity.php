<?php

namespace App\Enums\Psychosocial\HSE;

enum HSEGravity: string
{
    case LIGHT = '1';
    case LOW = '2';
    case MODERATE = '3';
    case HIGH = '4';
    case EXTREME = '5';

    
    public function label(): string
    {
        return match ($this) {
            self::LIGHT => 'Leve',
            self::LOW => 'Baixa',
            self::MODERATE => 'Moderada',
            self::HIGH => 'Alta',
            self::EXTREME => 'Extrema',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
