@extends('layouts.app')

@section('title', 'Data Jabatan')
@section('page_title', 'Manajemen Data Jabatan')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
    <div>
        <h2 class="text-lg md:text-xl font-bold text-black">Data Jabatan</h2>
        <p class="text-xs md:text-sm text-gray-600 mt-1">Kelola data jabatan untuk guru dan karyawan</p>
    </div>
    <a href="{{ route('admin.jabatan.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 font-medium text-sm md:text-base w-full sm:w-auto text-center">
        + Tambah Jabatan
    </a>
</div>

@if($jabatan->count() > 0)
    <div class="mb-4 text-sm text-gray-600">
        Total <strong>{{ $jabatan->total() }}</strong> jabatan terdaftar dalam sistem
    </div>
@endif

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Nama Jabatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($jabatan as $j)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-black">{{ $j->nama_jabatan }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-black">{{ Str::limit($j->deskripsi, 100) ?: '-' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.jabatan.edit', $j) }}" class="text-black hover:text-gray-700 hover:underline">Edit</a>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('admin.jabatan.destroy', $j) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jabatan {{ $j->nama_jabatan }}? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data jabatan</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan data jabatan baru.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.jabatan.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                            Tambah Jabatan Pertama
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($jabatan->hasPages())
    <div class="mt-4">
        {{ $jabatan->links() }}
    </div>
@endif
@endsection
