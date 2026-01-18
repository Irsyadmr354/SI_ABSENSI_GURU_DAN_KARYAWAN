@extends('layouts.app')

@section('title', 'Tambah Jam Kerja')
@section('page_title', 'Tambah Jam Kerja')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-bold text-black">Tambah Jam Kerja</h2>
    <p class="text-sm text-gray-600 mt-1">Atur jam kerja baru untuk sistem absensi</p>
</div>

<x-card>
    <form action="{{ route('admin.jam-kerja.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-black mb-1">
                    Nama Jam Kerja <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama" required value="{{ old('nama') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black"
                       placeholder="Contoh: Jam Kerja Normal">
                <p class="text-xs text-gray-500 mt-1">Nama untuk mengidentifikasi jam kerja ini</p>
                @error('nama') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-black mb-1">
                        Jam Masuk <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="jam_masuk" required value="{{ old('jam_masuk') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                    <p class="text-xs text-gray-500 mt-1">Waktu mulai kerja</p>
                    @error('jam_masuk') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-black mb-1">
                        Jam Pulang <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="jam_pulang" required value="{{ old('jam_pulang') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                    <p class="text-xs text-gray-500 mt-1">Waktu selesai kerja (harus setelah jam masuk)</p>
                    @error('jam_pulang') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-black mb-1">
                    Toleransi Keterlambatan (menit) <span class="text-red-500">*</span>
                </label>
                <input type="number" name="toleransi_keterlambatan" required min="0" value="{{ old('toleransi_keterlambatan', 15) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                <p class="text-xs text-gray-500 mt-1">Waktu toleransi setelah jam masuk sebelum dihitung terlambat (dalam menit)</p>
                @error('toleransi_keterlambatan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <label class="flex items-start">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                           class="mt-1 rounded border-gray-300">
                    <div class="ml-3">
                        <span class="text-sm font-medium text-black">Aktifkan jam kerja ini</span>
                        <p class="text-xs text-gray-600 mt-1">Jika dicentang, jam kerja ini akan menjadi aktif dan jam kerja aktif lainnya akan otomatis dinonaktifkan</p>
                    </div>
                </label>
            </div>

            <div class="pt-4 border-t border-gray-200 flex flex-col sm:flex-row gap-3 sm:space-x-4">
                <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 font-medium w-full sm:w-auto text-center">
                    Simpan Data
                </button>
                <a href="{{ route('admin.jam-kerja.index') }}" class="bg-gray-200 text-black px-6 py-2 rounded hover:bg-gray-300 font-medium text-center w-full sm:w-auto">
                    Batal
                </a>
            </div>
        </div>
    </form>
</x-card>
@endsection
