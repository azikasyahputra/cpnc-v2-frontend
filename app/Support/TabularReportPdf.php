<?php

namespace App\Support;

/**
 * FPDF renderer for the generic tabular laporan reports.
 *
 * Columns (headings/widths/aligns/formats) are configured per report by the
 * callers in App\Support\Pdf. Also hosts the "RINCIAN KOMISI" mini-table used
 * by the komisi supir report.
 */
class TabularReportPdf extends PdfDocument
{
    public function __construct(string $orientation = 'P', $size = 'A4')
    {
        parent::__construct($orientation, $size);
        $this->SetFont('Helvetica', '', 8);
    }

    /**
     * Bottom "RINCIAN KOMISI" mini-table of the komisi supir report.
     */
    public function rincianKomisi(
        string $namasupir,
        $jumlah,
        $totalkuranglebih,
        $totalkomisisupir,
        $totalkomisikenek,
        $totalkomisi
    ) {
        $w = 136; // 40% of the legal landscape width
        $c1 = 52;
        $c2 = 42;
        $c3 = 42;

        $labelKuranglebih = $totalkuranglebih > 0 ? 'UANG KANTOR' : 'UANG SOPIR';

        $rows = [
            ['rincian', $jumlah.' RIT KOMISI', 'RINCIAN KOMISI', ''],
            ['', 'KOMISI SUPIR', $totalkomisisupir, '-'],
            ['', 'KOMISI KENEK', $totalkomisikenek, ''],
            ['', $labelKuranglebih, $totalkuranglebih, ''],
            ['', '', '-', ''],
            ['total', 'TERIMA KOMISI', $totalkomisi, ''],
        ];

        $this->SetFont('Helvetica', '', 9);
        foreach ($rows as $row) {
            [$type, $a, $b, $c] = $row;
            $this->SetX($this->lMargin);
            $bold = $type === 'total' || $type === 'rincian';
            $this->SetFont('Helvetica', $bold ? 'B' : '', 9);

            if ($type === 'rincian') {
                $this->Cell($c1, 6, $a, 1, 0, 'C');
                $this->Cell($c2 + $c3, 6, $b, 1, 1, 'C');
                continue;
            }

            $this->Cell($c1, 6, $a, 1, 0, 'L');
            $this->Cell($c2, 6, $this->fmtNum($b), 1, 0, 'R');
            $this->Cell($c3, 6, $c, 1, 1, 'R');
        }
        $this->SetFont('Helvetica', '', 9);
    }
}
