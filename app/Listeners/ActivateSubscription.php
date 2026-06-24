<?php

namespace App\Listeners;

use App\Events\PaymentApproved;
use App\Services\Subscription\CompanyStateService;

class ActivateSubscription
{
    public function __construct(private CompanyStateService $companyStateService) {}

    public function handle(PaymentApproved $event): void {
        $this->companyStateService->activate($event->company);
    }
}
