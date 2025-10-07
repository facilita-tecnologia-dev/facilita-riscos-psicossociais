<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelpers;

enum BaseCollection: string
{
    use EnumHelpers;

    case PROART = 'proart';
    case HSE = 'hse';
    case ORGANIZATIONAL = 'organizational-climate';

    // public function label(): string
    // {
    //     return match ($this) {
    //         self::PROART => 'Riscos Psicossociais',
    //         self::HSE => 'Clima Organizacional',
    //         self::ORGANIZATIONAL => 'Clima Organizacional',
    //     };
    // }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}