<?php

namespace App\Enums\Subscription;

enum AccessStatus: string
{
    case ACTIVE = 'active';
    case BLOCKED = 'blocked';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::BLOCKED => 'Bloqueado',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}