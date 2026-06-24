<?php

namespace App\Enums\Subscription;

enum PaymentType: string
{
    case MONTHLY  = 'monthly'; 
    case YEARLY = 'yearly';

    public function label(): string
    {
        return match ($this) {
            self::MONTHLY => 'Mensal',
            self::YEARLY => 'Anual',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}