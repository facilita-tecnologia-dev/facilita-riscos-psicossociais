<?php

namespace App\Services\Subscription\Billing;

use App\Models\WebhookEvent;

class WebhookIdempotencyService
{
    public function alreadyProcessed(string $eventId): bool {
        return WebhookEvent::query()
            ->where('event_id', $eventId)
            ->exists();
    }

    public function store(string $gateway, string $eventId, string $eventType, array $payload): void {

        WebhookEvent::query()->create([
            'gateway' => $gateway,
            'event_id' => $eventId,
            'event_type' => $eventType,
            'payload' => $payload,
            'processed_at' => now(),
        ]);
    }
}