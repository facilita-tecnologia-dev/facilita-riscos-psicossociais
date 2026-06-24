<?php

namespace App\Listeners;

use App\Events\PaymentFailed;
use App\Services\Subscription\CompanyStateService;

class BlockCompanyAccess
{
    public function __construct(private CompanyStateService $companyStateService) {}

    public function handle(PaymentFailed $event): void {
        $this->companyStateService->markPastDue($event->company);
    }
}
