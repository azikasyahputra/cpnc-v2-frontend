<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\ArrayExport;
use App\Support\ApiClient;

class LaporanPiutangController extends Controller
{
    public function laporanpiutang(){
        date_default_timezone_set('Asia/Jakarta');
        return view('laporanpiutang.indexlaporanpiutang');
    }
    public function downloadlaporanpiutang(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal=$request->input('tanggal_awal');
        $tanggal_akhir=$request->input('tanggal_akhir');
        $download=$request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Piutang '.$tanggal_awal.' s.d '.$tanggal_akhir;
        $report = ApiClient::post('reports/piutang', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
        $d = $report['data'] ?? [];
        if(!empty($d['data'])){
            switch($download){
                case 'Download Excel':
                    return Excel::download(new ArrayExport(array_merge([$d['headings']], $d['data']), $nama, 'Laporan Piutang'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

                case 'Download PDF':
                    $pdf = PDF::loadView('laporanpiutang.laporanpiutang',['data'=>$d['data'],'tanggalawal'=>$tanggal_awal,'tanggalakhir'=>$tanggal_akhir])->setPaper('a4', 'portrait');
                    return $pdf->download($nama.'.pdf');
              break;
            }
        }else{
            $request->session()->flash('gagal', 'Data tidak ada pada tanggal yang dipilih');
            return redirect('/laporanpiutang');
        }
    }

    public function laporanorder(){
        date_default_timezone_set('Asia/Jakarta');
        return view('laporanpiutang.indexlaporanorder');
    }
    public function downloadlaporanorder(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal=$request->input('tanggal_awal');
        $tanggal_akhir=$request->input('tanggal_akhir');
        $download=$request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Order '.$tanggal_awal.' s.d '.$tanggal_akhir;
        $report = ApiClient::post('reports/order', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
        $d = $report['data'] ?? [];
        if(count($d['data'] ?? array()) > 1){
            switch($download){
                case 'Download Excel':
                    return Excel::download(new ArrayExport(array_merge([$d['headings']], $d['data']), $nama, 'Laporan Order'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

                case 'Download PDF':
                    $dokumen = array();
                    foreach (($d['dokumen'] ?? array()) as $item) {
                        $dokumen[] = (object) $item;
                    }
                    $pdf = PDF::loadView('laporanpiutang.laporanorder',['data'=>$d['data'],'tanggalawal'=>$tanggal_awal,'tanggalakhir'=>$tanggal_akhir,'header'=>$d['header'] ?? array(),'dokumen'=>$dokumen,'total'=>$d['total'] ?? array()])->setPaper('a4', 'landscape');
                    return $pdf->download($nama.'.pdf');
              break;
            }
        }else{
            $request->session()->flash('gagal', 'Data tidak ada pada tanggal yang dipilih');
            return redirect('/laporanorder');
        }
    }

    public function laporankeseluruhan(){
        date_default_timezone_set('Asia/Jakarta');
        return view('laporanpiutang.indexlaporankeseluruhan');
    }
    public function downloadlaporankeseluruhan(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal=$request->input('tanggal_awal');
        $tanggal_akhir=$request->input('tanggal_akhir');
        $download=$request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Buku Besar '.$tanggal_awal.' s.d '.$tanggal_akhir;
        $report = ApiClient::post('reports/piutang-keseluruhan', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
        $d = $report['data'] ?? [];
        switch($download){
            case 'Download Excel':
                return Excel::download(new ArrayExport(array_merge([$d['headings']], $d['data']), $nama, 'Laporan Buku Besar'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

            case 'Download PDF':
                $pdfData = array();
                foreach ($d['data'] as $row) {
                    if (isset($row['kode_referensi'])) {
                        $pdfData[] = $row;
                    }
                }
                $dataTotal = $d['dataTotal'] ?? array();
                $datatotal = array();
                if (isset($dataTotal[3])) {
                    $datatotal[] = array($dataTotal[3], $dataTotal[4], $dataTotal[5]);
                }
                $pdf = PDF::loadView('laporanpiutang.laporankeseluruhan',['data'=>$pdfData,'tanggalawal'=>$tanggal_awal,'tanggalakhir'=>$tanggal_akhir,'datatotal'=>$datatotal])->setPaper('a4', 'portrait');
                return $pdf->download($nama.'.pdf');
          break;
        }
    }

    public function laporanrugilaba(){
        date_default_timezone_set('Asia/Jakarta');
        return view('laporanpiutang.indexlaporanrugilaba');
    }
    public function downloadlaporanrugilaba(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        set_time_limit(300);
        $tanggal_awal=$request->input('tanggal_awal');
        $tanggal_akhir=$request->input('tanggal_akhir');
        $download=$request->input('download');
        $tanggalawal = date('Y-m-d', strtotime($tanggal_awal));
	    $tanggalakhir = date('Y-m-d', strtotime($tanggal_akhir));
        $nama = 'Laporan Laba Rugi '.$tanggal_awal.' s.d '.$tanggal_akhir;
        $report = ApiClient::post('reports/rugi-laba', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
        $d = $report['data'] ?? [];
        if(!empty($d['data'])){
            switch($download){
                case 'Download Excel':
                    return Excel::download(new ArrayExport(array_merge([$d['headings']], $d['data']), $nama, 'Laporan Laba Rugi'), str_replace(['/', '\\'], '-', $nama).'.xlsx');

                case 'Download PDF':
                    $pdf = PDF::loadView('laporanpiutang.laporanrugilaba',['data'=>$d['data'],'tanggalawal'=>$tanggal_awal,'tanggalakhir'=>$tanggal_akhir])->setPaper('a4', 'portrait');
                    return $pdf->download($nama.'.pdf');
              break;
            }
        }else{
            $request->session()->flash('gagal', 'Data tidak ada pada tanggal yang dipilih');
            return redirect('/laporanrugilaba');
        }
    }
}
