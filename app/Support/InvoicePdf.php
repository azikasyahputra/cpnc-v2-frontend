<?php

namespace App\Support;

/**
 * FPDF renderer for the preprinted-form invoice.
 *
 * A4 portrait, Helvetica 10.5pt, text placed at fixed positions so it lines
 * up with the preprinted invoice form. All coordinates are in mm.
 */
class InvoicePdf extends PdfDocument
{
    // Table geometry (mm).
    const TABLE_LEFT = 4.50;
    const TABLE_WIDTH = 203.28;
    const TABLE_RIGHT = 207.78;

    // Detail table columns (mm).
    const COL1_X = 4.50;        // no kwitansi
    const COL2_X = 48.80;       // nama biaya
    const COL3_RIGHT = 150.08;  // biaya detail (right aligned)
    const COL4_X = 152.98;      // keterangan

    // Detail-pelanggan table (6 equal columns).
    const DP_COL_WIDTH = 33.807; // 95.838pt
    const DP_WRAP_WIDTH = 33.278; // col width minus 2px border-spacing
    const DP_BL_NO_KODE_RIGHT = 56.71; // right edge of "BL NO"
    const DP_BL_NO_X = 59.30;    // no BL text left edge

    // Tanggal / footer / terbilang text positions (mm).
    const X_TANGGAL = 146.50;
    const X_TERBILANG = 112.03;
    const W_TERBILANG = 95.52;

    // Baselines (mm from page top).
    const BASELINE_NO_INVOICE = 63.77;
    const BASELINE_BL_NO = 98.16;
    const BASELINE_DETAIL_ROW1 = 127.03;
    const DETAIL_ROW_STEP = 5.05;
    const BASELINE_TOTAL = 217.42;
    const BASELINE_TERBILANG = 233.98;
    const TERBILANG_STEP = 6.78;
    const BASELINE_TANGGAL = 249.11;
    const BASELINE_FOOTER = 278.21;

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

    public function __construct(array $data)
    {
        parent::__construct('P', 'A4');
        $this->SetMargins(0, 0, 0);
        $this->SetAutoPageBreak(false);
        $this->SetFont('Helvetica', '', 10.5);

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

        $this->AddPage();

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

    protected function renderAlamatPelanggan()
    {
        $inv = $this->inv;
        $center = 151.30;
        $baseline = 35.39;
        $step = 4.52;

        $nama = strtoupper((string) $inv->nama_client);
        $alamat = strtoupper((string) $inv->alamat_client);
        $kota = strtoupper((string) $inv->kota_client);

        $this->textCenterAt($center, $baseline, $nama);
        $baseline += $step;

        foreach ($this->wrap($alamat, 0.55 * self::TABLE_WIDTH) as $line) {
            $this->textCenterAt($center, $baseline, $line);
            $baseline += $step;
        }

        $this->textCenterAt($center, $baseline, $kota);
    }

    protected function renderNoInvoice()
    {
        $this->textAt(4.50 + 0.18 * self::TABLE_WIDTH, self::BASELINE_NO_INVOICE, (string) $this->inv->no_invoice);
    }

    protected function renderDetailPelanggan()
    {
        $inv = $this->inv;
        $cols = [
            strtoupper((string) $inv->nama_kapal_pesawat),
            strtoupper((string) $inv->negara_asal_tujuan),
            strtoupper((string) $inv->nama_pelayaran),
            $this->fmtDate($inv->tanggal_berangkat),
            strtoupper((string) $inv->kemasan),
            strtoupper((string) $inv->nama_barang),
        ];

        $line1 = 92.87;
        $line2 = 97.39;
        $center = 95.13;

        foreach ($cols as $i => $text) {
            $cx = 21.137 + self::DP_COL_WIDTH * $i;
            $wrapWidth = self::DP_WRAP_WIDTH;
            if ($text === '') {
                continue;
            }
            if ($this->GetStringWidth($text) <= $wrapWidth) {
                $this->textCenterAt($cx, $center, $text);
            } else {
                $this->wrapText($cx, $wrapWidth, $line1, $line2 - $line1, $text, 'center');
            }
        }
    }

    protected function renderBlNo()
    {
        $this->textRightAt(self::DP_BL_NO_KODE_RIGHT, self::BASELINE_BL_NO, (string) $this->inv->kode_jenis_invoice);
        $this->textAt(self::DP_BL_NO_X, self::BASELINE_BL_NO, (string) $this->inv->no_bl);
    }

    protected function renderDetailInvoice()
    {
        $i = 0;
        foreach ($this->detail as $baris) {
            $y = self::BASELINE_DETAIL_ROW1 + self::DETAIL_ROW_STEP * $i;
            $this->textAt(self::COL1_X, $y, (string) $baris->no_kwitansi);
            $namaBiaya = $this->biayadetail->firstWhere('id_biaya', $baris->id_biaya_detail);
            $this->wrapText(self::COL2_X, self::COL3_RIGHT - self::COL2_X, $y, 0, strtoupper((string) ($namaBiaya->nama_biaya ?? '')));
            $this->textRightAt(self::COL3_RIGHT, $y, $this->fmtNum($baris->biaya_detail));
            $this->wrapText(self::COL4_X, self::TABLE_RIGHT - self::COL4_X, $y, 0, strtoupper((string) $baris->keterangan));
            $i++;
        }
    }

    protected function renderTotal()
    {
        $this->textRightAt(self::COL3_RIGHT, self::BASELINE_TOTAL, $this->fmtNum($this->inv->jumlah_biaya));
    }

    protected function renderTerbilang()
    {
        $this->wrapText(self::X_TERBILANG, self::W_TERBILANG, self::BASELINE_TERBILANG, self::TERBILANG_STEP, strtoupper((string) $this->inv->biaya_terbilang));
    }

    protected function renderTanggal()
    {
        $this->textAt(self::X_TANGGAL, self::BASELINE_TANGGAL, $this->fmtDate($this->inv->tanggal_invoice));
    }

    protected function renderFooter()
    {
        $this->textAt(self::X_TANGGAL, self::BASELINE_FOOTER, 'YOPPY. B');
    }
}
