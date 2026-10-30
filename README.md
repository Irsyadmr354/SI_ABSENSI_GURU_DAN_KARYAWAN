# SI Absensi Guru dan Karyawan

Aplikasi absensi sekolah berbasis Laravel dengan check-in dan check-out lewat QR code, role admin, guru, dan karyawan.

## Kenapa proyek ini dibuat

Sekolah butuh cara absensi yang tidak bisa diwakilkan. QR code dibuat di dashboard admin, ditampilkan di layar, lalu dipindai oleh guru atau karyawan dari HP. Setiap token hanya berlaku sekali dan terikat ke akun yang memindai, sehingga satu orang tidak bisa mengabsenkan rekannya.

## Fitur

- Login dan registrasi dengan tiga role: admin, guru, karyawan
- Absensi QR one-time token dengan masa berlaku pendek
- Validasi jam masuk, toleransi keterlambatan, dan jam pulang
- Hitung menit terlambat otomatis
- Riwayat absensi dan pengajuan izin
- CRUD guru, karyawan, jabatan, jam kerja, dan user
- Export absensi ke PDF dan Excel
- Reset absensi hari ini untuk keperluan demo (nonaktif di production)

## Stack

- Laravel 12, PHP 8.2+
- MySQL atau MariaDB
- Blade, Tailwind CSS, Vite
- PHPUnit

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Atur koneksi database di `.env`, lalu:

```bash
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Akun demo hasil seeder:

| Role | Email | Password |
|---|---|---|
| Admin | admin@example.com | password |
| Guru | guru1@example.com | password |
| Karyawan | karyawan1@example.com | password |

Cek `database/seeders` untuk data terbaru.

## Alur QR

1. Admin membuka dashboard, QR code dibuat dengan token acak dan disimpan di cache.
2. Guru atau karyawan memindai QR, diarahkan ke `/absensi/scan/{token}`.
3. Sistem memaksa login agar akun yang memindai jelas.
4. Setelah login, `/absensi/scan-process/{token}` memvalidasi token, pemilik token, role, jam kerja aktif, dan jendela waktu.
5. Scan pertama mencatat jam masuk dan menit terlambat. Scan kedua mencatat jam pulang.

## Test

```bash
php artisan test
```

Hasil terakhir:

```
Tests: 10 passed (28 assertions)
```

Cakupan: check-in tepat waktu, check-in terlambat, check-out, token sekali pakai, token milik user lain, scan di luar jendela waktu, dan redirect dashboard per role.

## Struktur

```
app/Http/Controllers/AbsensiScanController.php   alur scan QR
app/Http/Controllers/Admin                       panel admin
app/Models/Absensi.php                           model dan accessor keterlambatan
routes/web.php                                   routing publik, admin, guru, karyawan
tests/Feature/AbsensiScanTest.php                test alur scan
```

## Batasan

- Reset absensi demo hanya untuk lingkungan non-production.
- Export PDF memakai library yang butuh ekstensi PHP standar, ikuti `composer.json`.
- Belum ada notifikasi WhatsApp atau email untuk keterlambatan.
