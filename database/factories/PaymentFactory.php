<?php

namespace Database\Factories;

use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subscription_id'    => Subscription::factory(),
            'kind'               => PaymentKind::INITIAL,
            'amount'             => 50000,
            'due_date'           => now()->addDays(3),
            'status'             => PaymentStatus::PENDING,
            'external_reference' => 'payment_test_' . uniqid(),
        ];
    }

    public function paid(): static
    {
        return $this->state([
            'status'      => PaymentStatus::PAID,
            'paid_at'     => now(),
            'paid_amount' => 50000,
        ]);
    }

    public function failed(): static
    {
        return $this->state([
            'status' => PaymentStatus::FAILED,
        ]);
    }

    public function renewal(): static
    {
        return $this->state([
            'kind' => PaymentKind::RENEWAL,
        ]);
    }

    public function planChange(int $employeesCount = 100, int $amount = 80000): static
    {
        return $this->state([
            'kind'     => PaymentKind::PLAN_CHANGE,
            'amount'   => $amount,
            'metadata' => [
                'employees_count' => $employeesCount,
                'amount'          => $amount,
                'type'            => 'yearly',
            ],
        ]);
    }
}
