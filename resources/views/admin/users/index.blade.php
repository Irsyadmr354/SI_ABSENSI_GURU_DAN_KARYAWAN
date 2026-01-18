@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page_title', 'Manajemen Pengguna')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
    <div>
        <h2 class="text-lg md:text-xl font-bold text-black">Manajemen Pengguna</h2>
        <p class="text-xs md:text-sm text-gray-600 mt-1">Kelola akun pengguna sistem (Admin, Guru, Karyawan)</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 font-medium text-sm md:text-base w-full sm:w-auto text-center">
        + Tambah User
    </a>
</div>

@if($users->count() > 0)
    <div class="mb-4 text-sm text-gray-600">
        Menampilkan <strong>{{ $users->count() }}</strong> dari <strong>{{ $users->total() }}</strong> pengguna
        @php
            $totalAktif = $users->filter(fn($u) => $u->is_active)->count();
        @endphp
        (<strong class="text-green-600">{{ $totalAktif }} aktif</strong>, <strong class="text-red-600">{{ $users->total() - $totalAktif }} tidak aktif</strong>)
    </div>
@endif

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($users as $u)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-black">{{ $u->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-black">{{ $u->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $u->role == 'admin' ? 'bg-red-100 text-red-800' : ($u->role == 'guru' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                        {{ ucfirst($u->role) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $u->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $u->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                    @if(!$u->is_active)
                        <p class="text-xs text-gray-500 mt-1">Tidak dapat login</p>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('admin.users.edit', $u) }}" class="text-black hover:text-gray-700 hover:underline">Edit</a>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('admin.users.reset-password', $u) }}" method="POST" class="inline" onsubmit="return confirm('Reset password user {{ $u->name }} menjadi \"password123\"?')">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:text-blue-800 hover:underline">Reset Password</button>
                        </form>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $u->name }}? Tindakan ini akan menghapus semua data terkait dan tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data user</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan user baru.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                            Tambah User Pertama
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($users->hasPages())
    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endif
@endsection
