<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    // Proses login pake USERNAME
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Kalau BENER, masukin session + lempar ke dashboard
        if ($request->username == 'admin' && $request->password == 'admin123') {
            $request->session()->put('is_admin', true);
            return redirect('/admin');
        }

        // Kalau SALAH, baru balik + kasih pesan salah
        return back()->withErrors([
            'username' => 'Username atau password salah!',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}