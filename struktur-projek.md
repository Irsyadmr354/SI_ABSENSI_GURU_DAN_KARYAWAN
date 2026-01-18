Buatkan sebuah WEBSITE FULLSTACK menggunakan:
- Backend: Laravel (versi terbaru stabil)
- Frontend: Blade + Tailwind CSS
- Database: MySQL
- Authentication: Laravel Auth (Login, Register, Logout)
- Role: Admin, Guru, Karyawan
- Responsive (desktop & mobile)
- Clean code, rapi, mudah dikembangkan
- UI: modern, profesional, dan ringan
- Color: Hitam dan Putih

Tema website:
"SISTEM INFORMASI ABSENSI GURU DAN KARYAWAN"

================================================
🎯 FITUR UTAMA
================================================

A. AUTHENTICATION & ROLE
1. Login & Register
2. Middleware role-based access:
   - Admin
   - Guru
   - Karyawan
3. Redirect dashboard sesuai role
4. Proteksi halaman (user tidak bisa akses role lain)

------------------------------------------------
B. FITUR ADMIN
------------------------------------------------
1. Dashboard Admin
   - Total guru
   - Total karyawan
   - Total absensi hari ini
   - Grafik absensi (harian / bulanan)

2. Manajemen Data Master (CRUD)
   - Data Guru
   - Data Karyawan
   - Data Jabatan
   - Data Jam Kerja

3. Manajemen Absensi
   - Lihat seluruh absensi
   - Filter berdasarkan:
     - Tanggal
     - Nama
     - Role
   - Export absensi ke PDF & Excel

4. Manajemen User
   - Tambah user
   - Edit user
   - Reset password
   - Nonaktifkan akun

------------------------------------------------
C. FITUR GURU & KARYAWAN
------------------------------------------------
1. Dashboard User
   - Status absensi hari ini
   - Riwayat absensi

2. Absensi Online
   - Check-in
   - Check-out
   - Validasi:
     - Tidak bisa absen dua kali
     - Waktu masuk & pulang
   - Keterangan (hadir, izin, sakit, alpha)

3. Riwayat Absensi
   - Filter berdasarkan tanggal
   - Tampilkan jam masuk & keluar

------------------------------------------------
D. SISTEM ABSENSI
------------------------------------------------
1. Absensi berbasis:
   - Waktu (jam server)
2. Status:
   - Hadir
   - Izin
   - Sakit
   - Alpha
3. Otomatis menentukan keterlambatan

------------------------------------------------
E. UI / UX (TAILWIND CSS)
------------------------------------------------
1. Tema warna:
   - Biru & Putih (clean & profesional)
2. Layout:
   - Sidebar
   - Navbar
   - Card dashboard
3. Responsif:
   - Mobile
   - Tablet
   - Desktop
4. Notifikasi:
   - Success
   - Error
   - Warning

------------------------------------------------
F. DATABASE DESIGN
------------------------------------------------
Buatkan:
1. ERD (Entity Relationship Diagram)
2. Migration Laravel
3. Relasi antar tabel

Tabel utama:
- users
- guru
- karyawan
- jabatan
- jam_kerja
- absensi

------------------------------------------------
G. TECHNICAL REQUIREMENTS
------------------------------------------------
1. Gunakan:
   - MVC Laravel dengan best practice
2. Gunakan:
   - Validation Form Request
3. Gunakan:
   - Seeder & Factory
4. Gunakan:
   - Middleware role
5. Gunakan:
   - Clean route grouping

------------------------------------------------
H. OUTPUT YANG HARUS DIBUAT
------------------------------------------------
1. Struktur folder Laravel
2. Migration database
3. Model & relasi
4. Controller
5. Route web.php
6. Blade view (Tailwind CSS)
7. ERD & Flowchart sistem
8. Penjelasan singkat tiap fitur

Pastikan hasil akhir:
- Siap dijalankan
- Tidak error
- Mudah dikembangkan
- Cocok untuk Ujian Praktik / Project Sekolah
