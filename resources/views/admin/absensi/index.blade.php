@extends('layouts.app')

@section('title', 'Data Absensi')
@section('page_title', 'Manajemen Data Absensi')

@section('content')
<div class="mb-6">
    <h2 class="text-lg md:text-xl font-bold text-black">Data Absensi</h2>
    <p class="text-xs md:text-sm text-gray-600 mt-1">Lihat dan kelola seluruh data absensi guru dan karyawan</p>
</div>

<!-- Filter Form -->
<x-card>
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-black mb-1">Filter Pencarian</h3>
        <p class="text-sm text-gray-600">Gunakan filter di bawah untuk mencari data absensi tertentu</p>
    </div>
    
    <form method="GET" action="{{ route('admin.absensi.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-black mb-1">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                <p class="text-xs text-gray-500 mt-1">Pilih tanggal awal</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-black mb-1">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                <p class="text-xs text-gray-500 mt-1">Pilih tanggal akhir</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-black mb-1">Cari Nama</label>
                <input type="text" name="nama" value="{{ request('nama') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black" 
                       placeholder="Masukkan nama...">
                <p class="text-xs text-gray-500 mt-1">Cari berdasarkan nama pegawai</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-black mb-1">Filter Role</label>
                <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                    <option value="">Semua Role</option>
                    <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="karyawan" {{ request('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Filter berdasarkan role</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 font-medium">
                Terapkan Filter
            </button>
            <a href="{{ route('admin.absensi.index') }}" class="bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300 font-medium">
                Reset Filter
            </a>
            <a href="{{ route('admin.absensi.export-pdf') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 font-medium">
                Export PDF
            </a>
            <a href="{{ route('admin.absensi.export-excel') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 font-medium">
                Export Excel
            </a>
        </div>
    </form>
</x-card>

<!-- Tabel Data -->
<x-card>
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-black">Data Absensi</h3>
            @if($absensi->count() > 0)
                <p class="text-sm text-gray-600 mt-1">Menampilkan {{ $absensi->count() }} dari {{ $absensi->total() }} data absensi</p>
            @endif
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Nama Pegawai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Jam Masuk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Jam Pulang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Terlambat</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($absensi as $a)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black">{{ $a->tanggal->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $a->tanggal->format('l') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black">{{ $a->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $a->user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            {{ ucfirst($a->user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black">{{ $a->jam_masuk ?? '-' }}</div>
                        @if(!$a->jam_masuk)
                            <div class="text-xs text-gray-400">Belum check-in</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black">{{ $a->jam_pulang ?? '-' }}</div>
                        @if($a->jam_masuk && !$a->jam_pulang)
                            <div class="text-xs text-yellow-600">Belum check-out</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $a->status == 'hadir' ? 'bg-green-100 text-green-800' : ($a->status == 'izin' ? 'bg-yellow-100 text-yellow-800' : ($a->status == 'sakit' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($a->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($a->terlambat)
                            <span class="text-sm font-medium text-red-600">{{ $a->terlambat }} menit</span>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data absensi</h3>
                        <p class="mt-1 text-sm text-gray-500">Tidak ada data absensi yang sesuai dengan filter Anda.</p>
                        @if(request()->anyFilled(['tanggal_dari', 'tanggal_sampai', 'nama', 'role']))
                            <div class="mt-6">
                                <a href="{{ route('admin.absensi.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                                    Reset Filter
                                </a>
                            </div>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-card>

@if($absensi->hasPages())
    <div class="mt-4">
        {{ $absensi->links() }}
    </div>
@endif
@endsection
