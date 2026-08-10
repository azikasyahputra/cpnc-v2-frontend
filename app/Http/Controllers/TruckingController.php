<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use App\Support\ApiClient;
use App\Support\GridTable;

class TruckingController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('trucking.index');
    }

    /**
     * Shared order-trucking grid definition.
     *
     * @param  array  $payload
     * @return string
     */
    protected function renderTruckingTable(array $payload)
    {
        $columns = [
            [
                'name' => 'no_invoice',
                'label' => 'ID',
                'width' => '150px',
                'sortable' => true,
                'filter' => 'master_order_trucking.no_invoice',
            ],
            [
                'name' => 'nama_client',
                'label' => 'Nama Klien',
                'sortable' => true,
                'filter' => 'master_client.nama_client',
            ],
            [
                'name' => 'tanggal_order',
                'label' => 'Tanggal',
                'width' => '120px',
                'sortable' => true,
                'filter' => 'master_order_trucking.tanggal_order',
            ],
            [
                'name' => 'flag_pengeluaran',
                'label' => 'Uang Jalan',
                'width' => '120px',
                'sortable' => true,
                'filter' => 'master_order_trucking.flag_pengeluaran',
            ],
            [
                'name' => 'flag_bayar',
                'label' => 'Lunas',
                'width' => '120px',
                'sortable' => true,
                'filter' => 'master_order_trucking.flag_bayar',
            ],
            [
                'name' => 'Action',
                'label' => 'Action',
                'width' => '220px',
                'html' => function ($src) {
                    $lunas = '';
                    $belumlunas = '';
                    if ($src->flag_bayar == 'Belum') {
                        $lunas = '<a href="'.URL::route('truckinglunas', $src->id_order_trucking).'" class="btn btn-sm btn-info" title="Lunas"><i class="bx bx-money"></i></a>';
                    }
                    if ($src->flag_pengeluaran == 'Belum') {
                        $belumlunas = '<a href="'.URL::route('truckingkasbonjalan', $src->id_order_trucking).'" class="btn btn-sm btn-success" title="Buat Pengeluaran"><i class="bx bx-plus"></i></a>';
                    }
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="'.URL::route('truckingdetail', $src->id_order_trucking).'" class="btn btn-sm btn-primary" title="Detail Order Trucking">'.$icon.'</a>
                            '.$lunas.' '.$belumlunas.'
                            <a href="'.URL::route('truckingedit', $src->id_order_trucking).'" class="btn btn-sm btn-warning" title="Edit Order Trucking">'.$iconD.'</a>
                            <a href="'.URL::route('truckinghapus', $src->id_order_trucking).'" class="btn btn-sm btn-danger" title="Hapus Order" onclick="return confirm (\'anda akan hapus data?\');">'.$iconX.'</a>
                        </div>';
                },
            ],
        ];

        return GridTable::fromApi($payload, $columns, [
            'name' => 'Ordertrucking',
            'per_page' => 15,
            'default_sort' => ['id_order_trucking', 'desc'],
            'add_button' => ['label' => 'Tambah Order Trucking', 'url' => route('truckingcreate')],
        ])->render();
    }
    
        public function sort($sort)
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('trucking.index', ['group' => $sort]);
    }
    
    public function detail($id){
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('trucking/'.$id);
        $trucking = collect([ (object) ($payload['data'] ?? []) ]);
         return view('trucking.detail',['trucking'=>$trucking]);
    }
    
    public function kasbonjalan($id){
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('trucking/'.$id);
        $trucking = collect([ (object) ($payload['data'] ?? []) ]);
        return view('trucking.uangkasbonjalan',['trucking'=>$trucking]);
    }
    
    public function saveeditkasbonjalan(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('trucking/'.$request->input('id_order_trucking').'/savekasbonjalan', $request->all());
        return redirect()->route('trucking');
    }
    
    public function create(){
        date_default_timezone_set('Asia/Jakarta');
        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];
        $klien = $this->objectList($d['client']);
        $supir = $this->objectList($d['supir']);
        return view('trucking.create',['klien'=>$klien,'supir'=>$supir]);
    }
    
    public function save(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('trucking', $request->all());
        return redirect()->route('trucking');
    }
    
    public function edit($id){
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('trucking/'.$id);
        $trucking = collect([ (object) ($payload['data'] ?? []) ]);
        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];
        $klien = $this->objectList($d['client']);
        $supir = $this->objectList($d['supir']);
        return view('trucking.edit',['trucking'=>$trucking,'klien'=>$klien,'supir'=>$supir]);
    }
    
    public function saveedit(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('trucking/'.$request->input('id_order_trucking'), $request->all());
        return redirect()->route('trucking');
    }
    
    public function lunas($id){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('trucking/'.$id.'/lunas');
        return redirect()->route('trucking');
    }
    
    public function hapus($id){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('trucking/'.$id);
        return redirect()->route('trucking');
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
