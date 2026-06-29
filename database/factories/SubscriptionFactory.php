<?php

namespace Database\Factories;

use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id'      => Company::factory(),
            'employees_count' => 50,
            'amount'          => 50000,
            'type'            => PaymentType::YEARLY,
            'status'          => SubscriptionStatus::PENDING,
            'started_at'      => now(),
        ];
    }

    public function active(): static
    {
        return $this->state([
            'status'               => SubscriptionStatus::ACTIVE,
            'current_period_start' => now(),
            'current_period_end'   => now()->addYear(),
            'next_billing_at'      => now()->addYear(),
        ]);
    }

    public function monthly(): static
    {
        return $this->state([
            'type'   => PaymentType::MONTHLY,
            'amount' => 5000,
        ]);
    }

    public function yearly(): static
    {
        return $this->state([
            'type'   => PaymentType::YEARLY,
            'amount' => 50000,
        ]);
    }

    public function pastDue(): static
    {
        return $this->state([
            'status'               => SubscriptionStatus::PAST_DUE,
            'current_period_start' => now()->subMonth(),
            'current_period_end'   => now()->subDay(),
            'next_billing_at'      => now()->subDay(),
            'past_due_at'          => now()->subDay(),
        ]);
    }
}
