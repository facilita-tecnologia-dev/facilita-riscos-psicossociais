<?php

namespace Database\Seeders\OrganizationalIndicator;

use App\Enums\Psychosocial\Indicator;
use App\Models\Organizationalndicator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationalIndicatorSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('company_organizational_indicator')->delete();
            DB::table('organizational_indicator')->delete();

            Organizationalndicator::insert([
                [
                    'type' => Indicator::EXTRA_HOURS->value,
                    'display_name' => Indicator::EXTRA_HOURS->label(),
                ],
                [
                    'type' => Indicator::ABSENTEEISM->value,
                    'display_name' => Indicator::ABSENTEEISM->label(),
                ],
                [
                    'type' => Indicator::TURNOVER->value,
                    'display_name' => Indicator::TURNOVER->label(),
                ],
                [
                    'type' => Indicator::REPORTS->value,
                    'display_name' => Indicator::REPORTS->label(),
                ],
            ]);

            $indicators = Organizationalndicator::all();

            $companies = DB::table('companies')->pluck('id');
            $pivotRows = [];

            foreach ($companies as $companyId) {
                foreach ($indicators as $indicator) {
                    $pivotRows[] = [
                        'company_id' => $companyId,
                        'indicator_id' => $indicator['id'],
                        'value' => null,
                    ];
                }
            }

            // 5. Inserir pivot
            DB::table('company_organizational_indicator')->insert($pivotRows);
        });
    }
}
