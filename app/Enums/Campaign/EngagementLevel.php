<?php

namespace App\Enums\Campaign;

enum EngagementLevel: string
{
    case SATISFACTORY = 'Satisfatória';
    case MEDIUM = 'Média';
    case UNSATISFACTORY = 'Insatisfatória';

    public static function fromPercentage(float $value): self
    {
        return match (true) {
            $value >= 75 => self::SATISFACTORY,
            $value >= 40 => self::MEDIUM,
            default      => self::UNSATISFACTORY,
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SATISFACTORY   => '#5EC8BC',
            self::MEDIUM         => '#FFD60A',
            self::UNSATISFACTORY => '#FF453A',
        };
    }
}