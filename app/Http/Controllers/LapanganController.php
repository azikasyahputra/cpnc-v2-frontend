<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class LapanganController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('lapangan.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('lapangan.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::post('lapangan', $request->all());
        return redirect()->route('lapanganedit', $payload['data']['id']);
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('lapangan/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('lapangan.edit', ['lapangan' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('lapangan/' . $request->input('id_lapangan'), $request->all());
        return redirect()->route('lapanganedit', $request->input('id_lapangan'));
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('lapangan/' . $id);
        return redirect()->route('lapangan');
    }
}