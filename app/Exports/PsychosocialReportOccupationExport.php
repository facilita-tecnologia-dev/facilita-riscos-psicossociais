<?php

namespace App\Exports;

use App\Enums\ControlActionTypes;
use App\Enums\GravityTypes;
use App\Enums\ProbabilityTypes;
use App\Enums\RiskTypes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PsychosocialReportOccupationExport implements FromCollection, WithEvents
{

    protected Collection $risks;

    protected array $documentTitleRows;

    protected array $occupationTitleRows;
    protected array $occupationRows;

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

        $this->occupationTitleRows = [];
        $this->occupationRows = [];

        $this->riskRows = [];
        
        $this->controlActionHeadingRows = [];
        $this->controlActionRows = [];

        $this->emptyRows = [];

        $currentRow = 1;

        $rows->push([session('auth:company')->name . ' - Inventário de Riscos Psicossociais (Função)']);
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

            foreach ($occupationRisks as $type => $risk) {
                $rows->push([
                    'Perigo Psicossocial: ' . RiskTypes::from($type)->label(),
                    '',
                    'Severidade: ' . GravityTypes::from($risk['risk']['gravity'])->label(),
                    'Probabilidade: ' . ProbabilityTypes::from($risk['risk']['probability'])->label(),
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
                            ControlActionTypes::from($actionType)->label(),
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
                        case '1':
                            $color = 'F26C6C';
                            break;
                        case '2':
                            $color = 'F6B26B';
                            break;
                        case '3':
                            $color = 'DDE26F';
                            break;
                        case '4':
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
