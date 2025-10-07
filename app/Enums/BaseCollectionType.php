<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelpers;

enum BaseCollectionType: string
{
    use EnumHelpers;

    case PSYCHOSOCIAL = 'psychosocial-risks';
    case ORGANIZATIONAL = 'organizational-climate';

    public function label(): string
    {
        return match ($this) {
            self::PSYCHOSOCIAL => 'Riscos Psicossociais',
            self::ORGANIZATIONAL => 'Clima Organizacional',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}