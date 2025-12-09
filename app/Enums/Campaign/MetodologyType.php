<?php

namespace App\Enums\Campaign;

use App\Enums\Traits\EnumHelpers;

enum MetodologyType: string
{
    use EnumHelpers;

    case PROART = 'proart';
    case HSE = 'hse';
    case ORGANIZATIONAL = 'organizational-climate';

    public function label(): string
    {
        return match ($this) {
            self::PROART => 'PROART',
            self::HSE => 'HSE',
            self::ORGANIZATIONAL => 'Clima Organizacional',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}