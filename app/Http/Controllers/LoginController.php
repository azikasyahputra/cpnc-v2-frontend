<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ApiClient;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $request->session()->get('id');
        if (!$data) {
            return view('login/login');
        } else {
            return redirect('/dashboard');
        }
    }

    public function checklogin(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        try {
            $result = ApiClient::post('auth/login', [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]);
        } catch (\Throwable $e) {
            return redirect('/');
        }

        if ($result && isset($result['data']['token'])) {
            $token = $result['data']['token'];
            $user = $result['data']['user'];

            $request->session()->put('api_token', $token);
            $request->session()->put('nama', $user['nama']);
            $request->session()->put('username', $user['username']);
            $request->session()->put('id', $user['id']);
            $request->session()->put('role', $user['role']);

            return redirect()->route('dashboard');
        }

        return redirect('/');
    }

    public function dashboard(Request $request)
    {
        $data = $request->session()->get('id');
        if (!$data) {
            return redirect('/');
        }

        date_default_timezone_set('Asia/Jakarta');

        $dashboard = ApiClient::get('dashboard');
        $d = $dashboard['data'] ?? [];

        return view('dashboard/dashboard', [
            'ordertoday' => $d['ordertoday'] ?? 0,
            'ordermonth' => $d['ordermonth'] ?? 0,
            'invoicetoday' => $d['invoicetoday'] ?? 0,
            'invoicemonth' => $d['invoicemonth'] ?? 0,
            'labamonth' => $d['labamonth'] ?? 0,
            'labatoday' => $d['labatoday'] ?? 0,
            'lababrutomonth' => $d['lababrutomonth'] ?? 0,
            'biayamonth' => $d['biayamonth'] ?? 0,
        ]);
    }

    public function logout(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        try {
            ApiClient::post('auth/logout');
        } catch (\Throwable $e) {
            // token may already be invalid — still clear the session
        }
        $request->session()->flush();
        return redirect('/');
    }
}
