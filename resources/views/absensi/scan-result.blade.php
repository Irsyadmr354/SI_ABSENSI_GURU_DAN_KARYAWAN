<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Absensi - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-zinc-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden relative">
        @if(isset($status) && $status === 'success')
            <!-- Success State -->
            <div class="bg-emerald-500 h-32 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-white/10 skew-y-6 transform origin-bottom-left"></div>
                <div class="p-4 bg-white/20 backdrop-blur-sm rounded-full animate-bounce">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            
            <div class="p-8 text-center space-y-6">
                <div>
                    <h2 class="text-2xl font-black text-zinc-900">Berhasil Absen!</h2>
                    <p class="text-zinc-500 font-medium text-sm mt-1">Data kehadiran Anda telah tercatat.</p>
                </div>

                <div class="bg-zinc-50 rounded-2xl p-5 border border-zinc-100 space-y-3">
                    <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-zinc-100 shadow-sm">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">Tipe</span>
                        <span class="text-xs font-black text-emerald-600 uppercase tracking-wider">
                            {{ $type ?? 'Hadir' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-zinc-100 shadow-sm">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">Waktu</span>
                        <span class="text-2xl font-mono font-bold text-zinc-900">
                            {{ $time ?? '--:--' }}
                        </span>
                    </div>

                    @if(isset($terlambat) && $terlambat)
                    <div class="bg-red-50 text-red-600 p-3 rounded-xl text-xs font-bold border border-red-100 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Terlambat {{ $terlambat }}
                    </div> 
                    @endif
                </div>

                <div class="mt-8"></div>
            </div>

        @elseif(isset($status) && $status === 'error')
            <!-- Error State -->
            <div class="bg-red-500 h-32 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-white/10 -skew-y-6 transform origin-bottom-right"></div>
                <div class="p-4 bg-white/20 backdrop-blur-sm rounded-full">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
            
            <div class="p-8 text-center space-y-6">
                <div>
                    <h2 class="text-2xl font-black text-zinc-900">Gagal Absen</h2>
                    <p class="text-zinc-500 font-medium text-sm mt-1">Terjadi kesalahan pada proses absensi.</p>
                </div>

                <div class="bg-red-50 text-red-600 px-5 py-4 rounded-2xl text-sm font-bold border border-red-100 leading-relaxed">
                    {{ $message ?? 'Silakan coba lagi beberapa saat lagi.' }}
                </div>

                <div class="mt-8"></div>
            </div>

        @else
            <!-- Info State -->
            <div class="bg-blue-500 h-32 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-white/10 skew-y-6 transform origin-bottom-left"></div>
                <svg class="w-12 h-12 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            
            <div class="p-8 text-center space-y-6">
                <div>
                    <h2 class="text-2xl font-black text-zinc-900">Informasi</h2>
                    <p class="text-zinc-500 font-medium text-sm mt-1">{{ $message ?? 'Status absensi.' }}</p>
                </div>
            </div>
        @endif
        
        <div class="bg-zinc-50 p-4 text-center border-t border-zinc-100">
             <p class="text-[10px] uppercase font-bold tracking-widest text-zinc-400">Secure Attendance System</p>
        </div>
    </div>

</body>
</html>
