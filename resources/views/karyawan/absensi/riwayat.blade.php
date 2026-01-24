@extends('layouts.app')

@section('title', 'Log Absensi - SI Absensi')
@section('page_title', 'Arsip Personal')

@section('content')
    <div class="space-y-8 animate-in fade-in duration-700">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1 text-left">
                <h2
                    class="text-4xl font-black text-black tracking-tight uppercase italic leading-none underline decoration-8 decoration-gray-200">
                    Arsip Kehadiran</h2>
                <p class="text-gray-400 font-bold text-sm uppercase tracking-widest mt-4">Record data Presensi Digital
                    Karyawan</p>
            </div>
            <a href="{{ route('karyawan.absensi.index') }}"
                class="group inline-flex items-center text-xs font-black uppercase tracking-[0.2em] text-black">
                <svg class="w-5 h-5 mr-1 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Terminal
            </a>
        </div>

        <!-- Filter Section -->
        <div class="bg-white border-2 border-black rounded-[2.5rem] p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <form method="GET" action="{{ route('karyawan.absensi.riwayat') }}"
                class="flex flex-col md:flex-row items-end gap-6">
                <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 italic">Mulai
                            Tanggal</label>
                        <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                            class="w-full px-5 py-3 border-2 border-gray-100 rounded-xl focus:border-black transition-all font-black text-xs uppercase italic bg-gray-50">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 italic">Sampai
                            Tanggal</label>
                        <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                            class="w-full px-5 py-3 border-2 border-gray-100 rounded-xl focus:border-black transition-all font-black text-xs uppercase italic bg-gray-50">
                    </div>
                </div>
                <div class="flex gap-3 w-full md:w-auto">
                    <button type="submit"
                        class="flex-1 md:flex-none px-8 py-3.5 bg-black text-white rounded-xl font-black uppercase tracking-widest text-[9px] shadow-lg hover:scale-[1.02] active:scale-95 transition-all">
                        Filter Record
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div
            class="bg-white border-4 border-black rounded-[2.5rem] shadow-[12px_12px_0px_0px_rgba(0,0,0,0.05)] overflow-hidden">
            <div class="overflow-x-auto text-left">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-black text-white text-left">
                            <th class="px-8 py-6 text-[9px] font-black uppercase tracking-[0.3em]">Waktu / Hari</th>
                            <th class="px-8 py-6 text-[9px] font-black uppercase tracking-[0.3em]">Check-In</th>
                            <th class="px-8 py-6 text-[9px] font-black uppercase tracking-[0.3em]">Check-Out</th>
                            <th class="px-8 py-6 text-[9px] font-black uppercase tracking-[0.3em]">Log</th>
                            <th class="px-8 py-6 text-[9px] font-black uppercase tracking-[0.3em] text-right">Lama Kerja
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-100">
                        @forelse($riwayat as $r)
                            <tr class="group hover:bg-gray-50 transition-all duration-150">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-black leading-none italic">
                                        {{ $r->tanggal->format('d M, Y') }}</p>
                                    <p class="text-[10px] font-bold text-gray-300 uppercase mt-1 italic tracking-tighter">
                                        {{ $r->tanggal->isoFormat('dddd') }}</p>
                                </td>
                                <td class="px-8 py-6 font-black text-xs italic">{{ $r->jam_masuk ?? '--:--' }}</td>
                                <td class="px-8 py-6 font-black text-xs italic">{{ $r->jam_pulang ?? '--:--' }}</td>
                                <td class="px-8 py-6">
                                    <span
                                        class="inline-flex items-center px-4 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-[0.2em] border-2 border-black {{ $r->status == 'hadir' ? 'bg-black text-white' : 'bg-gray-100 text-black shadow-inner' }}">
                                        {{ $r->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right font-black italic text-xs">
                                    @if($r->jam_masuk && $r->jam_pulang)
                                        @php
                                            $in = \Carbon\Carbon::parse($r->jam_masuk);
                                            $out = \Carbon\Carbon::parse($r->jam_pulang);
                                            $diff = $in->diffInHours($out);
                                        @endphp
                                        {{ $diff }} Jam
                                    @else
                                        <span class="text-gray-200">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-32 text-center bg-gray-50 border-t-4 border-black border-dashed">
                                    <h4
                                        class="text-2xl font-black text-black uppercase italic decoration-gray-200 underline decoration-4 underline-offset-4">
                                        Record Tidak Ditemukan</h4>
                                    <p
                                        class="text-gray-400 font-bold max-w-sm mx-auto mt-4 px-6 text-xs uppercase tracking-widest leading-relaxed">
                                        Silakan sesuaikan filter tanggal atau lakukan absensi pertama Anda hari ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($riwayat->hasPages())
            <div class="flex justify-center pb-12">
                {{ $riwayat->links() }}
            </div>
        @endif
    </div>
@endsection
