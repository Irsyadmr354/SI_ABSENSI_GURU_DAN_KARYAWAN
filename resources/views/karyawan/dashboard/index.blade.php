@extends('layouts.app')

@section('title', 'Dashboard Karyawan')
@section('page_title', 'Dashboard Karyawan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <x-card>
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-black">Selamat Datang, {{ auth()->user()->name }}</h2>
            <p class="text-sm md:text-base text-gray-600 mt-1">{{ now()->format('l, d F Y') }} - {{ now()->format('H:i') }}</p>
        </div>
    </x-card>

    <!-- Status Absensi Hari Ini -->
    <x-card>
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-black">Status Absensi Hari Ini</h3>
            <p class="text-sm text-gray-600">Informasi absensi Anda pada tanggal {{ now()->format('d/m/Y') }}</p>
        </div>
        
        @if($absensiHariIni)
            <div class="space-y-3 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Status Kehadiran:</span>
                    <span class="px-3 py-1 rounded text-sm font-medium {{ $absensiHariIni->status == 'hadir' ? 'bg-green-100 text-green-800' : ($absensiHariIni->status == 'izin' ? 'bg-yellow-100 text-yellow-800' : ($absensiHariIni->status == 'sakit' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                        {{ ucfirst($absensiHariIni->status) }}
                    </span>
                </div>
                
                @if($absensiHariIni->jam_masuk)
                    <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-600">Jam Masuk:</span>
                        <span class="text-sm font-semibold text-black">{{ $absensiHariIni->jam_masuk }}</span>
                    </div>
                @else
                    <div class="pt-2 border-t border-gray-200">
                        <p class="text-sm text-gray-500">Anda belum melakukan check-in hari ini</p>
                        <a href="{{ route('karyawan.absensi.index') }}" class="text-sm text-black hover:underline mt-2 inline-block">Lakukan check-in sekarang →</a>
                    </div>
                @endif
                
                @if($absensiHariIni->jam_pulang)
                    <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-600">Jam Pulang:</span>
                        <span class="text-sm font-semibold text-black">{{ $absensiHariIni->jam_pulang }}</span>
                    </div>
                @elseif($absensiHariIni->jam_masuk)
                    <div class="pt-2 border-t border-gray-200">
                        <p class="text-sm text-gray-500">Anda belum melakukan check-out</p>
                        <a href="{{ route('karyawan.absensi.index') }}" class="text-sm text-black hover:underline mt-2 inline-block">Lakukan check-out sekarang →</a>
                    </div>
                @endif
                
                @if($absensiHariIni->terlambat)
                    <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-600">Keterlambatan:</span>
                        <span class="text-sm font-semibold text-red-600">{{ $absensiHariIni->terlambat }} menit</span>
                    </div>
                @endif

                @if($absensiHariIni->keterangan)
                    <div class="pt-2 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-600 block mb-1">Keterangan:</span>
                        <p class="text-sm text-gray-700">{{ $absensiHariIni->keterangan }}</p>
                    </div>
                @endif
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-sm text-yellow-800 mb-2"><strong>Belum ada absensi hari ini</strong></p>
                <p class="text-xs text-yellow-700 mb-3">Silakan lakukan check-in untuk mencatat kehadiran Anda.</p>
                <a href="{{ route('karyawan.absensi.index') }}" class="inline-block bg-black text-white px-4 py-2 rounded text-sm hover:bg-gray-800">
                    Check In Sekarang
                </a>
            </div>
        @endif
    </x-card>

    <!-- Riwayat Absensi Terakhir -->
    <x-card>
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-black">Riwayat Absensi Terakhir</h3>
                <p class="text-sm text-gray-600">5 absensi terakhir Anda</p>
            </div>
            <a href="{{ route('karyawan.absensi.riwayat') }}" class="text-sm text-black hover:underline">Lihat Semua →</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Jam Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Jam Pulang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Terlambat</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($riwayatAbsensi as $r)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->tanggal->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->jam_masuk ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->jam_pulang ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $r->status == 'hadir' ? 'bg-green-100 text-green-800' : ($r->status == 'izin' ? 'bg-yellow-100 text-yellow-800' : ($r->status == 'sakit' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                {{ ucfirst($r->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->terlambat ? $r->terlambat . ' menit' : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <p class="text-sm text-gray-500">Belum ada riwayat absensi</p>
                            <p class="text-xs text-gray-400 mt-1">Riwayat absensi Anda akan muncul di sini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</div>
@endsection
