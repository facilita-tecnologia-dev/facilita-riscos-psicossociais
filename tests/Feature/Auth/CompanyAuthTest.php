<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use App\Livewire\Auth\Login\CompanyLoginComponent;
use App\Livewire\Auth\Register\CompanyRegisterComponent;

uses(DatabaseTransactions::class);

describe('login page', function () {
    it('renders login page for guests', function () {
        $this->get(route('company.login'))->assertOk();
    });
});

describe('CompanyLoginComponent validation', function () {
    it('requires cnpj', function () {
        Livewire::test(CompanyLoginComponent::class)
            ->set('cnpj', '')
            ->set('password', 'password')
            ->call('submit')
            ->assertHasErrors(['cnpj']);
    });

    it('requires password', function () {
        Livewire::test(CompanyLoginComponent::class)
            ->set('cnpj', '11.222.333/0001-81')
            ->set('password', '')
            ->call('submit')
            ->assertHasErrors(['password']);
    });

    it('dispatches danger alert for unregistered company', function () {
        Livewire::test(CompanyLoginComponent::class)
            ->set('cnpj', '11.222.333/0001-81')
            ->set('password', 'wrongpassword')
            ->call('submit')
            ->assertDispatched('alert:danger');
    });

    it('dispatches danger alert for wrong password', function () {
        Company::factory()->create([
            'cnpj'     => '11.222.333/0001-81',
            'password' => Hash::make('correct_password'),
        ]);

        Livewire::test(CompanyLoginComponent::class)
            ->set('cnpj', '11.222.333/0001-81')
            ->set('password', 'wrong_password')
            ->call('submit')
            ->assertDispatched('alert:danger');
    });
});

describe('register page', function () {
    it('renders register page for guests', function () {
        $this->get(route('company.register'))->assertOk();
    });
});

describe('CompanyRegisterComponent validation', function () {
    it('requires name with minimum 6 characters', function () {
        Livewire::test(CompanyRegisterComponent::class)
            ->set('name', 'ABC')
            ->set('cnpj', '11.222.333/0001-81')
            ->set('email', 'test@test.com')
            ->set('password', 'Password1!')
            ->set('password_confirmation', 'Password1!')
            ->call('submit')
            ->assertHasErrors(['name']);
    });

    it('requires valid cnpj format', function () {
        Livewire::test(CompanyRegisterComponent::class)
            ->set('name', 'Empresa Teste')
            ->set('cnpj', '1234')
            ->set('email', 'test@test.com')
            ->set('password', 'Password1!')
            ->set('password_confirmation', 'Password1!')
            ->call('submit')
            ->assertHasErrors(['cnpj']);
    });

    it('requires unique cnpj', function () {
        $existingCompany = Company::factory()->create(['cnpj' => '11.222.333/0001-81']);

        Livewire::test(CompanyRegisterComponent::class)
            ->set('name', 'Empresa Teste')
            ->set('cnpj', $existingCompany->cnpj)
            ->set('email', 'new@test.com')
            ->set('password', 'Password1!')
            ->set('password_confirmation', 'Password1!')
            ->call('submit')
            ->assertHasErrors(['cnpj']);
    });

    it('requires valid email', function () {
        Livewire::test(CompanyRegisterComponent::class)
            ->set('name', 'Empresa Teste')
            ->set('cnpj', '11.222.333/0001-81')
            ->set('email', 'not-an-email')
            ->set('password', 'Password1!')
            ->set('password_confirmation', 'Password1!')
            ->call('submit')
            ->assertHasErrors(['email']);
    });

    it('requires password confirmation to match', function () {
        Livewire::test(CompanyRegisterComponent::class)
            ->set('name', 'Empresa Teste')
            ->set('cnpj', '11.222.333/0001-81')
            ->set('email', 'test@test.com')
            ->set('password', 'Password1!')
            ->set('password_confirmation', 'DifferentPassword1!')
            ->call('submit')
            ->assertHasErrors(['password_confirmation']);
    });

    it('requires start_mode to be trial or subscription', function () {
        Livewire::test(CompanyRegisterComponent::class)
            ->set('name', 'Empresa Teste')
            ->set('cnpj', '11.222.333/0001-81')
            ->set('email', 'test@test.com')
            ->set('password', 'Password1!')
            ->set('password_confirmation', 'Password1!')
            ->set('start_mode', 'invalid')
            ->call('submit')
            ->assertHasErrors(['start_mode']);
    });
});

describe('password reset pages', function () {
    it('renders forgot password page for guests', function () {
        $this->get(route('company.password-request'))->assertOk();
    });
});
