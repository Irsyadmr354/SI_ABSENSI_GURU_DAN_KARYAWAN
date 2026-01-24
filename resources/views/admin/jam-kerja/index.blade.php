@extends('layouts.app')

@section('title', 'Manajemen Jam Kerja - SI Absensi')
@section('page_title', 'Konfigurasi Waktu')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Pengaturan Jam Kerja</h1>
            <p class="text-sm text-zinc-500 mt-1">Konfigurasi waktu masuk, pulang, dan toleransi keterlambatan.</p>
        </div>
        <a href="{{ route('admin.jam-kerja.create') }}" 
           class="inline-flex items-center justify-center px-4 py-2 bg-zinc-900 text-white rounded-xl text-sm font-medium hover:bg-black transition-all shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Jadwal
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main List -->
        <div class="lg:col-span-2 space-y-4">
            @forelse($jamKerja as $jk)
                <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                    @if($jk->is_active)
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-emerald-500"></div>
                    @endif

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-bold text-zinc-900">{{ $jk->nama }}</h3>
                                @if($jk->is_active)
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-100">
                                        Aktif
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-6 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-zinc-50 flex items-center justify-center text-zinc-500 border border-zinc-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-zinc-500 font-semibold uppercase">Masuk</p>
                                        <p class="font-mono font-bold text-zinc-900">{{ \Carbon\Carbon::parse($jk->jam_masuk)->format('H:i') }}</p>
                                    </div>
                                </div>
                                <div class="w-px h-8 bg-zinc-100"></div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-zinc-50 flex items-center justify-center text-zinc-500 border border-zinc-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-zinc-500 font-semibold uppercase">Pulang</p>
                                        <p class="font-mono font-bold text-zinc-900">{{ \Carbon\Carbon::parse($jk->jam_pulang)->format('H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between md:flex-col md:items-end gap-4 border-t md:border-t-0 md:border-l border-zinc-100 pt-4 md:pt-0 md:pl-6">
                            <div class="text-left md:text-right">
                                <p class="text-xs text-zinc-500 font-semibold uppercase">Toleransi</p>
                                <p class="font-bold text-zinc-900">{{ $jk->toleransi_keterlambatan }} Menit</p>
                            </div>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('admin.jam-kerja.edit', $jk) }}" class="p-2 bg-zinc-50 text-zinc-600 rounded-lg hover:bg-zinc-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('admin.jam-kerja.destroy', $jk) }}" method="POST" onsubmit="return confirm('Hapus aturan waktu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-12 text-center bg-zinc-50 border border-zinc-200 border-dashed rounded-2xl">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 border border-zinc-100 shadow-sm">
                        <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4 class="text-lg font-bold text-zinc-900">Belum Ada Jadwal</h4>
                    <p class="text-sm text-zinc-500 mt-1">Silakan buat aturan jam kerja baru.</p>
                </div>
            @endforelse

            @if($jamKerja->hasPages())
                <div class="flex justify-center pt-4">
                    {{ $jamKerja->links() }}
                </div>
            @endif
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            @php
                $jamAktif = $jamKerja->firstWhere('is_active', true);
            @endphp
            
            <div class="bg-zinc-900 text-white rounded-2xl p-6 shadow-md relative overflow-hidden">
                <div class="relative z-10">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-4">Sedang Berlaku</h4>
                    @if($jamAktif)
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            <p class="text-xl font-bold">{{ $jamAktif->nama }}</p>
                        </div>
                        <div class="h-px w-full bg-white/10 my-4"></div>
                        <div class="space-y-3 font-mono text-sm">
                            <div class="flex justify-between">
                                <span class="text-zinc-400">Masuk</span>
                                <span class="font-bold">{{ \Carbon\Carbon::parse($jamAktif->jam_masuk)->format('H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-400">Pulang</span>
                                <span class="font-bold">{{ \Carbon\Carbon::parse($jamAktif->jam_pulang)->format('H:i') }}</span>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-zinc-400">Belum ada jadwal yang diaktifkan.</p>
                    @endif
                </div>
                <!-- Decoration -->
                <div class="absolute -right-6 -bottom-6 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 100-16 8 8 0 000 16zm1-8h4v2h-6V7h2v5z"/></svg>
                </div>
            </div>

            <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
                <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3 block">Informasi</h4>
                <p class="text-sm text-zinc-600 leading-relaxed">
                    Hanya satu aturan jam kerja yang dapat aktif dalam satu waktu. Mengaktifkan jadwal baru akan otomatis menonaktifkan jadwal sebelumnya.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
