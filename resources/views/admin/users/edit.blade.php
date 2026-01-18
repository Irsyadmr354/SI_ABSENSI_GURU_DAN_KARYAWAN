@extends('layouts.app')

@section('title', 'Edit User')
@section('page_title', 'Edit User')

@section('content')
<form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-black mb-1">Nama</label>
            <input type="text" name="name" required value="{{ old('name', $user->name) }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Email</label>
            <input type="email" name="email" required value="{{ old('email', $user->email) }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <div>
            <label class="block text-sm font-medium text-black mb-1">Role</label>
            <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
            @error('role') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
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
