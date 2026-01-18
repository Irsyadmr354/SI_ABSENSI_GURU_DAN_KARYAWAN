@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('page_title', 'Manajemen Data Karyawan')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
    <div>
        <h2 class="text-lg md:text-xl font-bold text-black">Data Karyawan</h2>
        <p class="text-xs md:text-sm text-gray-600 mt-1">Kelola data karyawan yang terdaftar dalam sistem</p>
    </div>
    <a href="{{ route('admin.karyawan.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 font-medium text-sm md:text-base w-full sm:w-auto text-center">
        + Tambah Karyawan
    </a>
</div>

@if($karyawan->count() > 0)
    <div class="mb-4 text-sm text-gray-600">
        Menampilkan <strong>{{ $karyawan->count() }}</strong> dari <strong>{{ $karyawan->total() }}</strong> data karyawan
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
            @forelse($karyawan as $k)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-black">{{ $k->nip }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-black">{{ $k->nama }}</div>
                    @if($k->no_telp)
                        <div class="text-xs text-gray-500">{{ $k->no_telp }}</div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-black">{{ $k->jabatan->nama_jabatan ?? '-' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-black">{{ $k->user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $k->user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $k->user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.karyawan.edit', $k) }}" class="text-black hover:text-gray-700 hover:underline">Edit</a>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('admin.karyawan.destroy', $k) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karyawan {{ $k->nama }}? Tindakan ini tidak dapat dibatalkan.')">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data karyawan</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan data karyawan baru.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.karyawan.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                            Tambah Karyawan Pertama
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($karyawan->hasPages())
    <div class="mt-4">
        {{ $karyawan->links() }}
    </div>
@endif
@endsection
