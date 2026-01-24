<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI Absensi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .pattern-grid {
            background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(90deg, currentColor 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="min-h-screen bg-white text-zinc-900 grid lg:grid-cols-2">
    
    <!-- Left Section (Branding & Visuals) -->
    <div class="relative hidden lg:flex flex-col justify-between p-12 bg-zinc-900 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 text-zinc-800 opacity-20 pattern-grid"></div>
        <div class="absolute inset-0 bg-linear-to-t from-zinc-900 via-transparent to-transparent"></div>
        
        <!-- Decoration Circles -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-zinc-800 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-linear-to-t from-black to-transparent opacity-80"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-zinc-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <span class="text-xl font-bold tracking-tight">SI ABSENSI</span>
            </div>
        </div>

        <div class="relative z-10 mb-12">
            <h1 class="text-5xl font-bold mb-6 leading-tight">Manajemen Absensi <br>Yang <span class="text-zinc-400">Efisien.</span></h1>
            <p class="text-lg text-zinc-400 max-w-md">Platform terintegrasi untuk mencatat kehadiran guru dan karyawan secara realtime, akurat, dan profesional.</p>
        </div>

        <div class="relative z-10 flex items-center gap-4 text-sm text-zinc-500 font-medium">
            <span>&copy; {{ date('Y') }} Platform Absensi</span>
            <div class="h-1 w-1 bg-zinc-700 rounded-full"></div>
            <span>v1.0.0</span>
        </div>
    </div>

    <!-- Right Section (Form) -->
    <div class="flex items-center justify-center p-8 bg-zinc-50">
        <div class="w-full max-w-md bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-zinc-100">
            <div class="mb-10 text-center lg:text-left">
                <div class="lg:hidden flex justify-center mb-6">
                    <div class="w-12 h-12 bg-zinc-900 rounded-xl flex items-center justify-center text-white">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-zinc-900 mb-2">Selamat Datang!</h2>
                <p class="text-zinc-500">Silakan masuk untuk mengakses dashboard anda.</p>
            </div>

            @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 text-emerald-700 animate-fade-in-down">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3.5 bg-zinc-50 border border-zinc-200 text-zinc-900 rounded-xl focus:ring-2 focus:ring-black focus:border-black transition-all outline-none pl-11 group-hover:bg-white"
                            placeholder="nama@email.com">
                        <svg class="w-5 h-5 text-zinc-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-zinc-700">Password</label>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" required
                            class="w-full px-4 py-3.5 bg-zinc-50 border border-zinc-200 text-zinc-900 rounded-xl focus:ring-2 focus:ring-black focus:border-black transition-all outline-none pl-11"
                            placeholder="••••••••">
                        <svg class="w-5 h-5 text-zinc-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-5 h-5 rounded border-zinc-300 text-black focus:ring-black transition-colors">
                        <span class="text-sm text-zinc-600 group-hover:text-black transition-colors">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-zinc-900 text-white font-bold py-4 rounded-xl hover:bg-black hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <span>Masuk Dashboard</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-zinc-100 text-center">
                <p class="text-zinc-500">Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-zinc-900 hover:underline">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</body>
</html>
