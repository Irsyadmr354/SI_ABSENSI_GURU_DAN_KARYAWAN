@extends('layouts.app')

@section('title', 'Data Absensi - SI Absensi')
@section('page_title', 'Monitoring Kehadiran')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Laporan Absensi</h1>
            <p class="text-sm text-zinc-500 mt-1">Monitoring kehadiran seluruh pegawai secara real-time.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.absensi.export-pdf') }}" class="px-4 py-2 bg-white border border-zinc-200 text-zinc-700 rounded-xl text-sm font-medium hover:bg-zinc-50 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                PDF
            </a>
            <a href="{{ route('admin.absensi.export-excel') }}" class="px-4 py-2 bg-zinc-900 text-white rounded-xl text-sm font-medium hover:bg-black transition-all flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Excel
            </a>
        </div>
    </div>

    <!-- Filter Panel -->
    <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
        <form method="GET" action="{{ route('admin.absensi.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Dari Tanggal</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Nama Pegawai</label>
                <input type="text" name="nama" value="{{ request('nama') }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm placeholder-zinc-400"
                    placeholder="Cari nama...">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Filter Role</label>
                <div class="relative">
                    <select name="role" class="w-full pl-4 pr-10 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all appearance-none cursor-pointer font-medium text-sm">
                        <option value="">Semua Role</option>
                        <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="karyawan" {{ request('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-zinc-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-4 flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.absensi.index') }}" class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-700 rounded-xl font-bold text-sm hover:bg-zinc-50 transition-all">
                    Reset
                </a>
                <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all shadow-md">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 border-b border-zinc-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Pegawai</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Pulang</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-zinc-500 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($absensi as $a)
                        <tr class="hover:bg-zinc-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-zinc-900">{{ $a->tanggal->format('d M') }}</span>
                                    <span class="text-xs text-zinc-500">{{ $a->tanggal->isoFormat('dddd') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600 font-bold text-xs border border-zinc-200">
                                        {{ substr($a->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-zinc-900">{{ $a->user->name }}</span>
                                        <span class="text-xs text-zinc-500">{{ ucfirst($a->user->role) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-mono text-zinc-600 bg-zinc-100 px-2 py-1 rounded">{{ $a->jam_masuk ?? '--:--' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-mono text-zinc-600 bg-zinc-100 px-2 py-1 rounded">{{ $a->jam_pulang ?? '--:--' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'hadir' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'izin' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'sakit' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'alpha' => 'bg-red-50 text-red-700 border-red-100',
                                    ];
                                    $class = $statusClasses[$a->status] ?? 'bg-zinc-50 text-zinc-700 border-zinc-100';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium border {{ $class }}">
                                    {{ ucfirst($a->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($a->terlambat > 0)
                                    <span class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded">
                                        +{{ $a->terlambat }}m
                                    </span>
                                @elseif($a->status == 'hadir')
                                    <span class="text-xs font-semibold text-emerald-600">On Time</span>
                                @else
                                    <span class="text-xs text-zinc-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="mx-auto w-12 h-12 bg-zinc-50 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                </div>
                                <p class="text-sm font-medium text-zinc-900">Data tidak ditemukan</p>
                                <p class="text-xs text-zinc-500">Coba sesuaikan filter pencarian Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($absensi->hasPages())
        <div class="flex justify-center pt-4">
            {{ $absensi->links() }}
        </div>
    @endif
</div>
@endsection
