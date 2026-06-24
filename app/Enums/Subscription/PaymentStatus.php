<?php

namespace App\Enums\Subscription;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
    case OVERDUE = 'overdue';
    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pendente',
            self::PAID => 'Pago',
            self::FAILED =>  'Falhou',
            self::OVERDUE => 'Atrasado',
            self::CANCELED => 'Cancelado',
            self::REFUNDED => 'Ressarcido',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => '#FFC107',
            self::PAID => '#4CAF50',
            self::FAILED =>  '#F44336',
            self::OVERDUE => '#F44336',
            self::CANCELED => '#F44336',
            self::REFUNDED => '#FFC107',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}