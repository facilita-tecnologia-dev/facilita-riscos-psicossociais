<?php

use App\Services\Subscription\SubscriptionPricingService;

describe('tiers()', function () {
    it('returns exactly 9 tiers', function () {
        expect(SubscriptionPricingService::tiers())->toHaveCount(9);
    });

    it('each tier has value and label keys', function () {
        foreach (SubscriptionPricingService::tiers() as $tier) {
            expect($tier)->toHaveKeys(['value', 'label']);
        }
    });

    it('last tier represents 1000+ employees', function () {
        $tiers = SubscriptionPricingService::tiers();
        expect(end($tiers))->toMatchArray(['value' => 1001, 'label' => '1000+']);
    });
});

describe('pricing()', function () {
    it('returns yearly and monthly keys', function () {
        $pricing = SubscriptionPricingService::pricing(50);
        expect($pricing)->toHaveKeys(['yearly', 'monthly']);
    });

    it('prices tier 1-50 correctly', function () {
        expect(SubscriptionPricingService::pricing(1))->toMatchArray(['yearly' => 50000, 'monthly' => 5000]);
        expect(SubscriptionPricingService::pricing(50))->toMatchArray(['yearly' => 50000, 'monthly' => 5000]);
    });

    it('prices tier 51-100 correctly', function () {
        expect(SubscriptionPricingService::pricing(51))->toMatchArray(['yearly' => 80000, 'monthly' => 8000]);
        expect(SubscriptionPricingService::pricing(100))->toMatchArray(['yearly' => 80000, 'monthly' => 8000]);
    });

    it('prices tier 101-200 correctly', function () {
        expect(SubscriptionPricingService::pricing(101))->toMatchArray(['yearly' => 100000, 'monthly' => 10000]);
        expect(SubscriptionPricingService::pricing(200))->toMatchArray(['yearly' => 100000, 'monthly' => 10000]);
    });

    it('prices tier 201-300 correctly', function () {
        expect(SubscriptionPricingService::pricing(201))->toMatchArray(['yearly' => 200000, 'monthly' => 20000]);
        expect(SubscriptionPricingService::pricing(300))->toMatchArray(['yearly' => 200000, 'monthly' => 20000]);
    });

    it('prices tier 301-400 correctly', function () {
        expect(SubscriptionPricingService::pricing(301))->toMatchArray(['yearly' => 300000, 'monthly' => 30000]);
        expect(SubscriptionPricingService::pricing(400))->toMatchArray(['yearly' => 300000, 'monthly' => 30000]);
    });

    it('prices tier 401-500 correctly', function () {
        expect(SubscriptionPricingService::pricing(401))->toMatchArray(['yearly' => 400000, 'monthly' => 40000]);
        expect(SubscriptionPricingService::pricing(500))->toMatchArray(['yearly' => 400000, 'monthly' => 40000]);
    });

    it('prices tier 501-750 correctly', function () {
        expect(SubscriptionPricingService::pricing(501))->toMatchArray(['yearly' => 500000, 'monthly' => 50000]);
        expect(SubscriptionPricingService::pricing(750))->toMatchArray(['yearly' => 500000, 'monthly' => 50000]);
    });

    it('prices tier 751-1000 correctly', function () {
        expect(SubscriptionPricingService::pricing(751))->toMatchArray(['yearly' => 600000, 'monthly' => 60000]);
        expect(SubscriptionPricingService::pricing(1000))->toMatchArray(['yearly' => 600000, 'monthly' => 60000]);
    });

    it('prices 1000+ employees correctly', function () {
        expect(SubscriptionPricingService::pricing(1001))->toMatchArray(['yearly' => 800000, 'monthly' => 80000]);
        expect(SubscriptionPricingService::pricing(9999))->toMatchArray(['yearly' => 800000, 'monthly' => 80000]);
    });

    it('yearly price is always greater than monthly', function () {
        foreach (SubscriptionPricingService::tiers() as $tier) {
            $pricing = SubscriptionPricingService::pricing($tier['value']);
            expect($pricing['yearly'])->toBeGreaterThan($pricing['monthly']);
        }
    });
});

describe('employeeRange()', function () {
    it('returns correct label for tier boundaries', function () {
        expect(SubscriptionPricingService::employeeRange(1))->toBe('1 - 50');
        expect(SubscriptionPricingService::employeeRange(50))->toBe('1 - 50');
        expect(SubscriptionPricingService::employeeRange(51))->toBe('51 - 100');
        expect(SubscriptionPricingService::employeeRange(100))->toBe('51 - 100');
        expect(SubscriptionPricingService::employeeRange(101))->toBe('101 - 200');
        expect(SubscriptionPricingService::employeeRange(200))->toBe('101 - 200');
        expect(SubscriptionPricingService::employeeRange(201))->toBe('201 - 300');
        expect(SubscriptionPricingService::employeeRange(300))->toBe('201 - 300');
        expect(SubscriptionPricingService::employeeRange(1001))->toBe('1000+');
        expect(SubscriptionPricingService::employeeRange(5000))->toBe('1000+');
    });
});

describe('maxEmployees()', function () {
    it('returns 1 for exactly 1 employee (single-employee special case)', function () {
        expect(SubscriptionPricingService::maxEmployees(1))->toBe(1);
    });

    it('returns 50 for values 2-50', function () {
        expect(SubscriptionPricingService::maxEmployees(2))->toBe(50);
        expect(SubscriptionPricingService::maxEmployees(50))->toBe(50);
    });

    it('returns 100 for values in 51-100 tier', function () {
        expect(SubscriptionPricingService::maxEmployees(51))->toBe(100);
        expect(SubscriptionPricingService::maxEmployees(100))->toBe(100);
    });

    it('returns PHP_INT_MAX for 1000+ tier', function () {
        expect(SubscriptionPricingService::maxEmployees(1001))->toBe(PHP_INT_MAX);
    });
});
