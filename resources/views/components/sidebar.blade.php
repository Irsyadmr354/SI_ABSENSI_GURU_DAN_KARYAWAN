@auth
    <!-- Mobile Overlay -->
    <div id="sidebar-overlay"
        class="hidden fixed inset-0 bg-zinc-900/50 backdrop-blur-sm z-40 md:hidden transition-opacity"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed md:static inset-y-0 left-0 z-50 w-72 bg-white border-r border-zinc-200 min-h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shrink-0 flex flex-col">
        
        <!-- Header -->
        <div class="p-6 border-b border-zinc-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-zinc-900 rounded-lg flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <div>
                    <h1 class="font-bold text-zinc-900 tracking-tight">SI ABSENSI</h1>
                    <p class="text-xs text-zinc-500 font-medium">Enterprise System</p>
                </div>
            </div>
            <button id="close-sidebar" class="md:hidden text-zinc-400 hover:text-zinc-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-1">
            @if(auth()->user()->isAdmin())
                <div class="px-3 mb-2 mt-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Dashboard</div>
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Overview
                </a>

                <div class="px-3 mb-2 mt-6 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Data Master</div>
                
                <a href="{{ route('admin.guru.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('admin.guru.*') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.guru.*') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Data Guru
                </a>
                <a href="{{ route('admin.karyawan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('admin.karyawan.*') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.karyawan.*') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Data Karyawan
                </a>
                <a href="{{ route('admin.jabatan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('admin.jabatan.*') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.jabatan.*') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Data Jabatan
                </a>
                <a href="{{ route('admin.jam-kerja.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('admin.jam-kerja.*') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.jam-kerja.*') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Jam Kerja
                </a>

                <div class="px-3 mb-2 mt-6 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Administrasi</div>

                <a href="{{ route('admin.absensi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('admin.absensi.*') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.absensi.*') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Rekap Absensi
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('admin.users.*') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manajemen User
                </a>

            @elseif(auth()->user()->isGuru())
                <div class="px-3 mb-2 mt-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Aktivitas</div>
                
                <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('guru.dashboard') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('guru.dashboard') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('guru.absensi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('guru.absensi.index') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('guru.absensi.index') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Absensi Sekarang
                </a>
                <a href="{{ route('guru.absensi.riwayat') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('guru.absensi.riwayat') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('guru.absensi.riwayat') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Riwayat Kehadiran
                </a>

            @elseif(auth()->user()->isKaryawan())
                 <div class="px-3 mb-2 mt-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Aktivitas</div>
                
                <a href="{{ route('karyawan.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('karyawan.dashboard') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('karyawan.dashboard') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('karyawan.absensi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('karyawan.absensi.index') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('karyawan.absensi.index') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Absensi Sekarang
                </a>
                <a href="{{ route('karyawan.absensi.riwayat') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-all group {{ request()->routeIs('karyawan.absensi.riwayat') ? 'bg-zinc-900 text-white shadow-md' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('karyawan.absensi.riwayat') ? 'text-zinc-300' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Riwayat Kehadiran
                </a>
            @endif
        </nav>

        <!-- Profile Footer -->
        <div class="p-4 border-t border-zinc-100">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-zinc-50 transition-colors cursor-default">
                <div class="w-10 h-10 bg-zinc-100 rounded-full flex items-center justify-center text-zinc-900 font-bold border border-zinc-200">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-zinc-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-zinc-500 truncate">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
        </div>
    </aside>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const closeButton = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (closeButton) {
                closeButton.addEventListener('click', function () {
                    sidebar.classList.add('-translate-x-full');
                    if (overlay) overlay.classList.add('hidden');
                });
            }
        });
    </script>
@endauth
