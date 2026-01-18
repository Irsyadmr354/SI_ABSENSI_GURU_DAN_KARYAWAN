<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Sample Guru
        User::create([
            'name' => 'Guru Satu',
            'email' => 'guru1@example.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'is_active' => true,
        ]);

        // Sample Karyawan
        User::create([
            'name' => 'Karyawan Satu',
            'email' => 'karyawan1@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'is_active' => true,
        ]);
    }
}
