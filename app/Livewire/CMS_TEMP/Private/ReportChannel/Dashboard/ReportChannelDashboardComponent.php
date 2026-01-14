<?php

namespace App\Livewire\Cms\Private\ReportChannel\Dashboard;

use App\Services\ReportChannel\ReportChannelService;
use Carbon\Carbon;
use Livewire\Component;

class ReportChannelDashboardComponent extends Component
{
    public array $reports;
    public array $completedReports;
    public array $archivedReports;

    public function render()
    {
        return view('livewire.cms.private.report-channel.dashboard.report-channel-dashboard-component');
    }

    public function mount()
    {
        $reports = collect(ReportChannelService::allReports())->groupBy(fn ($report) => Carbon::parse($report['created_at'])->year);

        $years = collect([now()->year, now()->year - 1, now()->year - 2]);

        $reportsByYear =  $years->mapWithKeys(fn($year) => [$year => $reports->get($year, collect())]);

        $completedReportsByYear =  $years->mapWithKeys(fn($year) => [$year => $reports->get($year, collect())
                                                    ->filter(fn($report) => $report['status'] == 'completed') ]);

        $archivedReportsByYear =  $years->mapWithKeys(fn($year) => [$year => $reports->get($year, collect())
                                                    ->filter(fn($report) => $report['status'] == 'archived')  ]);

        $this->reports = [
            'total' => $reportsByYear->mapWithKeys(fn($reports, $year) => [$year => $reports->count()])->sum(),
            'lastYears' => $reportsByYear->mapWithKeys(fn($reports, $year) => [$year => $reports->count()]),
        ];

        $this->completedReports = [
            'total' => $completedReportsByYear->mapWithKeys(fn($reports, $year) => [$year => $reports->count()])->sum(),
            'lastYears' => $completedReportsByYear->mapWithKeys(fn($reports, $year) => [$year => $reports->count()]),
        ];

        $this->archivedReports = [
            'total' => $archivedReportsByYear->mapWithKeys(fn($reports, $year) => [$year => $reports->count()])->sum(),
            'lastYears' => $archivedReportsByYear->mapWithKeys(fn($reports, $year) => [$year => $reports->count()]),
        ];
    }
}
