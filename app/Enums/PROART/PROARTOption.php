<?php

namespace App\Enums\PROART;

enum PROARTOption: int
{
    case ALWAYS = 5;
    case FREQUENTLY = 4;
    case SOMETIMES = 3;
    case RARELY = 2;
    case NEVER = 1;

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
