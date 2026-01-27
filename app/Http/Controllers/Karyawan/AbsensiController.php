<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\JamKerja;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = today();

        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        $jamKerja = JamKerja::where('is_active', true)->first();

        return view('karyawan.absensi.index', compact('absensiHariIni', 'jamKerja'));
    }

    // Manual CheckIn/CheckOut Removed - Replaced by AbsensiScanController using QR Code


    public function ajukanIzin(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'status' => 'required|in:izin,sakit',
            'keterangan' => 'required|string|max:500',
        ]);

        $user = auth()->user();
        $tanggal = Carbon::parse($request->tanggal);

        // Cek apakah sudah ada absensi di tanggal tersebut
        $absensi = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $tanggal)
            ->first();

        if ($absensi) {
            // Jika sudah ada, update statusnya
            $absensi->update([
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);
        } else {
            // Jika belum ada, buat baru
            Absensi::create([
                'user_id' => $user->id,
                'tanggal' => $tanggal,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);
        }

        return redirect()->back()->with('success', 'Pengajuan ' . ucfirst($request->status) . ' berhasil diajukan!');
    }

    public function riwayat(Request $request)
    {
        $user = auth()->user();
        $query = Absensi::where('user_id', $user->id)->orderBy('tanggal', 'desc');

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $riwayat = $query->paginate(15);

        return view('karyawan.absensi.riwayat', compact('riwayat'));
    }
}
