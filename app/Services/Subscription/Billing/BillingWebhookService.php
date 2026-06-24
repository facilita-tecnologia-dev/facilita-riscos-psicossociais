<?php

namespace App\Services\Subscription\Billing;

use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\Subscription\SubscriptionLifecycleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillingWebhookService
{
    public function __construct(private PaymentService $paymentService, private WebhookIdempotencyService $idempotencyService) {}

    public function handlePagSeguroWebhook(array $payload): void
    {
        $charge = $payload['charges'][0] ?? null;

        if (! $charge) return;

        $referenceId = $charge['reference_id'] ?? null;
        $status = $charge['status'] ?? null;
        
        if (! $referenceId || ! $status) return;

        DB::transaction(function () use ($payload, $referenceId, $status) {
            $processed = match ($status) {
                'PAID' => $this->handlePaymentPaid($referenceId, $payload),
                'DECLINED' => $this->handlePaymentDeclined($referenceId, $payload),
                default => false,
            };

            if ($processed) {
                $this->idempotencyService->store('pagseguro', ($referenceId . '_' . $status), $status, $payload);
            }
        });
    }
    
    private function handlePaymentPaid(string $referenceId, array $payload): bool
    {
        $payment = $this->getPayment($referenceId);

        if ($payment->isPaid()) return false;

        $this->paymentService->markAsPaid($payment, $payload);

        match ($payment->kind) {
            PaymentKind::INITIAL => $this->handleInitialPayment($payment),
            PaymentKind::RENEWAL => $this->handleRenewalPayment($payment),
            PaymentKind::PLAN_CHANGE => $this->handlePlanChangePayment($payment),
        };

        return true;
    }

    private function handleInitialPayment(Payment $payment): void {
        SubscriptionLifecycleService::activate($payment->subscription);
    }

    private function handleRenewalPayment(Payment $payment): void {
        SubscriptionLifecycleService::renew($payment->subscription);
    }

    private function handlePlanChangePayment(Payment $payment): void {
        $metadata = $payment->metadata;
        SubscriptionLifecycleService::changePlan($payment->subscription, $metadata['employees_count'], $metadata['amount']);
    }

    private function handlePaymentDeclined(string $referenceId, array $payload): bool
    {
        $payment = $this->getPayment($referenceId);

        if ($payment->status === PaymentStatus::FAILED) return false;

        $this->paymentService->markAsFailed($payment, $payload);

        $subscription = $payment->subscription;

        if ($subscription->status === SubscriptionStatus::ACTIVE) {
            SubscriptionLifecycleService::markPastDue($subscription);
        }

        return true;
    }

    private function getPayment(string $referenceId): Payment
    {
        return Payment::query()
            ->where('external_reference', $referenceId)
            ->firstOrFail();
    }
}