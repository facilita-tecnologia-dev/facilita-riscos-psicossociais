<?php

namespace App\Jobs;

use App\Enums\Campaign\EvaluationTypes;
use App\Enums\OC\OCEvaluation;
use App\Enums\OC\OCVisualization;
use App\Enums\Psychosocial\RiskInventoryFormat;
use App\Exports\HSEReportDepartmentExport;
use App\Exports\HSEReportOccupationExport;
use App\Exports\PROARTReportDepartmentExport;
use App\Exports\PROARTReportOccupationExport;
use App\Models\ActionPlan;
use App\Models\Company;
use App\Models\OrganizationalReport;
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

class GenerateOrganizationalReportJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public string $company_id;
    public string $evaluation_type;
    public string $visualization_type;
    public string $cache_key;

    /**
     * Create a new job instance.
     */
    public function __construct(string $company_id, string $evaluation_type, string $visualization_type, string $cache_key)
    {
        $this->company_id = $company_id;
        $this->evaluation_type = $evaluation_type;
        $this->visualization_type = $visualization_type;
        $this->cache_key = $cache_key;
    }

    public function handle(): void
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 900);

        try {
            $company = Company::findOrFail($this->company_id);
            $dashboard = Cache::get("{$this->cache_key}:dashboard", collect());

             $this->updateProgress(20);

            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');

            $view = $this->visualization_type === OCVisualization::GENERAL->value
                                            ? 'pdf.organizational-report.general'
                                            : 'pdf.organizational-report.answers';

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
                'evaluation_type' => $this->evaluation_type,
                'dashboard'    => $dashboard,
            ])->setPaper('a4', 'portrait');


            $this->updateProgress(55);

            $output = $pdf->output();
            $path = env('AWS_ORGANIZATIONAL_REPORT_PATH') . '/relatorio-de-clima-organizacional-' . Str::slug($company->name) . ".pdf";
            
            if($s3->exists($path)){
                $s3->delete($path);
            }
            
            $s3->put($path, $output);

            $this->updateProgress(75);

            OrganizationalReport::updateOrCreate([
                'company_id' => $company->id
            ], [
                'file_path' => $path,
                'file_date' => now()
            ]);

            Cache::put("{$this->cache_key}:file-path", $path);

            $this->updateProgress(100);
        } catch (\Throwable $e) {
            // Loga o erro para análise
            Log::error('Erro ao gerar relatório psicossocial', [
                'company_id' => $this->company_id,
                'evaluation_type' => $this->evaluation_type,
                'visualization_type' => $this->visualization_type,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }

    public function updateProgress($value)
    {
        Cache::put("{$this->cache_key}:progress", $value);
    }
}
