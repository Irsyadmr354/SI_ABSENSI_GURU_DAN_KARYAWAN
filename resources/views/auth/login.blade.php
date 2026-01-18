<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="max-w-md w-full space-y-8 p-4 md:p-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-black">Sistem Absensi</h2>
                <p class="mt-2 text-gray-600">Guru dan Karyawan</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6 border border-gray-200 p-8 rounded-lg">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input id="email" name="email" type="email" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-black">Password</label>
                    <input id="password" name="password" type="password" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                           class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-black">Ingat saya</label>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Login
                </button>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-black">Belum punya akun? Daftar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
