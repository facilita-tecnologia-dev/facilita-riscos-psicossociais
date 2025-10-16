<?php

namespace App\Http\Controllers\Private;

use App\Models\BaseCollection;
use App\Enums\BaseCollection as EnumBaseCollection;
use App\Models\Hazard;
use App\Services\ReportChannelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MetricsController
{
    public function edit(Request $request)
    {
        Gate::authorize('metrics-edit');
        if(session('auth:company')->usesHSE()) return back();

        $hasReportChannel = ReportChannelService::hasReportChannel(session('auth:company'));
        
        if($hasReportChannel){
            $baseCollection = BaseCollection::firstWhere('key', EnumBaseCollection::PROART);
            $hazards = Hazard::where('base_collection_id', $baseCollection->id)->get();
            $reportChannelReports = ReportChannelService::reports(session('auth:company'));
            $reports = $hazards->mapWithKeys(fn($risk) => [$risk->type => $reportChannelReports->get($risk->type, 0)]);
        } else{
            $companyReports = session('auth:company')->reports()->get();
            $reports = $companyReports->mapWithKeys(fn($report) => [$report->type => $report->value]);
        }

        return view('private.company.company-metrics.edit', [
            'metrics' => session('auth:company')->proartIndicators()->with('metric')->get()->keyBy('metric.type'),
            'hasReportChannel' => $hasReportChannel,
            'reports' => $reports,
        ]);
    }

    public function update(Request $request)
    {
        Gate::authorize('metrics-edit');
        if(session('auth:company')->usesHSE()) return back();

        $data = $request->validate([
            'turnover' => 'nullable|between:0,100',
            'absenteeism' => 'nullable|between:0,100',
            'extra-hours' => 'nullable|between:0,100',
            'accidents' => 'nullable|between:0,100',
            'absences' => 'nullable|between:0,100',
        ]);

        DB::transaction(function () use ($data) {
            session('auth:company')->proartIndicators->each(fn($companyMetric) => $companyMetric->update(['value' => $data[$companyMetric->metric['type']]]));
        });

        session(['company' => session('auth:company')->load('proartIndicators')]);

        return back()->with('message', 'Indicadores armazenados com sucesso!');
    }
}
