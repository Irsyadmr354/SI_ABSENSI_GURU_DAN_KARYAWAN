@extends('layouts.app')

@section('title', 'Data Karyawan - SI Absensi')
@section('page_title', 'Manajemen Karyawan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Daftar Karyawan</h1>
            <p class="text-sm text-zinc-500 mt-1">Kelola data staf dan operasional sekolah.</p>
        </div>
        <a href="{{ route('admin.karyawan.create') }}" 
           class="inline-flex items-center justify-center px-4 py-2 bg-zinc-900 text-white rounded-xl text-sm font-medium hover:bg-black transition-all shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Karyawan
        </a>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white border border-zinc-200 rounded-xl p-2 md:p-3 flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <input type="text" placeholder="Cari nama atau NIP..." 
                   class="w-full pl-10 pr-4 py-2 bg-zinc-50 border-none rounded-lg text-sm focus:ring-2 focus:ring-zinc-200 transition-all placeholder-zinc-400 text-zinc-900">
            <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <div class="sm:w-48">
            <select class="w-full py-2 pl-3 pr-8 bg-zinc-50 border-none rounded-lg text-sm focus:ring-2 focus:ring-zinc-200 text-zinc-600">
                <option value="">Semua Jabatan</option>
                <!-- Populate via backend later -->
            </select>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 border-b border-zinc-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Identitas</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-zinc-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    {{-- Pending Users (Belum Lengkap) --}}
                    @if(isset($pendingUsers))
                        @foreach($pendingUsers as $pu)
                        <tr class="hover:bg-amber-50/50 transition-colors bg-amber-50/30">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-bold text-sm border border-amber-200">
                                        {{ substr($pu->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-zinc-900">{{ $pu->name }}</p>
                                        <p class="text-xs text-amber-600 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                            Data Belum Lengkap
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    Karyawan
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-zinc-600 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    {{ $pu->email }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu Data
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.karyawan.create', ['user_id' => $pu->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-zinc-900 text-white rounded-lg text-xs font-medium hover:bg-black transition-all shadow-sm">
                                    Lengkapi Data
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif

                    {{-- Existing Complete Data --}}
                    @foreach($karyawan as $k)
                    <tr class="hover:bg-zinc-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-700 font-bold text-sm border border-zinc-200">
                                    {{ substr($k->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-zinc-900 group-hover:text-black">{{ $k->nama }}</p>
                                    <p class="text-xs text-zinc-500 font-mono">{{ $k->nip }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-zinc-100 text-zinc-800 border border-zinc-200">
                                {{ $k->jabatan->nama_jabatan ?? 'Karyawan' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-0.5">
                                <span class="text-xs text-zinc-600 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    {{ $k->user->email }}
                                </span>
                                @if($k->no_telp)
                                <span class="text-xs text-zinc-600 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    {{ $k->no_telp }}
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($k->user->is_active)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-zinc-100 text-zinc-600 border border-zinc-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span>
                                    Non-Aktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.karyawan.edit', $k) }}" class="p-1.5 rounded-lg text-zinc-400 hover:text-zinc-700 hover:bg-zinc-100 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form action="{{ route('admin.karyawan.destroy', $k) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data karyawan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-zinc-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @if($karyawan->isEmpty() && (!isset($pendingUsers) || $pendingUsers->isEmpty()))
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 bg-zinc-50 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <p class="text-zinc-900 font-medium">Belum ada data karyawan</p>
                                <p class="text-zinc-500 text-sm mt-1">Silakan tambahkan data karyawan baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endif    
        @if($karyawan->hasPages())
        <div class="px-6 py-4 border-t border-zinc-100 bg-zinc-50 flex items-center justify-between">
            {{ $karyawan->links() }} 
        </div>
        @endif
    </div>
</div>
@endsection
