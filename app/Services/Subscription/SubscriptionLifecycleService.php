<?php

namespace App\Services\Subscription;

use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionEvent;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class SubscriptionLifecycleService
{
    public static function activate(Subscription $subscription): void {
        DB::transaction(function () use ($subscription) {
            $company = $subscription->company;
            $wasTrial = $company->trial_started_at !== null;

            if ($wasTrial) {
                TrialCleanupService::cleanup($company);
            }

            $currentPeriodStart = now();

            $currentPeriodEnd = $subscription->type === PaymentType::MONTHLY ? now()->addMonth() : now()->addYear();

            $subscription->update([
                'status' => SubscriptionStatus::ACTIVE,
                'current_period_start' => $currentPeriodStart,
                'current_period_end' => $currentPeriodEnd,
                'next_billing_at' => $currentPeriodEnd,
            ]);

            CompanyStateService::activate($subscription->company);
            CompanyNotificationService::notifySubscriptionCompany($company, $subscription->employees_count, $subscription->type);
            SubscriptionEventService::log($subscription, SubscriptionEvent::SUBSCRIPTION_ACTIVATED->value);
        });
    }

    public static function renew(Subscription $subscription): void {
        DB::transaction(function () use ($subscription) {
            if ($subscription->scheduled_type) {
                $subscription->update([
                    'type' => $subscription->scheduled_type,
                    'scheduled_type' => null,
                ]);

                $subscription->refresh();
            }

            $currentStart = $subscription->current_period_end;
            $currentEnd = $subscription->type === PaymentType::MONTHLY ? $currentStart->copy()->addMonth() : $currentStart->copy()->addYear();

            $subscription->update([
                'status' => SubscriptionStatus::ACTIVE,
                'current_period_start' => $currentStart,
                'current_period_end' => $currentEnd,
                'next_billing_at' => $currentEnd,
                'past_due_at' => null,
            ]);

            CompanyStateService::activate($subscription->company);
            SubscriptionEventService::log($subscription, SubscriptionEvent::RENEWAL_PAID->value);
            SubscriptionEventService::log($subscription, SubscriptionEvent::SUBSCRIPTION_REACTIVATED->value);
        });
    }

    public static function changePlan(Subscription $subscription, int $employeesCount, int $amount,): void {
        DB::transaction(function () use ($subscription, $employeesCount, $amount) {
            $oldEmployeesCount = $subscription->employees_count;
            $oldAmount = $subscription->amount;

            $subscription->update([
                'employees_count' => $employeesCount,
                'amount' => $amount,
            ]);

            SubscriptionEventService::log(
                $subscription,
                SubscriptionEvent::SUBSCRIPTION_PLAN_CHANGED->value,
                [
                    'old_employees_count' => $oldEmployeesCount,
                    'new_employees_count' => $employeesCount,
                    'old_amount' => $oldAmount,
                    'new_amount' => $amount,
                ]
            );
        });
    }

    public static function scheduleTypeChange(Subscription $subscription, PaymentType $type): void {
        $subscription->update([
            'scheduled_type' => $type,
        ]);

        SubscriptionEventService::log(
            $subscription,
            SubscriptionEvent::SUBSCRIPTION_TYPE_CHANGE_SCHEDULED->value,
            [
                'current_type' => $subscription->type->value,
                'scheduled_type' => $type->value,
            ]
        );
    }

    public static function cancelScheduledTypeChange(Subscription $subscription): void {
        $oldScheduledType = $subscription->scheduled_type;

        $subscription->update([
            'scheduled_type' => null,
        ]);

        SubscriptionEventService::log(
            $subscription,
            SubscriptionEvent::SUBSCRIPTION_TYPE_CHANGE_CANCELED->value,
            [
                'scheduled_type' => $oldScheduledType?->value,
            ]
        );
    }

    public static function markPastDue(Subscription $subscription): void {
        DB::transaction(function () use ($subscription) {
            $subscription->update([
                'status' => SubscriptionStatus::PAST_DUE,
                'past_due_at' => now(),
            ]);

            CompanyStateService::markPastDue($subscription->company);
            SubscriptionEventService::log($subscription, SubscriptionEvent::SUBSCRIPTION_PAST_DUE->value);
        });
    }

    public static function scheduleCancelation(Subscription $subscription,): void {
        $subscription->update([
            'cancel_at_period_end' => true,
            'scheduled_cancel_at' => $subscription->current_period_end,
        ]);

        SubscriptionEventService::log( $subscription, SubscriptionEvent::SUBSCRIPTION_CANCEL_SCHEDULED->value);
    }

    public static function finalizeCancellation(Subscription $subscription): void {
        DB::transaction(function () use ($subscription) {
            $subscription->update([
                'status' => SubscriptionStatus::ENDED,
                'cancel_at_period_end' => false,
                'scheduled_cancel_at' => null,
                'ended_at' => now(),
            ]);

            CompanyStateService::end($subscription->company);
            SubscriptionEventService::log($subscription, SubscriptionEvent::SUBSCRIPTION_ENDED->value);
        });
    }

    public static function reactivate(Subscription $subscription): void {
        $subscription->update([
            'cancel_at_period_end' => false,
            'scheduled_cancel_at' => null,
            'canceled_at' => null,
            'ended_at' => null,
            'status' => SubscriptionStatus::ACTIVE,
            'past_due_at' => null,
        ]);

        CompanyStateService::activate($subscription->company);

        SubscriptionEventService::log($subscription, SubscriptionEvent::SUBSCRIPTION_REACTIVATED->value);
    }
}