@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    <!-- Header Informasi -->
    <x-card>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-black">Selamat Datang, {{ auth()->user()->name }}</h2>
                <p class="text-sm md:text-base text-gray-600 mt-1">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="text-left md:text-right">
                <p class="text-xs md:text-sm text-gray-600">Waktu Server</p>
                <p class="text-base md:text-lg font-semibold text-black">{{ now()->format('H:i:s') }}</p>
            </div>
        </div>
    </x-card>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Total Guru</h3>
                    <p class="text-3xl font-bold text-black">{{ $totalGuru }}</p>
                    <p class="text-xs text-gray-500 mt-2">Guru terdaftar dalam sistem</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Total Karyawan</h3>
                    <p class="text-3xl font-bold text-black">{{ $totalKaryawan }}</p>
                    <p class="text-xs text-gray-500 mt-2">Karyawan terdaftar dalam sistem</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Absensi Hari Ini</h3>
                    <p class="text-3xl font-bold text-black">{{ $totalAbsensiHariIni }}</p>
                    <p class="text-xs text-gray-500 mt-2">Catatan absensi pada {{ now()->format('d/m/Y') }}</p>
                    @php
                        $totalPegawai = $totalGuru + $totalKaryawan;
                        $persentase = $totalPegawai > 0 ? round(($totalAbsensiHariIni / $totalPegawai) * 100, 1) : 0;
                    @endphp
                    @if($totalPegawai > 0)
                        <p class="text-xs {{ $persentase >= 80 ? 'text-green-600' : ($persentase >= 50 ? 'text-yellow-600' : 'text-red-600') }} mt-1">
                            {{ $persentase }}% dari total pegawai
                        </p>
                    @endif
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-card>
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-black">Grafik Absensi Harian</h3>
                <p class="text-sm text-gray-600">30 hari terakhir</p>
            </div>
            <canvas id="chartHarian" height="100"></canvas>
            <p class="text-xs text-gray-500 mt-4 text-center">Menampilkan trend absensi harian selama sebulan terakhir</p>
        </x-card>

        <x-card>
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-black">Grafik Absensi Bulanan</h3>
                <p class="text-sm text-gray-600">12 bulan terakhir</p>
            </div>
            <canvas id="chartBulanan" height="100"></canvas>
            <p class="text-xs text-gray-500 mt-4 text-center">Menampilkan total absensi per bulan selama setahun terakhir</p>
        </x-card>
    </div>

    <!-- Quick Links -->
    <x-card>
        <h3 class="text-lg font-semibold text-black mb-4">Akses Cepat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.guru.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center">
                <p class="text-sm font-medium text-black">Data Guru</p>
                <p class="text-xs text-gray-500 mt-1">Kelola data guru</p>
            </a>
            <a href="{{ route('admin.karyawan.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center">
                <p class="text-sm font-medium text-black">Data Karyawan</p>
                <p class="text-xs text-gray-500 mt-1">Kelola data karyawan</p>
            </a>
            <a href="{{ route('admin.absensi.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center">
                <p class="text-sm font-medium text-black">Data Absensi</p>
                <p class="text-xs text-gray-500 mt-1">Lihat laporan absensi</p>
            </a>
            <a href="{{ route('admin.users.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 text-center">
                <p class="text-sm font-medium text-black">Manajemen User</p>
                <p class="text-xs text-gray-500 mt-1">Kelola pengguna</p>
            </a>
        </div>
    </x-card>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Harian
    const ctxHarian = document.getElementById('chartHarian').getContext('2d');
    new Chart(ctxHarian, {
        type: 'line',
        data: {
            labels: @json(array_column($absenHarian, 'label')),
            datasets: [{
                label: 'Jumlah Absensi',
                data: @json(array_column($absenHarian, 'count')),
                borderColor: 'rgb(0, 0, 0)',
                backgroundColor: 'rgba(0, 0, 0, 0.1)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Grafik Bulanan
    const ctxBulanan = document.getElementById('chartBulanan').getContext('2d');
    new Chart(ctxBulanan, {
        type: 'bar',
        data: {
            labels: @json(array_column($absenBulanan, 'label')),
            datasets: [{
                label: 'Total Absensi',
                data: @json(array_column($absenBulanan, 'count')),
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                borderColor: 'rgb(0, 0, 0)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
@endsection
