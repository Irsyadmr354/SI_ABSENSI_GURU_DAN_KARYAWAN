@extends('layouts.app')

@section('title', 'Edit Karyawan - SI Absensi')
@section('page_title', 'Update Karyawan')

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
                                <a href="{{ route('admin.karyawan.index') }}"
                                    class="hover:text-black transition-colors">Data Karyawan</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z">
                                    </path>
                                </svg>
                                <span class="text-black italic">Edit: {{ $karyawan->nama }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2
                    class="text-3xl font-black text-black tracking-tight uppercase italic underline decoration-4 underline-offset-8">
                    Update Karyawan</h2>
            </div>
            <a href="{{ route('admin.karyawan.index') }}"
                class="inline-flex items-center text-sm font-black uppercase tracking-widest text-gray-400 hover:text-black transition-colors group">
                <svg class="w-5 h-5 mr-1 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.karyawan.update', $karyawan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-8">
                <!-- Account Information Segment -->
                <div
                    class="bg-white border-2 border-black rounded-3xl shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                    <div class="bg-black p-6 flex items-center justify-between border-b-2 border-black">
                        <h3 class="text-lg font-black text-white uppercase tracking-widest italic leading-tight">1.
                            Kredensial Pengguna</h3>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Nama
                                    User/ID <span class="text-red-500">*</span></label>
                                <input type="text" name="name" required value="{{ old('name', $karyawan->user->name) }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-bold transition-all text-sm"
                                    placeholder="Username login">
                                @error('name') <p class="text-red-500 text-[10px] font-black mt-1 uppercase italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Email
                                    Terdaftar <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required value="{{ old('email', $karyawan->user->email) }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-bold transition-all text-sm"
                                    placeholder="email@institusi.id">
                                @error('email') <p class="text-red-500 text-[10px] font-black mt-1 uppercase italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Perbaharui
                                Kata Sandi</label>
                            <input type="password" name="password"
                                class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-bold transition-all text-sm"
                                placeholder="Biarkan kosong jika tidak berubah">
                            <p class="text-[10px] font-bold text-gray-400 mt-2 italic uppercase">Hanya isi kolom di atas
                                jika Anda ingin mereset kata sandi karyawan ini.</p>
                            @error('password') <p class="text-red-500 text-[10px] font-black mt-1 uppercase italic">
                                {{ $message }}
                            </p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Profile Information Segment -->
                <div
                    class="bg-white border-2 border-black rounded-3xl shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                    <div class="bg-black p-6 flex items-center justify-between border-b-2 border-black">
                        <h3 class="text-lg font-black text-white uppercase tracking-widest italic leading-tight">2. Bio Data
                            Karyawan</h3>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">NIP
                                    / Kode Unik <span class="text-red-500">*</span></label>
                                <input type="text" name="nip" required value="{{ old('nip', $karyawan->nip) }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-bold transition-all text-sm">
                                @error('nip') <p class="text-red-500 text-[10px] font-black mt-1 uppercase italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Nama
                                    Lengkap Karyawan <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" required value="{{ old('nama', $karyawan->nama) }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-bold transition-all text-sm">
                                @error('nama') <p class="text-red-500 text-[10px] font-black mt-1 uppercase italic">
                                    {{ $message }}
                                </p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Jabatan
                                    Struktural</label>
                                <div class="relative">
                                    <select name="jabatan_id"
                                        class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-black transition-all appearance-none cursor-pointer text-sm">
                                        <option value="">-- TANPA JABATAN --</option>
                                        @foreach($jabatan as $j)
                                            <option value="{{ $j->id }}" {{ old('jabatan_id', $karyawan->jabatan_id) == $j->id ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-black font-black">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Kontak
                                    Telepon</label>
                                <input type="text" name="no_telp" value="{{ old('no_telp', $karyawan->no_telp) }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-bold transition-all text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-black mb-1 italic">Alamat
                                Domisili Tetap</label>
                            <textarea name="alamat" rows="4"
                                class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-0 focus:border-black font-bold transition-all resize-none text-sm">{{ old('alamat', $karyawan->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-8 flex flex-col sm:flex-row gap-4 border-t-2 border-black">
                        <button type="submit"
                            class="flex-1 px-8 py-5 bg-black text-white rounded-2xl font-black uppercase tracking-widest text-sm shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)] hover:shadow-none hover:translate-x-0.75 hover:translate-y-0.75 transition-all duration-200 flex items-center justify-center italic">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.karyawan.index') }}"
                            class="px-8 py-5 bg-white border-2 border-black text-black rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-gray-100 transition-all text-center">
                            Membatalkan
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
