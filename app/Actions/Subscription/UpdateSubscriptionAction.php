<?php

namespace App\Actions\Subscription;

use App\Models\Subscription;
use App\Services\Psychosocial\SubscriptionPricingService;

class UpdateSubscriptionAction
{
    public function execute(Subscription $subscription)
    {
        $pricing = new SubscriptionPricingService();

        $newAmount = $pricing->calculate(
            $subscription->company->employees_count
        );

        $subscription->update([
            'amount' => $newAmount,
            'employees_count' => $subscription->company->employees_count,
        ]);

        return $subscription;
    }
}