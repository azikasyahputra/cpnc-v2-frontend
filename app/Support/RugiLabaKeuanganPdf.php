<?php

namespace App\Support;

/**
 * FPDF renderer for the Laporan Laba/Rugi Keuangan (A4 portrait).
 *
 * A 4-column income statement with per-revenue values in the third column and
 * summary/total values in the fourth.
 */
class RugiLabaKeuanganPdf extends PdfDocument
{
    /** @var array */
    protected $data;

    /** @var array */
    protected $totals;

    /** @var string */
    protected $tanggalakhir;

    /** @var array */
    protected $widths;

    public function __construct(array $data, array $totals, string $tanggalakhir)
    {
        parent::__construct('P', 'A4');
        $this->SetMargins(8, 12, 8);
        $this->SetAutoPageBreak(true, 14);
        $this->SetFont('Helvetica', '', 9);

        $this->data = $data;
        $this->totals = $totals;
        $this->tanggalakhir = $tanggalakhir;

        $this->widths = [16, 80, 44, 54];
    }

    public function build(): string
    {
        $this->AddPage();
        $this->renderTitle();
        $this->renderBody();
        $this->renderSignature();

        return $this->Output('S');
    }

    protected function renderTitle()
    {
        $this->SetFont('Helvetica', 'B', 12);
        $lines = [
            'PT.CAHYAPRAJA NUSACERIA',
            'Laporan Laba/Rugi',
            'Untuk Tahun yang berakhir '.$this->fmtDateLong($this->tanggalakhir),
            '(dalam rupiah)',
        ];
        $x = $this->GetX();
        $y = $this->GetY();
        $w = $this->usableWidth();
        $h = 6 + count($lines) * 5;
        $this->Rect($x, $y, $w, $h);

        foreach ($lines as $line) {
            $this->Cell($w, 5, $this->latin($line), 0, 1, 'C');
        }
        $this->Ln(2);
        $this->SetFont('Helvetica', '', 9);
    }

    /**
     * One statement line: label in the first two columns, optional values in
     * the third (revenue breakdown) and fourth (summary) columns.
     */
    protected function row(string $label, $value3 = '', $value4 = '', bool $bold = false, bool $blank3 = false)
    {
        if ($this->GetY() + 7 > $this->PageBreakTrigger) {
            $this->AddPage();
        }

        $this->SetFont('Helvetica', $bold ? 'B' : '', 9);
        [$a, $b, $c, $d] = $this->widths;

        $this->Cell($a, 7, '', 'B', 0, 'L');
        $this->Cell($b, 7, $this->latin($label), 'B', 0, 'L');
        $this->Cell($c, 7, $blank3 ? '' : $this->fmtNum($value3), 'B', 0, 'R');
        $this->Cell($d, 7, $this->fmtNum($value4), 'B', 0, 'R');
        $this->Ln();

        $this->SetFont('Helvetica', '', 9);
    }

    protected function blankRow()
    {
        $this->row('', '', '');
    }

    protected function renderBody()
    {
        $t = $this->totals;

        $this->row('Peredaran Usaha', '', '', true);
        $this->row('Pendapatan Jasa', $t['totalpendapatanjasa'] ?? 0, '', false, true);
        $this->row('Pendapatan Operasional', $t['totalpendapatanoperasional'] ?? 0, '', false, true);
        $this->row('Pendapatan Trucking', $t['totalpendapatantrucking'] ?? 0, '', false, true);
        $this->row('Total Pendapatan', '', $t['totallababruto'] ?? 0, true, true);
        $this->blankRow();
        $this->row('Laba Bruto Usaha', '', $t['totallababruto'] ?? 0, true, true);
        $this->blankRow();

        foreach ($this->data as $biaya) {
            $nama = is_array($biaya) ? ($biaya['nama_biaya'] ?? '') : ($biaya->nama_biaya ?? '');
            $jumlah = is_array($biaya) ? ($biaya['jumlah_biaya'] ?? 0) : ($biaya->jumlah_biaya ?? 0);
            $this->row((string) $nama, '', $jumlah, false, true);
        }

        $this->row('Total Biaya', '', $t['totalbiaya'] ?? 0, true, true);
        $this->blankRow();
        $this->row('Laba (Rugi) Neto Usaha', '', $t['labarugineto'] ?? 0, true, true);
        $this->row('Penghasilan dari Luar Usaha', '', $t['totalpenghasilanluarusaha'] ?? 0, true, true);
        $this->row('Biaya dari Luar Usaha', '', $t['totalbiayaluarusaha'] ?? 0, true, true);
        $this->row('Laba (Rugi) Neto setelah pajak', '', $t['labarugineto'] ?? 0, true, true);
    }

    protected function renderSignature()
    {
        $this->Ln(4);
        $w = $this->usableWidth();
        $this->SetX($this->lMargin);
        $this->Cell($w - 50, 6, 'Jakarta, '.$this->fmtDateLong($this->tanggalakhir), 0, 0, 'R');
        $this->Cell(50, 6, '', 0, 1, 'L');
        $this->Ln(8);
        $this->SetX($this->lMargin);
        $this->Cell($w - 50, 6, '', 0, 0, 'R');
        $this->Cell(50, 6, $this->latin('Yoppy Benny'), 0, 1, 'L');
    }
}
