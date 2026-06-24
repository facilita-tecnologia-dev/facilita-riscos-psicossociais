<?php

namespace App\Actions\Subscription;

use App\Actions\Payment\CreatePaymentAction;
use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\Subscription;

class CreateSubscriptionAction
{
    public function execute(Company $company, int $employees, int $amount, PaymentType $type): Subscription 
    {
        $subscription = Subscription::create([
            'company_id' => $company->id,
            'employees_count' => $employees,
            'amount' => $amount,
            'type' => $type->value,
            'status' => SubscriptionStatus::PENDING->value,
            'started_at' => now(),
            'next_billing_at' => now()->addMonth(),
        ]);

        app(CreatePaymentAction::class)->execute($subscription);

        return $subscription;
    }
}