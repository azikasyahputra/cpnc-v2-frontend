<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use App\Support\ApiClient;
use App\Support\GridTable;

class PengeluaranController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('pengeluaran.index');
    }
    
    public function create($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);
       return view('pengeluaran.create',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'biayadetail'=>$data['biayadetail'],'referensi'=>$data['referensi']]);
    }
    
    public function save(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('pengeluaran', $request->all());
        return redirect()->route('pengeluaran');
    }
    
    public function detail($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->pengeluaranData($id);
       return view('pengeluaran.detail',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'biayadetail'=>$data['biayadetail'],'referensi'=>$data['referensi']]);
    }
    
    public function edit($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->pengeluaranData($id);
       return view('pengeluaran.edit',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'biayadetail'=>$data['biayadetail'],'referensi'=>$data['referensi']]);
    }
    
    public function saveedit(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('pengeluaran/'.$request->input('id_pengeluaran'), $request->all());
        return redirect()->route('pengeluaran');
    }
    
    public function hapus($id){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('pengeluaran/'.$id);
        return redirect()->route('pengeluaran');
    }

    /**
     * Shape an invoice API payload for the pengeluaran create view.
     *
     * @param  int  $id  invoice id
     * @return array
     */
    protected function invoiceData($id)
    {
        $payload = ApiClient::get('invoice/'.$id);
        $data = $payload['data'];

        return [
            'header' => $this->objectList($data['header']),
            'detail' => $this->objectList($data['detail']),
            'detailcount' => count($data['detail']),
            'biayadetail' => $this->objectList($data['biaya']),
            'referensi' => $this->objectList($data['referensi']),
        ];
    }

    /**
     * Shape a pengeluaran API payload for the detail/edit views.
     *
     * @param  int  $id
     * @return array
     */
    protected function pengeluaranData($id)
    {
        $payload = ApiClient::get('pengeluaran/'.$id);
        $data = $payload['data'];

        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];

        return [
            'header' => $this->objectList($data['header']),
            'detail' => $this->objectList($data['detail']),
            'detailcount' => count($data['detail']),
            'biayadetail' => $this->objectList($data['biaya']),
            'referensi' => $this->objectList($d['referensi']),
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
