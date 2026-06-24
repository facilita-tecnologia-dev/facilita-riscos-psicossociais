<?php

namespace App\Services\Subscription\Billing;

use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionEvent;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\Subscription\SubscriptionEventService;

class PaymentService
{
    public static function createPayment(Subscription $subscription, PaymentKind $kind = PaymentKind::INITIAL): Payment {
        return $subscription->payments()->create([
            'kind' => $kind,
            'amount' => $subscription->amount,
            'paid_amount' => null,
            'due_date' => now()->addDays(3),
            'status' => PaymentStatus::PENDING,
            'external_reference' => 'payment_' . $subscription->id . '_' . uniqid(),
            'gateway_payment_id' => null,
        ]);
    }

    public static function createPlanChangePayment(Subscription $subscription, int $amount, int $employeesCount, PaymentType $type): Payment {
        $payment = $subscription->payments()
            ->where('kind', PaymentKind::PLAN_CHANGE)
            ->where('status', PaymentStatus::PENDING)
            ->latest()
            ->first();

        if ($payment) {
            $payment->update([
                'amount' => $amount,
                'due_date' => now()->addDays(3),
                'metadata' => [
                    'employees_count' => $employeesCount,
                    'amount' => $amount,
                    'type' => $type->value,
                ],
                'gateway_payment_id' => null,
                'gateway_status' => null,
                'gateway_invoice_url' => null,
                'gateway_receipt_url' => null,
                'gateway_payload' => null,
            ]);

            return $payment->fresh();
        }

        return $subscription->payments()->create([
            'kind' => PaymentKind::PLAN_CHANGE,
            'amount' => $amount,
            'paid_amount' => null,
            'due_date' => now()->addDays(3),
            'status' => PaymentStatus::PENDING,
            'external_reference' => 'payment_' . $subscription->id . '_' . uniqid(),
            'metadata' => [
                'employees_count' => $employeesCount,
                'amount' => $amount,
                'type' => $type->value,
            ],
        ]);
    }

    public static function markAsPaid(Payment $payment, array $payload = [],): void {
        $payment->update([
            'status' => PaymentStatus::PAID,
            'paid_at' => now(),
            'paid_amount' => $payload['charges'][0]['amount']['value'] ?? $payment->amount,
            'gateway_status' => $payload['charges'][0]['status'] ?? null,
            'gateway_payload' => $payload,
            'gateway_payment_method' => $payload['payment_method'] ?? null,
            'gateway_receipt_url' => $payload['receipt_url'] ?? null,

             'checkout_url' => null,
        ]);

        SubscriptionEventService::log($payment->subscription, SubscriptionEvent::PAYMENT_PAID->value, $payload);
    }

    public static function markAsFailed(Payment $payment, array $payload = []): void {
        $payment->update([
            'status' => PaymentStatus::FAILED,
            'gateway_status' => $payload['charges'][0]['status'] ?? null,
            'gateway_payload' => $payload,
        ]);
    }
}