<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SI Absensi</title>
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
    
    <!-- Left Section (Branding) -->
    <div class="relative hidden lg:flex flex-col justify-between p-12 bg-zinc-900 text-white overflow-hidden">
        <div class="absolute inset-0 text-zinc-800 opacity-20 pattern-grid"></div>
        <div class="absolute inset-0 bg-linear-to-t from-zinc-900 via-transparent to-transparent"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-zinc-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <span class="text-xl font-bold tracking-tight">SI ABSENSI</span>
            </div>
        </div>

        <div class="relative z-10 mb-12">
            <h1 class="text-5xl font-bold mb-6 leading-tight">Bergabunglah <br>Bersama <span class="text-zinc-400">Kami.</span></h1>
            <p class="text-lg text-zinc-400 max-w-md">Daftarkan akun anda untuk mulai menggunakan sistem absensi terintegrasi.</p>
        </div>

        <div class="relative z-10 flex items-center gap-4 text-sm text-zinc-500 font-medium">
            <span>&copy; {{ date('Y') }} Platform Absensi</span>
        </div>
    </div>

    <!-- Right Section (Form) -->
    <div class="flex items-center justify-center p-8 bg-zinc-50 overflow-y-auto">
        <div class="w-full max-w-md bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-zinc-100 my-auto">
            <div class="mb-8 text-center lg:text-left">
                 <div class="lg:hidden flex justify-center mb-6">
                    <div class="w-12 h-12 bg-zinc-900 rounded-xl flex items-center justify-center text-white">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-zinc-900 mb-2">Registrasi Akun</h2>
                <p class="text-zinc-500">Lengkapi data diri anda untuk mendaftar.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                        placeholder="Nama Anda">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                        placeholder="nama@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                        placeholder="Minimal 8 karakter">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all placeholder-zinc-400"
                        placeholder="Ulangi password">
                </div>
                
                <div class="pt-2">
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Daftar Sebagai</label>
                    <div class="grid grid-cols-2 gap-3">
                         <label class="cursor-pointer">
                            <input type="radio" name="role" value="guru" class="peer sr-only" required>
                            <div class="p-3 rounded-xl border border-zinc-200 bg-white peer-checked:bg-zinc-900 peer-checked:text-white peer-checked:border-zinc-900 transition-all text-center">
                                <span class="text-sm font-medium">Guru</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="karyawan" class="peer sr-only">
                            <div class="p-3 rounded-xl border border-zinc-200 bg-white peer-checked:bg-zinc-900 peer-checked:text-white peer-checked:border-zinc-900 transition-all text-center">
                                <span class="text-sm font-medium">Karyawan</span>
                            </div>
                        </label>
                    </div>
                     @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-zinc-900 text-white font-bold py-3.5 rounded-xl hover:bg-black hover:scale-[1.01] active:scale-[0.99] transition-all shadow-lg flex items-center justify-center gap-2">
                        <span>Daftar Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-8 border-t border-zinc-100 text-center">
                <p class="text-zinc-500 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-zinc-900 hover:underline">Masuk disini</a></p>
            </div>
        </div>
    </div>
</body>
</html>
