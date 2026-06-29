<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Livewire\Private\User\UserImportComponent;
use App\Models\Company;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

function importTestCompany(): Company
{
    return Company::factory()->create([
        'subscription_status'        => SubscriptionStatus::ACTIVE,
        'access_status'              => AccessStatus::ACTIVE,
        'billing_managed_externally' => true,
    ]);
}

it('show page and form to import users', function () {
    $company = importTestCompany();

    $this->actingAs($company, 'company')
        ->withSession([
            'auth:user'    => $company,
            'auth:company' => $company,
            'auth:guard'   => 'company',
        ])
        ->get(route('user.import'))
        ->assertOk()
        ->assertViewIs('private.user.import.index');
});

describe('UserImportComponent validation', function () {
    beforeEach(function () {
        $company = importTestCompany();
        session()->put('auth:user', $company);
        session()->put('auth:company', $company);
        session()->put('auth:guard', 'company');
    });

    it('file field is required', function () {
        Livewire::test(UserImportComponent::class)
            ->call('uploadUsersFile')
            ->assertHasErrors(['import_users_file']);
    });

    it('file must be xlsx format', function () {
        Livewire::test(UserImportComponent::class)
            ->set('import_users_file', UploadedFile::fake()->create('funcionarios.txt', 100))
            ->call('uploadUsersFile')
            ->assertHasErrors(['import_users_file']);
    });
});
