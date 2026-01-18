<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        Jabatan::create([
            'nama_jabatan' => 'Guru Kelas',
            'deskripsi' => 'Guru yang mengajar di kelas',
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Guru Mata Pelajaran',
            'deskripsi' => 'Guru yang mengajar mata pelajaran tertentu',
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Staff Administrasi',
            'deskripsi' => 'Karyawan administrasi',
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Staff IT',
            'deskripsi' => 'Karyawan teknologi informasi',
        ]);
    }
}
