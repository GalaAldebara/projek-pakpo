<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login'); // arahkan ke resources/views/auth/login.blade.php
    }

    /**
     * Proses login menggunakan employee_id dan password
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'password' => 'required|string|min:6',
        ]);

        // Cari user berdasarkan employee_id
        $user = User::where('employee_id', $request->employee_id)->first();

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            return redirect()->intended('/dashboard')
                ->with('success', 'Login berhasil, selamat datang!');
        }

        // Jika gagal
        return back()->withErrors([
            'employee_id' => 'Employee ID atau password salah.',
        ])->withInput();
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
