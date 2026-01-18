@extends('layouts.app')

@section('title', 'Edit Karyawan')
@section('page_title', 'Edit Data Karyawan')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-bold text-black">Edit Data Karyawan</h2>
    <p class="text-sm text-gray-600 mt-1">Perbarui informasi data karyawan: {{ $karyawan->nama }}</p>
</div>

<x-card>
    <form action="{{ route('admin.karyawan.update', $karyawan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <h3 class="text-md font-semibold text-black mb-4 border-b border-gray-200 pb-2">Informasi Akun</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-black mb-1">
                            Nama User <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" required value="{{ old('name', $karyawan->user->name) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                        <p class="text-xs text-gray-500 mt-1">Nama yang digunakan untuk login</p>
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" required value="{{ old('email', $karyawan->user->email) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                        <p class="text-xs text-gray-500 mt-1">Email untuk login (harus unik)</p>
                        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black mb-1">Password</label>
                        <input type="password" name="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                        <p class="text-xs text-gray-500 mt-1">Isi password baru jika ingin mengubah (minimal 8 karakter). Kosongkan jika tidak diubah.</p>
                        @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-md font-semibold text-black mb-4 border-b border-gray-200 pb-2">Informasi Karyawan</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-black mb-1">
                            NIP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nip" required value="{{ old('nip', $karyawan->nip) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                        <p class="text-xs text-gray-500 mt-1">Nomor Induk Pegawai (harus unik)</p>
                        @error('nip') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" required value="{{ old('nama', $karyawan->nama) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                        <p class="text-xs text-gray-500 mt-1">Nama lengkap karyawan</p>
                        @error('nama') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black mb-1">Jabatan</label>
                        <select name="jabatan_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                            <option value="">Pilih Jabatan (Opsional)</option>
                            @foreach($jabatan as $j)
                                <option value="{{ $j->id }}" {{ old('jabatan_id', $karyawan->jabatan_id) == $j->id ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih jabatan karyawan</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">{{ old('alamat', $karyawan->alamat) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Alamat tempat tinggal</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black mb-1">Nomor Telepon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp', $karyawan->no_telp) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-black focus:border-black">
                        <p class="text-xs text-gray-500 mt-1">Nomor telepon yang dapat dihubungi</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200 flex flex-col sm:flex-row gap-3 sm:space-x-4">
                <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 font-medium w-full sm:w-auto text-center">
                    Perbarui Data
                </button>
                <a href="{{ route('admin.karyawan.index') }}" class="bg-gray-200 text-black px-6 py-2 rounded hover:bg-gray-300 font-medium text-center w-full sm:w-auto">
                    Batal
                </a>
            </div>
        </div>
    </form>
</x-card>
@endsection
