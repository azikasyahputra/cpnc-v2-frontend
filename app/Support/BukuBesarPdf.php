<?php

namespace App\Support;

/**
 * FPDF renderer for the Laporan Buku Besar Keuangan (A4 portrait, Times font).
 *
 * Fixed, non-breaking layout: a section header per account, wrapped unbordered
 * data rows, bold bordered account totals, and a gray GRAND TOTAL row.
 */
class BukuBesarPdf extends PdfDocument
{
    /** @var array */
    protected $rows;

    /** @var array */
    protected $totals;

    /** @var string */
    protected $tanggalawal;

    /** @var string */
    protected $tanggalakhir;

    public function __construct(array $d, string $tanggalawal, string $tanggalakhir)
    {
        parent::__construct('P', 'A4');
        $this->SetMargins(10, 12, 10);
        $this->SetAutoPageBreak(false);

        [$rows, $totals] = $this->prepare($d);
        $this->rows = $rows;
        $this->totals = $totals;
        $this->tanggalawal = str_replace('-', '', $tanggalawal);
        $this->tanggalakhir = str_replace('-', '', $tanggalakhir);
    }

    public function build(): string
    {
        $this->SetDrawColor(0, 0, 0);
        $this->AddPage();

        $this->renderHeader();
        $this->tableTop();
        $this->columns();

        foreach ($this->rows as $row) {
            if (($row['tanggal'] ?? '') === 'header') {
                $this->sectionHeader($row['kode_referensi'] ?? '');
            } elseif (($row['tanggal'] ?? '') === 'tail') {
                $this->accountTotal($row);
            } else {
                $this->row($row);
            }
        }

        foreach ($this->totals as $total) {
            $this->grandTotal($total);
        }

        $this->tableBottom();

        return $this->Output('S');
    }

    /**
     * Shape raw API rows for PDF rendering.
     *
     * @return array{0: array, 1: array}
     */
    protected function prepare(array $d): array
    {
        $pdfData = [];
        foreach (($d['data'] ?? []) as $row) {
            if (! isset($row['keterangan'])) {
                continue;
            }
            $blank = trim((string) ($row['tanggal'] ?? '')) === ''
                && trim((string) ($row['no_transaksi'] ?? '')) === ''
                && trim((string) $row['keterangan']) === '';

            if ($blank && trim((string) ($row['kode_referensi'] ?? '')) !== '') {
                $row['tanggal'] = 'header';
                $row['no_transaksi'] = 'header';
                $row['keterangan'] = 'header';
            } elseif (trim((string) $row['keterangan']) === 'Total') {
                $row['tanggal'] = 'tail';
                $row['no_transaksi'] = 'tail';
                $row['keterangan'] = 'tail';
            } elseif (trim((string) $row['keterangan']) === 'GRAND TOTAL') {
                continue;
            }
            $row['debit'] = $this->toNumber($row['debit'] ?? 0);
            $row['kredit'] = $this->toNumber($row['kredit'] ?? 0);
            $row['saldo'] = $this->toNumber($row['saldo'] ?? 0);
            $pdfData[] = $row;
        }

        $totals = [];
        $dataTotal = $d['dataTotal'] ?? [];
        if (isset($dataTotal[3])) {
            $totals[] = [
                $this->toNumber($dataTotal[3]),
                $this->toNumber($dataTotal[4]),
                $this->toNumber($dataTotal[5]),
            ];
        }

        return [$pdfData, $totals];
    }

    /**
     * Coerce an API value (already-formatted string or number) to a float.
     */
    protected function toNumber($value): float
    {
        if (is_numeric($value)) {
            return (float) $value;
        }

        $digits = preg_replace('/[^\d\-]/', '', (string) $value);

        return (float) ($digits === '' ? 0 : $digits);
    }

    /**
     * Column widths in mm (sums to 190), mirroring the old fixed-layout table:
     * No Referensi 15%, remaining columns split evenly.
     */
    protected function columnsWidths(): array
    {
        return [28.5, 26.9, 26.9, 26.9, 26.9, 26.9, 26.9];
    }

