<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\ArrayExport;
use App\Support\ApiClient;

class LaporanTruckingController extends Controller
{
    public function laporanpiutang()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('laporantrucking.indexlaporanpiutang');
    }
    public function downloadlaporanpiutang(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $download = $request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
        $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Piutang ' . $tanggal_awal . ' s.d ' . $tanggal_akhir;
        $report = ApiClient::post('reports/trucking/piutang', ['tanggal_awal' => $tanggalawal, 'tanggal_akhir' => $tanggalakhir]);
        $d = $report['data'] ?? [];
        if (!empty($d['data'])) {
            switch ($download) {
                case 'Download Excel':
                    return Excel::download(new ArrayExport(array_merge([$d['headings']], $d['data']), $nama, 'Laporan Piutang'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

                case 'Download PDF':
                    return PDF::truckingPiutang($d['data'], $tanggal_awal, $tanggal_akhir);
                    break;
            }
        } else {
            $request->session()->flash('gagal', 'Data tidak ada pada tanggal yang dipilih');
            return redirect('/laporanpiutangtrucking');
        }
    }

    public function laporantagihanklien()
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('lookups');
        $klien = array_map(function ($item) { return (object) $item; }, $payload['data']['client'] ?? array());
        return view('laporantrucking.indexlaporantagihanklien', ['klien' => $klien]);
    }
    public function downloadlaporantagihanklien(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $invoicetagihan = $request->input('invoice_tagihan');
        $id_client = $request->input('id_client');
        $download = $request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
        $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $report = ApiClient::post('reports/trucking/tagihan-klien', ['tanggal_awal' => $tanggalawal, 'tanggal_akhir' => $tanggalakhir, 'id_client' => $id_client]);
        $d = $report['data'] ?? [];
        $namaclient = $d['namaclient'] ?? '';
        $nama = 'Laporan Tagihan ' . $namaclient . ' ' . $tanggal_awal . ' s.d ' . $tanggal_akhir;
        if (count($d['data'] ?? array()) > 1) {
            switch ($download) {
                case 'Download Excel':
                    $headings1 = array(' ', 'PT.CAHYAPRAJA NUSACERIA', ' ', ' ', ' ', ' ', 'INVOICE No.', $invoicetagihan, ' ', ' ');
                    $headings2 = array(' ', 'Telp:4358506 Fax:4358652', ' ', ' ', ' ', ' ', $namaclient, ' ', ' ', ' ');
                    return Excel::download(new ArrayExport(array_merge([$headings1], [$headings2], [$d['headings']], $d['data']), $nama, 'Laporan Piutang'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

                case 'Download PDF':
                    $pdfData = array();
                    foreach ($d['data'] as $row) {
                        if (count($row) >= 10) {
                            $pdfData[] = $row;
                        }
                    }
                    $noinvoice = $invoicetagihan;
                    return PDF::tagihanKlien($pdfData, $tanggal_awal, $tanggal_akhir, $noinvoice, $namaclient, $d['totalsemua'] ?? 0);
                    break;
            }
        } else {
            $request->session()->flash('gagal', 'Data tidak ada pada tanggal yang dipilih');
            return redirect('/laporantagihanklien');
        }
    }

    public function laporanrugilabatrucking()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('laporantrucking.indexlaporanrugilaba');
    }
    public function downloadlaporanrugilabatrucking(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $download = $request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
        $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Rugi/Laba Trucking ' . $tanggal_awal . ' s.d ' . $tanggal_akhir;
        $report = ApiClient::post('reports/trucking/rugi-laba', ['tanggal_awal' => $tanggalawal, 'tanggal_akhir' => $tanggalakhir]);
        $d = $report['data'] ?? [];
        if (count($d['data'] ?? array()) > 1) {
            switch ($download) {
                case 'Download Excel':
                    $headings1 = array(' ', 'PT.CAHYAPRAJA NUSACERIA', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ');
                    $headings2 = array(' ', 'Telp:4358506 Fax:4358652', ' ', ' ', ' ', ' ', '', ' ', ' ', ' ', ' ');
                    return Excel::download(new ArrayExport(array_merge([$headings1], [$headings2], [$d['headings']], $d['data']), $nama, 'Laporan Rugi Laba Trucking'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

                case 'Download PDF':
                    $pdfData = array();
                    foreach ($d['data'] as $row) {
                        if (count($row) < 12) {
                            continue;
                        }
                        $pdfData[] = array($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[0]);
                    }
                    return PDF::truckingRugiLaba($pdfData, $tanggal_awal, $tanggal_akhir, $d['totalsemua'] ?? 0);
                    break;
            }
        } else {
            $request->session()->flash('gagal', 'Data tidak ada pada tanggal yang dipilih');
            return redirect('/laporanrugilabatrucking');
        }
    }

    public function laporankomisisupir()
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('lookups');
        $supir = array_map(function ($item) { return (object) $item; }, $payload['data']['supir'] ?? array());
        return view('laporantrucking.indexlaporankomisisupir', ['supir' => $supir]);
    }
    public function downloadlaporankomisisupir(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $alasanpemotongan = $request->input('alasan_pemotongan');
        $biayapemotongan = $request->input('biaya_pemotongan');
        $idsupir = $request->input('id_supir');
        $download = $request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
        $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $report = ApiClient::post('reports/trucking/komisi-supir', ['tanggal_awal' => $tanggalawal, 'tanggal_akhir' => $tanggalakhir, 'id_supir' => $idsupir]);
        $d = $report['data'] ?? [];
        $namasupir = $d['namasupir'] ?? '';
        $nama = 'Laporan Komisi Supir a/n ' . $namasupir . ' ' . $tanggal_awal . ' s.d ' . $tanggal_akhir;
        $jumlah = $d['jumlah'] ?? 0;
        $totalkuranglebih = $d['totalkuranglebih'] ?? 0;
        $totalkomisisupir = $d['totalkomisisupir'] ?? 0;
        $totalkomisikenek = $d['totalkomisikenek'] ?? 0;
        $totalkomisi = $d['totalkomisi'] ?? 0;
        if ($jumlah > 0) {
            switch ($download) {
                case 'Download Excel':
                    $dataArray = $d['data'];
                    if ($alasanpemotongan != '' && $biayapemotongan != '') {
                        $pemotongan = array(' ', ' ', $alasanpemotongan, ' ', ' ', ' ', ' ', ' ', ' ', ' ', '-' . $biayapemotongan, ' ', ' ');
                        $idx = count($dataArray) - 9;
                        if ($idx >= 0) {
                            array_splice($dataArray, $idx, 0, array($pemotongan));
                            $dataArray[$idx + 7][1] = $dataArray[$idx + 7][1] - $biayapemotongan;
                            $dataArray[$idx + 9][1] = $dataArray[$idx + 9][1] - $biayapemotongan;
                        }
                    }
                    return Excel::download(new ArrayExport(array_merge([$d['headings3']], [$d['headings']], $dataArray), $nama, 'Laporan Komisi Supir'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

                case 'Download PDF':
                    if ($biayapemotongan != '') {
                        $totalkuranglebih = $totalkuranglebih - $biayapemotongan;
                        if ($totalkuranglebih < 0) {
                            $totalkomisi = $totalkomisisupir + $totalkomisikenek + abs($totalkuranglebih);
                        } else if ($totalkuranglebih > 0) {
                            $totalkomisi = $totalkomisisupir + $totalkomisikenek - $totalkuranglebih;
                        }
                    }
                    $pdfData = count($d['data']) > 9 ? array_slice($d['data'], 0, count($d['data']) - 9) : $d['data'];
                    return PDF::komisiSupir($pdfData, $tanggal_awal, $tanggal_akhir, $namasupir, $jumlah, $totalkuranglebih, $totalkomisisupir, $totalkomisikenek, $totalkomisi, $alasanpemotongan, $biayapemotongan);
                    break;
            }
        } else {
            $request->session()->flash('gagal', 'Data tidak ada pada tanggal yang dipilih');
            return redirect('/laporankomisisupir');
        }
    }
}
