<?php

namespace Database\Seeders\Metrics;

use App\Enums\MetricTypes;
use App\Models\Metric;
use Illuminate\Database\Seeder;

class MetricsSeeder extends Seeder
{
    public function run(): void
    {
        Metric::insert([
            [
                'type' => MetricTypes::ABSENCES->value,
                'display_name' => MetricTypes::ABSENCES->label(),
            ],
            [
                'type' => MetricTypes::ABSENTEEISM->value,
                'display_name' => MetricTypes::ABSENTEEISM->label(),
            ],
            [
                'type' => MetricTypes::ACCIDENTS->value,
                'display_name' => MetricTypes::ACCIDENTS->label(),
            ],
            [
                'type' => MetricTypes::EXTRA_HOURS->value,
                'display_name' => MetricTypes::EXTRA_HOURS->label(),
            ],
            [
                'type' => MetricTypes::TURNOVER->value,
                'display_name' => MetricTypes::TURNOVER->label(),
            ],
        ]);
    }
}
