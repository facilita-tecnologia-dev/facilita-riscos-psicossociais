<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Enums\User\UserStatus;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

it('show user page', function () {
    $company = Company::factory()->create([
        'subscription_status' => SubscriptionStatus::ACTIVE,
        'access_status'       => AccessStatus::ACTIVE,
    ]);
    $user = User::factory()->create();

    // UserInfoComponent requires the user to be attached to the company via the pivot
    $role = Role::first();
    $user->companies()->attach($company->id, ['role_id' => $role->id, 'status' => UserStatus::ACTIVE->value]);

    // UserPolicy::view() allows a user to view their own profile when using user guard
    $this->actingAs($user, 'web')
        ->withSession([
            'auth:user'    => $user,
            'auth:company' => $company,
            'auth:guard'   => 'user',
        ])
        ->get(route('user.show', $user))
        ->assertOk()
        ->assertViewIs('private.user.show.index')
        ->assertViewHas('user', fn (User $u) => $u->id === $user->id);
});
