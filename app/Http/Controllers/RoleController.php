<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use URL;

class RoleController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('role.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('role.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::post('role', $request->all());
        return redirect()->route('roleedit', $payload['data']['id']);
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('role/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        return view('role.edit', ['role' => $row]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('role/' . $request->input('id_role'), $request->all());
        return redirect()->route('roleedit', $request->input('id_role'));
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('role/' . $id);
        return redirect()->route('role');
    }
}
