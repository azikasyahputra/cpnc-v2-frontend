<?php

namespace App\Support;

/**
 * FPDF renderer for the Neraca report (A4 landscape).
 *
 * A balanced two-column statement (AKTIVA left, KEWAJIBAN right) inside a
 * bordered 6-column grid.
 */
class NeracaPdf extends PdfDocument
{
    /** @var array */
    protected $d;

    /** @var string */
    protected $tanggalakhir;

    /** @var array */
    protected $widths;

    public function __construct(array $d, string $tanggalakhir)
    {
        parent::__construct('L', 'A4');
        $this->SetMargins(8, 12, 8);
        $this->SetAutoPageBreak(true, 14);
        $this->SetFont('Helvetica', '', 9);

        $this->d = $d;
        $this->tanggalakhir = $tanggalakhir;

        $this->widths = [15, 90, 34, 15, 90, 37];
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
            'NERACA',
            'PER '.$this->fmtDateLong($this->tanggalakhir),
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
     * Render one "line" of the statement.
     *
     * A/B hold the left label+value cells, C the left value, D/E the right
     * label, F the right value. Section rows pass '' as the value so the
     * value cell renders empty, matching the bordered-blade layout.
     *
     * @param  string  $leftLabel  label text in column B
     * @param  mixed  $leftValue  value for column C
     * @param  string  $rightLabel  label text in column E
     * @param  mixed  $rightValue  value for column F
     * @param  bool  $section  render as a bold section header
     */
    protected function row(string $leftLabel, $leftValue, string $rightLabel, $rightValue, bool $section = false)
    {
        if ($this->GetY() + 8 > $this->PageBreakTrigger) {
            $this->AddPage();
        }

        $this->SetFont('Helvetica', $section ? 'B' : '', 9);
        [$a, $b, $c, $d, $e, $f] = $this->widths;

        $this->cellText($a, 8, '', 'B', 'L');
        $this->cellText($b, 8, $leftLabel, 'B', 'L');
        $this->cellText($c, 8, $this->val($leftValue), 'B', 'R');
        $this->cellText($d, 8, '', 'B', 'L');
        $this->cellText($e, 8, $rightLabel, 'B', 'L');
        $this->cellText($f, 8, $this->val($rightValue), 'B', 'R');
        $this->Ln();

        $this->SetFont('Helvetica', '', 9);
    }

    protected function val($value): string
    {
        return $value === '' || $value === null ? '' : $this->fmtNum($value);
    }

    protected function renderBody()
    {
        $d = $this->d;
        $v = fn ($key) => $d[$key] ?? 0;

        $this->row('AKTIVA', '', 'KEWAJIBAN', '', true);
        $this->row('Aktiva Lancar', '', 'Kewajiban', '', true);
        $this->row('Kas dan Setara Kas', $v('totalkas'), 'Utang Usaha', $v('utangusaha'));
        $this->row('', '', 'Utang Pajak', $v('utangpajak'));
        $this->row('Piutang', $v('piutang'), '', '');
        $this->row('Persediaan', '-', '', '');
        $this->row('Aktiva Tetap', '', 'Ekuitas', '', true);
        $this->row('Inventaris (Neto)', $v('inventaris'), 'Modal Disetor', $v('modaldisetor'));
        $this->row('Penambahan Aktiva', $v('penambahanaktiva'), 'Laba (Rugi) Tahun Berjalan', $v('labarugiberjalan'));
        $this->row('Akumulasi Penyusutan', $v('akumulasipenyusutan'), 'Laba (Rugi) Tahun Lalu', $v('labarugilalu'));
        $this->row('', '-', '', '');
        $this->row('', '', '', '');
        $this->row('JUMLAH AKTIVA', $v('jumlahaktiva'), 'JUMLAH KEWAJIBAN DAN EKUITAS', $v('jumlahkewajiban'), true);
    }

    protected function renderSignature()
    {
        $this->Ln(4);
        $w = $this->usableWidth();
        $this->SetX($this->lMargin);
        $this->Cell($w - 50, 6, 'Jakarta, '.$this->fmtDateLong($this->tanggalakhir), 0, 0, 'R');
        $this->Cell(50, 6, '', 0, 1, 'L');
        $this->Ln(10);
        $this->SetX($this->lMargin);
        $this->Cell($w - 50, 6, '', 0, 0, 'R');
        $this->Cell(50, 6, $this->latin('Yoppy Benny'), 'U', 1, 'L');
        $this->SetX($this->lMargin);
        $this->Cell($w - 50, 6, '', 0, 0, 'R');
        $this->Cell(50, 6, 'Direktur', 0, 1, 'L');
    }
}
