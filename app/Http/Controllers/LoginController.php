<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Debug: lihat apakah user ditemukan dan password cocok
        if (!$user) {
            return back()->withErrors([
                'username' => 'Username tidak ditemukan.',
            ])->withInput($request->except('password'));
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'username' => 'Password salah.',
            ])->withInput($request->except('password'));
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Debug: pastikan user sudah login
        if (Auth::check()) {
            return redirect()->route('menu')->with('success', 'Login berhasil, selamat datang!');
        } else {
            return back()->withErrors([
                'username' => 'Gagal melakukan login.',
            ])->withInput($request->except('password'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
