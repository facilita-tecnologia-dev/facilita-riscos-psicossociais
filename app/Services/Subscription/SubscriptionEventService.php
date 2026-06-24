<?php

namespace App\Services\Subscription;

use App\Models\Subscription;

class SubscriptionEventService
{
    public static function log(Subscription $subscription, string $type, ?array $payload = null): void {
        $subscription
            ->events()
            ->create([
                'type' => $type,
                'payload' => $payload,
            ]);
    }
}