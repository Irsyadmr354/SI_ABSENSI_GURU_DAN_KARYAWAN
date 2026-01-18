<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = today();

        // Status absensi hari ini
        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        // Riwayat absensi (5 terakhir)
        $riwayatAbsensi = Absensi::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('guru.dashboard.index', compact('absensiHariIni', 'riwayatAbsensi'));
    }
}
