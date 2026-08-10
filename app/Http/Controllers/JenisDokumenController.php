<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class JenisDokumenController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('jenisdokumen.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('jenisdokumen.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('jenisdokumen', $request->all());
        return redirect()->route('jenisdokumen');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('jenisdokumen/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('jenisdokumen.edit', ['jenisdokumen' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('jenisdokumen/' . $request->input('id_jenis_dokumen'), $request->all());
        return redirect()->route('jenisdokumen');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('jenisdokumen/' . $id);
        return redirect()->route('jenisdokumen');
    }
}