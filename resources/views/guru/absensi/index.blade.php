 @extends('layouts.app')

@section('title', 'Absensi Online - SI Absensi')
@section('page_title', 'Terminal Kehadiran')

@section('content')
<div class="space-y-8">
    <!-- Header with Live Sync -->
    <div class="bg-zinc-900 text-white rounded-2xl p-8 shadow-lg relative overflow-hidden">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-white/10 rounded-full border border-white/10 backdrop-blur-sm">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-xs font-semibold tracking-wide">Sistem Online & Terkoneksi</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight">
                    {{ now()->isoFormat('dddd, D MMMM Y') }}
                </h2>
            </div>

            <div class="text-right hidden sm:block">
                <p class="text-xs font-semibold tracking-widest text-zinc-400 mb-1 uppercase">Waktu Server</p>
                <p class="text-5xl font-mono font-bold tracking-tight" id="huge-clock">
                    {{ now()->format('H:i') }}<span class="text-zinc-500 text-3xl">:{{ now()->format('s') }}</span>
                </p>
            </div>
        </div>

        <!-- Decoration -->
        <div class="absolute -right-20 -bottom-32 opacity-10 pointer-events-none">
            <svg class="w-96 h-96" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
            </svg>
        </div>
    </div>

    <!-- Main Interaction Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Punch Section (Important) -->
        <div class="xl:col-span-2 space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-zinc-100 flex items-center justify-center text-zinc-900 border border-zinc-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.232l-3.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900">Terminal Presensi</h3>
            </div>

            <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="bg-zinc-50 border-b border-zinc-200 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-1">Jadwal Aktif</p>
                        <h4 class="text-lg font-bold text-zinc-900">
                            {{ $jamKerja ? $jamKerja->nama : 'Jadwal Default' }}
                        </h4>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="px-4 py-2 border border-zinc-200 rounded-lg bg-white shadow-sm">
                            <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider text-center mb-0.5">Masuk</p>
                            <p class="font-mono font-bold text-zinc-900 text-center">
                                {{ $jamKerja ? \Carbon\Carbon::parse($jamKerja->jam_masuk)->format('H:i') : '--:--' }}
                            </p>
                        </div>
                        <div class="px-4 py-2 border border-zinc-200 rounded-lg bg-white shadow-sm">
                            <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider text-center mb-0.5">Pulang</p>
                            <p class="font-mono font-bold text-zinc-900 text-center">
                                {{ $jamKerja ? \Carbon\Carbon::parse($jamKerja->jam_pulang)->format('H:i') : '--:--' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    @if($absensiHariIni && $absensiHariIni->jam_masuk)
                        <div class="space-y-8">
                            <!-- Status Dashboard -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="p-6 border border-zinc-200 rounded-2xl bg-zinc-900 text-white relative overflow-hidden shadow-md group">
                                    <div class="relative z-10">
                                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-2">Waktu Check-In</p>
                                        <p class="text-3xl font-mono font-bold">
                                            {{ \Carbon\Carbon::parse($absensiHariIni->jam_masuk)->format('H:i') }}
                                        </p>
                                        @if($absensiHariIni->terlambat)
                                            <div class="mt-3 inline-flex items-center px-2.5 py-1 bg-red-500/20 border border-red-500/30 text-red-400 rounded-lg text-xs font-bold uppercase tracking-wide">
                                                {{ $absensiHariIni->terlambat_deskripsi }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="absolute -right-4 -bottom-4 text-zinc-800 opacity-20 group-hover:scale-110 transition-transform duration-500">
                                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
                                    </div>
                                </div>

                                <div class="p-6 border border-zinc-200 rounded-2xl bg-white text-zinc-900 relative overflow-hidden shadow-sm">
                                    <p class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">Waktu Check-Out</p>
                                    <p class="text-3xl font-mono font-bold">
                                        {{ $absensiHariIni->jam_pulang ? \Carbon\Carbon::parse($absensiHariIni->jam_pulang)->format('H:i') : '--:--' }}
                                    </p>
                                    @if(!$absensiHariIni->jam_pulang)
                                        <div class="mt-3 inline-flex items-center px-2.5 py-1 bg-zinc-100 rounded-lg text-xs font-bold uppercase text-zinc-500">
                                            Menunggu Check-Out
                                        </div>
                                    @else
                                        <div class="mt-3 inline-flex items-center px-2.5 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-lg text-xs font-bold uppercase">
                                            Selesai
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if(!$absensiHariIni->jam_pulang)
                                <div class="p-6 bg-zinc-50 border border-zinc-200 rounded-2xl text-center relative overflow-hidden group">
                                    <h4 class="text-lg font-bold text-zinc-900 mb-4">Scan untuk Check-Out</h4>
                                    
                                    <div class="flex justify-center mb-4">
                                        <div class="bg-white p-4 rounded-xl shadow-sm border border-zinc-200 relative">
                                            <div id="qrcode-out"></div>
                                            <!-- Loading Overlay -->
                                            <div id="loading-overlay-out" class="absolute inset-0 bg-white/90 flex items-center justify-center z-10 transition-opacity duration-300">
                                                <div class="w-8 h-8 border-4 border-zinc-200 border-t-zinc-900 rounded-full animate-spin"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p class="text-xs text-zinc-500 max-w-xs mx-auto">Scan QR Code ini menggunakan kamera HP Anda untuk melakukan absensi keluar.</p>
                                    
                                    <!-- Timer Bar -->
                                    <div class="absolute bottom-0 left-0 w-full h-1 bg-zinc-200">
                                        <div id="timer-bar-out" class="h-full bg-emerald-500 w-full transition-all ease-linear duration-1000"></div>
                                    </div>
                                </div>
                            @else
                                <div class="p-6 bg-zinc-50 border border-zinc-200 rounded-2xl text-center">
                                    <div class="w-12 h-12 bg-white border border-zinc-200 rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <h4 class="text-lg font-bold text-zinc-900">Absensi Selesai</h4>
                                    <p class="text-sm text-zinc-500 mt-1">Terima kasih atas dedikasi Anda hari ini.</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <div class="mb-6">
                                <h4 class="text-2xl font-bold text-zinc-900 mb-2">Absensi Kehadiran</h4>
                                <p class="text-zinc-500 text-sm max-w-sm mx-auto">Scan QR Code di bawah ini menggunakan kamera HP Anda untuk Check-In.</p>
                            </div>

                            <div class="flex justify-center mb-6">
                                <div class="bg-white p-6 rounded-2xl shadow-lg border border-zinc-100 relative group">
                                    <div id="qrcode-in"></div>
                                    <div id="loading-overlay-in" class="absolute inset-0 bg-white/90 flex items-center justify-center z-10 transition-opacity duration-300">
                                        <div class="w-10 h-10 border-4 border-zinc-200 border-t-zinc-900 rounded-full animate-spin"></div>
                                    </div>
                                    
                                    <!-- Scan corner markers -->
                                    <div class="absolute top-4 left-4 w-6 h-6 border-t-2 border-l-2 border-zinc-900 rounded-tl-lg"></div>
                                    <div class="absolute top-4 right-4 w-6 h-6 border-t-2 border-r-2 border-zinc-900 rounded-tr-lg"></div>
                                    <div class="absolute bottom-4 left-4 w-6 h-6 border-b-2 border-l-2 border-zinc-900 rounded-bl-lg"></div>
                                    <div class="absolute bottom-4 right-4 w-6 h-6 border-b-2 border-r-2 border-zinc-900 rounded-br-lg"></div>
                                </div>
                            </div>
                            
                            <div class="w-full max-w-md mx-auto h-1.5 bg-zinc-100 rounded-full overflow-hidden">
                                <div id="timer-bar-in" class="h-full bg-zinc-900 w-full transition-all ease-linear duration-1000"></div>
                            </div>
                            <p class="mt-2 text-xs font-mono text-zinc-400">Auto-refresh setiap 10 detik</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Request Leave Section -->
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-zinc-100 flex items-center justify-center text-zinc-900 border border-zinc-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900">Pengajuan Izin</h3>
            </div>

            <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
                <form action="{{ route('guru.absensi.ajukan-izin') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Tanggal</label>
                        <input type="date" name="tanggal" required min="{{ date('Y-m-d') }}"
                            value="{{ old('tanggal', date('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all font-medium text-sm">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Jenis Izin</label>
                        <div class="relative">
                            <select name="status" required class="w-full pl-4 pr-10 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all appearance-none cursor-pointer font-medium text-sm">
                                <option value="izin">IZIN / KEPERLUAN PRIBADI</option>
                                <option value="sakit">SAKIT / KENDALA KESEHATAN</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-zinc-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-500">Keterangan</label>
                        <textarea name="keterangan" required rows="4" placeholder="Jelaskan alasan pengajuan izin..."
                            class="w-full px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent resize-none text-sm transition-all">{{ old('keterangan') }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-zinc-100 text-zinc-900 border border-zinc-200 rounded-xl font-bold text-sm hover:bg-zinc-200 transition-all hover:shadow-sm">
                        Kirim Pengajuan
                    </button>
                </form>
            </div>

            <div class="p-6 bg-zinc-100 border border-zinc-200 rounded-2xl">
                <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3">Catatan Sistem</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <div class="w-1.5 h-1.5 bg-zinc-400 rounded-full mt-1.5 shrink-0"></div>
                        <p class="text-xs text-zinc-600 leading-relaxed">Data lokasi dan IP akan dicatat otomatis saat check-in untuk validasi kehadiran.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-1.5 h-1.5 bg-zinc-400 rounded-full mt-1.5 shrink-0"></div>
                        <p class="text-xs text-zinc-600 leading-relaxed">Pengajuan sakit wajib melampirkan surat dokter jika lebih dari 2 hari berturut-turut.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    // Configuration
    const checkInContainer = document.getElementById('qrcode-in');
    const checkOutContainer = document.getElementById('qrcode-out');
    // HARDCODED NGROK URL AS PER REQUEST TO FIX CSS/LINK ISSUES
    const ngrokBaseUrl = "https://postdiscoidal-chargeful-tera.ngrok-free.dev/absensi/scan/"; 
    const refreshInterval = 10000;
    
    async function updateQR() {
        // Determine mode based on element existence
        const mode = checkInContainer ? 'in' : (checkOutContainer ? 'out' : null);
        if (!mode) return;

        const container = mode === 'in' ? checkInContainer : checkOutContainer;
        const loader = document.getElementById(`loading-overlay-${mode}`);
        const timerBar = document.getElementById(`timer-bar-${mode}`);

        try {
             // Reset timer bar animation
             if(timerBar) {
                timerBar.style.transition = 'none';
                timerBar.style.width = '100%';
                void timerBar.offsetWidth; // trigger reflow
                timerBar.style.transition = `width ${refreshInterval}ms linear`;
                timerBar.style.width = '0%';
            }

            const response = await fetch("{{ route('absensi.get-qr-token') }}");
            const data = await response.json();
            
            if (data.token) {
                const fullUrl = ngrokBaseUrl + data.token;
                
                // Clear previous
                container.innerHTML = '';
                
                // Generate new
                new QRCode(container, {
                    text: fullUrl,
                    width: mode === 'in' ? 200 : 150,
                    height: mode === 'in' ? 200 : 150,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });

                if(loader) loader.classList.add('opacity-0');
            }
        } catch (error) {
            console.error('Error fetching token:', error);
        }
    }

    // Initial call
    document.addEventListener('DOMContentLoaded', () => {
        updateQR();
        setInterval(updateQR, refreshInterval);
    });

    // Clock
    setInterval(() => {
        const clockElem = document.getElementById('huge-clock');
        if (clockElem) {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            clockElem.innerHTML = `${h}:${m}<span class="text-zinc-500 text-3xl ml-1">:${s}</span>`;
        }
    }, 1000);
</script>
@endsection
