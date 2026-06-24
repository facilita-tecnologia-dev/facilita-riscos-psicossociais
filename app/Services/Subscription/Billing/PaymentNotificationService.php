<?php

namespace App\Services\Subscription\Billing;

use App\Enums\Subscription\PaymentEmailType;
use App\Mail\PaymentNotificationMail;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;

class PaymentNotificationService
{
    public static function send(Payment $payment, PaymentEmailType $type): void {
        Mail::to($payment->subscription->company->email)->queue(
            new PaymentNotificationMail($payment, $type)
        );
    }
}