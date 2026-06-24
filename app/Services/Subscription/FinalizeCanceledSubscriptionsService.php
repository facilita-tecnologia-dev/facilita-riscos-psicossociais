<?php

namespace App\Services\Subscription;

use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Subscription;

class FinalizeCanceledSubscriptionsService
{
    public function process(): void
    {
        Subscription::query()
            ->whereNotNull('ends_at')
            ->where('ends_at', '<=', now())
            ->each(function (Subscription $subscription) {
                $subscription->update([
                    'status' => SubscriptionStatus::CANCELED,
                    'canceled_at' =>now(),
                ]);

                CompanyStateService::end($subscription->company);
            });
    }
}