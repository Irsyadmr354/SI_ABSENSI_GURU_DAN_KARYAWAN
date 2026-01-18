<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\KaryawanController as AdminKaryawanController;
use App\Http\Controllers\Admin\JabatanController as AdminJabatanController;
use App\Http\Controllers\Admin\JamKerjaController as AdminJamKerjaController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\AbsensiController as KaryawanAbsensiController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Master data routes
    Route::resource('guru', AdminGuruController::class);
    Route::resource('karyawan', AdminKaryawanController::class);
    Route::resource('jabatan', AdminJabatanController::class);
    Route::resource('jam-kerja', AdminJamKerjaController::class);
    
    // Absensi routes
    Route::get('/absensi', [AdminAbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/export-pdf', [AdminAbsensiController::class, 'exportPdf'])->name('absensi.export-pdf');
    Route::get('/absensi/export-excel', [AdminAbsensiController::class, 'exportExcel'])->name('absensi.export-excel');
    
    // User management routes
    Route::resource('users', AdminUserController::class);
    Route::post('/users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('users.reset-password');
});

// Guru routes
Route::prefix('guru')->middleware(['auth', 'guru'])->group(function() {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
    Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('guru.absensi.index');
    Route::post('/absensi/check-in', [GuruAbsensiController::class, 'checkIn'])->name('guru.absensi.check-in');
    Route::post('/absensi/check-out', [GuruAbsensiController::class, 'checkOut'])->name('guru.absensi.check-out');
    Route::post('/absensi/ajukan-izin', [GuruAbsensiController::class, 'ajukanIzin'])->name('guru.absensi.ajukan-izin');
    Route::get('/absensi/riwayat', [GuruAbsensiController::class, 'riwayat'])->name('guru.absensi.riwayat');
});

// Karyawan routes
Route::prefix('karyawan')->middleware(['auth', 'karyawan'])->group(function() {
    Route::get('/dashboard', [KaryawanDashboardController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/absensi', [KaryawanAbsensiController::class, 'index'])->name('karyawan.absensi.index');
    Route::post('/absensi/check-in', [KaryawanAbsensiController::class, 'checkIn'])->name('karyawan.absensi.check-in');
    Route::post('/absensi/check-out', [KaryawanAbsensiController::class, 'checkOut'])->name('karyawan.absensi.check-out');
    Route::post('/absensi/ajukan-izin', [KaryawanAbsensiController::class, 'ajukanIzin'])->name('karyawan.absensi.ajukan-izin');
    Route::get('/absensi/riwayat', [KaryawanAbsensiController::class, 'riwayat'])->name('karyawan.absensi.riwayat');
});
