<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class FeedbacksExport implements FromCollection, WithEvents
{
    protected array $headerRows = [];
    protected array $dataRows = [];

    public function collection()
    {
        $rows = collect();
        $currentRow = 1;

        $feedbacks = Company::firstWhere('id', session('auth:company')->id)
            ->feedbacks()
            ->with(['user:id,department'])
            ->get();

        // Cabeçalho
        $rows->push(['Conteúdo', 'Setor', 'Data do Feedback']);
        $this->headerRows[] = $currentRow;
        $currentRow++;

        // Dados
        foreach ($feedbacks as $feedback) {
            $rows->push([
                $feedback->content,
                $feedback->user->department,
                $feedback->created_at->format('d/m/Y'),
            ]);

            $this->dataRows[] = $currentRow;
            $currentRow++;
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                /* -----------------------------
                 *  Cabeçalho
                 * -----------------------------*/
                foreach ($this->headerRows as $row) {
                    $sheet->getStyle("A{$row}:C{$row}")->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => 'FFFFFF'],
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => '333333'],
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);
                }

                /* -----------------------------
                 *  Linhas de dados
                 * -----------------------------*/
                foreach ($this->dataRows as $row) {
                    $sheet->getStyle("A{$row}:C{$row}")->applyFromArray([
                        'font' => ['color' => ['rgb' => '333333']],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'FFFFFF'],
                        ],
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => '666666']
                            ]
                        ]
                    ]);
                }

                /* -----------------------------
                 *  Ajustes de coluna + wrap
                 * -----------------------------*/
                $sheet->getStyle('A2:A' . (count($this->dataRows) + 1))
                      ->getAlignment()
                      ->setWrapText(true);

                $sheet->getColumnDimension('A')->setWidth(75);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(30);
            },
        ];
    }
}
