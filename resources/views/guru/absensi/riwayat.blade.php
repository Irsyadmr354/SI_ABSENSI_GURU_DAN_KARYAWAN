@extends('layouts.app')

@section('title', 'Riwayat Absensi - SI Absensi')
@section('page_title', 'Riwayat Kehadiran')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-zinc-900">Riwayat Absensi</h2>
            <p class="text-sm text-zinc-500 mt-1">Rekapitulasi kehadiran Anda.</p>
        </div>
        <a href="{{ route('guru.absensi.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Absensi
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
        <form method="GET" action="{{ route('guru.absensi.riwayat') }}" class="flex flex-col md:flex-row items-end gap-4">
            <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Dari Tanggal</label>
                    <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                        class="w-full px-4 py-2 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Sampai Tanggal</label>
                    <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                        class="w-full px-4 py-2 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm">
                </div>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="flex-1 md:flex-none px-6 py-2.5 bg-zinc-900 text-white rounded-xl font-bold text-sm shadow-md hover:bg-black transition-all">
                    Filter
                </button>
                <a href="{{ route('guru.absensi.riwayat') }}" class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-700 rounded-xl font-bold text-sm hover:bg-zinc-50 transition-all text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 border-b border-zinc-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jam Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jam Pulang</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-zinc-500 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($riwayat as $r)
                        <tr class="hover:bg-zinc-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-zinc-900">{{ $r->tanggal->format('d F Y') }}</span>
                                    <span class="text-xs text-zinc-500">{{ $r->tanggal->isoFormat('dddd') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-mono text-zinc-600 bg-zinc-100 px-2 py-1 rounded">{{ $r->jam_masuk ?? '--:--' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-mono text-zinc-600 bg-zinc-100 px-2 py-1 rounded">{{ $r->jam_pulang ?? '--:--' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'hadir' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'izin' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'sakit' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'alpha' => 'bg-red-50 text-red-700 border-red-100',
                                    ];
                                    $class = $statusClasses[$r->status] ?? 'bg-zinc-50 text-zinc-700 border-zinc-100';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium border {{ $class }}">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($r->terlambat > 0)
                                    <span class="text-xs font-semibold text-red-600">
                                        Terlambat {{ $r->terlambat }} menit
                                    </span>
                                @elseif($r->status == 'hadir')
                                    <span class="text-xs font-semibold text-emerald-600">
                                        Tepat Waktu
                                    </span>
                                @else
                                    <span class="text-xs text-zinc-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="mx-auto w-12 h-12 bg-zinc-50 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="text-sm font-medium text-zinc-900">Belum ada riwayat absensi</p>
                                <p class="text-xs text-zinc-500">Data kehadiran Anda akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($riwayat->hasPages())
        <div class="flex justify-center pt-4">
            {{ $riwayat->links() }}
        </div>
    @endif
</div>
@endsection
