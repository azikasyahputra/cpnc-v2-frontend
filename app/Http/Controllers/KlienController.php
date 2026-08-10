<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class KlienController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('klien.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('klien.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('klien', $request->all());
        return redirect()->route('klien');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('klien/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('klien.edit', ['klien' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('klien/' . $request->input('id_client'), $request->all());
        return redirect()->route('klien');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('klien/' . $id);
        return redirect()->route('klien');
    }
}