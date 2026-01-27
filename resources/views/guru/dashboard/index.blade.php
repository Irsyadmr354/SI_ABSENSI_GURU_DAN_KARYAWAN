@extends('layouts.app')

@section('title', 'Dashboard Guru - SI Absensi')
@section('page_title', 'Dashboard Guru')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="bg-white border border-zinc-200 rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-zinc-900/5 rounded-full -mr-20 -mt-20"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold text-zinc-900 tracking-tight">Halo, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h2>
                <p class="mt-2 text-zinc-500 text-lg">Siap memberikan ilmu terbaik hari ini?</p>
            </div>
            <div class="bg-zinc-50 px-5 py-3 rounded-2xl border border-zinc-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-zinc-900 shadow-sm border border-zinc-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <label class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Waktu Server</label>
                    <p class="text-2xl font-mono font-bold text-zinc-900 leading-none" id="live-clock">{{ now()->format('H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Status Card -->
        <div class="xl:col-span-1 space-y-6">
            <h3 class="text-lg font-bold text-zinc-900">Status Kehadiran</h3>
            
            <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
                @if($absensiHariIni)
                    <div class="flex items-center justify-between p-4 bg-zinc-50 rounded-xl mb-6 border border-zinc-100">
                        <span class="text-sm font-medium text-zinc-500">Status Hari Ini</span>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $absensiHariIni->status == 'hadir' ? 'bg-emerald-500' : 'bg-zinc-400' }}"></span>
                            <span class="text-sm font-bold text-zinc-900 uppercase">{{ $absensiHariIni->status }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="p-4 bg-white border border-zinc-100 rounded-xl text-center shadow-sm">
                            <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wide mb-1">Masuk</p>
                            <p class="text-2xl font-bold text-zinc-900">{{ $absensiHariIni->jam_masuk ? \Carbon\Carbon::parse($absensiHariIni->jam_masuk)->format('H:i') : '--:--' }}</p>
                        </div>
                        <div class="p-4 bg-white border border-zinc-100 rounded-xl text-center shadow-sm">
                            <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wide mb-1">Pulang</p>
                            <p class="text-2xl font-bold text-zinc-900">{{ $absensiHariIni->jam_pulang ? \Carbon\Carbon::parse($absensiHariIni->jam_pulang)->format('H:i') : '--:--' }}</p>
                        </div>
                    </div>

                    @if($absensiHariIni->terlambat !== null)
                    <div class="p-4 bg-amber-50 border border-amber-100 rounded-xl flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2 text-amber-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span class="text-sm font-semibold">Terlambat</span>
                        </div>
                        <span class="text-sm font-bold text-amber-800">{{ $absensiHariIni->terlambat_deskripsi }}</span>
                    </div>
                    @endif

                    @if(!$absensiHariIni->jam_pulang && $absensiHariIni->jam_masuk)
                    <a href="{{ route('guru.absensi.index') }}" class="w-full flex justify-center items-center py-3.5 px-4 bg-zinc-900 text-white rounded-xl font-semibold hover:bg-black transition-all shadow-lg active:scale-[0.98]">
                        Lakukan Check Out
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                    </a>
                    @endif
                @else
                    <div class="text-center py-8">
                        <div class="w-20 h-20 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-zinc-100">
                            <svg class="w-10 h-10 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="text-lg font-bold text-zinc-900">Belum Check-In</h4>
                        <p class="text-zinc-500 text-sm mb-6">Mulai hari anda dengan mencatat kehadiran.</p>
                        
                        <a href="{{ route('guru.absensi.index') }}" class="w-full flex justify-center items-center py-3.5 px-4 bg-zinc-900 text-white rounded-xl font-semibold hover:bg-black transition-all shadow-lg active:scale-[0.98]">
                            Check In Sekarang
                        </a>
                    </div>
                @endif
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
                <h4 class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Info Penting
                </h4>
                <p class="text-sm text-blue-800 font-medium">Jangan lupa untuk melakukan Check-Out sebelum meninggalkan sekolah agar jam kerja tercatat akurat.</p>
            </div>
        </div>

        <!-- History Table -->
        <div class="xl:col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-zinc-900">Aktivitas Terakhir</h3>
                <a href="{{ route('guru.absensi.riwayat') }}" class="text-sm font-semibold text-zinc-600 hover:text-zinc-900 flex items-center gap-1 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-zinc-50 border-b border-zinc-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jam Masuk</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jam Pulang</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            @forelse($riwayatAbsensi as $r)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-zinc-900">{{ $r->tanggal->format('d M') }}</span>
                                        <span class="text-xs text-zinc-500">{{ $r->tanggal->format('Y') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-mono text-zinc-600 bg-zinc-100 px-2 py-1 rounded">{{ $r->jam_masuk ? \Carbon\Carbon::parse($r->jam_masuk)->format('H:i') : '--:--' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-mono text-zinc-600 bg-zinc-100 px-2 py-1 rounded">{{ $r->jam_pulang ? \Carbon\Carbon::parse($r->jam_pulang)->format('H:i') : '--:--' }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $r->status == 'hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-100 text-zinc-800' }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="mx-auto w-12 h-12 bg-zinc-50 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    </div>
                                    <p class="text-sm font-medium text-zinc-900">Belum ada riwayat</p>
                                    <p class="text-xs text-zinc-500">Data absensi akan muncul di sini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Live Clock Update
    setInterval(() => {
        const timeElement = document.getElementById('live-clock');
        if (timeElement) {
            timeElement.textContent = new Date().toLocaleTimeString('id-ID');
        }
    }, 1000);
</script>
@endsection
