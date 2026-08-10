<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use URL;
use App\Support\ApiClient;
use App\Support\GridTable;

class InvoiceController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('invoice.index');
    }

    /**
     * Shared invoice grid definition.
     *
     * @param  array  $payload
     * @return string
     */
    protected function renderInvoiceTable(array $payload)
    {
        $columns = [
            [
                'name' => 'no_invoice',
                'label' => 'No.Invoice',
                'width' => '200px',
                'sortable' => true,
                'filter' => 'master_invoice_header.no_invoice',
            ],
            [
                'name' => 'nama_client',
                'label' => 'Nama Klien',
                'sortable' => true,
                'filter' => 'master_client.nama_client',
            ],
            [
                'name' => 'dCreated',
                'label' => 'Tanggal Pembuatan',
                'width' => '220px',
                'sortable' => true,
                'filter' => 'master_invoice_header.dCreated',
            ],
            [
                'name' => 'Action',
                'label' => 'Action',
                'width' => '250px',
                'html' => function ($src) {
                    $lunas = '';
                    $pengeluaran = '';
                    if ($src->flag_bayar == 'Belum') {
                        $lunas = '<a href="'.URL::route('invoicelunas', $src->id_invoice).'" class="btn btn-sm btn-info" title="Lunas"><i class="bx bx-money"></i></a>';
                    }
                    if ($src->flag_pengeluaran == 'Belum') {
                        $pengeluaran = '<a href="'.URL::route('pengeluarancreate', $src->id_invoice).'" class="btn btn-sm btn-success" title="Buat Pengeluaran"><i class="bx bx-plus"></i></a>';
                    }
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="'.URL::route('invoicedetail', $src->id_invoice).'" class="btn btn-sm btn-primary" title="Detail Invoice">'.$icon.'</a>
                            '.$lunas.' '.$pengeluaran.'
                            <a href="'.URL::route('invoiceedit', $src->id_invoice).'" class="btn btn-sm btn-warning" title="Edit Invoice">'.$iconD.'</a>
                            <a href="'.URL::route('invoicehapus', $src->id_invoice).'" class="btn btn-sm btn-danger" title="Hapus Invoice" onclick="return confirm (\'anda akan hapus data?\');">'.$iconX.'</a>
                        </div>';
                },
            ],
        ];

        return GridTable::fromApi($payload, $columns, [
            'name' => 'Invoice',
            'per_page' => 15,
            'default_sort' => ['id_invoice', 'desc'],
        ])->render();
    }
    
        public function sort($sorting)
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('invoice.index', ['group' => $sorting]);
    }
    
    public function detail($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);
       return view('invoice.detail',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'biayadetail'=>$data['biayadetail'],'referensi'=>$data['referensi']]);
    }
    
     public function downloadinvoice($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);
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
        $pdf = PDF::loadView('invoice.invoice',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'biayadetail'=>$data['biayadetail'],'referensi'=>$data['referensi'],'imagedata'=>$imageData]);
        return $pdf->stream();
    }
    
     public function downloadkwitansi($id){
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('invoice/'.$id);
        $data = $payload['data'];

        $biayaMap = [];
        foreach ($data['biaya'] as $row) {
            $biayaMap[$row['id_biaya']] = $row['nama_biaya'];
        }

        $detail = collect($data['detail'])
            ->filter(function ($row) use ($biayaMap) {
                $nama = $biayaMap[$row['id_biaya_detail']] ?? '';
                return stripos($nama, 'PPN') === false;
            })
            ->values()
            ->map(function ($row) use ($biayaMap) {
                $row['nama_biaya'] = $biayaMap[$row['id_biaya_detail']] ?? '';
                return (object) $row;
            });

        $detailcount = $detail->count();
        $header = $this->objectList($data['header']);
        $biaya = $this->objectList($data['biaya']);
        $referensi = $this->objectList($data['referensi']);
        $pdf = PDF::loadView('invoice.kwitansi',['header'=>$header,'detail'=>$detail,'detailcount'=>$detailcount,'biayadetail'=>$biaya,'referensi'=>$referensi])->setPaper([0,0,105,281],'landscape');
        return $pdf->stream();
    }
    
    public function create($id){
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('order/'.$id);
        $order = collect([ (object) ($payload['data'] ?? []) ]);
        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];
        $biaya = $this->objectList($d['biaya']);
        $referensi = $this->objectList($d['referensi']);
       return view('invoice.create',['order'=>$order,'biaya'=>$biaya, 'referensi'=>$referensi]);
    }
    
    public function save(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('invoice', $request->all());
        return redirect()->route('invoice');
    }
    
    public function edit($id){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);
       return view('invoice.edit',['header'=>$data['header'],'detail'=>$data['detail'],'detailcount'=>$data['detailcount'],'biayadetail'=>$data['biayadetail'],'referensi'=>$data['referensi']]);
    }
    
    public function saveedit(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('invoice/'.$request->input('id_invoice'), $request->all());
        return redirect()->route('invoice');
    }

    public function lunas($id){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('invoice/'.$id.'/lunas');
        return redirect()->route('invoice');
    }
    
    public function hapus($id){
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('invoice/'.$id);
        return redirect()->route('invoice');
    }

    /**
     * Fetch an invoice from the API and shape it for the detail/edit views.
     *
     * @param  int  $id
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
