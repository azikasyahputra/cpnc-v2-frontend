<?php

namespace App\Support;

use Carbon\Carbon;
use Fpdf\Fpdf;

/**
 * FPDF renderer for the preprinted-form invoice (dompdf-compatible layout).
 *
 * The layout reproduces, 1:1, the output previously produced by
 * resources/views/invoice/invoice.blade.php under dompdf:
 * A4 portrait, Helvetica 10.5pt, text placed at fixed positions so it lines
 * up with the preprinted invoice form. All coordinates were derived from
 * dompdf's rendered output (1pt = 25.4/72 mm).
 */
class InvoiceFpdf extends Fpdf
{
    /** @var object|null */
    protected $inv;

    /** @var \Illuminate\Support\Collection */
    protected $detail;

    /** @var int */
    protected $detailcount;

    /** @var \Illuminate\Support\Collection */
    protected $biayadetail;

    /** @var \Illuminate\Support\Collection */
    protected $referensi;

    // Table geometry (mm), measured on a full-width A4 form (0-210mm).
    const TABLE_LEFT = 0.52;
    const TABLE_WIDTH = 210.0;
    const TABLE_RIGHT = 210.0;

    // Detail table columns (mm).
    const COL1_X = 0.52;        // no kwitansi
    const COL2_X = 46.13;       // nama biaya
    const COL3_RIGHT = 150.73;  // biaya detail (right aligned)
    const COL4_X = 153.62;      // keterangan

    // Tanggal / footer / terbilang text positions (mm).
    const X_TANGGAL = 147.00;
    const X_TERBILANG = 111.30;
    const W_TERBILANG = 98.70;

    // Baselines (mm from page top).
    const BASELINE_NO_INVOICE = 51.66;
    const BASELINE_DETAIL_PELANGGAN1 = 80.76;
    const BASELINE_DETAIL_PELANGGAN2 = 86.05;
    const BASELINE_BL_NO = 87.37;
    const BASELINE_DETAIL_ROW1 = 114.74;
    const DETAIL_ROW_STEP = 4.92;
    const BASELINE_TOTAL = 229.08;
    const BASELINE_TERBILANG = 248.69;
    const TERBILANG_STEP = 4.37;
    const BASELINE_TANGGAL = 260.84;
    const BASELINE_FOOTER = 289.93;

    public function __construct(array $data)
    {
        parent::__construct('P', 'mm', 'A4');

        $this->inv = $data['header']->first();
        $this->detail = $data['detail'];
        $this->detailcount = $data['detailcount'];
        $this->biayadetail = $data['biayadetail'];
        $this->referensi = $data['referensi'];
    }

    public function build(): string
    {
        if ($this->inv === null) {
            return $this->Output('S');
        }

        $this->SetMargins(0, 0, 0);
        $this->SetAutoPageBreak(false);
        $this->AddPage();
        $this->SetFont('Helvetica', '', 10.5);

        $this->renderAlamatPelanggan();
        $this->renderNoInvoice();
        $this->renderDetailPelanggan();
        $this->renderBlNo();
        $this->renderDetailInvoice();
        $this->renderTotal();
        $this->renderTerbilang();
        $this->renderTanggal();
        $this->renderFooter();

        return $this->Output('S');
    }

    protected function formatTanggal($tanggal): string
    {
        return $tanggal ? Carbon::parse($tanggal)->format('d/m/Y') : '';
    }

    protected function formatAngka($angka): string
    {
        return number_format((float) $angka, 0, '', '.');
    }

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

