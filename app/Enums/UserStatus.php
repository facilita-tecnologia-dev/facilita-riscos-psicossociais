<?php

namespace App\Enums;

enum UserStatus: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    
    public static function labelFromValue(int $value): ?string
    {
        return self::tryFrom($value)?->label();
    }
}