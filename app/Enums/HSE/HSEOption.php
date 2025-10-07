<?php

namespace App\Enums\HSE;

enum HSEOption: int
{
    case NEVER = 0;
    case RARELY = 1;
    case SOMETIMES = 2;
    case FREQUENTLY = 3;
    case ALWAYS = 4;

    public function label(): string
    {
        return match ($this) {
            self::NEVER => 'Nunca',
            self::RARELY => 'Raramente',
            self::SOMETIMES => 'Às vezes',
            self::FREQUENTLY => 'Frequentemente',
            self::ALWAYS => 'Sempre',
        };
    }
}
