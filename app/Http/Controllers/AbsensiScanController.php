<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\JamKerja;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AbsensiScanController extends Controller
{
    // INIT SCAN: Force Logout to ensure fresh login
    public function scanInit($token)
    {
        // Force Logout existing session to strictly enforce "Wajib Login"
        if(auth()->check()) {
            auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        // Store the token in session so LoginController knows where to redirect after login
        session(['scan_redirect_token' => $token]);

        // Redirect explicitly to login page
        return redirect()->route('login');
    }

    public function scanProcess(Request $request, $token)
    {
        // 1. Validate Token (Cache valid for 20 seconds)
        // Ambil data token dari cache
        $tokenData = Cache::get('attendance_qr_' . $token);

        if (!$tokenData) {
            return view('absensi.scan-result', [
                'status' => 'error', 
                'message' => 'QR Code Link Sudah Kadaluarsa atau Tidak Valid. Silakan refresh QR Code pada Dashboard dan scan ulang.'
            ]);
        }

        $user = auth()->user();
        if (!$user) {
             // Should be handled by middleware, but double check
             return redirect()->route('login');
        }

        // 2. Validate User Identification
        // Jika token mengandung info user_id, wajib cocok dengan user yang sedang login
        if (isset($tokenData['user_id']) && $tokenData['user_id'] != $user->id) {
             return view('absensi.scan-result', [
                 'status' => 'error', 
                 'message' => 'Akun Tidak Cocok! QR Code ini milik user ID: ' . $tokenData['user_id'] . ', sedangkan Anda login sebagai: ' . $user->name . ' (' . $user->email . '). Silakan login dengan akun yang sesuai.'
             ]);
        }
        
        // Hapus token agar tidak bisa digunakan ulang (One-Time usage)
        Cache::forget('attendance_qr_' . $token);

        // 3. Validate Role
        if (!in_array($user->role, ['guru', 'karyawan'])) {
             return view('absensi.scan-result', [
                 'status' => 'error', 
                 'message' => 'Akun Anda tidak memiliki hak akses untuk absensi ini.'
             ]);
        }

        $today = today();
        $now = Carbon::now('Asia/Jakarta');

        // 4. Get Active Schedule
        $jamKerja = JamKerja::where('is_active', true)->first();
        if (!$jamKerja) {
             return view('absensi.scan-result', [
                 'status' => 'error', 
                 'message' => 'Jadwal kerja belum diatur oleh admin.'
             ]);
        }

        $jamMasuk = Carbon::parse($today->format('Y-m-d') . ' ' . $jamKerja->jam_masuk, 'Asia/Jakarta');
        $jamPulang = Carbon::parse($today->format('Y-m-d') . ' ' . $jamKerja->jam_pulang, 'Asia/Jakarta');

        // 5a. Validate: Too Early (e.g. attempting to check in 3 hours before start)
        // Allow check-in starting 2 hours before shift
        $earliestCheckIn = $jamMasuk->copy()->subHours(2);
        
        if ($now->lessThan($earliestCheckIn)) {
             return view('absensi.scan-result', [
                 'status' => 'error', 
                 'message' => 'Belum waktunya absensi. Silakan coba lagi mulai jam ' . $earliestCheckIn->format('H:i') . '.'
             ]);
        }

        // 5b. Validate: Too Late (Tolerance: 2 Hours after Jam Pulang)
        // User still can scan up to 2 hours after shift ends (for those who forgot)
        $jamPulangTolerance = $jamPulang->copy()->addHours(2);

        if ($now->greaterThan($jamPulangTolerance)) {
            return view('absensi.scan-result', [
                'status' => 'error', 
                'message' => 'Waktu absensi hari ini sudah berakhir (Melewati batas toleransi ' . $jamPulangTolerance->format('H:i') . ').'
            ]);
        }

        // 6. Check Existing Attendance
        $absensi = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        // --- CHECK IN FLOW ---
        if (!$absensi || !$absensi->jam_masuk) {
            $jamMasukWithTolerance = $jamMasuk->copy()->addMinutes($jamKerja->toleransi_keterlambatan);
            $terlambat = null;

            if ($now->gt($jamMasukWithTolerance)) {
                $terlambat = $now->diffInMinutes($jamMasukWithTolerance->subMinutes($jamKerja->toleransi_keterlambatan));
            }

            if ($absensi) {
                 $absensi->update([
                    'jam_masuk' => $now->format('H:i:s'),
                    'status' => 'hadir',
                    'terlambat' => $terlambat,
                ]);
                $absensi->refresh(); // Refresh to get the updated 'terlambat' value for the accessor
            } else {
                $absensi = Absensi::create([
                    'user_id' => $user->id,
                    'tanggal' => $today,
                    'jam_masuk' => $now->format('H:i:s'),
                    'status' => 'hadir',
                    'terlambat' => $terlambat,
                ]);
            }
            
            // Format deskripsi terlambat using accessor
            $terlambatDesc = $absensi->terlambat_deskripsi; // Use Accessor

            return view('absensi.scan-result', [
                'status' => 'success', 
                'type' => 'Masuk', 
                'user' => $user,
                'time' => $now->format('H:i'),
                'terlambat' => $terlambatDesc
            ]);
        }

        // --- CHECK OUT FLOW ---
        if ($absensi && !$absensi->jam_pulang) {
             $absensi->update([
                 'jam_pulang' => $now->format('H:i:s'),
             ]);

             return view('absensi.scan-result', [
                'status' => 'success', 
                'type' => 'Pulang', 
                'user' => $user,
                'time' => $now->format('H:i')
            ]);
        }

        // --- ALREADY COMPLETED ---
        return view('absensi.scan-result', [
            'status' => 'info', 
            'message' => 'Anda sudah melakukan check-in dan check-out hari ini.'
        ]);
    }

    // DEMO RESET: Allow users to reset their attendance for portfolio/testing
    public function demoReset()
    {
        $user = auth()->user();
        if(!$user) return redirect()->route('login');

        Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->delete();

        return redirect()->back()->with('success', 'Data absensi hari ini berhasil di-reset (Mode Demo).');
    }
}
