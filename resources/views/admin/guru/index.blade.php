@extends('layouts.app')

@section('title', 'Data Guru')
@section('page_title', 'Manajemen Data Guru')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
    <div>
        <h2 class="text-lg md:text-xl font-bold text-black">Data Guru</h2>
        <p class="text-xs md:text-sm text-gray-600 mt-1">Kelola data guru yang terdaftar dalam sistem</p>
    </div>
    <a href="{{ route('admin.guru.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 font-medium text-sm md:text-base w-full sm:w-auto text-center">
        + Tambah Guru
    </a>
</div>

@if($guru->count() > 0)
    <div class="mb-4 text-sm text-gray-600">
        Menampilkan <strong>{{ $guru->count() }}</strong> dari <strong>{{ $guru->total() }}</strong> data guru
    </div>
@endif

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">NIP</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Jabatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Status Akun</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($guru as $g)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-black">{{ $g->nip }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-black">{{ $g->nama }}</div>
                    @if($g->no_telp)
                        <div class="text-xs text-gray-500">{{ $g->no_telp }}</div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-black">{{ $g->jabatan->nama_jabatan ?? '-' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-black">{{ $g->user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $g->user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $g->user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.guru.edit', $g) }}" class="text-black hover:text-gray-700 hover:underline">Edit</a>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('admin.guru.destroy', $g) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru {{ $g->nama }}? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data guru</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan data guru baru.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.guru.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                            Tambah Guru Pertama
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($guru->hasPages())
    <div class="mt-4">
        {{ $guru->links() }}
    </div>
@endif
@endsection
