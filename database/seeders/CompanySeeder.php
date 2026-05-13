<?php

namespace Database\Seeders;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\PROART\PROARTHazard;
use App\Models\BaseControlAction;
use App\Models\CID;
use App\Models\Company;
use App\Models\CompanyAbsence;
use App\Models\CompanyReport;
use App\Models\PROARTIndicator;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::factory(3)->create(['password' => Hash::make('facilita3015'), 'psychosocial_collection_type' => MetodologyType::PROART->value])->each(function($company){
            // Users
            User::factory(rand(8, 100))->create(['password' => null])->each(function($user) use($company) {
                $company->allUsers()->attach($user, ['role_id' => rand(1, 2)]);
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

            // Absences 
            CID::all()->each(function($cid) use($company){
                for($i = 0; $i < rand(0,2); $i++){
                    $user = $company->activeUsers->random();
                    CompanyAbsence::create([
                        'company_id' => $company->id,
                        'cid_id' => $cid->id,
                        'department' => $user->department,
                        'occupation' => $user->occupation,
                        'duration' => rand(4, 30),
                    ]);
                }
            });
        });

        Company::factory(3)->create(['password' => Hash::make('facilita3015'), 'psychosocial_collection_type' => MetodologyType::HSE->value])->each(function($company){
            // Users
            User::factory(rand(8, 100))->create(['password' => null])->each(function($user) use($company) {
                $company->allUsers()->attach($user, ['role_id' => rand(1, 2)]);
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
            PROARTIndicator::all()->each(fn($indicator) => $company->proartIndicators()->create(['indicator_id' => $indicator->id]));

            // Reports
            CompanyReport::insert([
                ['company_id' => $company->id, 'type' => PROARTHazard::MORAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::SEXUAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::DISCRIMINATION->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value],
            ]);

            // Absences 
            CID::all()->each(function($cid) use($company){
                for($i = 0; $i < rand(0,2); $i++){
                    $user = $company->activeUsers->random();
                    CompanyAbsence::create([
                        'company_id' => $company->id,
                        'cid_id' => $cid->id,
                        'department' => $user->department,
                        'occupation' => $user->occupation,
                        'duration' => rand(4, 30),
                    ]);
                }
            });
        });
    }
}
