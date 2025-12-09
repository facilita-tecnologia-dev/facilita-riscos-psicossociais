<?php

namespace App\Enums\OC;

enum OCVisualization: string
{
    case GENERAL = 'general';
    case ANSWERS = 'answers';

    public function label(): string
    {
        return match ($this) {
            self::GENERAL => 'Geral',
            self::ANSWERS => 'Questões',
        };
    }
}