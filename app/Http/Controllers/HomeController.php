<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isGuru()) {
                return redirect()->route('guru.dashboard');
            } elseif ($user->isKaryawan()) {
                return redirect()->route('karyawan.dashboard');
            }
        }

        // Redirect ke login jika belum login
        return redirect()->route('login');
    }
}
