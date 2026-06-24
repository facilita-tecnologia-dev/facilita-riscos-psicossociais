<?php

namespace App\Actions\Payment;

use App\Actions\Subscription\PrepareNextBillingCycleAction;
use App\Models\Payment;
use App\Models\Subscription;

class MarkPaymentAsPaidAction
{
    public function execute(Payment $payment)
    {
        $payment->update(['status' => 'paid', 'paid_at' => now()]);
        $subscription = $payment->subscription;

        app(PrepareNextBillingCycleAction::class)->execute($subscription);
    }
}