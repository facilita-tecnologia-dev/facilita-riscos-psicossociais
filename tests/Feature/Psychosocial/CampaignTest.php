<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use App\Livewire\Private\Campaign\CampaignCreateComponent;

uses(DatabaseTransactions::class);

function activeCompanySession(Company $company): array
{
    return [
        'auth:user'    => $company,
        'auth:company' => $company,
        'auth:guard'   => 'company',
    ];
}

function createActiveCompany(): Company
{
    return Company::factory()->create([
        'subscription_status'       => SubscriptionStatus::ACTIVE,
        'access_status'             => AccessStatus::ACTIVE,
        'billing_managed_externally' => false,
    ]);
}

describe('campaign pages require auth', function () {
    it('campaign index page redirects unauthenticated requests', function () {
        $this->get(route('campaign.index'))
            ->assertRedirect(route('site.home'));
    });

    it('campaign create page redirects unauthenticated requests', function () {
        $this->get(route('campaign.create'))
            ->assertRedirect(route('site.home'));
    });
});

describe('campaign pages accessible with active company', function () {
    it('renders campaign index page', function () {
        $company = createActiveCompany();

        $this->actingAs($company, 'company')
            ->withSession(activeCompanySession($company))
            ->get(route('campaign.index'))
            ->assertOk();
    });

    it('renders campaign create page', function () {
        $company = createActiveCompany();

        $this->actingAs($company, 'company')
            ->withSession(activeCompanySession($company))
            ->get(route('campaign.create'))
            ->assertOk();
    });
});

describe('CampaignCreateComponent validation', function () {
    beforeEach(function () {
        $company = createActiveCompany();
        session()->put('auth:user', $company);
        session()->put('auth:company', $company);
        session()->put('auth:guard', 'company');
    });

    it('requires campaign name', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', '')
            ->set('collection_id', 'base_1')
            ->set('start_date', now()->addHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->call('submit')
            ->assertHasErrors(['name']);
    });

    it('requires campaign name with at least 8 characters', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', 'Short')
            ->set('collection_id', 'base_1')
            ->set('start_date', now()->addHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->call('submit')
            ->assertHasErrors(['name']);
    });

    it('rejects name longer than 255 characters', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', str_repeat('a', 256))
            ->set('collection_id', 'base_1')
            ->set('start_date', now()->addHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->call('submit')
            ->assertHasErrors(['name']);
    });

    it('requires collection to be selected', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', 'Campanha de Teste 2024')
            ->set('collection_id', '')
            ->set('start_date', now()->addHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->call('submit')
            ->assertHasErrors(['collection_id']);
    });

    it('requires start_date', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', 'Campanha de Teste 2024')
            ->set('collection_id', 'base_1')
            ->set('start_date', '')
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->call('submit')
            ->assertHasErrors(['start_date']);
    });

    it('requires end_date after start_date', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', 'Campanha de Teste 2024')
            ->set('collection_id', 'base_1')
            ->set('start_date', now()->addHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->subDay()->format('Y-m-d\TH:i'))
            ->call('submit')
            ->assertHasErrors(['end_date']);
    });

    it('rejects start_date in the past', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', 'Campanha de Teste 2024')
            ->set('collection_id', 'base_1')
            ->set('start_date', now()->subHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->call('submit')
            ->assertHasErrors(['start_date']);
    });

    it('rejects description longer than 512 characters', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', 'Campanha de Teste 2024')
            ->set('collection_id', 'base_1')
            ->set('start_date', now()->addHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->set('description', str_repeat('a', 513))
            ->call('submit')
            ->assertHasErrors(['description']);
    });

    it('accepts null description', function () {
        Livewire::test(CampaignCreateComponent::class)
            ->set('name', 'Campanha de Teste 2024')
            ->set('collection_id', 'base_1')
            ->set('start_date', now()->addHour()->format('Y-m-d\TH:i'))
            ->set('end_date', now()->addDays(7)->format('Y-m-d\TH:i'))
            ->set('description', null)
            ->call('submit')
            ->assertHasNoErrors(['description']);
    });
});
