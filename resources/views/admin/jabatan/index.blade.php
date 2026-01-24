@extends('layouts.app')

@section('title', 'Data Jabatan - SI Absensi')
@section('page_title', 'Struktur Jabatan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Struktur Jabatan</h1>
            <p class="text-sm text-zinc-500 mt-1">Kelola hierarki dan posisi dalam organisasi.</p>
        </div>
        <a href="{{ route('admin.jabatan.create') }}" 
           class="inline-flex items-center justify-center px-4 py-2 bg-zinc-900 text-white rounded-xl text-sm font-medium hover:bg-black transition-all shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Jabatan
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="p-4 bg-white border border-zinc-200 rounded-2xl shadow-sm">
            <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-1">Total Posisi</p>
            <p class="text-2xl font-bold text-zinc-900">{{ $jabatan->total() }}</p>
        </div>
    </div>

    <!-- Data Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($jabatan as $j)
            <div class="group bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                    <a href="{{ route('admin.jabatan.edit', $j) }}" class="p-1.5 rounded-lg bg-zinc-100 text-zinc-600 hover:bg-zinc-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </a>
                    <form action="{{ route('admin.jabatan.destroy', $j) }}" method="POST" onsubmit="return confirm('Hapus jabatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>

                <div class="mb-4">
                    <div class="w-12 h-12 bg-zinc-100 rounded-xl flex items-center justify-center text-zinc-900 border border-zinc-200 font-bold text-lg mb-4">
                        {{ substr($j->nama_jabatan, 0, 1) }}
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 mb-1">{{ $j->nama_jabatan }}</h3>
                    <p class="text-sm text-zinc-500 line-clamp-2 min-h-[2.5em]">
                        {{ $j->deskripsi ?: 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <div class="pt-4 border-t border-zinc-100 flex items-center justify-between">
                    <span class="text-xs font-medium text-zinc-400">ID: {{ $j->id }}</span>
                    <span class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Detail Posisi</span>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-zinc-50 border border-zinc-200 border-dashed rounded-2xl">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-zinc-100">
                    <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h4 class="text-lg font-bold text-zinc-900">Belum Ada Data</h4>
                <p class="text-sm text-zinc-500 mt-1">Silakan tambahkan jabatan baru.</p>
            </div>
        @endforelse
    </div>

    @if($jabatan->hasPages())
        <div class="flex justify-center pt-6">
            {{ $jabatan->links() }}
        </div>
    @endif
</div>
@endsection
