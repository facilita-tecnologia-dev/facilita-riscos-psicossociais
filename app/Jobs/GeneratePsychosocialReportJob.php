<?php

namespace App\Jobs;

use App\Enums\Campaign\EvaluationTypes;
use App\Enums\Psychosocial\RiskInventoryFormat;
use App\Exports\HSEReportDepartmentExport;
use App\Exports\HSEReportOccupationExport;
use App\Exports\PROARTReportDepartmentExport;
use App\Exports\PROARTReportOccupationExport;
use App\Models\ActionPlan;
use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class GeneratePsychosocialReportJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public string $company_id;
    public string $report_id;
    public string $evaluation_type;
    public string $format;
    public string $cache_key;

    /**
     * Create a new job instance.
     */
    public function __construct(string $company_id, string $report_id, string $evaluation_type, string $format, string $cache_key)
    {
        $this->company_id = $company_id;
        $this->report_id = $report_id;
        $this->evaluation_type = $evaluation_type;
        $this->format = $format;
        $this->cache_key = $cache_key;
    }

    public function handle(): void
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 900);

        try {
            $company = Company::findOrFail($this->company_id);
            $report = ActionPlan::findOrFail($this->report_id);

            $risks = Cache::get("{$this->cache_key}:risks", collect());
            $absences = Cache::get("{$this->cache_key}:absences", collect());

            $this->updateProgress(15);

            if ($this->format === RiskInventoryFormat::PDF->value) {
                $this->generatePdf($company, $report, $risks, $absences);
                return;
            }

            if ($this->format === RiskInventoryFormat::EXCEL->value) {
                $this->generateExcel($company, $report, $risks, $absences);
                return;
            }

            throw new \Exception("Formato de relatório inválido: {$this->format}");

        } catch (\Throwable $e) {
            // Loga o erro para análise
            Log::error('Erro ao gerar relatório psicossocial', [
                'company_id' => $this->company_id,
                'report_id' => $this->report_id,
                'evaluation_type' => $this->evaluation_type,
                'format' => $this->format,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }


    private function generatePdf(Company $company, ActionPlan $report, $risks, $absences): void
    {
        $this->updateProgress(20);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');

        $view = $this->evaluation_type === EvaluationTypes::DEPARTMENT->value
                                        ? 'pdf.psychosocial-report.department'
                                        : 'pdf.psychosocial-report.occupation';

        $this->updateProgress(30);

        $logoBase64 = null;

        if ($company->logo && $s3->exists($company->logo)) {
            $fileContent = $s3->get($company->logo);
            $mime = $s3->mimeType($company->logo);
            $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode($fileContent);
        }

        $pdf = Pdf::loadView($view, [
            'companyLogo'    => $logoBase64,
            'company'    => $company,
            'risks'    => $risks,
            'absences' => $company->usesHSE() ? $absences : null,
        ])->setPaper('a4', 'portrait');

        $this->updateProgress(55);

        $output = $pdf->output();
        $path = env('AWS_ACTION_PLAN_PATH') . '/inventario-de-riscos-' . Str::slug($company->name) . ".pdf";
        
        if($s3->exists($path)){
            $s3->delete($path);
        }
        
        $s3->put($path, $output);

        $this->updateProgress(75);

        $report->update(['file_path' => $path, 'file_date' => now()]);

        Cache::put("{$this->cache_key}:file-path", $path);

        $this->updateProgress(100);
    }

    private function generateExcel(Company $company, ActionPlan $report, $risks, $absences)
    {
        $this->updateProgress(20);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');

        $exportClass = $this->evaluation_type === EvaluationTypes::DEPARTMENT->value
            ? ($company->usesHSE()
                ? new HSEReportDepartmentExport($company, $risks, $absences)
                : new PROARTReportDepartmentExport($company, $risks))
            : ($company->usesHSE()
                ? new HSEReportOccupationExport($company, $risks, $absences)
                : new PROARTReportOccupationExport($company, $risks));
            
        $this->updateProgress(55);

        $path = env('AWS_ACTION_PLAN_PATH') . '/inventario-de-riscos-' . Str::slug($company->name) . ".xlsx";

        if($s3->exists($path)){
            $s3->delete($path);
        }

        Excel::store($exportClass, $path, 's3');

        $this->updateProgress(75);

        $report->update(['file_path' => $path, 'file_date' => now()]);

        Cache::put("{$this->cache_key}:file-path", $path);

        $this->updateProgress(100);
    }

    public function updateProgress($value)
    {
        Cache::put("{$this->cache_key}:progress", $value);
    }
}
