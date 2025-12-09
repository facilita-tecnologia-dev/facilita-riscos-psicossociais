<?php

namespace App\Enums\Psychosocial\PROART;

enum PROARTOption: int
{
    case ALWAYS = 5;
    case FREQUENTLY = 4;
    case SOMETIMES = 3;
    case RARELY = 2;
    case NEVER = 1;

    public function inverted(): string
    {
        return match ($this) {
            self::ALWAYS => 1,
            self::FREQUENTLY => 2,
            self::SOMETIMES => 3,
            self::RARELY => 4,
            self::NEVER => 5,
        };
    }

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
