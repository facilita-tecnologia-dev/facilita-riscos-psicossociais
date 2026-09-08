<?php

namespace Database\Seeders;

use App\Enums\Campaign\CampaignStatus;
use App\Enums\Campaign\CollectionCategory;
use App\Enums\Psychosocial\PROART\PROARTHazard;
use App\Enums\Psychosocial\PsychosocialQuestionnaire;
use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Models\BaseCollection;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Organizationalndicator;
use App\Models\User;
use Database\Seeders\BaseTests\SBHSEQuestions\SBHSEQuestions;
use Illuminate\Database\Seeder;

/**
 * Empresa de testes que usa o formulário Sebratel (avaliado pelo motor HSE),
 * com funcionários fake e uma campanha em andamento pronta para responder.
 *
 * Rodar: php artisan db:seed --class=Database\\Seeders\\SebratelTestCompanySeeder
 */
class SebratelTestCompanySeeder extends Seeder
{
    private const EMAIL = 'sebratel.teste@example.com';
    private const PASSWORD = 'company123';
    private const EMPLOYEES = 12;

    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');

        // Limpa execução anterior
        $existing = Company::firstWhere('email', self::EMAIL);
        if ($existing) {
            User::whereIn('id', $existing->allUsers()->pluck('users.id'))->delete();
            $existing->delete(); // cascata: company_user, campaigns, action_plan, etc.
        }

        $cnpj = $faker->cnpj();

        $company = Company::create([
            'name' => 'Sebratel Testes Ltda',
            'cnpj' => $cnpj,
            'email' => self::EMAIL,
            'password' => self::PASSWORD, // cast 'hashed' aplica o bcrypt
            'psychosocial_collection_type' => 'hse',
            'psychosocial_questionnaire' => PsychosocialQuestionnaire::SB_BASED_ON_HSE,
            'has_cids' => true,
            'can_access_organizational' => true,
            'billing_managed_externally' => true,
            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status' => AccessStatus::ACTIVE,
        ]);

        // Funcionários (login só com CPF)
        $employees = collect();
        for ($i = 0; $i < self::EMPLOYEES; $i++) {
            $user = User::factory()->create([
                'password' => null,
                'is_temp_password' => false,
            ]);
            $company->allUsers()->attach($user, [
                'role_id' => UserRole::EMPLOYEE->value,
                'status' => UserStatus::ACTIVE->value,
            ]);
            $employees->push($user);
        }

        // Um gestor (login com CPF + senha company123)
        $manager = User::factory()->create([
            'name' => 'Gestor Sebratel',
            'password' => self::PASSWORD,
            'is_temp_password' => false,
        ]);
        $company->allUsers()->attach($manager, [
            'role_id' => UserRole::MANAGER->value,
            'status' => UserStatus::ACTIVE->value,
        ]);

        // Indicadores / relatórios / plano de ação (mesma base do cadastro real)
        Organizationalndicator::each(fn ($indicator) => $company->organizationalIndicators()->create(['indicator_id' => $indicator->id]));

        CompanyReport::insert([
            ['company_id' => $company->id, 'type' => PROARTHazard::MORAL_HARASSMENT->value],
            ['company_id' => $company->id, 'type' => PROARTHazard::SEXUAL_HARASSMENT->value],
            ['company_id' => $company->id, 'type' => PROARTHazard::DISCRIMINATION->value],
            ['company_id' => $company->id, 'type' => PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value],
        ]);

        $actionPlan = $company->actionPlan()->create();
        BaseControlAction::all()->each(fn ($controlAction) => $actionPlan->controlActions()->create([
            'action_plan_id' => $actionPlan->id,
            'hazard_id' => $controlAction->hazard_id,
            'control_action_type_id' => $controlAction->control_action_type_id,
            'gravity' => $controlAction->gravity,
            'content' => $controlAction->content,
        ]));

        // Campanha em andamento com o formulário Sebratel
        $sbCollection = BaseCollection::firstWhere('key', SBHSEQuestions::COLLECTION_KEY);
        $company->campaigns()->create([
            'collection_id' => $sbCollection->id,
            'type' => CollectionCategory::BASE->value,
            'name' => 'Campanha Sebratel de Teste',
            'description' => 'Campanha para validar o formulário Sebratel avaliado pelo motor HSE.',
            'start_date' => now()->subDay(),
            'end_date' => now()->addWeeks(2),
            'status' => CampaignStatus::IN_PROGRESS->value,
        ]);

        $this->command->info('===================================================');
        $this->command->info(' Empresa de teste Sebratel criada');
        $this->command->info('===================================================');
        $this->command->info(" Login da empresa (CNPJ + senha):");
        $this->command->info("   CNPJ:  {$cnpj}");
        $this->command->info("   Senha: " . self::PASSWORD);
        $this->command->info('');
        $this->command->info(" Gestor (CPF + senha " . self::PASSWORD . "):");
        $this->command->info("   CPF: {$manager->cpf}");
        $this->command->info('');
        $this->command->info(" Funcionários (login só com CPF):");
        foreach ($employees as $e) {
            $this->command->info("   {$e->cpf}  -  {$e->name} ({$e->department} / {$e->occupation})");
        }
        $this->command->info('===================================================');
    }
}
