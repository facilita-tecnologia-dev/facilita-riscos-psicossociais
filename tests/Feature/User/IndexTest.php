<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

it('show users page', function () {
    $company = Company::factory()->create([
        'subscription_status' => SubscriptionStatus::ACTIVE,
        'access_status'       => AccessStatus::ACTIVE,
    ]);

    $this->actingAs($company, 'company')
        ->withSession([
            'auth:user'    => $company,
            'auth:company' => $company,
            'auth:guard'   => 'company',
        ])
        ->get(route('user.index'))
        ->assertOk();
});
