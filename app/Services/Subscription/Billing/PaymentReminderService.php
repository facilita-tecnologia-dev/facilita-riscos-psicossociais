<?php

namespace App\Services\Subscription\Billing;

use App\Enums\Subscription\PaymentEmailType;
use App\Enums\Subscription\PaymentStatus;
use App\Models\Payment;

class PaymentReminderService
{
    public static function send(): void
    {
        $payments = Payment::query()
            ->whereIn('status', [PaymentStatus::PENDING, PaymentStatus::FAILED])
            ->whereDate('due_date', '>=', now()->subDays(15))
            ->get();

        foreach ($payments as $payment) {
            self::process($payment);
        }
    }

    private static function process(Payment $payment): void {
        if (! $payment->due_date) return;
        
        $days = now()->startOfDay()->diffInDays($payment->due_date->copy()->startOfDay(), false);

        match (true) {
            $days == 1 => self::sendDueIn1Day($payment),
            $days == 0 => self::sendDueToday($payment),
            $days == -3 => self::sendOverdue3Days($payment),
            $days == -7 => self::sendOverdue7Days($payment),
            $days == -15 => self::sendOverdue15Days($payment),
            default => null,
        };
    }

    private static function sendDueIn1Day(Payment $payment): void {
        if ($payment->due_in_1_day_email_sent_at) return;
        PaymentNotificationService::send($payment, PaymentEmailType::DUE_IN_1_DAY);
        $payment->update(['due_in_1_day_email_sent_at' => now()]);
    }

    private static function sendDueToday(Payment $payment): void {
        if ($payment->due_today_email_sent_at) return;
        PaymentNotificationService::send($payment, PaymentEmailType::DUE_TODAY);
        $payment->update(['due_today_email_sent_at' => now()]);
    }
    
    private static function sendOverdue3Days(Payment $payment): void {
        if ($payment->overdue_3_days_email_sent_at) return;
        PaymentNotificationService::send($payment, PaymentEmailType::OVERDUE_3_DAYS);
        $payment->update(['overdue_3_days_email_sent_at' => now()]);
    }

    private static function sendOverdue7Days(Payment $payment): void {
        if ($payment->overdue_7_days_email_sent_at) return;
        PaymentNotificationService::send($payment, PaymentEmailType::OVERDUE_7_DAYS);
        $payment->update(['overdue_7_days_email_sent_at' => now()]);
    }

    private static function sendOverdue15Days(Payment $payment): void {
        if ($payment->overdue_15_days_email_sent_at) return;
        PaymentNotificationService::send($payment, PaymentEmailType::OVERDUE_15_DAYS);
        $payment->update(['overdue_15_days_email_sent_at' => now()]);
    }
}