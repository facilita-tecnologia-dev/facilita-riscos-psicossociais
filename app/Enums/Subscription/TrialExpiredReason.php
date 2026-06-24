<?php

namespace App\Enums\Subscription;

enum TrialExpiredReason: string
{
    case TIME_LIMIT  = 'time_limit'; 
    case USAGE_LIMIT = 'usage_limit';

    public function label(): string
    {
        return match ($this) {
            self::TIME_LIMIT => 'Limite de tempo',
            self::USAGE_LIMIT => 'Limite de uso',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}