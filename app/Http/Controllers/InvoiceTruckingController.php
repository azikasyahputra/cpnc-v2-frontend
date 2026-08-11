<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceTruckingExport;
use Excel;
use PDF;
use Illuminate\Http\Request;
use URL;
use App\Support\ApiClient;

class InvoiceTruckingController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        return view('invoicetrucking.index');
    }

    public function sort($sorting)
    {
        date_default_timezone_set('Asia/Jakarta');

        return view('invoicetrucking.index', ['group' => $sorting]);
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $lookups = ApiClient::get('lookups');
        $d = $lookups['data'];
        $klien = $this->objectList($d['client']);

        return view('invoicetrucking.create', ['klien' => $klien, 'rows' => [], 'namaclient' => '']);
    }

    public function search(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $payload = ApiClient::post('invoicetrucking/search', [
            'no_aju' => $request->input('no_aju'),
            'id_client' => $request->input('id_client'),
        ]);

        $d = $payload['data'] ?? [];
        $rows = $this->objectList($d['data'] ?? []);
        $namaclient = $d['namaclient'] ?? '';

        $lookups = ApiClient::get('lookups');
        $klien = $this->objectList($lookups['data']['client']);

        return view('invoicetrucking.create', [
            'klien' => $klien,
            'rows' => $rows,
            'namaclient' => $namaclient,
            'no_aju' => $request->input('no_aju'),
            'id_client' => $request->input('id_client'),
            'tanggal_invoice' => date('d/m/Y'),
        ]);
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('invoicetrucking', $this->payload($request));

        return redirect()->route('invoicetrucking');
    }

    public function detail($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);

        return view('invoicetrucking.detail', [
            'header' => $data['header'],
            'detail' => $data['detail'],
        ]);
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);
        $lookups = ApiClient::get('lookups');
        $klien = $this->objectList($lookups['data']['client']);

        return view('invoicetrucking.edit', [
            'header' => $data['header'],
            'detail' => $data['detail'],
            'klien' => $klien,
        ]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('invoicetrucking/'.$request->input('id_invoice_trucking'), $this->payload($request));

        return redirect()->route('invoicetrucking');
    }

    public function download($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);

        return PDF::invoiceTrucking($data);
    }

    public function downloadxlsx($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->invoiceData($id);
        $header = $data['header']->first();
        $nama = 'Invoice Trucking '.($header->no_invoice ?? $id);

        return Excel::download(
            new InvoiceTruckingExport($data['header'], $data['detail']),
            str_replace(['/', '\\'], '-', $nama).'.xlsx'
        );
    }

    public function lunas($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('invoicetrucking/'.$id.'/lunas');

        return redirect()->route('invoicetrucking');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('invoicetrucking/'.$id);

        return redirect()->route('invoicetrucking');
    }

    protected function payload(Request $request)
    {
        $detail = [];

        foreach ((array) $request->input('detail', []) as $row) {
            $detail[] = [
                'id_order_trucking' => $row['id_order_trucking'] ?? null,
                'tanggal_order' => $row['tanggal_order'] ?? null,
                'tujuan' => $row['tujuan'] ?? null,
                'party' => $row['party'] ?? null,
                'container' => $row['container'] ?? null,
                'ongkos' => $row['ongkos'] ?? null,
                'uang_bongkar' => $row['uang_bongkar'] ?? null,
                'lift_off' => $row['lift_off'] ?? null,
            ];
        }

        return [
            'id_client' => $request->input('id_client'),
            'no_aju' => $request->input('no_aju'),
            'tanggal_invoice' => $request->input('tanggal_invoice'),
            'detail' => $detail,
        ];
    }

    protected function invoiceData($id)
    {
        $payload = ApiClient::get('invoicetrucking/'.$id);
        $data = $payload['data'];

        return [
            'header' => $this->objectList($data['header']),
            'detail' => $this->objectList($data['detail']),
        ];
    }

    protected function objectList(array $list)
    {
        return collect(array_map(function ($row) {
            return (object) $row;
        }, $list));
    }
}
