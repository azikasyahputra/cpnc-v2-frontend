<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class PelayaranController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('pelayaran.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('pelayaran.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('pelayaran', $request->all());
        return redirect()->route('pelayaran');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('pelayaran/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('pelayaran.edit', ['pelayaran' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('pelayaran/' . $request->input('id_pelayaran'), $request->all());
        return redirect()->route('pelayaran');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('pelayaran/' . $id);
        return redirect()->route('pelayaran');
    }
}