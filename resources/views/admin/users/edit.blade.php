@extends('layouts.app')

@section('title', 'Edit User - SI Absensi')
@section('page_title', 'Update Profil User')

@section('content')
    <div class="max-w-2xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h2
                class="text-3xl font-black text-black tracking-tight uppercase italic underline decoration-4 underline-offset-8">
                Update User</h2>
            <a href="{{ route('admin.users.index') }}"
                class="w-12 h-12 bg-white border-2 border-black rounded-2xl flex items-center justify-center hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none -translate-x-0.5 -translate-y-0.5 hover:translate-x-0 hover:translate-y-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white border-4 border-black rounded-4xl shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] p-10">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nama
                            Lengkap</label>
                        <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                            class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-lg shadow-inner bg-gray-50">
                        @error('name') <p class="text-red-500 text-[10px] font-black uppercase mt-1 italic">{{ $message }}
                        </p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Email
                            Akun</label>
                        <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                            class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-lg shadow-inner bg-gray-50">
                        @error('email') <p class="text-red-500 text-[10px] font-black uppercase mt-1 italic">{{ $message }}
                        </p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Level Hak Akses
                            / Role <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="role" required
                                class="w-full px-6 py-5 border-2 border-black rounded-2xl focus:ring-0 focus:border-black font-black text-lg shadow-inner bg-gray-50 appearance-none cursor-pointer">
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    ADMINISTRATOR</option>
                                <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>TENAGA
                                    PENGAJAR (GURU)</option>
                                <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>STAF
                                    OPERASIONAL (KARYAWAN)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-black">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center p-6 bg-gray-50 border-2 border-black rounded-3xl">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                            class="h-6 w-6 text-black focus:ring-0 border-2 border-black rounded-lg cursor-pointer transition-all">
                        <label for="is_active"
                            class="ml-4 block text-[10px] font-black uppercase tracking-widest text-black cursor-pointer italic">Akun
                            Dalam Status Aktif</label>
                    </div>
                </div>

                <div class="pt-8 border-t-4 border-black">
                    <button type="submit"
                        class="w-full px-8 py-5 bg-black text-white rounded-2xl font-black uppercase tracking-widest text-sm shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)] hover:shadow-none hover:translate-x-0.75 hover:translate-y-0.75 transition-all flex items-center justify-center italic">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Simpan Perubahan User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
