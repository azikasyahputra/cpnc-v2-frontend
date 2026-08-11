<?php

namespace App\Support;

/**
 * FPDF renderer for the Invoice Trucking (A4 portrait).
 *
 * Company letterhead, client name, and a 9-column itemised table with a
 * TOTAL TAGIHAN footer.
 */
class InvoiceTruckingPdf extends PdfDocument
{
    /** @var object|null */
    protected $head;

    /** @var \Illuminate\Support\Collection */
    protected $detail;

    /** @var array */
    protected $widths;

    public function __construct(array $data)
    {
        parent::__construct('P', 'A4');
        $this->SetMargins(10, 12, 10);
        $this->SetAutoPageBreak(true, 14);
        $this->SetFont('Helvetica', '', 9);

        $this->head = $data['header']->first();
        $this->detail = $data['detail'];

        $this->widths = [13, 18, 24, 24, 24, 24, 21, 21, 25];
    }

    public function build(): string
    {
        if ($this->head === null) {
            return $this->Output('S');
        }

        $this->AddPage();
        $this->renderLetterhead();
        $this->renderClient();
        $this->renderTable();

        return $this->Output('S');
    }

    public function fmtNum($value): string
    {
        return number_format((float) $value, 0, ',', '.');
    }

    protected function renderLetterhead()
    {
        $this->SetFont('Helvetica', 'B', 14);
        $this->Cell(0, 7, 'PT.CAHYAPRAJA NUSACERIA', 0, 1);
        $this->SetFont('Helvetica', '', 9);
        $this->Cell(0, 5, 'Office : Jl. Fort Barat No,43A Kebon Bawang, Tj. Priok, Jakarta Utara', 0, 1);
        $this->Cell(0, 5, 'Telp. (021) 4358506     Fax. (021) 4358652', 0, 1);
        $this->Ln(4);
    }

    protected function renderClient()
    {
        $this->SetFont('Helvetica', 'B', 13);
        $this->Cell(0, 7, $this->latin((string) $this->head->nama_client), 0, 1);
        $this->SetFont('Helvetica', '', 9);
        $this->Ln(3);
    }

    protected function renderTable()
    {
        $headings = ['AJU', 'Tanggal', 'Tujuan', 'Party', 'Container', 'Ongkos', 'U.Bongkar', 'Lift Off', 'Tagihan'];
        $aligns = ['C', 'C', 'L', 'L', 'L', 'R', 'R', 'R', 'R'];

        $this->SetFont('Helvetica', 'B', 9);
        foreach ($this->widths as $i => $w) {
            $this->Cell($w, 7, $headings[$i], 'TB', 0, $aligns[$i]);
        }
        $this->Ln();

        $this->SetFont('Helvetica', '', 9);
        $total = 0;
        foreach ($this->detail as $row) {
            $tagihan = (int) $row->ongkos + (int) $row->uang_bongkar + (int) $row->lift_off;
            $total += $tagihan;

            if ($this->GetY() + 7 > $this->PageBreakTrigger) {
                $this->AddPage();
                $this->SetFont('Helvetica', 'B', 9);
                foreach ($this->widths as $i => $w) {
                    $this->Cell($w, 7, $headings[$i], 'TB', 0, $aligns[$i]);
                }
                $this->Ln();
                $this->SetFont('Helvetica', '', 9);
            }

            $cells = [
                (string) $this->head->no_aju,
                (string) $row->tanggal_order,
                (string) $row->tujuan,
                (string) $row->party,
                (string) $row->container,
                $this->fmtNum($row->ongkos),
                $this->fmtNum($row->uang_bongkar),
                $this->fmtNum($row->lift_off),
                $this->fmtNum($tagihan),
            ];
            foreach ($this->widths as $i => $w) {
                $this->Cell($w, 7, $this->latin($cells[$i]), 'B', 0, $aligns[$i]);
            }
            $this->Ln();
        }

        $mergeW = array_sum(array_slice($this->widths, 0, 8));
        $this->SetFont('Helvetica', 'B', 9);
        $this->Cell($mergeW, 7, 'TOTAL TAGIHAN', 'B', 0, 'R');
        $this->Cell($this->widths[8], 7, $this->fmtNum($total), 'B', 0, 'R');
        $this->Ln();
    }
}
