@extends('layouts.app')

@section('title', 'Edit Jabatan')
@section('page_title', 'Edit Data Jabatan')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-bold text-black">Edit Data Jabatan</h2>
    <p class="text-sm text-gray-600 mt-1">Perbarui informasi jabatan: {{ $jabatan->nama_jabatan }}</p>
</div>

<x-card>
    <form action="{{ route('admin.jabatan.update', $jabatan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-black mb-1">
                    Nama Jabatan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_jabatan" required value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                <p class="text-xs text-gray-500 mt-1">Nama jabatan yang akan ditampilkan</p>
                @error('nama_jabatan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-black mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">{{ old('deskripsi', $jabatan->deskripsi) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Penjelasan tentang jabatan ini</p>
            </div>

            <div class="pt-4 border-t border-gray-200 flex flex-col sm:flex-row gap-3 sm:space-x-4">
                <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 font-medium w-full sm:w-auto text-center">
                    Perbarui Data
                </button>
                <a href="{{ route('admin.jabatan.index') }}" class="bg-gray-200 text-black px-6 py-2 rounded hover:bg-gray-300 font-medium text-center w-full sm:w-auto">
                    Batal
                </a>
            </div>
        </div>
    </form>
</x-card>
@endsection
