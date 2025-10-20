<?php

namespace App\Enums\OC;

enum OCOption: int
{
    case STRONGLY_AGREE = 5;
    case AGREE = 4;
    case NEUTRAL = 3;
    case DISAGREE = 2;
    case STRONGLY_DISAGREE = 1;

    public function inverted(): string
    {
        return match ($this) {
            self::STRONGLY_AGREE => 1,
            self::AGREE => 2,
            self::NEUTRAL => 3,
            self::DISAGREE => 4,
            self::STRONGLY_DISAGREE => 5,
        };
    }
    
    public function label(): string
    {
        return match ($this) {
            self::STRONGLY_DISAGREE => 'Discordo totalmente',
            self::DISAGREE => 'Discordo parcialmente',
            self::NEUTRAL => 'Não tenho uma opinião definida',
            self::AGREE => 'Concordo parcialmente',
            self::STRONGLY_AGREE => 'Concordo totalmente',
        };
    }
}
