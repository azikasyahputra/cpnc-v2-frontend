<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\ArrayExport;
use App\Support\ApiClient;

class LaporanKeuanganController extends Controller
{
    public function laporanbukubesar(){
        date_default_timezone_set('Asia/Jakarta');
        return view('laporankeuangan.indexlaporanbukubesar');
    }
    public function downloadlaporanbukubesar(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal=$request->input('tanggal_awal');
        $tanggal_akhir=$request->input('tanggal_akhir');
        $download=$request->input('download');
	    $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Buku Besar Keuangan '.str_replace('-','',$tanggal_awal).' s.d '.str_replace('-','',$tanggal_akhir);
        $report = ApiClient::post('reports/buku-besar', ['tanggal_awal' => $tanggalawal, 'tanggal_akhir' => $tanggalakhir]);
        $d = is_array($report) && is_array($report['data'] ?? null) ? $report['data'] : [];
        switch($download){
            case 'Download Excel':
                return Excel::download(new ArrayExport(array_merge([$d['headings'] ?? []], $d['data'] ?? []), $nama, 'Laporan Buku Besar Keuangan'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

            case 'Download PDF':
                [$pdfData, $datatotal] = $this->prepareBukuBesar($d);
                $content = $this->buildBukuBesarFpdf($pdfData, $datatotal, str_replace('-','',$tanggal_awal), str_replace('-','',$tanggal_akhir));

                return response($content, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="'.str_replace(['/', '\\'], '-', $nama).'.pdf"',
                ]);
          break;
        }
    }

    /**
     * Shape buku besar report rows/totals for PDF rendering.
     *
     * @return array{0: array, 1: array}
     */
    protected function prepareBukuBesar(array $d)
    {
        $pdfData = array();
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
            $row['debit']  = $this->toNumber($row['debit'] ?? 0);
            $row['kredit'] = $this->toNumber($row['kredit'] ?? 0);
            $row['saldo']  = $this->toNumber($row['saldo'] ?? 0);
            $pdfData[] = $row;
        }

        $dataTotal = $d['dataTotal'] ?? array();
        $datatotal = array();
        if (isset($dataTotal[3])) {
            $datatotal[] = array(
                $this->toNumber($dataTotal[3]),
                $this->toNumber($dataTotal[4]),
                $this->toNumber($dataTotal[5]),
            );
        }

        return [$pdfData, $datatotal];
    }

    /**
     * Coerce an API value (already-formatted string or number) to a float,
     * so number_format() in the PDF views never receives a non-numeric string.
     *
     * @param  mixed  $value
     * @return float
     */
    protected function toNumber($value)
    {
        if (is_numeric($value)) {
            return (float) $value;
        }

        $digits = preg_replace('/[^\d\-]/', '', (string) $value);

        return (float) ($digits === '' ? 0 : $digits);
    }

