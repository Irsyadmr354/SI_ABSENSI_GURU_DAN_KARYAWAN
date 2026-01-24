@extends('layouts.app')

@section('title', 'Tambah Jabatan - SI Absensi')
@section('page_title', 'Registrasi Jabatan')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Jabatan Baru</h1>
            <p class="text-sm text-zinc-500 mt-1">Definisikan peran baru dalam struktur organisasi.</p>
        </div>
        <a href="{{ route('admin.jabatan.index') }}" 
           class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white border border-zinc-200 rounded-2xl p-6 md:p-8 shadow-sm">
        <form action="{{ route('admin.jabatan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Nama Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_jabatan" required value="{{ old('nama_jabatan') }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm placeholder-zinc-400"
                    placeholder="Contoh: Kepala Sekolah">
                @error('nama_jabatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all resize-none text-sm placeholder-zinc-400"
                    placeholder="Deskripsi singkat tanggung jawab...">{{ old('deskripsi') }}</textarea>
                <p class="text-xs text-zinc-400">Opsional: Tambahkan detail mengenai wewenang jabatan ini.</p>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all shadow-md">
                    Simpan Jabatan
                </button>
                <a href="{{ route('admin.jabatan.index') }}" class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-700 rounded-xl font-bold text-sm hover:bg-zinc-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
