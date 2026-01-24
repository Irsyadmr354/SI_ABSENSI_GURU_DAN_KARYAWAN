<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users except admin
        $users = User::whereIn('role', ['guru', 'karyawan'], 'and', false)->get();

        // Create attendance data for the last 30 days
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }

            foreach ($users as $user) {
                // 90% chance of attendance
                if (rand(1, 100) <= 90) {
                    $jamMasuk = Carbon::parse($date->format('Y-m-d') . ' 07:00:00')
                        ->addMinutes(rand(-15, 60)); // Random arrival time between 6:45 and 8:00
                    
                    $jamKeluar = Carbon::parse($date->format('Y-m-d') . ' 16:00:00')
                        ->addMinutes(rand(-30, 30)); // Random departure time
                    
                    // Determine status based on arrival time
                    $status = 'hadir';
                    if ($jamMasuk->format('H:i') > '07:15') {
                        $status = 'hadir'; // Still present but might be late
                    }
                    
                    // 5% chance of requesting leave (izin/sakit)
                    if (rand(1, 100) <= 5) {
                        $status = rand(0, 1) ? 'izin' : 'sakit';
                        $jamMasuk = null;
                        $jamKeluar = null;
                    }
                    
                    Absensi::create([
                        'user_id' => $user->id,
                        'tanggal' => $date->format('Y-m-d'),
                        'jam_masuk' => $jamMasuk,
                        'jam_pulang' => $jamKeluar,
                        'status' => $status,
                        'keterangan' => $status === 'izin' ? 'Keperluan keluarga' : 
                                       ($status === 'sakit' ? 'Tidak enak badan' : null),
                    ]);
                } else {
                    // 10% chance of being absent (alpha)
                    Absensi::create([
                        'user_id' => $user->id,
                        'tanggal' => $date->format('Y-m-d'),
                        'jam_masuk' => null,
                        'jam_pulang' => null,
                        'status' => 'alpha',
                        'keterangan' => null,
                    ]);
                }
            }
        }
    }
}
