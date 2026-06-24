<?php

namespace App\Services\Subscription;

class SubscriptionPricingService
{
    public static function pricing(int $employees): array
    {
        return match (true) {
            $employees <= 50 => ['yearly' => 50000, 'monthly' => 5000,],
            $employees <= 100 => ['yearly' => 80000, 'monthly' => 8000,],
            $employees <= 200 => ['yearly' => 100000, 'monthly' => 10000,],
            $employees <= 300 => ['yearly' => 200000, 'monthly' => 20000,],
            $employees <= 400 => ['yearly' => 300000, 'monthly' => 30000,],
            $employees <= 500 => ['yearly' => 400000, 'monthly' => 40000,],
            $employees <= 750 => ['yearly' => 500000, 'monthly' => 50000,],
            $employees <= 1000 => ['yearly' => 600000, 'monthly' => 60000,],
            default => ['yearly' => 800000, 'monthly' => 80000,],
        };
    }

    public static function employeeRange(int $employees): string
    {
        return match (true) {
            $employees <= 50 => '1 - 50',
            $employees <= 100 => '51 - 100',
            $employees <= 200 => '101 - 200',
            $employees <= 300 => '201 - 300',
            $employees <= 400 => '301 - 400',
            $employees <= 500 => '401 - 500',
            $employees <= 750 => '501 - 750',
            $employees <= 1000 => '751 - 1000',
            default => '1000+',
        };
    }

    public static function maxEmployees(int $employees): int
    {
        return match (true) {
            $employees <= 1 => 1,
            $employees <= 50 => 50,
            $employees <= 100 => 100,
            $employees <= 200 => 200,
            $employees <= 300 => 300,
            $employees <= 400 => 400,
            $employees <= 500 => 500,
            $employees <= 750 => 750,
            $employees <= 1000 => 1000,
            default => PHP_INT_MAX,
        };
    }
}
