<?php

namespace App\Listeners;

use App\Events\SubscriptionCanceled;
use App\Services\Subscription\CompanyStateService;

class CancelSubscription
{
    public function __construct(private CompanyStateService $companyStateService) {}

    public function handle(SubscriptionCanceled $event): void {
        $this->companyStateService->cancel($event->company);
    }
}
