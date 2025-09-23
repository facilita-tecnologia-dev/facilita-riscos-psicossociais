<?php

namespace App\Enums;

enum FinalRiskTypes: string
{
    case LOW = '1';
    case MEDIUM = '2';
    case HIGH = '3';
    case CRITICAL = '4';

    
    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Risco Baixo',
            self::MEDIUM => 'Risco Médio',
            self::HIGH => 'Risco Alto',
            self::CRITICAL => 'Risco Crítico',
        };
    }
}
