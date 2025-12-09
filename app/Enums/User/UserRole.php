<?php

namespace App\Enums\User;

enum UserRole: string
{
    case MANAGER = '1';
    case EMPLOYEE = '2';

    public function label(): string
    {
        return match ($this) {
            self::MANAGER => 'Gestor',
            self::EMPLOYEE => 'Funcionário',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
