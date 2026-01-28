<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with('user');

        // Filter tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Filter nama
        if ($request->filled('nama')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama . '%');
            });
        }

        // Filter role
        if ($request->filled('role')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        $absensi = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.absensi.index', compact('absensi'));
    }

    public function exportPdf(Request $request)
    {
        // TODO: Implement PDF export using DomPDF
        // This is a placeholder - actual implementation requires DomPDF package
        return redirect()->back()->with('info', 'Fitur export PDF akan segera tersedia.');
    }

    public function exportExcel(Request $request)
    {
        // TODO: Implement Excel export using Laravel Excel
        // This is a placeholder - actual implementation requires Laravel Excel package
        return redirect()->back()->with('info', 'Fitur export Excel akan segera tersedia.');
    }

    public function terminal()
    {
        return view('admin.absensi.terminal');
    }

    public function getQrToken()
    {
        $user = auth()->user();
        $token = \Illuminate\Support\Str::random(64);
        
        // Simpan token dengan user_id pembuatnya
        // Valid 30 detik (cukup untuk scan)
        \Illuminate\Support\Facades\Cache::put('attendance_qr_' . $token, [
            'valid' => true,
            'user_id' => $user->id
        ], 60);

        return response()->json([
            'token' => $token,
            'expires_in' => 60
        ]);
    }
}
