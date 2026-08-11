<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use URL;

class UserController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('user.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $roles = $this->roleList();
        return view('user.create', ['roles' => $roles]);
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::post('user', $request->all());
        return redirect()->route('useredit', $payload['data']['id']);
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('user/' . $id);
        $row = collect([ (object) ($payload['data'] ?? []) ]);
        $roles = $this->roleList();
        return view('user.edit', ['user' => $row, 'roles' => $roles]);
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('user/' . $request->input('id_user'), $request->all());
        return redirect()->route('useredit', $request->input('id_user'));
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('user/' . $id);
        return redirect()->route('user');
    }

    protected function roleList()
    {
        $payload = ApiClient::get('role');
        return collect(array_map(function ($row) {
            return (object) $row;
        }, $payload['data'] ?? []));
    }
}
