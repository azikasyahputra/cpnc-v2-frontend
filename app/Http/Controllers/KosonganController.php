<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class KosonganController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('kosongan.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('kosongan.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('kosongan', $request->all());
        return redirect()->route('kosongan');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('kosongan/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('kosongan.edit', ['kosongan' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('kosongan/' . $request->input('id_kosongan'), $request->all());
        return redirect()->route('kosongan');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('kosongan/' . $id);
        return redirect()->route('kosongan');
    }
}