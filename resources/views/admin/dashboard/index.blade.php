@extends('layouts.app')

@section('title', 'Admin Dashboard - SI Absensi')
@section('page_title', 'Dashboard Overview')

@section('content')
    <div class="space-y-8">
        <!-- Header Section -->
        <div>
            <h1 class="text-3xl font-bold text-zinc-900 tracking-tight">Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
            <p class="text-zinc-500 mt-2">Berikut adalah ringkasan aktivitas sistem hari ini.</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 border border-zinc-200/60 shadow-sm relative overflow-hidden group hover:border-zinc-300 transition-all">
                <div class="absolute top-0 right-0 w-32 h-32 bg-zinc-900/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-zinc-100 rounded-xl flex items-center justify-center text-zinc-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                            {{ $totalGuru }} Aktif
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Guru</p>
                        <h3 class="text-3xl font-bold text-zinc-900 mt-1">{{ $totalGuru }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-zinc-200/60 shadow-sm relative overflow-hidden group hover:border-zinc-300 transition-all">
                <div class="absolute top-0 right-0 w-32 h-32 bg-zinc-900/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-zinc-100 rounded-xl flex items-center justify-center text-zinc-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $totalKaryawan }} Aktif
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Karyawan</p>
                        <h3 class="text-3xl font-bold text-zinc-900 mt-1">{{ $totalKaryawan }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-zinc-900 rounded-2xl p-6 shadow-lg shadow-zinc-200 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-20 -mt-20 blur-3xl transition-opacity opacity-50 group-hover:opacity-75"></div>
                
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center text-white backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        @php
                            $totalPegawai = $totalGuru + $totalKaryawan;
                            $persentase = $totalPegawai > 0 ? round(($totalAbsensiHariIni / $totalPegawai) * 100, 1) : 0;
                        @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-sm">
                            {{ $persentase }}% Kehadiran
                        </span>
                    </div>
                    <div class="text-white">
                        <p class="text-sm font-medium text-zinc-400">Absensi Hari Ini</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $totalAbsensiHariIni }}</h3>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="mt-6">
                        <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-white rounded-full transition-all duration-1000 ease-out" style="width: {{ $persentase }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-zinc-900">Tren Kehadiran</h3>
                        <p class="text-sm text-zinc-500">Statistik 30 hari terakhir</p>
                    </div>
                    <button class="p-2 hover:bg-zinc-50 rounded-lg transition-colors text-zinc-400 hover:text-zinc-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                    </button>
                </div>
                <div class="h-75 w-full">
                    <canvas id="chartHarian"></canvas>
                </div>
            </x-card>

            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-zinc-900">Rekapitulasi Bulanan</h3>
                        <p class="text-sm text-zinc-500">Perbandingan per bulan</p>
                    </div>
                     <button class="p-2 hover:bg-zinc-50 rounded-lg transition-colors text-zinc-400 hover:text-zinc-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                    </button>
                </div>
                <div class="h-75 w-full">
                    <canvas id="chartBulanan"></canvas>
                </div>
            </x-card>
        </div>

        <!-- Quick Actions Grid -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-zinc-900">Menu Cepat</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.guru.index') }}" class="group bg-white p-5 rounded-xl border border-zinc-200 hover:border-zinc-300 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <svg class="w-4 h-4 text-zinc-300 group-hover:text-zinc-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                    <h4 class="font-semibold text-zinc-900">Kelola Guru</h4>
                    <p class="text-sm text-zinc-500 mt-1">Manajemen data pengajar</p>
                </a>

                <a href="{{ route('admin.karyawan.index') }}" class="group bg-white p-5 rounded-xl border border-zinc-200 hover:border-zinc-300 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <svg class="w-4 h-4 text-zinc-300 group-hover:text-zinc-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                    <h4 class="font-semibold text-zinc-900">Kelola Karyawan</h4>
                    <p class="text-sm text-zinc-500 mt-1">Manajemen data staf</p>
                </a>

                <a href="{{ route('admin.absensi.index') }}" class="group bg-white p-5 rounded-xl border border-zinc-200 hover:border-zinc-300 hover:shadow-md transition-all">
                     <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <svg class="w-4 h-4 text-zinc-300 group-hover:text-zinc-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                    <h4 class="font-semibold text-zinc-900">Laporan Absensi</h4>
                    <p class="text-sm text-zinc-500 mt-1">Rekap data kehadiran</p>
                </a>

                <a href="{{ route('admin.users.index') }}" class="group bg-white p-5 rounded-xl border border-zinc-200 hover:border-zinc-300 hover:shadow-md transition-all">
                     <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <svg class="w-4 h-4 text-zinc-300 group-hover:text-zinc-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                    <h4 class="font-semibold text-zinc-900">User Management</h4>
                    <p class="text-sm text-zinc-500 mt-1">Kontrol akses sistem</p>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Global Chart Defaults
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.color = '#71717a';
        Chart.defaults.scale.grid.color = '#f4f4f5';
        Chart.defaults.plugins.tooltip.backgroundColor = '#18181b';
        Chart.defaults.plugins.tooltip.padding = 12;
        Chart.defaults.plugins.tooltip.cornerRadius = 8;
        
        // Setup Chart
        const createChart = (id, type, config) => {
            const ctx = document.getElementById(id).getContext('2d');
            new Chart(ctx, {
                type: type,
                data: config.data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: { borderDash: [2, 4] }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    ...config.options
                }
            });
        };

        // Data & Config for Charts
        createChart('chartHarian', 'line', {
            data: {
                labels: @json(array_column($absenHarian, 'label')),
                datasets: [{
                    label: 'Absensi',
                    data: @json(array_column($absenHarian, 'count')),
                    borderColor: '#18181b', // Zinc-900
                    backgroundColor: (ctx) => {
                        const gradient = ctx.chart.ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(24, 24, 27, 0.1)');
                        gradient.addColorStop(1, 'rgba(24, 24, 27, 0)');
                        return gradient;
                    },
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    borderWidth: 2
                }]
            }
        });

        createChart('chartBulanan', 'bar', {
            data: {
                labels: @json(array_column($absenBulanan, 'label')),
                datasets: [{
                    label: 'Total',
                    data: @json(array_column($absenBulanan, 'count')),
                    backgroundColor: '#18181b',
                    borderRadius: 4,
                    hoverBackgroundColor: '#27272a'
                }]
            }
        });
    </script>
@endsection
