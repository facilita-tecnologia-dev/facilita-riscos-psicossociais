<?php

namespace App\Enums\Subscription;

enum SubscriptionStatus: string
{
    case TRIALING = 'trialing';
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case PAST_DUE = 'past_due';
    case CANCELED = 'canceled';
    case ENDED = 'ended';

    public function label(): string
    {
        return match ($this) {
            self::TRIALING => 'Teste grátis',
            self::PENDING => 'Aguardando pagamento',
            self::ACTIVE => 'Ativo',
            self::PAST_DUE =>  'Pagamento atrasado',
            self::CANCELED => 'Cancelado',
            self::ENDED => 'Encerrado',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}