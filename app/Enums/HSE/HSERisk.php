<?php

namespace App\Enums\HSE;

enum HSERisk: string
{
    case TRIVIAL = '1';
    case TOLERABLE = '2';
    case MODERATE = '3';
    case SUBSTANTIAL = '4';
    case INTOLERABLE = '5';

    public function label(): string
    {
        return match ($this) {
            self::TRIVIAL => 'Trivial',
            self::TOLERABLE => 'Tolerável',
            self::MODERATE => 'Moderado',
            self::SUBSTANTIAL => 'Substancial',
            self::INTOLERABLE => 'Intolerável',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::INTOLERABLE => '#F44336',
            self::SUBSTANTIAL => '#FF9800',
            self::MODERATE => '#FFC107',
            self::TOLERABLE => '#CDDC39',
            self::TRIVIAL => '#4CAF50',
        };
    }
}
