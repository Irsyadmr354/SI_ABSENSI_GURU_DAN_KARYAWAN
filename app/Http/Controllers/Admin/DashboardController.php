<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru = Guru::count();
        $totalKaryawan = Karyawan::count();
        $totalAbsensiHariIni = Absensi::whereDate('tanggal', today())->count();

        // Data untuk grafik harian (30 hari terakhir)
        $absenHarian = [];
        for ($i = 29; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
            $count = Absensi::whereDate('tanggal', $tanggal)->count();
            $absenHarian[] = [
                'tanggal' => $tanggal->format('Y-m-d'),
                'label' => $tanggal->format('d M'),
                'count' => $count,
            ];
        }

        // Data untuk grafik bulanan (12 bulan terakhir)
        $absenBulanan = [];
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $count = Absensi::whereYear('tanggal', $bulan->year)
                ->whereMonth('tanggal', $bulan->month)
                ->count();
            $absenBulanan[] = [
                'bulan' => $bulan->format('Y-m'),
                'label' => $bulan->format('M Y'),
                'count' => $count,
            ];
        }

        return view('admin.dashboard.index', compact(
            'totalGuru',
            'totalKaryawan',
            'totalAbsensiHariIni',
            'absenHarian',
            'absenBulanan'
        ));
    }
}
