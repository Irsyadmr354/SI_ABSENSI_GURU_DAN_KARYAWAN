@auth
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-zinc-200 px-4 md:px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <!-- Mobile menu button -->
                <button id="mobile-menu-button"
                    class="md:hidden text-zinc-500 hover:text-zinc-900 focus:outline-none transition-colors p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <div>
                    <h2 class="text-lg font-bold text-zinc-900 tracking-tight">@yield('page_title', 'Dashboard')</h2>
                    <p class="text-xs text-zinc-500 hidden md:flex items-center gap-2 mt-0.5 font-medium">
                        <span>{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
                        <span class="w-1 h-1 bg-zinc-300 rounded-full"></span>
                        <span id="current-time" class="font-mono text-zinc-400">{{ now()->format('H:i:s') }}</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <!-- User Info -->
                <div class="hidden sm:flex items-center gap-3 pl-4 border-l border-zinc-100">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-zinc-900 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-zinc-500 mt-1">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                     <div class="w-10 h-10 bg-zinc-100 rounded-full flex items-center justify-center text-zinc-900 font-bold border border-zinc-200">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-zinc-400 hover:bg-red-50 hover:text-red-500 transition-all" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <script>
        // Update time every second
        setInterval(() => {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                timeElement.textContent = `${hours}:${minutes}:${seconds}`;
            }
        }, 1000);
    </script>
@endauth
