<?php

namespace App\Exports;

use App\Enums\PROART\PROARTControlActionTypes;
use App\Enums\PROART\PROARTGravity;
use App\Enums\PROART\PROARTProbability;
use App\Enums\PROART\PROARTHazard;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PROARTReportDepartmentExport implements FromCollection, WithEvents
{

    protected Collection $risks;

    protected array $documentTitleRows;

    protected array $departmentTitleRows;
    protected array $departmentRows;

    protected array $riskRows;

    protected array $controlActionHeadingRows;
    protected array $controlActionRows;

    protected array $emptyRows;

    public function __construct(Collection $risks)
    {
        $this->risks = $risks;
    }

    public function collection()
    {
        $rows = collect();

        $this->documentTitleRows = [];

        $this->departmentTitleRows = [];
        $this->departmentRows = [];

        $this->riskRows = [];
        
        $this->controlActionHeadingRows = [];
        $this->controlActionRows = [];

        $this->emptyRows = [];

        $currentRow = 1;

        $rows->push([session('auth:company')->name . ' - Inventário de Riscos Psicossociais (Setor)']);
        $this->documentTitleRows[] = $currentRow;
        $currentRow++;
        
        $rows->push(['']);
        $this->emptyRows[] = $currentRow;
        $currentRow++;

        foreach ($this->risks as $department => $departmentRisks) {
            $rows->push(['Setor']);
            $this->departmentTitleRows[] = $currentRow;
            $currentRow++;

            $rows->push([$department]);
            $this->departmentRows[] = $currentRow;
            $currentRow++;

            $rows->push(['']);
            $this->emptyRows[] = $currentRow;
            $currentRow++;

            foreach ($departmentRisks as $type => $risk) {
                $rows->push([
                    'Perigo Psicossocial: ' . PROARTHazard::from($type)->label(),
                    '',
                    'Severidade: ' . PROARTGravity::from($risk['risk']['gravity'])->label(),
                    'Probabilidade: ' . PROARTProbability::from($risk['risk']['probability'])->label(),
                    'Risco Identificado: ' . $risk['risk']['evaluated']->label()
                ]);

                $this->riskRows[] = [
                    'currentRow' => $currentRow,
                    'risk' => $risk['risk']['evaluated']->value
                ];

                $currentRow++;

                $rows->push([
                    'Medida de Controle',
                    'Tipo',
                    'Prazo',
                    'Responsável',
                    'Situação',
                ]);

                $this->controlActionHeadingRows[] = $currentRow;
                $currentRow++;

                foreach ($risk['control_actions'] as $actionType => $actions)
                {
                    foreach ($actions as $action)
                    {
                        $rows->push([
                            $action->content,
                            PROARTControlActionTypes::from($actionType)->label(),
                            $action->deadline ?? 'Indefinido',
                            $action->assignee ?? 'Indefinido',
                            $action->status ?? 'Indefinido',
                        ]);

                        $this->controlActionRows[] = $currentRow;
                        $currentRow++;
                    } 
                }

                $rows->push(['']);
                $this->emptyRows[] = $currentRow;
                $currentRow++;
            }

            $rows->push(['']);
            $this->emptyRows[] = $currentRow;
            $currentRow++;
            $rows->push(['']);
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

                foreach ($this->departmentTitleRows as $row) {
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

                foreach ($this->departmentRows as $row) {
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
                        case '4':
                            $color = 'F26C6C';
                            break;
                        case '3':
                            $color = 'F6B26B';
                            break;
                        case '2':
                            $color = 'DDE26F';
                            break;
                        case '1':
                            $color = 'A8E6CF';
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
