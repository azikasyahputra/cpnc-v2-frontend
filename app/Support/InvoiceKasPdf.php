<?php

namespace App\Support;

/**
 * FPDF renderer for the Invoice Kas / bukti kas (A4 portrait).
 *
 * A kas voucher with a 4-column journal table (Kode, Keterangan, Debit,
 * Kredit), padded with zero rows up to six lines, and total debit/kredit
 * footer.
 */
class InvoiceKasPdf extends PdfDocument
{
    /** @var object|null */
    protected $header;

    /** @var \Illuminate\Support\Collection */
    protected $detail;

    /** @var int */
    protected $detailcount;

    /** @var \Illuminate\Support\Collection */
    protected $referensi;

    /** @var array */
    protected $widths;

    public function __construct(array $data)
    {
        parent::__construct('P', 'A4');
        $this->SetMargins(10, 12, 10);
        $this->SetAutoPageBreak(true, 14);
        $this->SetFont('Helvetica', '', 9);

        $this->header = $data['header']->first();
        $this->detail = $data['detail'];
        $this->detailcount = $data['detailcount'];
        $this->referensi = $data['referensi'];

        $this->widths = [20, 90, 42, 42];
    }

    public function build(): string
    {
        if ($this->header === null) {
            return $this->Output('S');
        }

        $this->AddPage();
        $this->renderLetterhead();
        $this->renderTable();

        return $this->Output('S');
    }

    protected function renderLetterhead()
    {
        $this->SetFont('Helvetica', 'B', 10);
        $this->Cell(0, 6, 'PT.CAHYAPRAJA NUSACERIA', 0, 1);
        $this->Cell(0, 6, 'Tlp:4358506,4358602 Fax:4358652', 0, 1);
        $this->SetX($this->lMargin);
        $this->Cell(0, 6, 'No Transaksi. '.$this->header->no_transaksi, 0, 1, 'R');
        $this->SetX($this->lMargin);
        $this->Cell(0, 6, $this->fmtDate($this->header->tanggal_transaksi), 0, 1, 'R');
        $this->Ln(3);
    }

    protected function renderTable()
    {
        $headings = ['Kode', 'Keterangan', 'Debit', 'Kredit'];
        $aligns = ['L', 'L', 'R', 'R'];

        $this->SetFont('Helvetica', 'B', 9);
        foreach ($this->widths as $i => $w) {
            $this->Cell($w, 7, $headings[$i], 'TB', 0, $aligns[$i]);
        }
        $this->Ln();
        $this->SetFont('Helvetica', '', 9);

        $rowCount = 0;
        foreach ($this->detail as $row) {
            $this->renderDataRow($row);
            $rowCount++;
        }

        $n = $this->detailcount + 1;
        while ($n < 7) {
            $this->renderZeroRow();
            $n++;
            $rowCount++;
        }

        $this->renderTotalRow('total debit:', $this->header->total_debit);
        $this->renderTotalRow('total kredit:', $this->header->total_kredit);
    }

    protected function renderDataRow($row)
    {
        $kode = '';
        foreach ($this->referensi as $ref) {
            if ((int) ($ref->id_referensi ?? 0) === (int) ($row->id_referensi ?? 0)) {
                $kode = (string) ($ref->kode_referensi ?? '');
                break;
            }
        }

        $cells = [
            $kode,
            (string) $row->keterangan,
            $this->fmtNum($row->biaya_debit),
            $this->fmtNum($row->biaya_kredit),
        ];

        $this->drawRow($cells, 'B');
    }

    protected function renderZeroRow()
    {
        $this->drawRow(['0', '0', '0', '0'], 'B');
    }

    protected function renderTotalRow(string $label, $value)
    {
        $this->SetFont('Helvetica', 'B', 9);
        if ($this->GetY() + 7 > $this->PageBreakTrigger) {
            $this->AddPage();
        }
        $w = array_sum(array_slice($this->widths, 0, 2));
        $this->Cell($w, 7, $label, 'T', 0, 'R');
        $w2 = array_sum(array_slice($this->widths, 2));
        $this->Cell($w2, 7, $this->fmtNum($value), 'T', 0, 'R');
        $this->Ln();
        $this->SetFont('Helvetica', '', 9);
    }

    protected function drawRow(array $cells, string $border)
    {
        if ($this->GetY() + 7 > $this->PageBreakTrigger) {
            $this->AddPage();
            $this->SetFont('Helvetica', 'B', 9);
            foreach ($this->widths as $i => $w) {
                $this->Cell($w, 7, ['Kode', 'Keterangan', 'Debit', 'Kredit'][$i], 'TB', 0, ['L', 'L', 'R', 'R'][$i]);
            }
            $this->Ln();
            $this->SetFont('Helvetica', '', 9);
        }

        foreach ($this->widths as $i => $w) {
            $this->Cell($w, 7, $this->latin($cells[$i]), $border, 0, ['L', 'L', 'R', 'R'][$i]);
        }
        $this->Ln();
    }
}
