<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use App\Support\ApiClient;
use App\Support\GridTable;
use PDF;

class BukuKasController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('bukukas.index');
    }
    
    public function createkas(){
        date_default_timezone_set('Asia/Jakarta');
        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];
        $referensi = $this->objectList($d['referensi']);
        return view('bukukas.create',['referensi'=>$referensi]);
    }
    
    public function save(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('kas', $request->all());
        return redirect()->route('kas');
    }
    
    public function detail($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->kasData($id);
       return view('bukukas.detail',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'referensi'=>$data['referensi']]);
    }
    
    public function downloadinvoice($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->kasData($id);
        $avatarUrl = public_path('/assets/images/img.png');
        $arrContextOptions=array(
                        "ssl"=>array(
                            "verify_peer"=>false,
                            "verify_peer_name"=>false,
                        ),
                    );
        $type = pathinfo($avatarUrl, PATHINFO_EXTENSION);
        $avatarData = file_get_contents($avatarUrl, false, stream_context_create($arrContextOptions));
        $avatarBase64Data = base64_encode($avatarData);
        $imageData = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
        $pdf = PDF::loadView('bukukas.invoicekas',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'referensi'=>$data['referensi'],'imagedata'=>$imageData]);
        return $pdf->stream();
    }
    
    public function edit($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->kasData($id);
       return view('bukukas.edit',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'referensi'=>$data['referensi']]);
    
    }
    
    public function saveedit(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('kas/'.$request->input('id_kas'), $request->all());
        return redirect()->route('kas');
    }
    
    public function hapus($id){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('kas/'.$id);
        return redirect()->route('kas');
    }

    /**
     * Shape a buku kas API payload for the detail/edit/download views.
     *
     * @param  int  $id
     * @return array
     */
    protected function kasData($id)
    {
        $payload = ApiClient::get('kas/'.$id);
        $data = $payload['data'];

        return [
            'header' => $this->objectList($data['header']),
            'detail' => $this->objectList($data['detail']),
            'detailcount' => count($data['detail']),
            'referensi' => $this->objectList($data['referensi']),
        ];
    }

    /**
     * Convert a list of associative arrays to a collection of objects.
     *
     * @param  array  $list
     * @return \Illuminate\Support\Collection
     */
    protected function objectList(array $list)
    {
        return collect(array_map(function ($row) {
            return (object) $row;
        }, $list));
    }
}
