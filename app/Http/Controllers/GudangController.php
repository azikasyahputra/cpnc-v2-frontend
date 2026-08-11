<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class GudangController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('gudang.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('gudang.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::post('gudang', $request->all());
        return redirect()->route('gudangedit', $payload['data']['id']);
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('gudang/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('gudang.edit', ['gudang' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('gudang/' . $request->input('id_gudang'), $request->all());
        return redirect()->route('gudangedit', $request->input('id_gudang'));
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('gudang/' . $id);
        return redirect()->route('gudang');
    }
}