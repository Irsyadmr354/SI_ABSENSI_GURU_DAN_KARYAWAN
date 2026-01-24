<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (auth()->check()) {
            return $this->redirectBasedOnRole();
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => 'required|in:guru,karyawan',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => false, // Default nonaktif, harus diaktifkan admin
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Akun Anda sedang menunggu persetujuan administrator.');
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
