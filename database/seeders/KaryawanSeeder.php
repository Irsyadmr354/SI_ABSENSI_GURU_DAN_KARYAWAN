<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $userKaryawan = User::where('email', 'karyawan1@example.com')->first();
        $jabatan = Jabatan::where('nama_jabatan', 'Staff Administrasi')->first();

        if ($userKaryawan) {
            Karyawan::create([
                'user_id' => $userKaryawan->id,
                'nip' => 'K001',
                'nama' => 'Karyawan Satu',
                'jabatan_id' => $jabatan?->id,
                'alamat' => 'Jl. Contoh No. 2',
                'no_telp' => '081234567891',
            ]);
        }
    }
}
