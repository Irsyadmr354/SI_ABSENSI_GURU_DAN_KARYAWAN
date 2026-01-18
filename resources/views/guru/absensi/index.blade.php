@extends('layouts.app')

@section('title', 'Absensi')
@section('page_title', 'Absensi Online')

@section('content')
<div class="space-y-6">
    <!-- Informasi Jam Kerja -->
    @if($jamKerja)
    <x-card>
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-black">Informasi Jam Kerja</h3>
            <p class="text-sm text-gray-600">Jam kerja yang berlaku untuk absensi</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Jam Masuk</p>
                    <p class="text-lg font-semibold text-black">{{ $jamKerja->jam_masuk }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 mb-1">Jam Pulang</p>
                    <p class="text-lg font-semibold text-black">{{ $jamKerja->jam_pulang }}</p>
                </div>
            </div>
            @if($jamKerja->toleransi_keterlambatan > 0)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-600 mb-1">Toleransi Keterlambatan</p>
                    <p class="text-sm text-black">{{ $jamKerja->toleransi_keterlambatan }} menit</p>
                </div>
            @endif
        </div>
    </x-card>
    @endif

    <!-- Absensi Hari Ini -->
    <x-card>
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-black">Absensi Hari Ini</h3>
            <p class="text-sm text-gray-600">Tanggal: {{ now()->format('d/m/Y') }} - {{ now()->format('l') }}</p>
        </div>
        
        @if($absensiHariIni && $absensiHariIni->jam_masuk)
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium text-gray-700">Status:</span>
                        <span class="px-3 py-1 rounded bg-green-100 text-green-800 font-medium">
                            Sudah Check-In
                        </span>
                    </div>
                    <div class="bg-white rounded-lg p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Jam Masuk:</span>
                            <span class="text-lg font-bold text-black">{{ $absensiHariIni->jam_masuk }}</span>
                        </div>
                        
                        @if($absensiHariIni->terlambat)
                            <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                                <span class="text-sm text-gray-600">Keterlambatan:</span>
                                <span class="text-sm font-semibold text-red-600">{{ $absensiHariIni->terlambat }} menit</span>
                            </div>
                        @endif
                        
                        @if($absensiHariIni->jam_pulang)
                            <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                                <span class="text-sm text-gray-600">Jam Pulang:</span>
                                <span class="text-lg font-bold text-black">{{ $absensiHariIni->jam_pulang }}</span>
                            </div>
                            <div class="pt-3 mt-3 border-t-2 border-green-200">
                                <p class="text-sm text-green-800 text-center font-medium">✓ Absensi lengkap untuk hari ini</p>
                            </div>
                        @else
                            <div class="pt-4 mt-3 border-t border-gray-200">
                                <p class="text-sm text-gray-600 mb-3">Anda belum melakukan check-out. Silakan lakukan check-out jika waktu kerja Anda sudah selesai.</p>
                                <form action="{{ route('guru.absensi.check-out') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-black text-white px-6 py-3 rounded hover:bg-gray-800 font-medium">
                                        Check Out Sekarang
                                    </button>
                                </form>
                                <p class="text-xs text-gray-500 mt-2 text-center">Waktu saat ini: {{ now()->format('H:i:s') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="text-center">
                    <p class="text-lg font-semibold text-black mb-2">Belum Ada Check-In Hari Ini</p>
                    <p class="text-sm text-gray-600 mb-4">Silakan lakukan check-in untuk mencatat kehadiran Anda</p>
                    
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <p class="text-xs text-gray-600 mb-2">Waktu saat ini:</p>
                        <p class="text-2xl font-bold text-black mb-2">{{ now()->format('H:i:s') }}</p>
                        <p class="text-xs text-gray-500">{{ now()->format('d/m/Y') }}</p>
                    </div>
                    
                    <form action="{{ route('guru.absensi.check-in') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-black text-white px-8 py-3 rounded hover:bg-gray-800 font-medium text-lg">
                            Check In Sekarang
                        </button>
                    </form>
                    <p class="text-xs text-gray-500 mt-3">Pastikan Anda melakukan check-in sesuai jam kerja yang berlaku</p>
                </div>
            </div>
        @endif
    </x-card>

    <!-- Pengajuan Izin/Cuti -->
    <x-card>
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-black">Ajukan Izin / Cuti / Sakit</h3>
            <p class="text-sm text-gray-600">Gunakan form ini untuk mengajukan izin, cuti, atau sakit</p>
        </div>
        
        <form action="{{ route('guru.absensi.ajukan-izin') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-black mb-1">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" required 
                           min="{{ date('Y-m-d') }}"
                           value="{{ old('tanggal', date('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                    <p class="text-xs text-gray-500 mt-1">Pilih tanggal untuk izin/cuti/sakit</p>
                    @error('tanggal') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-black mb-1">
                        Jenis <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                        <option value="">Pilih Jenis</option>
                        <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin / Cuti</option>
                        <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Pilih jenis ketidakhadiran</p>
                    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-black mb-1">
                    Alasan / Keterangan <span class="text-red-500">*</span>
                </label>
                <textarea name="keterangan" required rows="3" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black"
                          placeholder="Contoh: Izin cuti tahunan, Sakit demam, dll">{{ old('keterangan') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Jelaskan alasan izin/cuti/sakit</p>
                @error('keterangan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 font-medium">
                    Ajukan Izin/Cuti/Sakit
                </button>
            </div>
        </form>
    </x-card>

    <!-- Petunjuk -->
    <x-card>
        <h3 class="text-lg font-semibold text-black mb-3">Petunjuk Absensi</h3>
        <div class="space-y-2 text-sm text-gray-700">
            <div class="flex items-start">
                <span class="font-medium mr-2">1.</span>
                <p>Lakukan check-in pada saat mulai bekerja sesuai jam kerja yang berlaku</p>
            </div>
            <div class="flex items-start">
                <span class="font-medium mr-2">2.</span>
                <p>Lakukan check-out pada saat selesai bekerja</p>
            </div>
            <div class="flex items-start">
                <span class="font-medium mr-2">3.</span>
                <p>Keterlambatan akan dihitung otomatis jika check-in melebihi jam masuk + toleransi</p>
            </div>
            <div class="flex items-start">
                <span class="font-medium mr-2">4.</span>
                <p>Untuk izin/cuti/sakit, gunakan form "Ajukan Izin" di atas (dapat diajukan sebelumnya)</p>
            </div>
        </div>
    </x-card>
</div>
@endsection
