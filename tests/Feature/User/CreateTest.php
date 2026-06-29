<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Enums\User\UserRole;
use App\Livewire\Private\User\UserCreateComponent;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

function userCreateCompany(): Company
{
    return Company::factory()->create([
        'subscription_status'        => SubscriptionStatus::ACTIVE,
        'access_status'              => AccessStatus::ACTIVE,
        'billing_managed_externally' => true,
    ]);
}

it('renders user create page', function () {
    $company = userCreateCompany();

    $this->actingAs($company, 'company')
        ->withSession([
            'auth:user'    => $company,
            'auth:company' => $company,
            'auth:guard'   => 'company',
        ])
        ->get(route('user.create'))
        ->assertOk()
        ->assertViewIs('private.user.create.index');
});

describe('UserCreateComponent validation', function () {
    beforeEach(function () {
        $company = userCreateCompany();
        session()->put('auth:user', $company);
        session()->put('auth:company', $company);
        session()->put('auth:guard', 'company');
    });

    it('name is required', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', '')
            ->set('cpf', '222.333.444-05')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['name']);
    });

    it('name cannot exceed 255 characters', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', str_repeat('a', 256))
            ->set('cpf', '222.333.444-05')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['name']);
    });

    it('cpf is required', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['cpf']);
    });

    it('cpf must be in correct format', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '12345678909')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['cpf']);
    });

    it('cpf must pass checksum validation', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '245.765.987-01')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['cpf']);
    });

    it('cpf must be unique', function () {
        User::factory()->create(['cpf' => '222.333.444-05']);

        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '222.333.444-05')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['cpf']);
    });

    it('department is required', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '123.456.789-09')
            ->set('department', '')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['department']);
    });

    it('occupation is required', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '123.456.789-09')
            ->set('department', 'Financeiro')
            ->set('occupation', '')
            ->set('role', UserRole::EMPLOYEE->value)
            ->call('submit')
            ->assertHasErrors(['occupation']);
    });

    it('role is required', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '123.456.789-09')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', '')
            ->call('submit')
            ->assertHasErrors(['role']);
    });

    it('role must be a valid user role', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '123.456.789-09')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', 'invalid_role')
            ->call('submit')
            ->assertHasErrors(['role']);
    });

    it('birth_date must be at least 16 years ago when provided', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '123.456.789-09')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->set('birth_date', now()->subYears(5)->format('Y-m-d'))
            ->call('submit')
            ->assertHasErrors(['birth_date']);
    });

    it('admission must not be in the future when provided', function () {
        Livewire::test(UserCreateComponent::class)
            ->set('name', 'João da Silva')
            ->set('cpf', '123.456.789-09')
            ->set('department', 'Financeiro')
            ->set('occupation', 'Analista')
            ->set('role', UserRole::EMPLOYEE->value)
            ->set('admission', now()->addYear()->format('Y-m-d'))
            ->call('submit')
            ->assertHasErrors(['admission']);
    });
});
