<?php

namespace App\Enums\Psychosocial\HSE;

enum HSEOption: int
{
    case NEVER = 0;
    case RARELY = 1;
    case SOMETIMES = 2;
    case FREQUENTLY = 3;
    case ALWAYS = 4;

    public function inverted(): string
    {
        return match ($this) {
            self::NEVER => 4,
            self::RARELY => 3,
            self::SOMETIMES => 2,
            self::FREQUENTLY => 1,
            self::ALWAYS => 0,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::NEVER => __('hse_options.never'),
            self::RARELY => __('hse_options.rarely'),
            self::SOMETIMES => __('hse_options.sometimes'),
            self::FREQUENTLY => __('hse_options.frequently'),
            self::ALWAYS => __('hse_options.always'),
        };
    }
}
