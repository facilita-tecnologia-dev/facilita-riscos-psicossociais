<?php

namespace Database\Seeders\PROARTIndicator;

use App\Enums\PROART\PROARTIndicator as EnumPROARTIndicator;
use App\Models\PROARTIndicator;
use Illuminate\Database\Seeder;

class PROARTIndicatorSeeder extends Seeder
{
    public function run(): void
    {
        PROARTIndicator::insert([
            [
                'type' => EnumPROARTIndicator::ABSENCES->value,
                'display_name' => EnumPROARTIndicator::ABSENCES->label(),
            ],
            [
                'type' => EnumPROARTIndicator::ABSENTEEISM->value,
                'display_name' => EnumPROARTIndicator::ABSENTEEISM->label(),
            ],
            [
                'type' => EnumPROARTIndicator::ACCIDENTS->value,
                'display_name' => EnumPROARTIndicator::ACCIDENTS->label(),
            ],
            [
                'type' => EnumPROARTIndicator::EXTRA_HOURS->value,
                'display_name' => EnumPROARTIndicator::EXTRA_HOURS->label(),
            ],
            [
                'type' => EnumPROARTIndicator::TURNOVER->value,
                'display_name' => EnumPROARTIndicator::TURNOVER->label(),
            ],
        ]);
    }
}
