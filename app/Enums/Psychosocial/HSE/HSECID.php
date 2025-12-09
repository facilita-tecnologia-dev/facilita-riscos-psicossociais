<?php

namespace App\Enums\Psychosocial\HSE;

enum HSECID: string
{
    case F32 = 'F32';
    case F33 = 'F33';
    case F34 = 'F34';
    case F40 = 'F40';
    case F41 = 'F41';
    case F43_0 = 'F43.0';
    case F43_1 = 'F43.1';
    case F43_2 = 'F43.2';
    case F43_8 = 'F43.8';
    case F43_9 = 'F43.9';
    case Z73_0 = 'Z73.0';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
