<?php

namespace App\Services\Subscription;

use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\Subscription;
use App\Services\Subscription\Billing\PaymentService;

class SubscriptionService
{
    public static function startTrial(Company $company, int $employeesCount): Subscription {
        $trialEndsAt = now()->addDays(14);

        $subscription = Subscription::query()
            ->create([
                'company_id' => $company->id,
                'employees_count' => $employeesCount,
                'amount' => 0,
                'status' => SubscriptionStatus::TRIALING,

                'started_at' => now(),

                'current_period_start' => now(),
                'current_period_end' => $trialEndsAt,

                'next_billing_at' => $trialEndsAt,

                'cancel_at_period_end' => false,
                'scheduled_cancel_at' => null,
            ]);

        CompanyStateService::trial($company, $trialEndsAt);

        return $subscription;
    }

    public static function createPendingSubscription(Company $company, int $employeesCount, int $amount, PaymentType $type): array {
        $subscription = Subscription::query()
            ->where('company_id', $company->id)
            ->whereIn('status', [
                SubscriptionStatus::TRIALING,
                SubscriptionStatus::PENDING,
            ])
            ->first();

        if ($subscription) {
            $subscription->update([
                'employees_count' => $employeesCount,
                'amount' => $amount,
                'type' => $type,

                'status' => SubscriptionStatus::PENDING,

                'started_at' => now(),

                'current_period_start' => null,
                'current_period_end' => null,
                'next_billing_at' => null,

                'cancel_at_period_end' => false,
                'scheduled_cancel_at' => null,
                'ended_at' => null,
            ]);
        } else {
            $subscription = Subscription::create([
                'company_id' => $company->id,
                'employees_count' => $employeesCount,
                'amount' => $amount,
                'type' => $type,

                'status' => SubscriptionStatus::PENDING,

                'started_at' => now(),

                'current_period_start' => null,
                'current_period_end' => null,
                'next_billing_at' => null,

                'cancel_at_period_end' => false,
                'scheduled_cancel_at' => null,
            ]);
        }

        $payment = $subscription->payments()
            ->where('status', PaymentStatus::PENDING)
            ->first();

        if ($payment) {
            $payment->update([
                'amount' => $amount,

                'gateway_payment_id' => null,
                'gateway_status' => null,
                'gateway_payload' => null,
                'checkout_url' => null,
            ]);
        } else {
            $payment = PaymentService::createPayment($subscription);
        }

        CompanyStateService::markPending($company);

        return [
            'subscription' => $subscription,
            'payment' => $payment,
        ];
    }

    public static function getCurrent(Company $company,): ?Subscription {
        return Subscription::query()
            ->where('company_id', $company->id)
            ->latest()
            ->first();
    }
}