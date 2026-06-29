<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

function authSession(User $user, Company $company): array
{
    return [
        'auth:user'    => $user,
        'auth:company' => $company,
        'auth:guard'   => 'user',
    ];
}

describe('AuthMiddleware', function () {
    it('redirects unauthenticated requests to home', function () {
        $this->get(route('home.company'))
            ->assertRedirect(route('site.home'));
    });

    it('redirects unauthenticated requests to subscription page to home', function () {
        $this->get(route('company.subscription.index'))
            ->assertRedirect(route('site.home'));
    });

    it('redirects unauthenticated requests to campaign page to home', function () {
        $this->get(route('campaign.index'))
            ->assertRedirect(route('site.home'));
    });

    it('redirects unauthenticated requests to user list to home', function () {
        $this->get(route('user.index'))
            ->assertRedirect(route('site.home'));
    });
});

describe('GuestMiddleware', function () {
    it('allows guests to see the login page', function () {
        $this->get(route('company.login'))->assertOk();
    });

    it('allows guests to see the register page', function () {
        $this->get(route('company.register'))->assertOk();
    });

    it('allows guests to see the user login page', function () {
        $this->get(route('user.login'))->assertOk();
    });

    it('redirects authenticated company away from login to company home', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status'       => AccessStatus::ACTIVE,
        ]);
        $user = User::factory()->create();

        $this->withSession(authSession($user, $company))
            ->get(route('company.login'))
            ->assertRedirect();
    });
});

describe('EnsureCompanyCanCreateSubscription', function () {
    it('allows access to subscription page for pending company', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::PENDING,
            'access_status'       => AccessStatus::BLOCKED,
        ]);
        $user = User::factory()->create();

        $this->withSession(authSession($user, $company))
            ->get(route('company.subscription.index'))
            ->assertOk();
    });

    it('redirects active subscribers away from subscription page', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status'       => AccessStatus::ACTIVE,
        ]);
        $user = User::factory()->create();

        $this->withSession(authSession($user, $company))
            ->get(route('company.subscription.index'))
            ->assertRedirect(route('company.show', $company));
    });
});

describe('EnsureCompanyHasAccess', function () {
    it('allows access for companies with active subscription', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status'       => AccessStatus::ACTIVE,
        ]);
        $user = User::factory()->create();

        // home.company has no Gate check, so 200 proves the middleware let the request through
        $this->actingAs($company, 'company')
            ->withSession([
                'auth:user'    => $company,
                'auth:company' => $company,
                'auth:guard'   => 'company',
            ])
            ->get(route('home.company'))
            ->assertOk();
    });

    it('redirects blocked companies to subscription page', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::PENDING,
            'access_status'       => AccessStatus::BLOCKED,
        ]);
        $user = User::factory()->create();

        $this->withSession(authSession($user, $company))
            ->get(route('campaign.index'))
            ->assertRedirect(route('company.subscription.index'));
    });
});

describe('success page', function () {
    it('is accessible after authentication without subscription middleware', function () {
        $company = Company::factory()->create([
            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status'       => AccessStatus::ACTIVE,
        ]);
        $user = User::factory()->create();

        $this->withSession(authSession($user, $company))
            ->get(route('company.subscription.success'))
            ->assertOk();
    });
});
