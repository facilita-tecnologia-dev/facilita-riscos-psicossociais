<?php

namespace App\Enums\Psychosocial;

enum RiskInventoryCoverage: string
{
    case ALL_RISKS  = 'all_risks';
    case HIGH_RISKS = 'high_risks';

    public function default(): string
    {
        return match ($this) {
            self::ALL_RISKS => 'Todos',
            self::HIGH_RISKS => 'Substanciais e Intoleráveis',
        };
    }

    public function aiha(): string
    {
        return match ($this) {
            self::ALL_RISKS => 'Todos',
            self::HIGH_RISKS => 'Altos e Muito Altos',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
