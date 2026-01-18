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

    public function checkIn(Request $request)
    {
        $user = auth()->user();
        $today = today();
        $now = Carbon::now();

        // Cek apakah sudah check-in hari ini
        $absensi = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        if ($absensi && $absensi->jam_masuk) {
            return redirect()->back()->with('error', 'Anda sudah melakukan check-in hari ini.');
        }

        // Ambil jam kerja aktif
        $jamKerja = JamKerja::where('is_active', true)->first();
        $terlambat = null;

        if ($jamKerja) {
            $jamMasukKerja = Carbon::parse($today->format('Y-m-d') . ' ' . $jamKerja->jam_masuk);
            $jamMasukKerja->addMinutes($jamKerja->toleransi_keterlambatan);

            if ($now->gt($jamMasukKerja)) {
                $terlambat = $now->diffInMinutes($jamMasukKerja->subMinutes($jamKerja->toleransi_keterlambatan));
            }
        }

        if ($absensi) {
            $absensi->update([
                'jam_masuk' => $now->format('H:i:s'),
                'status' => 'hadir',
                'terlambat' => $terlambat,
            ]);
        } else {
            Absensi::create([
                'user_id' => $user->id,
                'tanggal' => $today,
                'jam_masuk' => $now->format('H:i:s'),
                'status' => 'hadir',
                'terlambat' => $terlambat,
            ]);
        }

        return redirect()->back()->with('success', 'Check-in berhasil!');
    }

    public function checkOut(Request $request)
    {
        $user = auth()->user();
        $today = today();
        $now = Carbon::now();

        $absensi = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        if (!$absensi || !$absensi->jam_masuk) {
            return redirect()->back()->with('error', 'Anda belum melakukan check-in hari ini.');
        }

        if ($absensi->jam_pulang) {
            return redirect()->back()->with('error', 'Anda sudah melakukan check-out hari ini.');
        }

        $absensi->update([
            'jam_pulang' => $now->format('H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Check-out berhasil!');
    }

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
