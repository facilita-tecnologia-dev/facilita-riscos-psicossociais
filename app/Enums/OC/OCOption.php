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
            self::STRONGLY_DISAGREE => __('oc_options.strongly_disagree'),
            self::DISAGREE => __('oc_options.disagree'),
            self::NEUTRAL => __('oc_options.neutral'),
            self::AGREE => __('oc_options.agree'),
            self::STRONGLY_AGREE => __('oc_options.strongly_agree'),
        };
    }
}
