<?php

namespace App\Exports;

use App\Enums\Psychosocial\HSE\HSEGravity;
use App\Enums\Psychosocial\HSE\HSEHazard;
use App\Enums\Psychosocial\HSE\HSEProbability;
use App\Models\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class HSEReportOccupationExport implements FromCollection, WithEvents
{
    protected Company $company;

    protected Collection $risks;
    protected Collection $absences;

    protected array $documentTitleRows;

    protected array $occupationTitleRows;
    protected array $occupationRows;

    protected array $riskRows;

    protected array $controlActionHeadingRows;
    protected array $controlActionRows;

    protected array $absenceHeadingRows;
    protected array $absenceRows;

    protected array $emptyRows;

    public function __construct(Company $company, Collection $risks, Collection $absences)
    {
        $this->company = $company;
        $this->risks = $risks;
        $this->absences = $absences;
    }

    public function collection()
    {
        $rows = collect();

        $this->documentTitleRows = [];

        $this->occupationTitleRows = [];
        $this->occupationRows = [];

        $this->riskRows = [];
        
        $this->controlActionHeadingRows = [];
        $this->controlActionRows = [];

        $this->absenceHeadingRows = [];
        $this->absenceRows = [];

        $this->emptyRows = [];

        $currentRow = 1;

        $rows->push([$this->company->name . ' - Inventário de Riscos Psicossociais (Função)']);
        $this->documentTitleRows[] = $currentRow;
        $currentRow++;
        
        $rows->push(['']);
        $this->emptyRows[] = $currentRow;
        $currentRow++;

        foreach ($this->risks as $occupation => $occupationRisks) {
            $rows->push(['Função']);
            $this->occupationTitleRows[] = $currentRow;
            $currentRow++;

            $rows->push([$occupation]);
            $this->occupationRows[] = $currentRow;
            $currentRow++;

            $rows->push(['']);
            $this->emptyRows[] = $currentRow;
            $currentRow++;

            foreach ($occupationRisks as $groups) {
                foreach ($groups as $hazard => $risk) {
                    $rows->push([
                        'Perigo Psicossocial: ' . HSEHazard::from($hazard)->label(),
                        '',
                        'Severidade: ' . HSEGravity::from($risk['risk']['gravity'])->label(),
                        'Probabilidade: ' . HSEProbability::from($risk['risk']['probability'])->label(),
                        'Risco Identificado: ' . $risk['risk']['evaluated']->label()
                    ]);

                    $this->riskRows[] = [
                        'currentRow' => $currentRow,
                        'risk' => $risk['risk']['evaluated']->value
                    ];

                    $currentRow++;

                    $rows->push([
                        'Medida de Controle',
                        '',
                        'Prazo',
                        'Responsável',
                        'Situação',
                    ]);

                    $this->controlActionHeadingRows[] = $currentRow;
                    $currentRow++;

                    foreach ($risk['control_actions'] as $action)
                    {
                        $rows->push([
                            $action['content'],
                            '',
                            $action['deadline'] ?? 'Indefinido',
                            $action['assignee'] ?? 'Indefinido',
                            $action['status'] ?? 'Indefinido',
                        ]);

                        $this->controlActionRows[] = $currentRow;
                        $currentRow++;
                    }

                    $rows->push(['']);
                    $this->emptyRows[] = $currentRow;
                    $currentRow++;
                }
            }

            $rows->push(['']);
            $this->emptyRows[] = $currentRow;
            $currentRow++;
            $rows->push(['']);
            $this->emptyRows[] = $currentRow;
            $currentRow++;
        }

        $rows->push([$this->company->name . ' - Relatório de Afastamentos (Função)']);
        $this->documentTitleRows[] = $currentRow;
        $currentRow++;
        
        $rows->push(['']);
        $this->emptyRows[] = $currentRow;
        $currentRow++;

        if($this->absences->isNotEmpty()){
            foreach ($this->absences as $occupation => $occupationAbsences){
                $rows->push(['Função']);
                $this->occupationTitleRows[] = $currentRow;
                $currentRow++;

                $rows->push([$occupation]);
                $this->occupationRows[] = $currentRow;
                $currentRow++;

                $rows->push([
                    'Código CID',
                    'Data de Registro',
                    'Setor',
                    'Função',
                    'Duração',
                ]);

                $this->absenceHeadingRows[] = $currentRow;
                $currentRow++;

                foreach ($occupationAbsences as $absence){
                    $rows->push([
                        $absence->cid->type,
                        $absence->created_at->format('d/m/Y'),
                        $absence->department,
                        $absence->occupation,
                        $absence->duration . ' dias',
                    ]);

                    $this->absenceRows[] = $currentRow;
                    $currentRow++;
                }

                $rows->push(['']);
                $this->emptyRows[] = $currentRow;
                $currentRow++;
                $rows->push(['']);
                $this->emptyRows[] = $currentRow;
                $currentRow++;
            }
        } else {
            $rows->push(['Sua empresa não tem afastamentos cadastrados']);
            $this->emptyRows[] = $currentRow;
            $currentRow++;
        }

        return $rows;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                foreach ($this->documentTitleRows as $row) {
                    $sheet->mergeCells("A{$row}:E{$row}");
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 16,
                            'color' => ['rgb' => '333333'],
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'E0E0E0'],
                        ],
                    ]);
                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->occupationTitleRows as $row) {
                    $sheet->mergeCells("A{$row}:E{$row}");
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 14,
                            'color' => ['rgb' => '333333'],
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'E0E0E0'],
                        ],
                    ]);
                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->occupationRows as $row) {
                    $sheet->mergeCells("A{$row}:E{$row}");
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'size' => 13,
                            'color' => ['rgb' => '333333'],
                        ],
                    ]);
                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->riskRows as $riskData) {
                    $row = $riskData['currentRow'];
                    $risk = $riskData['risk'];

                    switch ($risk) {
                        case '5':
                            $color = 'F44336';
                            break;
                        case '4':
                            $color = 'FF9800';
                            break;
                        case '3':
                            $color = 'FFC107';
                            break;
                        case '2':
                            $color = 'CDDC39';
                            break;
                        case '1':
                            $color = '4CAF50';
                            break;
                        default:
                            $color = 'FFFFFF';
                    }

                    $sheet->mergeCells("A{$row}:B{$row}");
                    
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'size' => 12,
                            'color' => ['rgb' => '333333'],
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'E0E0E0'],
                        ],
                    ]);

                    $sheet->getStyle("E{$row}")->applyFromArray([
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $color],
                        ],
                    ]);

                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->controlActionHeadingRows as $row) {
                    $sheet->mergeCells("A{$row}:B{$row}");
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 11,
                            'color' => ['rgb' => '333333'],
                        ],
                    ]);
                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->controlActionRows as $row) {
                    $sheet->mergeCells("A{$row}:B{$row}");
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'size' => 11,
                            'color' => ['rgb' => '333333'],
                        ],
                    ]);
                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->absenceHeadingRows as $row) {
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 11,
                            'color' => ['rgb' => '333333'],
                        ],
                    ]);
                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->absenceRows as $row) {
                    $sheet->getStyle("A{$row}:E{$row}")->applyFromArray([
                        'font' => [
                            'size' => 11,
                            'color' => ['rgb' => '333333'],
                        ],
                    ]);
                    $sheet->getStyle("A{$row}:E{$row}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                }

                foreach ($this->emptyRows as $row) {
                    $sheet->mergeCells("A{$row}:E{$row}");
                }


                $sheet->getColumnDimension('A')->setWidth(70);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(40);
            }
        ];
    }
}
