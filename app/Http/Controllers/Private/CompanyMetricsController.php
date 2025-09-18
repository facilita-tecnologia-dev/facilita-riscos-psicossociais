<?php

namespace App\Http\Controllers\Private;

use App\Models\CompanyMetric;
use App\Models\Metric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CompanyMetricsController
{
    public function edit(Request $request)
    {
        Gate::authorize('metrics-edit');

        $metrics = session('auth:company')->metrics()->with('metric')->get()->keyBy('metric.type');

        return view('private.company.company-metrics.edit', compact('metrics'));
    }

    public function update(Request $request)
    {
        Gate::authorize('metrics-edit');

        $data = $request->validate([
            'turnover' => 'nullable|between:0,100',
            'absenteeism' => 'nullable|between:0,100',
            'extra-hours' => 'nullable|between:0,100',
            'accidents' => 'nullable|between:0,100',
            'absences' => 'nullable|between:0,100',
        ]);

        DB::transaction(function () use ($data) {
            session('auth:company')->metrics->each(fn($companyMetric) => $companyMetric->update(['value' => $data[$companyMetric->metric['type']]]));
        });

        session(['company' => session('auth:company')->load('metrics')]);

        return back()->with('message', 'Indicadores armazenados com sucesso!');
    }
}
