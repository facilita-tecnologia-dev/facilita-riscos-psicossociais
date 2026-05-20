<?php

namespace App\Enums\Psychosocial;

enum RiskInventoryCoverage: string
{
    case ALL_RISKS  = 'all_risks';
    case HIGH_RISKS = 'high_risks';

    public function label(): string
    {
        return match ($this) {
            self::ALL_RISKS => 'Todos',
            self::HIGH_RISKS => 'Substanciais e Intoleráveis',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
