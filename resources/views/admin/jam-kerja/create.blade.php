@extends('layouts.app')

@section('title', 'Tambah Jam Kerja - SI Absensi')
@section('page_title', 'Konfigurasi Waktu')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Aturan Waktu Baru</h1>
            <p class="text-sm text-zinc-500 mt-1">Tetapkan parameter waktu kerja standar institusi.</p>
        </div>
        <a href="{{ route('admin.jam-kerja.index') }}" 
           class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white border border-zinc-200 rounded-2xl p-6 md:p-8 shadow-sm">
        <form action="{{ route('admin.jam-kerja.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Nama Jadwal <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required value="{{ old('nama') }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm placeholder-zinc-400"
                    placeholder="Contoh: Jam Kerja Normal">
                @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Jam Masuk <span class="text-red-500">*</span></label>
                    <input type="time" name="jam_masuk" required value="{{ old('jam_masuk', '07:00') }}"
                        class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-mono font-bold text-lg">
                    @error('jam_masuk') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Jam Pulang <span class="text-red-500">*</span></label>
                    <input type="time" name="jam_pulang" required value="{{ old('jam_pulang', '16:00') }}"
                        class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-mono font-bold text-lg">
                    @error('jam_pulang') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Toleransi Keterlambatan (Menit) <span class="text-red-500">*</span></label>
                <input type="number" name="toleransi_keterlambatan" required value="{{ old('toleransi_keterlambatan', 15) }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-mono font-bold text-lg placeholder-zinc-400">
                <p class="text-xs text-zinc-400">Pegawai dianggap terlambat jika absen melewati Jam Masuk + Toleransi.</p>
                @error('toleransi_keterlambatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-200 flex items-start gap-4">
                 <div class="flex items-center h-5">
                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active') ? 'checked' : '' }}
                        class="w-4 h-4 text-zinc-900 border-zinc-300 rounded focus:ring-zinc-900">
                </div>
                <div class="text-sm">
                    <label for="is_active" class="font-medium text-zinc-900">Aktifkan Sekarang</label>
                    <p class="text-zinc-500 text-xs mt-0.5">Jadwal ini akan langsung menggantikan jadwal aktif saat ini.</p>
                </div>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all shadow-md">
                    Simpan Jadwal
                </button>
                <a href="{{ route('admin.jam-kerja.index') }}" class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-700 rounded-xl font-bold text-sm hover:bg-zinc-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
