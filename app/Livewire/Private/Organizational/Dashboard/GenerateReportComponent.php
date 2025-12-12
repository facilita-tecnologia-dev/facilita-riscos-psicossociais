<?php

namespace App\Livewire\Private\Organizational\Dashboard;

use App\Enums\OC\OCEvaluation;
use App\Enums\OC\OCVisualization;
use App\Models\Campaign;
use App\Models\OrganizationalReport;
use App\Services\Organizational\OrganizationalService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;

class GenerateReportComponent extends Component
{
    public Campaign|null $organizationalCampaign;
    public OrganizationalReport | null $report;

    public string $evaluation_type = OCEvaluation::DEPARTMENT->value;
    public string $visualization_type = OCVisualization::GENERAL->value;

    public bool $processing = false;
    public int $progress = 0;
    public bool $ready = false;

    public ?string $downloadUrl = null;

    public string $cache_key;


    public function render()
    {
        return view('livewire.private.organizational.dashboard.generate-report-component');
    }

    public function mount(Campaign $campaign)
    {
        $this->organizationalCampaign = $campaign;
        $this->report = session('auth:company')->organizationalReport;
        $this->cache_key = 'organizational-report';

        if ($this->report && $this->report->file_path && Storage::disk('s3')->exists($this->report->file_path)) {
            $this->ready = true;
            $this->processing = false;
            $this->progress = 100;

            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');
            $this->downloadUrl = $s3->url($this->report->file_path);
        }
    }

    public function poll()
    {
        $this->progress = Cache::get("{$this->cache_key}:progress", 0);

        if ($this->progress >= 100 && !$this->ready) {
            $this->processing = false;
            $this->ready = true;
            $file = Cache::get("{$this->cache_key}:file-path");

            if ($file) {
                /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
                $s3 = Storage::disk('s3');
                $this->downloadUrl = $s3->url($file);
            }

            $this->dispatch('alert:success', 'Seu relatório está pronto!');
        }
    }

    public function submit()
    {
        $this->validate([
            'evaluation_type' => ['required', Rule::enum(OCEvaluation::class)],
            'visualization_type' => ['required', Rule::enum(OCVisualization::class)],
        ]);

        $this->processing = true;
        $this->progress = 0;
        $this->ready = false;
        $this->downloadUrl = null;

        try {
            OrganizationalService::report($this->organizationalCampaign, $this->evaluation_type, $this->visualization_type, $this->cache_key);

            $this->dispatch('alert:success', 'Gerando relatório... isso pode levar alguns minutos.');
            $this->closeReportModal();

        } catch (\Throwable $th) {
            Log::error('Erro ao gerar o relatório.', [
                'company_id' => session('auth:company')->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
            
            $this->dispatch('alert:danger', 'Ocorreu um erro ao gerar o relatório. Tente novamente.');
        }
    }

    public function downloadReport()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');

        if (! $s3->exists($this->report->file_path)) {
            $this->dispatch('alert:danger', 'Não foi possível encontrar o arquivo. Por favor, gere-o novamente.');
        }

        $this->dispatch('alert:success', 'Download feito com sucesso!');
        return $s3->download($this->report->file_path);
    }

    public function openReportModal()
    {
        $this->dispatch('open-report-modal');
    }
    
    public function closeReportModal()
    {
        $this->dispatch('close-report-modal');
    }
}
