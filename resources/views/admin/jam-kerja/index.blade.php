@extends('layouts.app')

@section('title', 'Data Jam Kerja')
@section('page_title', 'Manajemen Jam Kerja')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
    <div>
        <h2 class="text-lg md:text-xl font-bold text-black">Data Jam Kerja</h2>
        <p class="text-xs md:text-sm text-gray-600 mt-1">Atur jam kerja yang berlaku untuk sistem absensi</p>
    </div>
    <a href="{{ route('admin.jam-kerja.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 font-medium text-sm md:text-base w-full sm:w-auto text-center">
        + Tambah Jam Kerja
    </a>
</div>

@if($jamKerja->count() > 0)
    <div class="mb-4 text-sm text-gray-600">
        Total <strong>{{ $jamKerja->total() }}</strong> jam kerja terdaftar. 
        @php
            $jamAktif = $jamKerja->firstWhere('is_active', true);
        @endphp
        @if($jamAktif)
            <span class="text-green-600 font-medium">Jam kerja aktif: {{ $jamAktif->nama }}</span>
        @else
            <span class="text-yellow-600 font-medium">Belum ada jam kerja yang aktif</span>
        @endif
    </div>
@endif

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Nama Jam Kerja</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Jam Masuk</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Jam Pulang</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Toleransi Keterlambatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($jamKerja as $jk)
            <tr class="hover:bg-gray-50 transition-colors {{ $jk->is_active ? 'bg-green-50' : '' }}">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-black">{{ $jk->nama }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-black">{{ $jk->jam_masuk }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-black">{{ $jk->jam_pulang }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-black">{{ $jk->toleransi_keterlambatan }} menit</div>
                    <div class="text-xs text-gray-500">Setelah jam masuk</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $jk->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $jk->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                    @if($jk->is_active)
                        <p class="text-xs text-green-600 mt-1">Digunakan untuk absensi</p>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.jam-kerja.edit', $jk) }}" class="text-black hover:text-gray-700 hover:underline">Edit</a>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('admin.jam-kerja.destroy', $jk) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jam kerja {{ $jk->nama }}? Tindakan ini tidak dapat dibatalkan.')">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data jam kerja</h3>
                    <p class="mt-1 text-sm text-gray-500">Tambahkan jam kerja untuk mengatur waktu absensi pegawai.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.jam-kerja.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                            Tambah Jam Kerja Pertama
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($jamKerja->hasPages())
    <div class="mt-4">
        {{ $jamKerja->links() }}
    </div>
@endif

<!-- Informasi -->
<div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
    <h4 class="text-sm font-semibold text-black mb-2">Informasi Penting:</h4>
    <ul class="text-sm text-gray-700 space-y-1 list-disc list-inside">
        <li>Hanya satu jam kerja yang dapat aktif pada satu waktu</li>
        <li>Jam kerja aktif akan digunakan sebagai acuan untuk menghitung keterlambatan</li>
        <li>Jika mengaktifkan jam kerja baru, jam kerja yang lama akan otomatis dinonaktifkan</li>
    </ul>
</div>
@endsection
