@extends('layouts.app')

@section('title', 'Terminal Absensi QR - SI Absensi')
@section('page_title', 'Terminal Absensi')

@section('content')
<div class="min-h-screen bg-zinc-950 flex flex-col items-center justify-center p-4 relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[70vh] h-[70vh] rounded-full bg-purple-500/10 blur-[100px]"></div>
        <div class="absolute top-[40%] -right-[10%] w-[60vh] h-[60vh] rounded-full bg-blue-500/10 blur-[100px]"></div>
    </div>

    <!-- Main Content -->
    <div class="text-center space-y-8 relative z-10 w-full max-w-2xl">
        <!-- Header -->
        <div class="space-y-4">
            <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight">
                ABSENSI SCAN
            </h1>
            <p class="text-xl text-zinc-400 font-medium">
                Silakan scan QR Code di bawah ini untuk melakukan Check-In atau Check-Out
            </p>
        </div>

        <!-- Clock -->
        <div class="inline-block px-8 py-3 bg-white/5 backdrop-blur-md border border-white/10 rounded-full">
            <h2 id="terminal-clock" class="text-3xl font-mono font-bold text-white tracking-widest">
                --:--:--
            </h2>
        </div>

        <!-- QR Display -->
        <div class="relative group">
            <div class="absolute inset-0 bg-linear-to-r from-purple-500 to-blue-500 rounded-3xl blur opacity-25 group-hover:opacity-50 transition-opacity duration-500"></div>
            
            <div class="relative bg-white p-8 rounded-3xl shadow-2xl mx-auto w-full max-w-100 aspect-square flex items-center justify-center overflow-hidden">
                <div id="qr-loading" class="absolute inset-0 flex items-center justify-center bg-white z-20">
                    <div class="w-12 h-12 border-4 border-zinc-200 border-t-zinc-900 rounded-full animate-spin"></div>
                </div>
                
                <div id="qr-container" class="w-full h-full flex items-center justify-center">
                    <!-- QR Code will be injected here -->
                </div>

                <!-- Progress Bar -->
                <div class="absolute bottom-0 left-0 w-full h-2 bg-zinc-100">
                    <div id="progress-bar" class="h-full bg-zinc-900 transition-all duration-100 ease-linear w-full"></div>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="flex items-center justify-center gap-2 text-sm font-medium text-zinc-500">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Terminal Aktif & Terhubung ke Server
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    // Clock
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour12: false });
        document.getElementById('terminal-clock').innerText = timeString;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // QR Logic
    let qrCodeObj = null;
    const qrContainer = document.getElementById('qr-container');
    const loadingOverlay = document.getElementById('qr-loading');
    const progressBar = document.getElementById('progress-bar');
    
    // Refresh interval in seconds
    const refreshInterval = 5; 
    let timeLeft = refreshInterval;

    const ngrokBaseUrl = "https://postdiscoidal-chargeful-tera.ngrok-free.dev/absensi/scan/";

    async function fetchNewToken() {
        try {
            const response = await fetch("{{ route('admin.absensi.get-qr') }}");
            const data = await response.json();
            
            if (data.token) {
                // Combine Base URL with Token
                const fullUrl = ngrokBaseUrl + data.token;
                renderQR(fullUrl);
                resetTimer();
            }
        } catch (error) {
            console.error('Error fetching token:', error);
        } finally {
            loadingOverlay.classList.add('hidden');
        }
    }

    function renderQR(token) {
        qrContainer.innerHTML = ''; // Clear previous
        qrCodeObj = new QRCode(qrContainer, {
            text: token,
            width: 300,
            height: 300,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    }

    function resetTimer() {
        timeLeft = refreshInterval;
        progressBar.style.width = '100%';
        // Force reflow
        void progressBar.offsetWidth;
        progressBar.style.transition = `width ${refreshInterval}s linear`;
        progressBar.style.width = '0%';
    }

    // Initial fetch
    fetchNewToken();

    // Periodic fetch
    setInterval(() => {
        fetchNewToken();
    }, refreshInterval * 1000);

</script>
@endsection