    /**
     * Stream the buku besar report as PDF using FPDF (low memory, fast on big tables).
     */
    public function downloadlaporanbukubesarFpdf(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);

        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $nama = 'Laporan Buku Besar Keuangan '.$tanggal_awal.' s.d '.$tanggal_akhir;
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));

        $report = ApiClient::post('reports/buku-besar', ['tanggal_awal' => $tanggalawal, 'tanggal_akhir' => $tanggalakhir]);
        $d = is_array($report) && is_array($report['data'] ?? null) ? $report['data'] : [];
        [$pdfData, $datatotal] = $this->prepareBukuBesar($d);

        $content = $this->buildBukuBesarFpdf($pdfData, $datatotal, str_replace('-','',$tanggal_awal), str_replace('-','',$tanggal_akhir));

        return response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.str_replace(['/', '\\'], '-', $nama).'.pdf"',
        ]);
    }

    /**
     * Render the buku besar report with FPDF.
     *
     * @param  array  $rows       rows shaped by prepareBukuBesar()
     * @param  array  $datatotal  grand-total rows [[debit, kredit, saldo], ...]
     * @return string PDF bytes
     */
    protected function buildBukuBesarFpdf(array $rows, array $datatotal, string $tanggalawal, string $tanggalakhir)
    {
        $pdf = new \Fpdf\Fpdf('P', 'mm', 'A4');
        $pdf->SetMargins(10, 12, 10);
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        $pdf->SetDrawColor(0, 0, 0);

        $this->bukuBesarHeader($pdf, $tanggalawal, $tanggalakhir);
        $this->bukuBesarTableTop($pdf);
        $this->bukuBesarColumns($pdf);

        foreach ($rows as $row) {
            if (($row['tanggal'] ?? '') === 'header') {
                $this->bukuBesarSectionHeader($pdf, $row['kode_referensi'] ?? '');
            } elseif (($row['tanggal'] ?? '') === 'tail') {
                $this->bukuBesarAccountTotal($pdf, $row);
            } else {
                $this->bukuBesarRow($pdf, $row);
            }
        }

        foreach ($datatotal as $total) {
            $this->bukuBesarGrandTotal($pdf, $total);
        }

        $this->bukuBesarTableBottom($pdf);

        return $pdf->Output('S');
    }

    /**
     * Column widths in mm (sums to 190), mirroring the old fixed-layout table:
     * No Referensi 15%, remaining columns split evenly.
     */
    protected function bukuBesarColumnsWidths()
    {
        return [28.5, 26.9, 26.9, 26.9, 26.9, 26.9, 26.9];
    }

    /** Report title inside a bordered box (left 30%), then the centered date line. */
    protected function bukuBesarHeader(\Fpdf\Fpdf $pdf, string $tanggalawal, string $tanggalakhir)
    {
        $boxW = 57;
        $boxH = 12;
        $y = $pdf->GetY();

        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetLineWidth(0.53);
        $pdf->Rect(10, $y, $boxW, $boxH);
        $pdf->SetXY(13, $y + 2.5);
        $pdf->Cell($boxW - 6, 7, 'Laporan Buku Besar Keuangan', 0, 0, 'L');
        $pdf->SetY($y + $boxH + 4);

        $pdf->SetFont('Times', 'B', 9);
        $pdf->Cell(190, 6, 'Tanggal: '.$tanggalawal.'-'.$tanggalakhir, 0, 1, 'C');
        $pdf->Ln(3);
    }

    /** Thick 3px top border of the table, as in the old template. */
    protected function bukuBesarTableTop(\Fpdf\Fpdf $pdf)
    {
        $this->bukuBesarEnsure($pdf, 8);
        $pdf->SetLineWidth(0.8);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(1.5);
    }

    /** Thick 3px bottom border of the table. */
    protected function bukuBesarTableBottom(\Fpdf\Fpdf $pdf)
    {
        $pdf->SetLineWidth(0.8);
        $pdf->Ln(1.5);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    }

    /** Add a page and redraw the table border + column header when there is not enough room. */
    protected function bukuBesarEnsure(\Fpdf\Fpdf $pdf, float $height)
    {
        if ($pdf->GetY() + $height > $pdf->GetPageHeight() - 12) {
            $pdf->AddPage();
            $this->bukuBesarTableTop($pdf);
            $this->bukuBesarColumns($pdf);
        }
    }

    /** Column header text, no borders (matches the old template). */
    protected function bukuBesarColumns(\Fpdf\Fpdf $pdf)
    {
        $headers = ['No Referensi', 'Tanggal', 'No Jurnal', 'Keterangan', 'Debit', 'Kredit', 'Saldo'];
        $widths = $this->bukuBesarColumnsWidths();

        $pdf->SetFont('Times', 'B', 7);

        $x = 10;
        $y = $pdf->GetY();
        foreach ($headers as $i => $label) {
            $align = $i >= 4 ? 'R' : 'L';
            $pdf->SetXY($x, $y);
            $pdf->Cell($widths[$i], 5, $this->pdfText($label), 0, 0, $align);
            $x += $widths[$i];
        }
        $pdf->SetY($y + 5);
    }

    /** Normal data row: no borders, wrapped text. */
    protected function bukuBesarRow(\Fpdf\Fpdf $pdf, array $row)
    {
        $this->bukuBesarMulticellRow($pdf, [
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
    protected function bukuBesarSectionHeader(\Fpdf\Fpdf $pdf, string $kodeReferensi)
    {
        $this->bukuBesarEnsure($pdf, 10);

        $pdf->SetLineWidth(0.26);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->SetY($pdf->GetY() + 1.5);

        $pdf->SetFont('Times', 'B', 7);
        $pdf->Cell(190, 5, $this->pdfText($kodeReferensi), 0, 1, 'L');
        $pdf->Ln(1);
    }

    /** Account total row: bordered, bold. */
    protected function bukuBesarAccountTotal(\Fpdf\Fpdf $pdf, array $row)
    {
        $this->bukuBesarBorderRow($pdf, [
            (string) ($row['kode_referensi'] ?? ''),
            '', '', '',
            number_format($row['debit'], 0, '', '.'),
            number_format($row['kredit'], 0, '', '.'),
            number_format($row['saldo'], 0, '', '.'),
        ], ['L', 'L', 'L', 'L', 'R', 'R', 'R']);
        $pdf->Ln(1);
    }

    /** GRAND TOTAL: thin line above, then a bordered gray row. */
    protected function bukuBesarGrandTotal(\Fpdf\Fpdf $pdf, array $total)
    {
        $this->bukuBesarEnsure($pdf, 10);

        $pdf->SetLineWidth(0.26);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->SetY($pdf->GetY() + 1.5);

        $this->bukuBesarBorderRow($pdf, [
            'GRAND TOTAL', '', '', '',
            number_format($total[0], 0, '', '.'),
            number_format($total[1], 0, '', '.'),
            number_format($total[2], 0, '', '.'),
        ], ['L', 'L', 'L', 'L', 'R', 'R', 'R'], true);
    }

    /**
     * Render a bordered row. The first value spans the first 4 columns
     * (matching the old template's colspan=4), with the amounts on the right.
     */
    protected function bukuBesarBorderRow(\Fpdf\Fpdf $pdf, array $values, array $aligns, bool $fill = false)
    {
        $this->bukuBesarMulticellRow($pdf, $values, $aligns, 4, true, $fill);
    }

    /**
     * Render a multi-line, vertically-centered row. When $span > 1 the first
     * value is drawn across the first $span columns.
     */
    protected function bukuBesarMulticellRow(\Fpdf\Fpdf $pdf, array $values, array $aligns, int $span = 1, bool $bold = false, bool $fill = false)
    {
        $widths = $this->bukuBesarColumnsWidths();
        $pad = 0.8;
        $lineHeight = 3.4;
        $pdf->SetFont('Times', $bold ? 'B' : '', 7);

        $spanW = array_sum(array_slice($widths, 0, $span));

        $lineSets = [];
        $lineSets[0] = $this->pdfTextLines($pdf, $this->pdfText((string) $values[0]), $spanW - 2 * $pad);
        $maxLines = count($lineSets[0]);

        for ($i = $span; $i < count($values); $i++) {
            $w = $widths[$i] - 2 * $pad;
            $lineSets[$i] = $this->pdfTextLines($pdf, $this->pdfText((string) $values[$i]), $w);
            $maxLines = max($maxLines, count($lineSets[$i]));
        }

        $rowHeight = $maxLines * $lineHeight + 2 * $pad;
        $this->bukuBesarEnsure($pdf, $rowHeight + 1);

        if ($fill) {
            $pdf->SetFillColor(211, 211, 211);
        }

        $y = $pdf->GetY();

        if ($span > 1) {
            $this->drawBukuBesarCell($pdf, 10, $y, $spanW, $rowHeight, $lineSets[0], $aligns[0], $pad, $lineHeight, true, $fill);

            $x = 10 + $spanW;
            for ($i = $span; $i < count($values); $i++) {
                $w = $widths[$i];
                $this->drawBukuBesarCell($pdf, $x, $y, $w, $rowHeight, $lineSets[$i], $aligns[$i], $pad, $lineHeight, true, $fill);
                $x += $w;
            }
        } else {
            $x = 10;
            foreach ($values as $i => $value) {
                $w = $widths[$i];
                $this->drawBukuBesarCell($pdf, $x, $y, $w, $rowHeight, $lineSets[$i] ?? [$this->pdfText((string) $value)], $aligns[$i], $pad, $lineHeight, false, false);
                $x += $w;
            }
        }

        $pdf->SetY($y + $rowHeight);
    }

    /** Draw one grid cell: optional 1px border/fill plus vertically-centered wrapped text. */
    protected function drawBukuBesarCell(\Fpdf\Fpdf $pdf, float $x, float $y, float $w, float $h, array $lines, string $align, float $pad, float $lineHeight, bool $bordered, bool $fill)
    {
        if ($bordered) {
            $pdf->SetLineWidth(0.26);
            $pdf->Rect($x, $y, $w, $h, $fill ? 'DF' : 'D');
        }

        $ty = $y + (($h - count($lines) * $lineHeight) / 2);
        foreach ($lines as $i => $line) {
            $pdf->SetXY($x + $pad, $ty + $i * $lineHeight);
            $pdf->Cell($w - 2 * $pad, $lineHeight, $line, 0, 0, $align);
        }
    }

    /** Word-wrap a text to the given width in the current font. */
    protected function pdfTextLines(\Fpdf\Fpdf $pdf, string $text, float $width): array
    {
        $text = trim($text);
        if ($text === '') {
            return [''];
        }

        $lines = [];
        $current = '';

        foreach (explode(' ', $text) as $word) {
            if ($pdf->GetStringWidth($word) > $width) {
                if ($current !== '') {
                    $lines[] = $current;
                    $current = '';
                }
                $chunk = '';
                foreach (str_split($word) as $char) {
                    if ($chunk !== '' && $pdf->GetStringWidth($chunk.$char) > $width) {
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
            if ($pdf->GetStringWidth($candidate) <= $width) {
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
     * Convert a UTF-8 string for FPDF's Latin-1 built-in fonts.
     */
    protected function pdfText(string $value): string
    {
        $converted = @iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $value);

        return $converted === false ? $value : $converted;
    }

    public function laporanneraca(){
        date_default_timezone_set('Asia/Jakarta');
        return view('laporankeuangan.indexlaporanneraca');
    }
    public function downloadlaporanneraca(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal=$request->input('tanggal_awal');
        $tanggal_akhir=$request->input('tanggal_akhir');
        $download=$request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Neraca '.$tanggal_awal.' s.d '.$tanggal_akhir;
        $report = ApiClient::post('reports/neraca', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
        $d = $report['data'] ?? [];
        switch($download){
            case 'Download Excel':
                return Excel::download(new ArrayExport(array_merge([$d['headings']], $d['data']), $nama, 'Laporan Neraca'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

            case 'Download PDF':
                $pdf = PDF::loadView('laporankeuangan.laporanneraca',
                                     ['tanggalawal'=>$tanggal_awal,'tanggalakhir'=>$tanggal_akhir,
                                      'totalkas'=>$d['totalkas'] ?? 0,
                                      'piutang'=>$d['piutang'] ?? 0,
                                      'inventaris'=>$d['inventaris'] ?? 0,
                                      'penambahanaktiva'=>$d['penambahanaktiva'] ?? 0,
                                      'akumulasipenyusutan'=>$d['akumulasipenyusutan'] ?? 0,
                                      'utangusaha'=>$d['utangusaha'] ?? 0,
                                      'utangpajak'=>$d['utangpajak'] ?? 0,
                                      'labarugiberjalan'=>$d['labarugiberjalan'] ?? 0,
                                      'labarugilalu'=>$d['labarugilalu'] ?? 0,
                                      'modaldisetor'=>$d['modaldisetor'] ?? 0,
                                      'jumlahaktiva'=>$d['jumlahaktiva'] ?? 0,
                                      'jumlahkewajiban'=>$d['jumlahkewajiban'] ?? 0,])->setPaper('a4', 'landscape');
                return $pdf->download($nama.'.pdf');
          break;
        }
    }

    public function laporanrugilabakeuangan(){
        date_default_timezone_set('Asia/Jakarta');
        return view('laporankeuangan.indexlaporanrugilabakeuangan');
    }
    public function downloadlaporanrugilabakeuangan(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal=$request->input('tanggal_awal');
        $tanggal_akhir=$request->input('tanggal_akhir');
        $download=$request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Rugi/Laba Keuangan '.$tanggal_awal.' s.d '.$tanggal_akhir;
        $report = ApiClient::post('reports/rugi-laba-keuangan', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
        $d = $report['data'] ?? [];
        switch($download){
            case 'Download Excel':
                return Excel::download(new ArrayExport(array_merge([$d['headings']], $d['data']), $nama, 'Laporan Rugi Laba Keuangan'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

            case 'Download PDF':
                $pdf = PDF::loadView('laporankeuangan.laporanrugilabakeuangan',
                                     ['data'=>$d['dataSemuaBiaya'] ?? array(),'tanggalawal'=>$tanggal_awal,
                                      'tanggalakhir'=>$tanggal_akhir,
				                      'totalpendapatanjasa'=>$d['totalpendapatanjasa'] ?? 0,
                                      'totalpendapatanoperasional'=>$d['totalpendapatanoperasional'] ?? 0,
                                      'totalpendapatantrucking'=>$d['totalpendapatantrucking'] ?? 0,
                                      'totallababruto'=>$d['totallababruto'] ?? 0,
                                      'totalbiaya'=>$d['totalbiaya'] ?? 0,
                                      'labarugineto'=>$d['labarugineto'] ?? 0,
                                      'totalpenghasilanluarusaha'=>$d['totalpenghasilanluarusaha'] ?? 0,
                                      'totalbiayaluarusaha'=>$d['totalbiayaluarusaha'] ?? 0,]);
                return $pdf->stream($nama.'.pdf');
          break;
        }
    }
}
