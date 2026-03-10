<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Tentukan redirect URL berdasarkan role
            $redirectUrl = '/';
            
            if (Auth::user()->isAdmin()) {
                $redirectUrl = route('admin.dashboard');
            } elseif (Auth::user()->isSiswa()) {
                $redirectUrl = route('siswa.dashboard');
            }

            // Return back dengan session untuk menampilkan alert
            return back()->with([
                'login_success' => true,
                'redirect_url' => $redirectUrl,
                'user_name' => Auth::user()->name ?? Auth::user()->username
            ]);
        }

        // Login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}