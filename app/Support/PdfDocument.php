<?php

namespace App\Support;

use Fpdf\Fpdf;

/**
 * Base FPDF renderer shared by every PDF this application produces.
 *
 * Provides the common plumbing: UTF-8 -> Latin-1 conversion for core fonts,
 * Indonesian number/date formatting, fixed-baseline text placement for
 * preprinted forms, letterhead/header blocks, and a bordered table engine
 * with repeated headers on page breaks and summary-row detection.
 */
abstract class PdfDocument extends Fpdf
{
    /** @var array */
    protected $headings = [];

    /** @var array */
    protected $widths = [];

    /** @var array */
    protected $aligns = [];

    /** @var array */
    protected $formats = [];

    public function __construct(string $orientation = 'P', $size = 'A4')
    {
        parent::__construct($orientation, 'mm', $size);
        $this->SetMargins(8, 12, 8);
        $this->SetAutoPageBreak(true, 14);
        $this->SetFont('Helvetica', '', 9);
    }

    /**
     * Convert a UTF-8 string to Latin-1 for FPDF's core fonts.
     */
    public function latin(string $value): string
    {
        $converted = @iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $value);

        return $converted === false ? $value : $converted;
    }

    /**
     * Format a value as an Indonesian integer (thousands separated by '.').
     */
    public function fmtNum($value): string
    {
        return number_format((float) $value, 0, '', '.');
    }

    /**
     * Robust date formatting: accepts 'Y-m-d H:i:s', 'Y-m-d' or 'm/d/Y'.
     */
    public function fmtDate($value, string $format = 'd/m/Y'): string
    {
        if ($value === null || $value === '' || $value === 'kosong') {
            return '';
        }
        $timestamp = strtotime((string) $value);

        return $timestamp === false ? (string) $value : date($format, $timestamp);
    }

    public function monthName(string $month): string
    {
        $names = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];

        return $names[$month] ?? $month;
    }

    /**
     * Long Indonesian date, e.g. "1 Januari 2026".
     */
    public function fmtDateLong($value): string
    {
        if ($value === null || $value === '') {
            return '';
        }
        $timestamp = strtotime((string) $value);
        if ($timestamp === false) {
            return (string) $value;
        }

        return date('j', $timestamp).' '.$this->monthName(date('m', $timestamp)).' '.date('Y', $timestamp);
    }

    // ------------------------------------------------------------------
    //  Fixed-baseline text placement (preprinted forms)
    // ------------------------------------------------------------------

    /**
     * Draw a single line of text with its baseline at $y.
     */
    protected function textAt(float $x, float $baseline, string $str)
    {
        if ($str === '') {
            return;
        }
        $this->Text($x, $baseline, $str);
    }

    protected function textRightAt(float $right, float $baseline, string $str)
    {
        $this->textAt($right - $this->GetStringWidth($str), $baseline, $str);
    }

    protected function textCenterAt(float $center, float $baseline, string $str)
    {
        $this->textAt($center - $this->GetStringWidth($str) / 2, $baseline, $str);
    }

    /**
     * Wrap a string to lines that fit within $width, then draw each line
     * starting at baseline $baseline (advancing by $step per line).
     */
    protected function wrapText(float $x, float $width, float $baseline, float $step, string $str, string $align = 'left')
    {
        foreach ($this->wrap($str, $width) as $i => $line) {
            $y = $baseline + $step * $i;
            if ($align === 'right') {
                $this->textRightAt($x, $y, $line);
            } elseif ($align === 'center') {
                $this->textCenterAt($x, $y, $line);
            } else {
                $this->textAt($x, $y, $line);
            }
        }
    }

    /**
     * Word-wrap a text to the given width in the current font.
     */
    public function wrap(string $str, float $width): array
    {
        $words = preg_split('/\s+/', trim($str));
        $lines = [];
        $current = '';

        foreach ($words as $word) {
            $candidate = $current === '' ? $word : $current.' '.$word;
            if ($this->GetStringWidth($candidate) <= $width || $current === '') {
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

    /**
     * Draw a bordered cell at the current position.
     */
    protected function cellText(float $w, float $h, string $text, $border = 0, string $align = 'L')
    {
        $this->Cell($w, $h, $this->latin($text), $border, 0, $align);
    }

    // ------------------------------------------------------------------
    //  Report header blocks
    // ------------------------------------------------------------------

    public function usableWidth(): float
    {
        return $this->w - $this->lMargin - $this->rMargin;
    }

    public function leftMargin(): float
    {
        return $this->lMargin;
    }

    /**
     * Bordered title box (left) optionally spanning only part of the width.
     */
    public function titleBox(string $title, float $width = 0, string $align = 'L')
    {
        $this->SetFont('Helvetica', 'B', 12);
        $x = $this->GetX();
        $y = $this->GetY();
        $w = $width > 0 ? $width : $this->usableWidth();
        $this->Rect($x, $y, $w, 8);
        $this->Cell($w, 8, $this->latin($title), 0, 1, $align);
        $this->SetFont('Helvetica', '', 8);
    }

    /**
     * Centered single-line text (used for the "Tanggal: ... - ..." line).
     */
    public function centeredLine(string $text, float $height = 6)
    {
        $this->SetX($this->lMargin);
        $this->Cell($this->usableWidth(), $height, $this->latin($text), 0, 1, 'C');
    }

    public function hr()
    {
        $y = $this->GetY();
        $this->Line($this->lMargin, $y, $this->w - $this->rMargin, $y);
        $this->Ln(1);
    }

    /**
     * Standard report header block: title box + period line.
     */
    public function renderHeaderBlock(string $title, string $period = '')
    {
        $this->titleBox($title, 50);
        if ($period !== '') {
            $this->centeredLine($period);
        }
        $this->Ln(2);
    }

    /**
     * Two-column letterhead block: company details on the left,
     * report-specific details on the right.
     */
    public function companyBlock(string $left, string $leftSub, string $right, string $rightSub)
    {
        $half = $this->usableWidth() / 2;
        $this->SetFont('Helvetica', 'B', 10);
        $this->SetX($this->lMargin);
        $this->Cell($half, 6, $this->latin($left), 0, 0, 'L');
        $this->Cell($half, 6, $this->latin($right), 0, 1, 'R');
        $this->SetFont('Helvetica', '', 9);
        $this->SetX($this->lMargin);
        $this->Cell($half, 6, $this->latin($leftSub), 0, 0, 'L');
        $this->Cell($half, 6, $this->latin($rightSub), 0, 1, 'R');
        $this->Ln(2);
    }

    // ------------------------------------------------------------------
    //  Table engine
    // ------------------------------------------------------------------

    /**
     * Start a table: store geometry and draw the bold header row.
     */
    public function beginTable(array $headings, array $widths, array $aligns = [], array $formats = [])
    {
        $this->headings = $headings;
        $this->widths = $widths;
        $this->aligns = array_values($aligns) ?: array_fill(0, count($headings), 'L');
        $this->formats = $formats;

        $this->SetFont('Helvetica', 'B', 8);
        foreach ($this->headings as $i => $heading) {
            $this->cellText($this->widths[$i], 6, (string) $heading, 'B', $this->aligns[$i]);
        }
        $this->Ln();
        $this->SetFont('Helvetica', '', 8);
    }

    /**
     * Draw a single data row. Rows containing the sentinel value "kosong"
     * are rendered bold (summary rows) and their sentinel cells are blanked.
     */
    public function tableRow(array $cells, bool $forceSummary = false)
    {
        $summary = $forceSummary;
        foreach ($cells as $cell) {
            if ($cell === 'kosong') {
                $summary = true;
                break;
            }
        }

        $this->repeatHeaderIfNeeded(6, 'B');

        $this->SetFont('Helvetica', $summary ? 'B' : '', 8);
        foreach ($this->widths as $i => $w) {
            $value = ($cells[$i] ?? null) === 'kosong' ? '' : $this->formatCell($cells[$i] ?? '', $i);
            $this->cellText($w, 6, $value, $summary && $this->rowBordered() ? 'T' : '', $this->aligns[$i]);
        }
        $this->Ln();
        $this->SetFont('Helvetica', '', 8);
    }

    /**
     * Bold footer row where the first $mergeCount columns are merged into a
     * single label cell (e.g. "GRAND TOTAL").
     */
    public function footerRow(array $cells, int $mergeCount = 0, string $border = 'T')
    {
        $this->repeatHeaderIfNeeded(6, 'B');

        $this->SetFont('Helvetica', 'B', 8);
        if ($mergeCount > 0) {
            $w = array_sum(array_slice($this->widths, 0, $mergeCount));
            $this->cellText($w, 6, $this->latin((string) $cells[0]), $border, 'L');
        }
        for ($i = $mergeCount; $i < count($this->widths); $i++) {
            $this->cellText($this->widths[$i], 6, $this->formatCell($cells[$i] ?? '', $i), $border, $this->aligns[$i]);
        }
        $this->Ln();
        $this->SetFont('Helvetica', '', 8);
    }

    public function formatCell($value, int $i): string
    {
        $format = $this->formats[$i] ?? 'text';
        switch ($format) {
            case 'num':
                return $this->fmtNum($value);
            case 'date':
                return $this->fmtDate($value, 'd/m/Y');
            case 'datemonth':
                return $this->fmtDate($value, 'd-M-Y');
            default:
                return (string) $value;
        }
    }

    protected function rowBordered(): bool
    {
        return true;
    }

    protected function repeatHeaderIfNeeded(float $rowHeight, string $weight)
    {
        if ($this->GetY() + $rowHeight <= $this->PageBreakTrigger) {
            return;
        }

        $this->AddPage();
        $this->SetFont('Helvetica', $weight, 8);
        foreach ($this->headings as $i => $heading) {
            $this->cellText($this->widths[$i], 6, (string) $heading, 'B', $this->aligns[$i]);
        }
        $this->Ln();
    }
}
