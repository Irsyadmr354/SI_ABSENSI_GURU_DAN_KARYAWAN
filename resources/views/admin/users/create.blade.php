@extends('layouts.app')

@section('title', 'Tambah User')
@section('page_title', 'Tambah User')

@section('content')
<form action="{{ route('admin.users.store') }}" method="POST" class="max-w-2xl">
    @csrf

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-black mb-1">Nama</label>
            <input type="text" name="name" required value="{{ old('name') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Email</label>
            <input type="email" name="email" required value="{{ old('email') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Password</label>
            <input type="password" name="password" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Role</label>
            <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                <option value="">Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
            @error('role') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                       class="rounded border-gray-300">
                <span class="ml-2 text-sm text-black">Aktif</span>
            </label>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300">Batal</a>
        </div>
    </div>
</form>
@endsection
