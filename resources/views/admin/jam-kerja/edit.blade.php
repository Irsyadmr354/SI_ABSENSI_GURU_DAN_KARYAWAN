@extends('layouts.app')

@section('title', 'Edit Jam Kerja - SI Absensi')
@section('page_title', 'Update Waktu')

@section('content')
    <div class="max-w-3xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-700">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2
                    class="text-3xl font-black text-black tracking-tight uppercase italic underline decoration-4 underline-offset-8 text-left">
                    Update Aturan</h2>
                <p class="text-gray-400 font-bold mt-4 text-sm text-left italic">Memodifikasi parameter untuk: <span
                        class="text-black NOT-italic">{{ $jamKerja->nama }}</span></p>
            </div>
            <a href="{{ route('admin.jam-kerja.index') }}"
                class="w-12 h-12 bg-white border-2 border-black rounded-2xl flex items-center justify-center hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none -translate-x-0.5 -translate-y-0.5 hover:translate-x-0 hover:translate-y-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white border-2 border-black rounded-4xl shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
            <form action="{{ route('admin.jam-kerja.update', $jamKerja) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-10 space-y-8">
                    <div class="space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">Nama Identitas
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required value="{{ old('nama', $jamKerja->nama) }}"
                            class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-lg shadow-inner bg-gray-50 placeholder-gray-300 transition-all">
                        @error('nama') <p class="text-red-500 text-[10px] font-black uppercase italic mt-1 text-left">
                            {{ $message }}
                        </p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2 text-left">
                            <label class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Jam
                                Masuk <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_masuk" required
                                value="{{ old('jam_masuk', $jamKerja->jam_masuk) }}"
                                class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-2xl shadow-inner bg-gray-50 transition-all">
                            @error('jam_masuk') <p class="text-red-500 text-[10px] font-black uppercase italic mt-1">
                                {{ $message }}
                            </p> @enderror
                        </div>
                        <div class="space-y-2 text-left">
                            <label class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Jam
                                Pulang <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_pulang" required
                                value="{{ old('jam_pulang', $jamKerja->jam_pulang) }}"
                                class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-2xl shadow-inner bg-gray-50 transition-all">
                            @error('jam_pulang') <p class="text-red-500 text-[10px] font-black uppercase italic mt-1">
                                {{ $message }}
                            </p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2 text-left">
                        <label class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Toleransi
                            (Menit) <span class="text-red-500">*</span></label>
                        <div class="relative items-center flex">
                            <input type="number" name="toleransi_keterlambatan" required
                                value="{{ old('toleransi_keterlambatan', $jamKerja->toleransi_keterlambatan) }}"
                                class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-xl shadow-inner bg-gray-50 transition-all appearance-none uppercase">
                            <span
                                class="absolute right-6 font-black uppercase tracking-widest text-[10px] text-gray-400 font-italic italic">Menit</span>
                        </div>
                        @error('toleransi_keterlambatan') <p
                        class="text-red-500 text-[10px] font-black uppercase italic mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center p-6 bg-gray-50 border-2 border-black rounded-3xl">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $jamKerja->is_active) ? 'checked' : '' }}
                            class="h-6 w-6 text-black focus:ring-0 border-2 border-black rounded-lg cursor-pointer transition-all">
                        <label for="is_active"
                            class="ml-4 block text-sm font-black uppercase tracking-widest text-black cursor-pointer italic text-left">Aktifkan
                            Sebagai Acuan Sistem Saat Ini</label>
                    </div>
                </div>

                <div class="bg-black p-10 flex flex-col sm:flex-row gap-4 border-t-2 border-black">
                    <button type="submit"
                        class="flex-1 px-8 py-5 bg-white text-black rounded-2xl font-black uppercase tracking-widest text-sm shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-0.75 hover:translate-y-0.75 transition-all flex items-center justify-center italic">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.232l-3.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Perbarui Aturan
                    </button>
                    <a href="{{ route('admin.jam-kerja.index') }}"
                        class="px-8 py-5 border-2 border-white text-white rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-white hover:text-black transition-all text-center">
                        Batalkan
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
