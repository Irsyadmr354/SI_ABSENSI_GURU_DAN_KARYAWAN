@auth
<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-black text-white min-h-screen md:min-h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex-shrink-0">
    <div class="p-4 md:p-6 h-full overflow-y-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-xl font-bold">SI ABSENSI</h1>
            <button id="close-sidebar" class="md:hidden text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <nav class="space-y-2">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.guru.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.guru.*') ? 'bg-gray-800' : '' }}">
                    Data Guru
                </a>
                <a href="{{ route('admin.karyawan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.karyawan.*') ? 'bg-gray-800' : '' }}">
                    Data Karyawan
                </a>
                <a href="{{ route('admin.jabatan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.jabatan.*') ? 'bg-gray-800' : '' }}">
                    Data Jabatan
                </a>
                <a href="{{ route('admin.jam-kerja.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.jam-kerja.*') ? 'bg-gray-800' : '' }}">
                    Jam Kerja
                </a>
                <a href="{{ route('admin.absensi.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.absensi.*') ? 'bg-gray-800' : '' }}">
                    Absensi
                </a>
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                    Manajemen User
                </a>
            @elseif(auth()->user()->isGuru())
                <a href="{{ route('guru.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('guru.dashboard') ? 'bg-gray-800' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('guru.absensi.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('guru.absensi.*') ? 'bg-gray-800' : '' }}">
                    Absensi
                </a>
                <a href="{{ route('guru.absensi.riwayat') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('guru.absensi.riwayat') ? 'bg-gray-800' : '' }}">
                    Riwayat Absensi
                </a>
            @elseif(auth()->user()->isKaryawan())
                <a href="{{ route('karyawan.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('karyawan.dashboard') ? 'bg-gray-800' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('karyawan.absensi.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('karyawan.absensi.*') ? 'bg-gray-800' : '' }}">
                    Absensi
                </a>
                <a href="{{ route('karyawan.absensi.riwayat') }}" class="block px-4 py-2 rounded hover:bg-gray-800 transition-colors {{ request()->routeIs('karyawan.absensi.riwayat') ? 'bg-gray-800' : '' }}">
                    Riwayat Absensi
                </a>
            @endif
        </nav>
    </div>
</aside>

<script>
    // Close sidebar when close button clicked
    document.addEventListener('DOMContentLoaded', function() {
        const closeButton = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                if (overlay) {
                    overlay.classList.add('hidden');
                }
            });
        }
    });
</script>
@endauth
