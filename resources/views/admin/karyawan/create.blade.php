@extends('layouts.app')

@section('title', 'Tambah Karyawan - SI Absensi')
@section('page_title', 'Registrasi Karyawan')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-zinc-900">Input Karyawan</h1>
                <p class="text-sm text-zinc-500 mt-1">Tambahkan data karyawan baru ke dalam sistem.</p>
            </div>
            <a href="{{ route('admin.karyawan.index') }}" 
               class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.karyawan.store') }}" method="POST" class="space-y-6">
            @csrf
            
            @if(isset($user))
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-sm text-blue-700">
                            Melengkapi data untuk akun pengguna: <strong>{{ $user->name }}</strong> ({{ $user->email }})
                        </p>
                    </div>
                </div>
            @endif
            
             <!-- Account Section -->
            <div class="bg-white border border-zinc-200 rounded-2xl p-6 md:p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6 pb-6 border-b border-zinc-100">
                    <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-4.514A9.01 9.01 0 0012 15c2.148 0 4.148.749 5.72 2.012M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-zinc-900">Akun Sistem</h3>
                        <p class="text-sm text-zinc-500">Informasi login karyawan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-zinc-700">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required value="{{ old('name', isset($user) ? $user->name : '') }}"
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                            placeholder="nama.pengguna">
                        @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-zinc-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required value="{{ old('email', isset($user) ? $user->email : '') }}"
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                            placeholder="email@perusahaan.id">
                        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5 md:col-span-2">
                        <label class="block text-sm font-semibold text-zinc-700">Password @if(!isset($user)) <span class="text-red-500">*</span> @else <span class="text-xs font-normal text-zinc-400">(Biarkan kosong jika tidak ingin mengubah)</span> @endif</label>
                        <input type="password" name="password" {{ isset($user) ? '' : 'required' }}
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                            placeholder="******">
                         @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="bg-white border border-zinc-200 rounded-2xl p-6 md:p-8 shadow-sm">
                 <div class="flex items-center gap-3 mb-6 pb-6 border-b border-zinc-100">
                    <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-zinc-900">Detail Karyawan</h3>
                        <p class="text-sm text-zinc-500">Data diri dan penempatan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-zinc-700">NIP / ID <span class="text-red-500">*</span></label>
                        <input type="text" name="nip" required value="{{ old('nip') }}"
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                            placeholder="Nomor Induk Pegawai">
                        @error('nip') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                     <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-zinc-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required value="{{ old('nama', isset($user) ? $user->name : '') }}"
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                            placeholder="Nama Lengkap">
                        @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="space-y-1.5">
                         <label class="block text-sm font-semibold text-zinc-700">Jabatan</label>
                         <div class="relative">
                            <select name="jabatan_id" class="w-full pl-4 pr-10 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all appearance-none cursor-pointer">
                                <option value="">Pilih Jabatan...</option>
                                @foreach($jabatan as $j)
                                    <option value="{{ $j->id }}" {{ (old('jabatan_id') == $j->id) || (!old('jabatan_id') && strtolower($j->nama_jabatan) == 'karyawan') ? 'selected' : '' }}>
                                        {{ $j->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                             <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-zinc-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-zinc-700">No. Telepon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                            placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="space-y-1.5 md:col-span-2">
                        <label class="block text-sm font-semibold text-zinc-700">Alamat</label>
                        <textarea name="alamat" rows="3"
                             class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400 resize-none"
                             placeholder="Alamat domisili lengkap...">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white font-semibold rounded-xl hover:bg-black transition-all shadow-lg shadow-zinc-200 active:scale-[0.98]">
                    Simpan Data
                </button>
                <a href="{{ route('admin.karyawan.index') }}" class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-700 font-semibold rounded-xl hover:bg-zinc-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