        foreach ($lines as $i => $line) {
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

    protected function renderAlamatPelanggan()
    {
        $inv = $this->inv;
        $center = 151.30;
        $baseline = 18.00;
        $step = 4.52;
        $wrapWidth = 88.70;

        $nama = strtoupper((string) $inv->nama_client);
        $alamat = strtoupper((string) $inv->alamat_client);
        $kota = strtoupper((string) $inv->kota_client);

        $this->textCenterAt($center, $baseline, $nama);
        $baseline += $step;

        $lines = $this->wrap($alamat, $wrapWidth);
        foreach ($lines as $line) {
            $this->textCenterAt($center, $baseline, $line);
            $baseline += $step;
        }

        $this->textCenterAt($center, $baseline, $kota);
    }

    protected function renderNoInvoice()
    {
        $this->textAt(self::TABLE_LEFT + 0.18 * self::TABLE_WIDTH, self::BASELINE_NO_INVOICE, (string) $this->inv->no_invoice);
    }

    protected function renderDetailPelanggan()
    {
        $inv = $this->inv;
        $cols = [
            strtoupper((string) $inv->nama_kapal_pesawat),
            strtoupper((string) $inv->negara_asal_tujuan),
            strtoupper((string) $inv->nama_pelayaran),
            $this->formatTanggal($inv->tanggal_berangkat),
            strtoupper((string) $inv->kemasan),
            strtoupper((string) $inv->nama_barang),
        ];

        $line1 = self::BASELINE_DETAIL_PELANGGAN1;
        $line2 = self::BASELINE_DETAIL_PELANGGAN2;
        $center = ($line1 + $line2) / 2;

        $widths = array_map(function ($text) {
            return $this->GetStringWidth($text);
        }, $cols);
        $totalWidth = array_sum($widths);

        $x = self::TABLE_LEFT;
        foreach ($cols as $i => $text) {
            $colW = $totalWidth > 0
                ? $widths[$i] / $totalWidth * self::TABLE_WIDTH
                : self::TABLE_WIDTH / 6;
            $cx = $x + $colW / 2;
            if ($text !== '') {
                if ($widths[$i] <= $colW) {
                    $this->textCenterAt($cx, $center, $text);
                } else {
                    $this->wrapText($cx, $colW, $line1, $line2 - $line1, $text, 'center');
                }
            }
            $x += $colW;
        }
    }

    protected function renderBlNo()
    {
        $x26 = self::TABLE_LEFT + 0.26 * self::TABLE_WIDTH;
        $this->textRightAt($x26, self::BASELINE_BL_NO, (string) $this->inv->kode_jenis_invoice);
        $this->textAt($x26 + 1.95, self::BASELINE_BL_NO, (string) $this->inv->no_bl);
    }

    protected function renderDetailInvoice()
    {
        $i = 0;
        foreach ($this->detail as $baris) {
            $y = self::BASELINE_DETAIL_ROW1 + self::DETAIL_ROW_STEP * $i;
            $this->textAt(self::COL1_X, $y, (string) $baris->no_kwitansi);
            $namaBiaya = $this->biayadetail->firstWhere('id_biaya', $baris->id_biaya_detail);
            $this->wrapText(self::COL2_X, self::COL3_RIGHT - self::COL2_X, $y, 0, strtoupper((string) ($namaBiaya->nama_biaya ?? '')));
            $this->textRightAt(self::COL3_RIGHT, $y, $this->formatAngka($baris->biaya_detail));
            $this->wrapText(self::COL4_X, self::TABLE_RIGHT - self::COL4_X, $y, 0, strtoupper((string) $baris->keterangan));
            $i++;
        }
    }

    protected function renderTotal()
    {
        $this->textRightAt(self::COL3_RIGHT, self::BASELINE_TOTAL, $this->formatAngka($this->inv->jumlah_biaya));
    }

    protected function renderTerbilang()
    {
        $this->wrapText(self::X_TERBILANG, self::W_TERBILANG, self::BASELINE_TERBILANG, self::TERBILANG_STEP, strtoupper((string) $this->inv->biaya_terbilang));
    }

    protected function renderTanggal()
    {
        $this->textAt(self::X_TANGGAL, self::BASELINE_TANGGAL, $this->formatTanggal($this->inv->tanggal_invoice));
    }

    protected function renderFooter()
    {
        $this->textAt(self::X_TANGGAL, self::BASELINE_FOOTER, 'YOPPY. B');
    }

    protected function wrap(string $str, float $width): array
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
}
