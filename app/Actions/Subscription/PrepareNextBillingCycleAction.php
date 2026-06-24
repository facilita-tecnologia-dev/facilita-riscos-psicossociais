<?php

namespace App\Actions\Subscription;

use App\Actions\Payment\CreatePaymentAction;
use App\Models\Subscription;

class PrepareNextBillingCycleAction
{
    public function execute(Subscription $subscription)
    {
        $subscription->update([
            'next_billing_at' => $subscription->type === 'monthly' ? now()->addMonth() : now()->addYear(),
        ]);

        app(CreatePaymentAction::class)->execute($subscription);
    }
}