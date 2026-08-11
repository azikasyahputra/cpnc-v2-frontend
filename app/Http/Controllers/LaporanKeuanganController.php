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
                return PDF::bukuBesar($d, $tanggal_awal, $tanggal_akhir);
          break;
        }
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
                return PDF::neraca($d, $tanggalakhir);
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
                return PDF::rugiLabaKeuangan($d['dataSemuaBiaya'] ?? array(), $d, $tanggalakhir);
          break;
        }
    }
}
