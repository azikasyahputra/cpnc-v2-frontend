<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class DaftarReferensiController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('daftarreferensi.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('daftarreferensi.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('referensi', $request->all());
        return redirect()->route('daftarreferensi');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('referensi/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('daftarreferensi.edit', ['daftarreferensi' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('referensi/' . $request->input('id_referensi'), $request->all());
        return redirect()->route('daftarreferensi');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('referensi/' . $id);
        return redirect()->route('daftarreferensi');
    }
}