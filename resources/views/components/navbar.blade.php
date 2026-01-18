@auth
<nav class="bg-white border-b border-gray-200 px-4 md:px-6 py-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="md:hidden text-black hover:text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <div>
                <h2 class="text-base md:text-lg font-semibold text-black">@yield('page_title', 'Dashboard')</h2>
                <p class="text-xs text-gray-500 mt-1 hidden md:block">Sistem Informasi Absensi Guru dan Karyawan</p>
            </div>
        </div>
        
        <div class="flex items-center space-x-2 md:space-x-4">
            <div class="text-right hidden sm:block">
                <p class="text-xs text-gray-600">Login sebagai</p>
                <p class="text-sm font-medium text-black">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500 hidden md:block">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-black hover:underline text-sm font-medium px-2 md:px-0">Logout</button>
            </form>
        </div>
    </div>
</nav>
@endauth
