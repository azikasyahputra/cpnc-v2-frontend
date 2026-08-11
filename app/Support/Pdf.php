<?php

namespace App\Support;

use Illuminate\Http\Response;

/**
 * FPDF-backed PDF entry point.
 *
 * Every method builds one of the FPDF renderers and returns a Laravel
 * response. Registered as the 'PDF' alias in config/app.php.
 */
class Pdf
{
    /**
     * Wrap rendered PDF bytes in a Laravel response.
     */
    protected static function respond(string $bytes, string $filename, bool $download = false): Response
    {
        $name = str_replace(['/', '\\'], '-', $filename).'.pdf';

        return response($bytes, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => ($download ? 'attachment' : 'inline').'; filename="'.$name.'"',
        ]);
    }

    /**
     * Shared generic table-report pipeline.
     */
    protected static function report(
        string $title,
        string $period,
        array $rows,
        string $orientation,
        $size,
        array $headings,
        array $widths,
        array $aligns,
        array $formats,
        string $filename,
        array $footer = [],
        int $footerMerge = 0
    ): Response {
        $pdf = new TabularReportPdf($orientation, $size);
        $pdf->AddPage();
        $pdf->renderHeaderBlock($title, $period);
        $pdf->beginTable($headings, $widths, $aligns, $formats);
        foreach ($rows as $row) {
            $pdf->tableRow(array_values((array) $row));
        }
        if ($footer) {
            $pdf->footerRow($footer, $footerMerge);
        }

        return self::respond($pdf->Output('S'), $filename, true);
    }

    protected static function fmtRange($awal, $akhir): string
    {
        $pdf = new TabularReportPdf('P', 'A4');

        return 'Tanggal: '.$pdf->fmtDate($awal, 'd/m/Y').'-'.$pdf->fmtDate($akhir, 'd/m/Y');
    }

    /**
     * Laporan Piutang (A4 portrait, 8 columns).
     */
    public static function laporanPiutang(array $data, $awal, $akhir): Response
    {
        return self::report(
            'Laporan Piutang',
            self::fmtRange($awal, $akhir),
            $data,
            'P',
            'A4',
            ['Nama Customer', 'Tanggal', 'Order No', 'Party', 'Doc', 'Total Tagihan', 'Diterima', 'Piutang'],
            [44, 20, 22, 18, 14, 25, 25, 26],
            ['L', 'L', 'L', 'L', 'L', 'R', 'R', 'R'],
            ['text', 'date', 'text', 'text', 'text', 'num', 'num', 'num'],
            'Laporan Piutang '.$awal.' s.d '.$akhir
        );
    }

    /**
     * Laporan Order (A4 landscape): pivot of per-document order totals.
     */
    public static function laporanOrder(array $data, $awal, $akhir, array $header, array $dokumen, array $total): Response
    {
        $count = count($dokumen) ?: 1;
        $widths = array_merge([90], array_fill(0, $count, (194 - 90) / $count));
        $aligns = array_merge(['L'], array_fill(0, $count, 'R'));
        $formats = array_merge(['text'], array_fill(0, $count, 'num'));

        $rows = [];
        foreach ($data as $row) {
            $cells = [(string) ($row['nama_client'] ?? '')];
            foreach ($dokumen as $doc) {
                $name = is_object($doc) ? $doc->nama_dokumen : $doc['nama_dokumen'];
                $cells[] = $row[$name] ?? 0;
            }
            $rows[] = $cells;
        }

        return self::report(
            'Laporan Order',
            self::fmtRange($awal, $akhir),
            $rows,
            'L',
            'A4',
            $header,
            $widths,
            $aligns,
            $formats,
            'Laporan Order '.$awal.' s.d '.$akhir,
            array_merge(['Total'], $total),
            1
        );
    }

    /**
     * Laporan Buku Besar / piutang keseluruhan (A4 portrait, 4 columns).
     */
    public static function laporanKeseluruhan(array $data, $awal, $akhir, array $datatotal): Response
    {
        $rows = [];
        foreach ($data as $row) {
            $rows[] = [
                $row['kode_referensi'] ?? '',
                $row['debit'] ?? 0,
                $row['kredit'] ?? 0,
                $row['saldo'] ?? 0,
            ];
        }

        $footer = [];
        if (isset($datatotal[0])) {
            $footer = array_merge(['GRAND TOTAL'], array_values($datatotal[0]));
        }

        return self::report(
            'Laporan Buku Besar',
            self::fmtRange($awal, $akhir),
            $rows,
            'P',
            'A4',
            ['No Referensi', 'Debit', 'Kredit', 'Saldo'],
            [70, 42, 42, 40],
            ['L', 'R', 'R', 'R'],
            ['text', 'num', 'num', 'num'],
            'Laporan Buku Besar '.$awal.' s.d '.$akhir,
            $footer,
            1
        );
    }

    /**
     * Laporan Laba/Rugi Order (A4 portrait, 12 columns + column totals).
     */
    public static function laporanRugiLaba(array $data, $awal, $akhir): Response
    {
        $totals = array_fill(0, 7, 0);
        foreach ($data as $row) {
            for ($i = 5; $i <= 11; $i++) {
                $totals[$i - 5] += (float) ($row[$i] ?? 0);
            }
        }

        $footer = array_merge(array_fill(0, 5, ''), $totals);

        return self::report(
            'Laporan Laba/Rugi Order',
            self::fmtRange($awal, $akhir),
            $data,
            'P',
            'A4',
            ['Order No', 'Tanggal', 'Nama Customer', 'Doc', 'Party', 'Piutang', 'Reimburs', 'Trucking', 'Dana Kerja', 'PPN', 'Jasa', 'Laba'],
            [16, 16, 32, 10, 12, 18, 18, 18, 18, 12, 12, 12],
            ['L', 'L', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R'],
            ['text', 'datemonth', 'text', 'text', 'text', 'num', 'num', 'num', 'num', 'num', 'num', 'num'],
            'Laporan Laba/Rugi '.$awal.' s.d '.$akhir,
            $footer,
            5
        );
    }

    /**
     * Laporan Piutang Trucking (A4 portrait, 6 columns).
     */
    public static function truckingPiutang(array $data, $awal, $akhir): Response
    {
        return self::report(
            'Laporan Piutang',
            self::fmtRange($awal, $akhir),
            $data,
            'P',
            'A4',
            ['Nama Customer', 'Tanggal', 'Order No', 'Total Tagihan', 'Lift Off', 'Piutang'],
            [60, 22, 22, 30, 30, 30],
            ['L', 'L', 'L', 'R', 'R', 'R'],
            ['text', 'date', 'text', 'num', 'num', 'num'],
            'Laporan Piutang Trucking '.$awal.' s.d '.$akhir
        );
    }

    /**
     * Laporan Tagihan Klien (A4 portrait, 10 columns).
     */
    public static function tagihanKlien(array $data, $awal, $akhir, string $noinvoice, string $nama, $totalsemua): Response
    {
        $pdf = new TabularReportPdf('P', 'A4');
        $pdf->AddPage();
        $pdf->companyBlock(
            'PT.CAHYAPRAJA NUSACERIA',
            'Tlp:4358506,4358602 Fax:4358652',
            'INVOICE No. '.$noinvoice,
            $nama
        );

        $pdf->beginTable(
            ['No', 'Tgl', 'Tujuan', 'Party', 'Container', 'Ongkos', 'DP', 'Lift Off', 'U.Bongkar', 'Kurang'],
            [12, 18, 24, 24, 22, 19, 19, 19, 19, 18],
            ['L', 'L', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'R'],
            ['text', 'datemonth', 'text', 'text', 'text', 'num', 'num', 'num', 'num', 'num']
        );
        foreach ($data as $row) {
            $pdf->tableRow(array_values((array) $row));
        }
        $pdf->footerRow(array_merge(array_fill(0, 9, ''), [$totalsemua]), 9);

        return self::respond(
            $pdf->Output('S'),
            'Laporan Tagihan '.$nama.' '.$awal.' s.d '.$akhir,
            true
        );
    }

    /**
     * Laporan Rugi/Laba Trucking (A4 portrait, 12 columns).
     */
    public static function truckingRugiLaba(array $data, $awal, $akhir, $totalsemua): Response
    {
        $pdf = new TabularReportPdf('P', 'A4');
        $pdf->AddPage();
        $pdf->companyBlock(
            'PT.CAHYAPRAJA NUSACERIA',
            'Tlp:4358506,4358602 Fax:4358652',
            '',
            ''
        );

        $pdf->beginTable(
            ['Supir', 'No', 'Nama Customer', 'Tgl', 'Tujuan', 'Party', 'Container', 'Ongkos', 'Uang Jalan', 'Komisi Supir', 'Komisi Kenek', 'Laba'],
            [18, 9, 28, 14, 16, 16, 14, 14, 14, 14, 14, 23],
            ['L', 'L', 'L', 'L', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'R'],
            ['text', 'text', 'text', 'datemonth', 'text', 'text', 'text', 'num', 'num', 'num', 'num', 'num']
        );
        foreach ($data as $row) {
            $pdf->tableRow(array_values((array) $row));
        }
        $pdf->footerRow(array_merge(array_fill(0, 11, ''), [$totalsemua]), 11);

        return self::respond(
            $pdf->Output('S'),
            'Laporan Rugi/Laba Trucking '.$awal.' s.d '.$akhir,
            true
        );
    }

    /**
     * Laporan Komisi Supir (Legal landscape, 13 columns + rincian komisi).
     */
    public static function komisiSupir(
        array $data,
        $awal,
        $akhir,
        string $namasupir,
        $jumlah,
        $totalkuranglebih,
        $totalkomisisupir,
        $totalkomisikenek,
        $totalkomisi,
        string $alasanpemotongan,
        $biayapemotongan
    ): Response {
        $pdf = new TabularReportPdf('L', 'Legal');
        $pdf->AddPage();

        $period = $pdf->fmtDate($awal, 'd-M-Y').' s.d '.$pdf->fmtDate($akhir, 'd-M-Y');
        $pdf->companyBlock(
            'PT.CAHYAPRAJA NUSACERIA',
            'Tlp:4358506,4358602 Fax:4358652',
            $namasupir,
            'TGL: '.$period
        );

        $widths = [22, 16, 26, 24, 22, 22, 28, 26, 28, 30, 30, 32, 34];
        $aligns = ['L', 'L', 'L', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R'];
        $formats = ['text', 'datemonth', 'text', 'text', 'text', 'text', 'num', 'num', 'num', 'num', 'num', 'num', 'num'];

        // Row of totals aligned to the last three columns, above the table.
        $x = $pdf->leftMargin() + array_sum(array_slice($widths, 0, 10));
        $pdf->SetX($x);
        $pdf->Cell($widths[10], 6, $pdf->fmtNum($totalkuranglebih), 0, 0, 'R');
        $pdf->Cell($widths[11], 6, $pdf->fmtNum($totalkomisisupir), 0, 0, 'R');
        $pdf->Cell($widths[12], 6, $pdf->fmtNum($totalkomisikenek), 0, 0, 'R');
        $pdf->Ln(1);

        $pdf->beginTable(
            ['No AJU', 'Tgl', 'Tujuan', 'Party', 'Order', 'Container', 'KAS BON U-JALAN', 'UANG JALAN', 'LIFT OFF/LIFT ON', 'Bongkar,Muat Kawalan,Mel', 'KURANG/LEBIH', 'Komisi Supir', 'Komisi Kenek'],
            $widths,
            $aligns,
            $formats
        );

        foreach ($data as $row) {
            $pdf->tableRow(array_values((array) $row));
        }

        if ($alasanpemotongan !== '') {
            $pdf->tableRow(array_merge(array_fill(0, 10, ''), ['-'.$biayapemotongan, '', '']), true);
        }

        $pdf->footerRow(
            array_merge(['GRAND TOTAL'], array_fill(0, 9, ''), [$totalkuranglebih, $totalkomisisupir, $totalkomisikenek]),
            10
        );

        $pdf->Ln(4);
        $pdf->rincianKomisi($namasupir, $jumlah, $totalkuranglebih, $totalkomisisupir, $totalkomisikenek, $totalkomisi);

        return self::respond(
            $pdf->Output('S'),
            'Laporan Komisi Supir a/n '.$namasupir.' '.$awal.' s.d '.$akhir,
            true
        );
    }

    /**
     * Laporan Buku Besar Keuangan (A4 portrait, fixed non-breaking layout).
     */
    public static function bukuBesar(array $d, string $tanggalawal, string $tanggalakhir): Response
    {
        $pdf = new BukuBesarPdf($d, $tanggalawal, $tanggalakhir);
        $nama = 'Laporan Buku Besar Keuangan '.$tanggalawal.' s.d '.$tanggalakhir;

        return self::respond($pdf->build(), $nama, true);
    }

    /**
     * Laporan Neraca (A4 landscape).
     */
    public static function neraca(array $d, string $tanggalakhir): Response
    {
        $pdf = new NeracaPdf($d, $tanggalakhir);

        return self::respond($pdf->build(), 'Laporan Neraca', true);
    }

    /**
     * Laporan Laba/Rugi Keuangan (A4 portrait).
     */
    public static function rugiLabaKeuangan(array $data, array $totals, string $tanggalakhir): Response
    {
        $pdf = new RugiLabaKeuanganPdf($data, $totals, $tanggalakhir);

        return self::respond($pdf->build(), 'Laporan Rugi/Laba Keuangan', false);
    }

    /**
     * Preprinted kwitansi form (105 x 281 mm landscape).
     */
    public static function kwitansi(array $data): Response
    {
        $pdf = new KwitansiPdf($data);

        return self::respond($pdf->build(), 'kwitansi');
    }

    /**
     * Invoice Trucking (A4 portrait).
     */
    public static function invoiceTrucking(array $data): Response
    {
        $pdf = new InvoiceTruckingPdf($data);
        $head = $data['header']->first();
        $nama = 'Invoice Trucking '.($head->no_invoice ?? 'invoice');

        return self::respond($pdf->build(), $nama, true);
    }

    /**
     * Invoice Kas / bukti kas (A4 portrait).
     */
    public static function invoiceKas(array $data): Response
    {
        $pdf = new InvoiceKasPdf($data);

        return self::respond($pdf->build(), 'invoice-kas');
    }

    /**
     * Standard invoice (A4 portrait, preprinted form).
     */
    public static function invoice(array $data): Response
    {
        $pdf = new InvoicePdf($data);

        return self::respond($pdf->build(), 'invoice');
    }
}
