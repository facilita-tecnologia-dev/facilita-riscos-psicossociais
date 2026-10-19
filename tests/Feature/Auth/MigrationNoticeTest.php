<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

// Passagem para o Facilita RH (RP21): só a empresa migrada; durante os dias de adaptação, a página; depois, direto.
function migrationNoticeSession(Company $company, string $guard): array
{
    return ['auth:user' => $guard === 'company' ? $company : User::factory()->create(), 'auth:company' => $company, 'auth:guard' => $guard];
}

beforeEach(function () {
    config([
        'migration_notice.days' => 30,
        'migration_notice.company_url' => 'https://rh.example.test',
        'migration_notice.user_url' => 'https://conecta.example.test',
    ]);
});

it('does not affect a company that was not migrated', function () {
    $company = Company::factory()->create();
    config(['migration_notice.companies' => []]);

    $response = $this->withSession(migrationNoticeSession($company, 'company'))->get(route('home.company'));

    expect($response->getContent())->not->toContain('mudaram de endereço');
});

it('shows the notice with the days left to the migrated company', function () {
    $company = Company::factory()->create();
    config(['migration_notice.companies' => [$company->id => now()->subDays(10)->toDateString()]]);

    $this->withSession(migrationNoticeSession($company, 'company'))->get(route('home.company'))
        ->assertOk()
        ->assertSee('mudaram de endereço')
        ->assertSee('20 dias')
        ->assertSee('https://rh.example.test', false);
});

it('sends the employee of a migrated company to the Conecta', function () {
    $company = Company::factory()->create();
    config(['migration_notice.companies' => [$company->id => now()->toDateString()]]);

    $this->withSession(migrationNoticeSession($company, 'user'))->get(route('home.user'))
        ->assertOk()
        ->assertSee('Facilita Conecta')
        ->assertSee('https://conecta.example.test', false);
});

it('redirects straight to the Facilita RH after the adaptation days', function () {
    $company = Company::factory()->create();
    config(['migration_notice.companies' => [$company->id => now()->subDays(31)->toDateString()]]);

    $this->withSession(migrationNoticeSession($company, 'company'))->get(route('home.company'))
        ->assertRedirect('https://rh.example.test');
});
