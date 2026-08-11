<?php

namespace App\Support;

/**
 * FPDF renderer for the preprinted kwitansi form (105 x 281 mm, landscape).
 *
 * The form is a narrow horizontal strip; values are laid out top-to-bottom.
 */
class KwitansiPdf extends PdfDocument
{
    /** @var object|null */
    protected $header;

    /** @var string */
    protected $detailKwitansi;

    public function __construct(array $data)
    {
        parent::__construct('L', [105, 281]);
        $this->SetMargins(5, 0, 5);
        $this->SetAutoPageBreak(false);
        $this->SetFont('Helvetica', '', 10.5);

        $this->header = $data['header']->first();
        $this->detailKwitansi = $this->buildDetailKwitansi($data);
    }

    public function build(): string
    {
        if ($this->header === null) {
            return $this->Output('S');
        }

        $this->AddPage();

        $rows = [
            (string) $this->header->no_invoice,
            (string) $this->header->no_invoice,
            strtoupper((string) $this->header->nama_client),
            strtoupper((string) $this->header->biaya_terbilang),
            $this->detailKwitansi,
            $this->fmtNum($this->header->jumlah_biaya),
        ];

        $x = 0.25 * 281; // 25% spacer column
        $y = 17;
        foreach ($rows as $value) {
            if ($value !== '') {
                $this->Text($x, $y, $value);
            }
            $y += 12;
        }

        $this->Text(0.23 * 281, 97, $this->fmtDate($this->header->tanggal_invoice));

        return $this->Output('S');
    }

    protected function buildDetailKwitansi(array $data): string
    {
        $detail = $data['detail'] ?? collect();
        $names = collect($detail)->map(function ($row) {
            return $row->nama_biaya ?? '';
        })->filter();

        return $names->implode(',');
    }
}