    /** Report title inside a bordered box (left 30%), then the centered date line. */
    protected function renderHeader()
    {
        $boxW = 57;
        $boxH = 12;
        $y = $this->GetY();

        $this->SetFont('Times', 'B', 11);
        $this->SetLineWidth(0.53);
        $this->Rect(10, $y, $boxW, $boxH);
        $this->SetXY(13, $y + 2.5);
        $this->Cell($boxW - 6, 7, 'Laporan Buku Besar Keuangan', 0, 0, 'L');
        $this->SetY($y + $boxH + 4);

        $this->SetFont('Times', 'B', 9);
        $this->Cell(190, 6, 'Tanggal: '.$this->tanggalawal.'-'.$this->tanggalakhir, 0, 1, 'C');
        $this->Ln(3);
    }

    /** Thick 3px top border of the table. */
    protected function tableTop()
    {
        $this->ensure(8);
        $this->SetLineWidth(0.8);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(1.5);
    }

    /** Thick 3px bottom border of the table. */
    protected function tableBottom()
    {
        $this->SetLineWidth(0.8);
        $this->Ln(1.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
    }

    /** Add a page and redraw the table border + column header when there is not enough room. */
    protected function ensure(float $height)
    {
        if ($this->GetY() + $height > $this->GetPageHeight() - 12) {
            $this->AddPage();
            $this->tableTop();
            $this->columns();
        }
    }

    /** Column header text, no borders. */
    protected function columns()
    {
        $headers = ['No Referensi', 'Tanggal', 'No Jurnal', 'Keterangan', 'Debit', 'Kredit', 'Saldo'];
        $widths = $this->columnsWidths();

        $this->SetFont('Times', 'B', 7);

        $x = 10;
        $y = $this->GetY();
        foreach ($headers as $i => $label) {
            $align = $i >= 4 ? 'R' : 'L';
            $this->SetXY($x, $y);
            $this->Cell($widths[$i], 5, $this->latin($label), 0, 0, $align);
            $x += $widths[$i];
        }
        $this->SetY($y + 5);
    }

    /** Normal data row: no borders, wrapped text. */
    protected function row(array $row)
    {
        $this->multicellRow([
            (string) ($row['kode_referensi'] ?? ''),
            (string) ($row['tanggal'] ?? ''),
            (string) ($row['no_transaksi'] ?? ''),
            (string) ($row['keterangan'] ?? ''),
            number_format($row['debit'], 0, '', '.'),
            number_format($row['kredit'], 0, '', '.'),
            number_format($row['saldo'], 0, '', '.'),
        ], ['L', 'L', 'L', 'L', 'R', 'R', 'R']);
    }

    /** Section header: a thin bottom-border line, then the bold account name. */
    protected function sectionHeader(string $kodeReferensi)
    {
        $this->ensure(10);

        $this->SetLineWidth(0.26);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->SetY($this->GetY() + 1.5);

        $this->SetFont('Times', 'B', 7);
        $this->Cell(190, 5, $this->latin($kodeReferensi), 0, 1, 'L');
        $this->Ln(1);
    }

    /** Account total row: bordered, bold. */
    protected function accountTotal(array $row)
    {
        $this->borderRow([
            (string) ($row['kode_referensi'] ?? ''),
            '', '', '',
            number_format($row['debit'], 0, '', '.'),
            number_format($row['kredit'], 0, '', '.'),
            number_format($row['saldo'], 0, '', '.'),
        ], ['L', 'L', 'L', 'L', 'R', 'R', 'R']);
        $this->Ln(1);
    }

    /** GRAND TOTAL: thin line above, then a bordered gray row. */
    protected function grandTotal(array $total)
    {
        $this->ensure(10);

        $this->SetLineWidth(0.26);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->SetY($this->GetY() + 1.5);

        $this->borderRow([
            'GRAND TOTAL', '', '', '',
            number_format($total[0], 0, '', '.'),
            number_format($total[1], 0, '', '.'),
            number_format($total[2], 0, '', '.'),
        ], ['L', 'L', 'L', 'L', 'R', 'R', 'R'], true);
    }

    /**
     * Render a bordered row. The first value spans the first 4 columns,
     * with the amounts on the right.
     */
    protected function borderRow(array $values, array $aligns, bool $fill = false)
    {
        $this->multicellRow($values, $aligns, 4, true, $fill);
    }

    /**
     * Render a multi-line, vertically-centered row. When $span > 1 the first
     * value is drawn across the first $span columns.
     */
    protected function multicellRow(array $values, array $aligns, int $span = 1, bool $bold = false, bool $fill = false)
    {
        $widths = $this->columnsWidths();
        $pad = 0.8;
        $lineHeight = 3.4;
        $this->SetFont('Times', $bold ? 'B' : '', 7);

        $spanW = array_sum(array_slice($widths, 0, $span));

        $lineSets = [];
        $lineSets[0] = $this->textLines($this->latin((string) $values[0]), $spanW - 2 * $pad);
        $maxLines = count($lineSets[0]);

        for ($i = $span; $i < count($values); $i++) {
            $w = $widths[$i] - 2 * $pad;
            $lineSets[$i] = $this->textLines($this->latin((string) $values[$i]), $w);
            $maxLines = max($maxLines, count($lineSets[$i]));
        }

        $rowHeight = $maxLines * $lineHeight + 2 * $pad;
        $this->ensure($rowHeight + 1);

        if ($fill) {
            $this->SetFillColor(211, 211, 211);
        }

        $y = $this->GetY();

        if ($span > 1) {
            $this->drawCell(10, $y, $spanW, $rowHeight, $lineSets[0], $aligns[0], $pad, $lineHeight, true, $fill);

            $x = 10 + $spanW;
            for ($i = $span; $i < count($values); $i++) {
                $w = $widths[$i];
                $this->drawCell($x, $y, $w, $rowHeight, $lineSets[$i], $aligns[$i], $pad, $lineHeight, true, $fill);
                $x += $w;
            }
        } else {
            $x = 10;
            foreach ($values as $i => $value) {
                $w = $widths[$i];
                $this->drawCell($x, $y, $w, $rowHeight, $lineSets[$i] ?? [$this->latin((string) $value)], $aligns[$i], $pad, $lineHeight, false, false);
                $x += $w;
            }
        }

        $this->SetY($y + $rowHeight);
    }

    /** Draw one grid cell: optional 1px border/fill plus vertically-centered wrapped text. */
    protected function drawCell(float $x, float $y, float $w, float $h, array $lines, string $align, float $pad, float $lineHeight, bool $bordered, bool $fill)
    {
        if ($bordered) {
            $this->SetLineWidth(0.26);
            $this->Rect($x, $y, $w, $h, $fill ? 'DF' : 'D');
        }

        $ty = $y + (($h - count($lines) * $lineHeight) / 2);
        foreach ($lines as $i => $line) {
            $this->SetXY($x + $pad, $ty + $i * $lineHeight);
            $this->Cell($w - 2 * $pad, $lineHeight, $line, 0, 0, $align);
        }
    }

    /** Word-wrap a text to the given width in the current font. */
    protected function textLines(string $text, float $width): array
    {
        $text = trim($text);
        if ($text === '') {
            return [''];
        }

        $lines = [];
        $current = '';

        foreach (explode(' ', $text) as $word) {
            if ($this->GetStringWidth($word) > $width) {
                if ($current !== '') {
                    $lines[] = $current;
                    $current = '';
                }
                $chunk = '';
                foreach (str_split($word) as $char) {
                    if ($chunk !== '' && $this->GetStringWidth($chunk.$char) > $width) {
                        $lines[] = $chunk;
                        $chunk = $char;
                    } else {
                        $chunk .= $char;
                    }
                }
                if ($chunk !== '') {
                    $current = $chunk;
                }
                continue;
            }

            $candidate = $current === '' ? $word : $current.' '.$word;
            if ($this->GetStringWidth($candidate) <= $width) {
                $current = $candidate;
            } else {
                $lines[] = $current;
                $current = $word;
            }
        }

        if ($current !== '') {
            $lines[] = $current;
        }

        return $lines;
    }
}
