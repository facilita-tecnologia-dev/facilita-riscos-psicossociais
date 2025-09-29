<?php

namespace Database\Seeders;

use App\Enums\RiskTypes;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Metric;
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
                    'risk_id' => $controlAction->risk_id,
                    'control_action_type_id' => $controlAction->control_action_type_id,
                    'gravity' => $controlAction->gravity,
                    'content' => $controlAction->content,
                ])
            );

            // Metrics
            Metric::all()->each(fn($metric) => $company->metrics()->create(['metric_id' => $metric->id]));

            // Reports
            CompanyReport::insert([
                ['company_id' => $company->id, 'type' => RiskTypes::MORAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => RiskTypes::SEXUAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => RiskTypes::DISCRIMINATION->value],
                ['company_id' => $company->id, 'type' => RiskTypes::OTHER_FORMS_OF_VIOLENCE->value],
            ]);
        });
    }
}
