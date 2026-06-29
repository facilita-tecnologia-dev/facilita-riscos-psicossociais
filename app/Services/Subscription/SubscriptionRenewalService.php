<?php

namespace App\Services\Subscription;

use App\Enums\Subscription\PaymentEmailType;
use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\SubscriptionEvent;
use App\Models\Subscription;
use App\Services\Subscription\Billing\PaymentNotificationService;
use App\Services\Subscription\Billing\PaymentService;

class SubscriptionRenewalService
{
    public static function generateRenewal(Subscription $subscription): array {
        if (! $subscription->isActive()) {
            throw new \Exception('Subscription is not active.');
        }

        $pendingPayment = $subscription
            ->payments()
            ->where('status', PaymentStatus::PENDING)
            ->first();

        if ($pendingPayment) {
            return [
                'created' => false,
                'payment' => $pendingPayment,
            ];
        }

        $payment = PaymentService::createPayment($subscription, PaymentKind::RENEWAL);

        SubscriptionEventService::log($subscription, SubscriptionEvent::RENEWAL_GENERATED->value);
        PaymentNotificationService::send($payment->fresh(), PaymentEmailType::CREATED);

        return [
            'created' => true,
            'payment' => $payment,
        ];
    }
}
