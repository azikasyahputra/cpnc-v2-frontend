<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;
use App\Support\GridTable;
use URL;

class KemasanController extends Controller
{
        public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('kemasan.index');
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('kemasan.create');
    }

    public function save(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::post('kemasan', $request->all());
        return redirect()->route('kemasan');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $payload = ApiClient::get('kemasan/'.$id);
        $kemasan = collect([ (object) ($payload['data'] ?? []) ]);
        return view('kemasan.edit', compact('kemasan'));
    }

    public function saveedit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::put('kemasan/'.$request->input('id_kemasan'), $request->all());
        return redirect()->route('kemasan');
    }

    public function hapus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        ApiClient::delete('kemasan/'.$id);
        return redirect()->route('kemasan');
    }
}
