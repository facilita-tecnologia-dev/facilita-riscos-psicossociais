<?php

namespace App\Livewire\Private\Psychosocial\Report;

use App\Enums\Psychosocial\RiskInventoryFormat;
use App\Enums\Psychosocial\RiskInventoryType;
use App\Models\ActionPlan;
use App\Models\Campaign;
use App\Services\Psychosocial\PsychosocialService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class GenerateReportComponent extends Component
{
    public Campaign|null $psychosocialCampaign;

    public string $type = RiskInventoryType::DEPARTMENT->value;
    public string $format = RiskInventoryFormat::PDF->value;

    public ActionPlan $report;

    public bool $processing = false;
    public int $progress = 0;
    public bool $ready = false;

    public ?string $downloadUrl = null;
    public bool $reportModalOpen = false;

    public string $cache_key;


    public function render()
    {
        return view('livewire.private.psychosocial.report.generate-report-component');
    }

    public function mount(Campaign $campaign)
    {
        $this->psychosocialCampaign = $campaign;
        $this->report = session('auth:company')->actionPlan;
        $this->cache_key = 'psychosocial-report';

        if ($this->report->file_path && Storage::disk('s3')->exists($this->report->file_path)) {
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

            $this->dispatch('alert:success', 'Seu Inventário de Riscos Psicossociais está pronto!');
        }
    }

    public function submit()
    {
        $this->validate([
            'type' => ['required'],
            'format' => ['required'],
        ]);

        $this->processing = true;
        $this->progress = 0;
        $this->ready = false;
        $this->downloadUrl = null;

        try {
            PsychosocialService::report($this->psychosocialCampaign, $this->type, $this->format, $this->cache_key);

            $this->dispatch('alert:success', 'Gerando Inventário de Riscos... isso pode levar alguns minutos.');
            $this->closeReportModal();

        } catch (\Throwable $e) {
            $this->dispatch('alert:danger', 'Ocorreu um erro ao gerar o relatório. Tente novamente.');
            $this->processing = false;
            $this->progress = 0;
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
