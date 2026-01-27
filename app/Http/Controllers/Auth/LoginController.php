<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            return $this->redirectBasedOnRole();
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (!Auth::user()->is_active) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
                ]);
            }

            // Check for pending scan redirect
            if (session()->has('scan_redirect_token')) {
                $token = session()->pull('scan_redirect_token');
                return redirect('/absensi/scan-process/' . $token);
            }

            return $this->redirectBasedOnRole();
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function redirectBasedOnRole()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isGuru()) {
            return redirect()->route('guru.dashboard');
        } elseif ($user->isKaryawan()) {
            return redirect()->route('karyawan.dashboard');
        }

        return redirect()->route('home');
    }
}
