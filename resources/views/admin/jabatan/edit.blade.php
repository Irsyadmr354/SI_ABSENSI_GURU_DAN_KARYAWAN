@extends('layouts.app')

@section('title', 'Edit Jabatan - SI Absensi')
@section('page_title', 'Update Jabatan')

@section('content')
    <div class="max-w-2xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2
                    class="text-3xl font-black text-black tracking-tight uppercase italic underline decoration-4 underline-offset-8">
                    Edit Profil Peran</h2>
                <p class="text-gray-400 font-bold mt-4 text-sm italic">Modifikasi otoritas dan deskripsi untuk: <span
                        class="text-black NOT-italic">{{ $jabatan->nama_jabatan }}</span></p>
            </div>
            <a href="{{ route('admin.jabatan.index') }}"
                class="w-12 h-12 bg-white border-2 border-black rounded-2xl flex items-center justify-center hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none -translate-x-0.5 -translate-y-0.5 hover:translate-x-0 hover:translate-y-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white border-4 border-black rounded-4xl shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] p-10 relative overflow-hidden">
            <!-- Decorative corner -->
            <div class="absolute right-0 top-0 w-24 h-24 bg-gray-50 -mr-12 -mt-12 rounded-full"></div>

            <form action="{{ route('admin.jabatan.update', $jabatan) }}" method="POST" class="space-y-8 relative z-10">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Nama Jabatan
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_jabatan" required
                        value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}"
                        class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-lg transition-all shadow-inner bg-gray-50"
                        placeholder="Contoh: Kepala Sekolah">
                    @error('nama_jabatan') <p class="text-red-500 text-[10px] font-black uppercase italic mt-2">
                        {{ $message }}
                    </p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Deskripsi &
                        Peran</label>
                    <textarea name="deskripsi" rows="5"
                        class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-bold transition-all resize-none shadow-inner text-sm bg-gray-50"
                        placeholder="Uraikan tanggung jawab singkat...">{{ old('deskripsi', $jabatan->deskripsi) }}</textarea>
                </div>

                <div class="pt-6 border-t-4 border-black flex items-center gap-4">
                    <button type="submit"
                        class="flex-1 px-8 py-5 bg-black text-white rounded-2xl font-black uppercase tracking-widest text-sm shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)] hover:shadow-none hover:translate-x-0.75 hover:translate-y-0.75 transition-all flex items-center justify-center italic">
                        Perbaharui Data
                        <svg class="ml-2 w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
