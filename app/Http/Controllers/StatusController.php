<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class StatusController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('status.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('status.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::post('status', $request->all());
        return redirect()->route('statusedit', $payload['data']['id']);
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('status/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('status.edit', ['status' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('status/' . $request->input('id_status'), $request->all());
        return redirect()->route('statusedit', $request->input('id_status'));
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('status/' . $id);
        return redirect()->route('status');
    }
}