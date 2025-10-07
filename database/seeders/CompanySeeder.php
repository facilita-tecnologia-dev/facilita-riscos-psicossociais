<?php

namespace Database\Seeders;

use App\Enums\PROART\PROARTHazard;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\PROARTIndicator;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::factory(5)->create(['password' => Hash::make('facilita3015')])->each(function($company){
            // Users
            User::factory(rand(8, 100))->create(['password' => null])->each(function($user) use($company) {
                $company->users()->attach($user, ['role_id' => rand(1, 2)]);
            });

            // Action Plan
            $actionPlan = $company->actionPlan()->create();

            BaseControlAction::all()->each(fn($controlAction) => 
                $actionPlan->controlActions()->create([
                    'action_plan_id' => $actionPlan->id,
                    'hazard_id' => $controlAction->hazard_id,
                    'control_action_type_id' => $controlAction->control_action_type_id,
                    'gravity' => $controlAction->gravity,
                    'content' => $controlAction->content,
                ])
            );

            // Metrics
            PROARTIndicator::all()->each(fn($metric) => $company->proartIndicators()->create(['indicator_id' => $metric->id]));

            // Reports
            CompanyReport::insert([
                ['company_id' => $company->id, 'type' => PROARTHazard::MORAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::SEXUAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::DISCRIMINATION->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value],
            ]);
        });

        Company::factory()->create(['password' => Hash::make('facilita3015')])->each(function($company){
            // Users
            User::factory(rand(8, 100))->create(['password' => null])->each(function($user) use($company) {
                $company->users()->attach($user, ['role_id' => rand(1, 2)]);
            });
        });
    }
}
