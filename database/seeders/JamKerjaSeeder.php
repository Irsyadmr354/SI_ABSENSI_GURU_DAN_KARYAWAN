<?php

namespace Database\Seeders;

use App\Models\JamKerja;
use Illuminate\Database\Seeder;

class JamKerjaSeeder extends Seeder
{
    public function run(): void
    {
        JamKerja::create([
            'nama' => 'Jam Kerja Normal',
            'jam_masuk' => '07:00:00',
            'jam_pulang' => '15:00:00',
            'toleransi_keterlambatan' => 15,
            'is_active' => true,
        ]);
    }
}
