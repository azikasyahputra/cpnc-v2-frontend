<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class BiayaController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('biaya.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('biaya.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::post('biaya', $request->all());
        return redirect()->route('biayaedit', $payload['data']['id']);
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('biaya/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('biaya.edit', ['biaya' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('biaya/' . $request->input('id_biaya'), $request->all());
        return redirect()->route('biayaedit', $request->input('id_biaya'));
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('biaya/' . $id);
        return redirect()->route('biaya');
    }
}