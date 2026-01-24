<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Absensi Guru dan Karyawan')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900">
    <div class="min-h-screen flex">
        @include('components.sidebar')
        
        <div class="flex-1 flex flex-col min-w-0">
            @include('components.navbar')
            
            <main class="flex-1 p-4 md:p-6 overflow-auto">
                @if(session('success'))
                    @include('components.alert', ['type' => 'success', 'message' => session('success')])
                @endif
                
                @if(session('error'))
                    @include('components.alert', ['type' => 'error', 'message' => session('error')])
                @endif

                @if(session('info'))
                    @include('components.alert', ['type' => 'info', 'message' => session('info')])
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    
    @yield('scripts')
    
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (menuButton) {
                menuButton.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    if (overlay) {
                        overlay.classList.toggle('hidden');
                    }
                });
            }
            
            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
