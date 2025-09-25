<?php

namespace App\Http\Controllers\Private;

use App\Services\ReportChannelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MetricsController
{
    public function edit(Request $request)
    {
        Gate::authorize('metrics-edit');
        
        $hasReportChannel = ReportChannelService::hasReportChannel(session('auth:company'));

        if($hasReportChannel){
            $risks = session('auth:company')->latestPsychosocialCampaign()->collection()->risks;
            $reportChannelReports = ReportChannelService::reports(session('auth:company'));
            $reports = $risks->mapWithKeys(fn($risk) => [$risk->type => $reportChannelReports->get($risk->type, 0)]);
        } else{
            $companyReports = session('auth:company')->reports()->get();
            $reports = $companyReports->mapWithKeys(fn($report) => [$report->type => $report->value]);
        }


        return view('private.company.company-metrics.edit', [
            'metrics' => session('auth:company')->metrics()->with('metric')->get()->keyBy('metric.type'),
            'hasReportChannel' => $hasReportChannel,
            'reports' => $reports,
        ]);
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
