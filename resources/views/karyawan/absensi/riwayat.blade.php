@extends('layouts.app')

@section('title', 'Riwayat Absensi')
@section('page_title', 'Riwayat Absensi')

@section('content')
<form method="GET" action="{{ route('karyawan.absensi.riwayat') }}" class="mb-4 space-y-4 bg-white p-4 border border-gray-200 rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-black mb-1">Tanggal Dari</label>
            <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-black mb-1">Tanggal Sampai</label>
            <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
    </div>
    <div class="flex space-x-2">
        <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Filter</button>
        <a href="{{ route('karyawan.absensi.riwayat') }}" class="bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300">Reset</a>
    </div>
</form>

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
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
            @forelse($riwayat as $r)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->tanggal->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->jam_masuk ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->jam_pulang ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 py-1 rounded {{ $r->status == 'hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($r->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $r->terlambat ? $r->terlambat . ' menit' : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $riwayat->links() }}
</div>
@endsection
