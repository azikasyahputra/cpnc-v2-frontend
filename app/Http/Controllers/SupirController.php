<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class SupirController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('supir.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('supir.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('supir', $request->all());
        return redirect()->route('supir');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('supir/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('supir.edit', ['supir' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('supir/' . $request->input('id_supir'), $request->all());
        return redirect()->route('supir');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('supir/' . $id);
        return redirect()->route('supir');
    }
}