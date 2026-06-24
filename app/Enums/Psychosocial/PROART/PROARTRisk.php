<?php

namespace App\Enums\Psychosocial\PROART;

enum PROARTRisk: string
{
    case LOW = '1';
    case MEDIUM = '2';
    case HIGH = '3';
    case CRITICAL = '4';

    
    public function default(): string
    {
        return match ($this) {
            self::LOW => 'Risco Baixo',
            self::MEDIUM => 'Risco Médio',
            self::HIGH => 'Risco Alto',
            self::CRITICAL => 'Risco Crítico',
        };
    }

    public function defaultColor(): string
    {
        return match ($this) {
            self::LOW => "#A8E6CF",
            self::MEDIUM => "#DDE26F",
            self::HIGH => "#F6B26B",
            self::CRITICAL => "#F26C6C",
        };
    }
}
