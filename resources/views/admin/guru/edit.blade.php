@extends('layouts.app')

@section('title', 'Edit Guru - SI Absensi')
@section('page_title', 'Modifikasi Data Guru')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <!-- Breadcrumb & Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="flex text-xs font-black uppercase tracking-widest text-gray-400 mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}"
                                class="hover:text-black transition-colors">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z">
                                    </path>
                                </svg>
                                <a href="{{ route('admin.guru.index') }}" class="hover:text-black transition-colors">Data
                                    Guru</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z">
                                    </path>
                                </svg>
                                <span class="text-black italic">Edit: {{ $guru->nama }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2
                    class="text-3xl font-black text-black tracking-tight uppercase italic underline decoration-4 underline-offset-8">
                    Edit Profil Guru</h2>
            </div>
            <a href="{{ route('admin.guru.index') }}"
                class="inline-flex items-center text-sm font-black uppercase tracking-widest text-gray-400 hover:text-black transition-colors group">
                <svg class="w-5 h-5 mr-1 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.guru.update', $guru) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-8">
                <!-- Account Information Segment -->
                <div
                    class="bg-white border-2 border-black rounded-3xl shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                    <div class="bg-black p-6 flex items-center justify-between">
                        <h3 class="text-lg font-black text-white uppercase tracking-widest italic">1. Kredensial Akun</h3>
                        <div
                            class="px-3 py-1 bg-white text-black text-[10px] font-black uppercase tracking-widest rounded-lg">
                            ID: {{ $guru->user->id }}</div>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">Nama Login
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="name" required value="{{ old('name', $guru->user->name) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all"
                                    placeholder="Username login">
                                @error('name') <p class="text-red-500 text-xs font-bold mt-1 uppercase italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">Email
                                    Institusi <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required value="{{ old('email', $guru->user->email) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all"
                                    placeholder="email@sekolah.id">
                                @error('email') <p class="text-red-500 text-xs font-bold mt-1 uppercase italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">Perbarui Kata
                                Sandi</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all"
                                placeholder="Biarkan kosong jika tidak ingin diubah">
                            <p class="text-[10px] font-bold text-gray-400 mt-2 italic uppercase">Abaikan kolom ini kecuali
                                jika Anda bermaksud mereset kata sandi guru ini.</p>
                            @error('password') <p class="text-red-500 text-xs font-bold mt-1 uppercase italic">
                                {{ $message }}
                            </p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Profile Information Segment -->
                <div
                    class="bg-white border-2 border-black rounded-3xl shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                    <div class="bg-black p-6 flex items-center justify-between">
                        <h3 class="text-lg font-black text-white uppercase tracking-widest italic">2. Data Pokok Guru</h3>
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.232l-3.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">NIP (Nomor
                                    Induk Pegawai) <span class="text-red-500">*</span></label>
                                <input type="text" name="nip" required value="{{ old('nip', $guru->nip) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all placeholder-gray-300">
                                @error('nip') <p class="text-red-500 text-xs font-bold mt-1 uppercase italic">{{ $message }}
                                </p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">Nama
                                    Lengkap & Gelar <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" required value="{{ old('nama', $guru->nama) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all">
                                @error('nama') <p class="text-red-500 text-xs font-bold mt-1 uppercase italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">Jabatan
                                    Fungsional</label>
                                <div class="relative">
                                    <select name="jabatan_id"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all appearance-none cursor-pointer">
                                        <option value="">-- TANPA JABATAN --</option>
                                        @foreach($jabatan as $j)
                                            <option value="{{ $j->id }}" {{ old('jabatan_id', $guru->jabatan_id) == $j->id ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-black">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">No. Kontak
                                    Terintegrasi</label>
                                <input type="text" name="no_telp" value="{{ old('no_telp', $guru->no_telp) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all"
                                    placeholder="Contoh: 08XXXXXXXXXX">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-black mb-1">Alamat
                                Domisili Tetap</label>
                            <textarea name="alamat" rows="4"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:border-black font-medium transition-all resize-none">{{ old('alamat', $guru->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-8 flex flex-col sm:flex-row gap-4 border-t-2 border-black">
                        <button type="submit"
                            class="flex-1 px-8 py-4 bg-black text-white rounded-2xl font-black uppercase tracking-widest text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.232l-3.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.guru.index') }}"
                            class="px-8 py-4 bg-white border-2 border-black text-black rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-gray-50 transition-all text-center">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
