@extends('layouts.app')

@section('title', 'Tambah User - SI Absensi')
@section('page_title', 'Registrasi Pengguna')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">User Baru</h1>
            <p class="text-sm text-zinc-500 mt-1">Tambahkan akun pengguna baru ke dalam sistem.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" 
           class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white border border-zinc-200 rounded-2xl p-6 md:p-8 shadow-sm">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Username <span class="text-red-500">*</span></label>
                <input type="text" name="name" required value="{{ old('name') }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm placeholder-zinc-400"
                    placeholder="nama.pengguna">
                @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" required value="{{ old('email') }}"
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm placeholder-zinc-400"
                    placeholder="email@sekolah.id">
                @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm placeholder-zinc-400"
                    placeholder="Minimal 8 karakter">
                @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Role <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="role" required class="w-full pl-4 pr-10 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all appearance-none cursor-pointer font-medium text-sm">
                        <option value="">Pilih Role...</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-zinc-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
                @error('role') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="p-4 bg-zinc-50 rounded-xl border border-zinc-200 flex items-start gap-4">
                 <div class="flex items-center h-5">
                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4 text-zinc-900 border-zinc-300 rounded focus:ring-zinc-900">
                </div>
                <div class="text-sm">
                    <label for="is_active" class="font-medium text-zinc-900">Aktifkan Akun</label>
                    <p class="text-zinc-500 text-xs mt-0.5">Pengguna dapat langsung login setelah akun dibuat.</p>
                </div>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all shadow-md">
                    Simpan User
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-700 rounded-xl font-bold text-sm hover:bg-zinc-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
