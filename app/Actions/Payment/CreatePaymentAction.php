<?php

namespace App\Actions\Payment;

use App\Models\Subscription;

class CreatePaymentAction
{
    public function execute(Subscription $subscription)
    {
        return $subscription->payments()->create([
            'amount' => $subscription->amount,
            'status' => 'pending',
            'due_date' => $subscription->next_billing_at,
            'gateway' => $subscription->gateway,
        ]);
    }
}