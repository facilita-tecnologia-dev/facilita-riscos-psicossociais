<?php

namespace App\Enums;

enum PsychosocialQuestionOptionsEnum: int
{
    case NEVER = 1;
    case RARELY = 2;
    case SOMETIMES = 3;
    case FREQUENTLY = 4;
    case ALWAYS = 5;

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
