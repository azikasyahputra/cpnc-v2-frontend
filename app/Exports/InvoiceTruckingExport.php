<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

/**
 * Invoice Trucking export laid out like tempate-cpnc.xlsx:
 * letterhead block (company, office, telp/fax), customer name, then a
 * bordered table with columns AJU | Tanggal | Tujuan | Party | Container |
 * Ongkos | U.Bongkar | Lift Off | Tagihan and a "Total Tagihan" footer.
 */
class InvoiceTruckingExport implements WithEvents, WithTitle
{
    /** @var Collection */
    protected $header;

    /** @var Collection */
    protected $detail;

    public function __construct(Collection $header, Collection $detail)
    {
        $this->header = $header;
        $this->detail = $detail;
    }

    public function title(): string
    {
        return 'Invoice Trucking';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $widths = [14.85, 14.10, 15.75, 10.68, 18.62, 15.85, 15.14, 13.57, 15.14];
                foreach ($widths as $i => $w) {
                    $sheet->getColumnDimensionByColumn($i + 1)->setWidth($w);
                }

                $head = $this->header->first();

                // Letterhead block
                $sheet->mergeCells('B1:D1');
                $sheet->setCellValue('B1', 'PT.CAHYAPRAJA NUSACERIA');
                $sheet->getStyle('B1')->getFont()->setBold(true)->setSize(12);

                $sheet->setCellValue('B2', 'Office');
                $sheet->mergeCells('C2:I2');
                $sheet->setCellValue('C2', 'Jl. Fort Barat No,43A Kebon Bawang, Tj. Priok, Jakarta Utara');

                $sheet->setCellValue('B3', 'Telp.');
                $sheet->mergeCells('C3:D3');
                $sheet->setCellValue('C3', '(021) 4358506');
                $sheet->setCellValue('E3', 'Fax.');
                $sheet->setCellValue('F3', '(021) 4358652');

                // Customer name
                $sheet->mergeCells('D5:G5');
                $sheet->setCellValue('D5', $head->nama_client ?? '');

                // Column headers
                $headers = ['AJU', 'Tanggal', 'Tujuan', 'Party', 'Container', 'Ongkos', 'U.Bongkar', 'Lift Off', 'Tagihan'];
                foreach ($headers as $i => $label) {
                    $col = chr(65 + $i);
                    $sheet->setCellValue($col.'7', $label);
                }
                $sheet->getStyle('A7:I7')->getFont()->setBold(true);
                $sheet->getStyle('A7:I7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Data rows
                $startRow = 8;
                $rowIdx = $startRow;
                $noAju = $head->no_aju ?? '';
                $total = 0;

                foreach ($this->detail as $detailRow) {
                    $tagihan = (int) $detailRow->ongkos + (int) $detailRow->uang_bongkar + (int) $detailRow->lift_off;
                    $total += $tagihan;

                    $sheet->setCellValue('A'.$rowIdx, $noAju);
                    $sheet->setCellValue('B'.$rowIdx, $detailRow->tanggal_order ?? '');
                    $sheet->setCellValue('C'.$rowIdx, $detailRow->tujuan ?? '');
                    $sheet->setCellValue('D'.$rowIdx, $detailRow->party ?? '');
                    $sheet->setCellValue('E'.$rowIdx, $detailRow->container ?? '');
                    $sheet->setCellValue('F'.$rowIdx, (int) $detailRow->ongkos);
                    $sheet->setCellValue('G'.$rowIdx, (int) $detailRow->uang_bongkar);
                    $sheet->setCellValue('H'.$rowIdx, (int) $detailRow->lift_off);
                    $sheet->setCellValue('I'.$rowIdx, $tagihan);

                    $sheet->getStyle('F'.$rowIdx.':I'.$rowIdx)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                    $rowIdx++;
                }

                $lastRow = $rowIdx - 1;

                // Total row
                $totalRow = $rowIdx;
                $sheet->mergeCells('G'.$totalRow.':H'.$totalRow);
                $sheet->setCellValue('G'.$totalRow, 'Total Tagihan');
                $sheet->setCellValue('I'.$totalRow, $total);
                $sheet->getStyle('G'.$totalRow.':I'.$totalRow)->getFont()->setBold(true);
                $sheet->getStyle('I'.$totalRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                // Borders around the table (headers..total row)
                $borderStyle = [
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ];
                $sheet->getStyle('A7:I'.$totalRow)->applyFromArray($borderStyle);
            },
        ];
    }
}
