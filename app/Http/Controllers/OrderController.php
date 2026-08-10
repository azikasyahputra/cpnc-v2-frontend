<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use App\Support\ApiClient;
use App\Support\GridTable;

class OrderController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('order.index');
    }

    /**
     * Shared order grid columns.
     *
     * @return array
     */
    protected function orderColumns()
    {
        return [
            [
                'name' => 'id_order',
                'label' => 'ID',
                'width' => '10px',
                'sortable' => true,
                'filter' => 'master_order.id_order',
            ],
            [
                'name' => 'no_order',
                'label' => 'No.Order',
                'sortable' => true,
                'filter' => 'master_order.no_order',
            ],
            [
                'name' => 'nama_client',
                'label' => 'Nama Klien',
                'sortable' => true,
                'filter' => 'master_client.nama_client',
            ],
            [
                'name' => 'nama_dokumen',
                'label' => 'Jenis',
                'width' => '100px',
                'sortable' => true,
                'filter' => 'master_jenis_dokumen.nama_dokumen',
            ],
            [
                'name' => 'tanggal_order',
                'label' => 'Tanggal',
                'width' => '120px',
                'sortable' => true,
                'filter' => 'master_order.tanggal_order',
            ],
            [
                'name' => 'flag_invoice',
                'label' => 'Invoice',
                'width' => '100px',
                'sortable' => true,
                'filter' => 'master_order.flag_invoice',
            ],
            [
                'name' => 'Action',
                'label' => 'Action',
                'width' => '200px',
                'html' => function ($src) {
                    $buatinvoice = '';
                    if ($src->flag_invoice == 'Belum') {
                        $buatinvoice = '<a href="'.URL::route('invoicecreate', $src->id_order).'" class="btn btn-sm btn-success" title="Buat Invoice"><i class="bx bx-plus"></i></a>';
                    }
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="'.URL::route('orderdetail', $src->id_order).'" class="btn btn-sm btn-primary" title="Detail Order">'.$icon.'</a>
                            '.$buatinvoice.'
                            <a href="'.URL::route('orderedit', $src->id_order).'" class="btn btn-sm btn-warning" title="Edit Order">'.$iconD.'</a>
                            <a href="'.URL::route('orderhapus', $src->id_order).'" class="btn btn-sm btn-danger" title="Hapus Order" onclick="return confirm (\'anda akan hapus data?\');">'.$iconX.'</a>
                        </div>';
                },
            ],
        ];
    }

    /**
     * Shared order grid options.
     *
     * @return array
     */
    protected function orderOptions()
    {
        return [
            'name' => 'Order',
            'per_page' => 15,
            'default_sort' => ['id_order', 'desc'],
            'add_button' => ['label' => 'Tambah Order', 'url' => route('ordercreate')],
        ];
    }

        public function sort($sort)
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('order.index', ['group' => $sort]);
    }
    
    public function detail($id){
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('order/'.$id);
        $order = collect([ (object) ($payload['data'] ?? []) ]);
        return view('order.detail',['order'=>$order]);
    }
    
    public function create(){
        date_default_timezone_set('Asia/Jakarta');
        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];
        $klien = $this->objectList($d['client']);
        $jenisdokumen = $this->objectList($d['jenisdokumen']);
        $pelayaran = $this->objectList($d['pelayaran']);
        $gudang = $this->objectList($d['gudang']);
        $lapangan = $this->objectList($d['lapangan']);
        $status = $this->objectList($d['status']);
        $kosongan = $this->objectList($d['kosongan']);
        return view('order.create',['klien'=>$klien,'jenisdokumen'=>$jenisdokumen,
                                    'pelayaran'=>$pelayaran,'gudang'=>$gudang,'lapangan'=>$lapangan,
                                    'status'=>$status,'kosongan'=>$kosongan]);
    }
    
    public function save(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('order', $request->all());
        return redirect()->route('order');
    }
    
    public function edit($id){
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('order/'.$id);
        $order = collect([ (object) ($payload['data'] ?? []) ]);
        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];
        $klien = $this->objectList($d['client']);
        $jenisdokumen = $this->objectList($d['jenisdokumen']);
        $pelayaran = $this->objectList($d['pelayaran']);
        $gudang = $this->objectList($d['gudang']);
        $lapangan = $this->objectList($d['lapangan']);
        $status = $this->objectList($d['status']);
        $kosongan = $this->objectList($d['kosongan']);
        return view('order.edit',['order'=>$order,'klien'=>$klien,'jenisdokumen'=>$jenisdokumen,
                                    'pelayaran'=>$pelayaran,'gudang'=>$gudang,'lapangan'=>$lapangan,
                                    'status'=>$status,'kosongan'=>$kosongan]);
    }
    
    public function saveedit(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('order/'.$request->input('id_order'), $request->all());
        return redirect()->route('order');
    }
    
    public function hapus($id){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('order/'.$id);
        return redirect()->route('order');
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
