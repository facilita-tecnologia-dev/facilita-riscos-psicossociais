<?php

namespace App\Enums;

enum OrganizationalQuestionOptionsEnum: int
{
    case STRONGLY_DISAGREE = 1;
    case DISAGREE = 2;
    case NEUTRAL = 3;
    case AGREE = 4;
    case STRONGLY_AGREE = 5;

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
