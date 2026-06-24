<?php

namespace App\Enums\Subscription;

enum SubscriptionEvent: string
{
    case SUBSCRIPTION_CREATED = 'subscription_created';
    case SUBSCRIPTION_ACTIVATED = 'subscription_activated';
    case SUBSCRIPTION_ENDED = 'subscription_ended';
    case SUBSCRIPTION_CANCEL_SCHEDULED = 'subscription_cancel_scheduled';
    case SUBSCRIPTION_REACTIVATED = 'subscription_reactivated';
    case SUBSCRIPTION_PAST_DUE = 'subscription_past_due';
    case SUBSCRIPTION_PLAN_CHANGED = 'subscription_plan_changed';
    case SUBSCRIPTION_TYPE_CHANGE_SCHEDULED = 'subscription_type_change_scheduled';
    case SUBSCRIPTION_TYPE_CHANGE_CANCELED = 'subscription_type_change_canceled';
    case PAYMENT_PAID = 'payment_paid';
    case PAYMENT_OVERDUE = 'payment_overdue';
    case RENEWAL_GENERATED = 'renewal_generated';
    case RENEWAL_PAID = 'renewal_paid';
    case RENEWAL_FAILED = 'renewal_failed';
    case RETRY_REQUESTED = 'retry_requested';

    
    public function label(): string
    {
        return match ($this) {
            self::SUBSCRIPTION_CREATED => 'Assinatura criada',
            self::SUBSCRIPTION_ACTIVATED => 'Assinatura ativada',
            self::SUBSCRIPTION_ENDED => 'Assinatura encerrada',
            self::SUBSCRIPTION_CANCEL_SCHEDULED => 'Cancelamento da assinatura agendado',
            self::SUBSCRIPTION_REACTIVATED => 'Assinatura reativada',
            self::SUBSCRIPTION_PAST_DUE => 'Assinatura atrasada',
            self::SUBSCRIPTION_PLAN_CHANGED => 'Plano alterado',
            self::SUBSCRIPTION_TYPE_CHANGE_SCHEDULED => 'Alteração no tipo de pagamento agendada',
            self::SUBSCRIPTION_TYPE_CHANGE_CANCELED => 'Alteração da forma de cobrança cancelada',
            self::PAYMENT_PAID => 'Pagamento realizado',
            self::PAYMENT_OVERDUE =>  'Pagamento atrasado',
            self::RENEWAL_GENERATED => 'Renovação criada',
            self::RENEWAL_PAID => 'Renovação paga',
            self::RENEWAL_FAILED => 'Falha na renovação',
            self::RETRY_REQUESTED => 'Nova tentativa solicitada',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}