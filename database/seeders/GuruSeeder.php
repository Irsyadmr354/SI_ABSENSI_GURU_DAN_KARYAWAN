<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $userGuru = User::where('email', 'guru1@example.com')->first();
        $jabatan = Jabatan::first();

        if ($userGuru) {
            Guru::create([
                'user_id' => $userGuru->id,
                'nip' => 'G001',
                'nama' => 'Guru Satu',
                'jabatan_id' => $jabatan?->id,
                'alamat' => 'Jl. Contoh No. 1',
                'no_telp' => '081234567890',
            ]);
        }
    }
}
