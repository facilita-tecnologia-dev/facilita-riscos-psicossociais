<?php

namespace Database\Seeders;

use App\Models\Company;
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
            User::factory(rand(8, 100))->create()->each(function($user) use($company) {
                $company->users()->attach($user, ['role_id' => rand(1, 2)]);
            });

            // Action Plan
            $company->actionPlan()->create();

            // Metrics
            Metric::all()->each(fn($metric) => $company->metrics()->create(['metric_id' => $metric->id]));
        });
    }
}
