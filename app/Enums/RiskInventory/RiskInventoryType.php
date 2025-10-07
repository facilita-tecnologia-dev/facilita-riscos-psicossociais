<?php

namespace App\Enums\RiskInventory;

enum RiskInventoryType: string
{
    case DEPARTMENT = 'department';
    case OCCUPATION = 'occupation';

    public function label(): string
    {
        return match ($this) {
            self::DEPARTMENT => 'Setor',
            self::OCCUPATION => 'Função',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
