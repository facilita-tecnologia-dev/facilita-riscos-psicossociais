<?php

namespace App\Enums;

enum RoleEnum: string
{
    case MANAGER = '1';
    case EMPLOYEE = '2';

    
    public function label(): string
    {
        return match ($this) {
            self::MANAGER => 'Gestor Interno',
            self::EMPLOYEE => 'Colaborador',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
