<?php

namespace App\Enums\Psychosocial\HSE;

enum HSERiskMatrix: string
{
    case DEFAULT = 'default';
    case AIHA = 'aiha';

    
    public function label(): string
    {
        return match ($this) {
            self::DEFAULT => 'Padrão HSE',
            self::AIHA => 'Matriz AHIA',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
