<div x-data="{ open: false }">

    <div
        class="md:hidden flex items-center justify-between p-4 fixed top-0 inset-x-0 z-40 bg-white/60 backdrop-blur-lg border-b border-white/40 shadow-sm transition-all duration-300">
        <a href="{{ route('dashboard') }}"
            class="text-2xl font-extrabold tracking-tighter text-[#FCBF49] flex items-center"
            style="font-family: 'Montserrat', sans-serif;">
            NextProject<span class="text-black text-lg font-bold ml-1">Film</span>
        </a>
        <button @click="open = true"
            class="text-zinc-500 hover:text-zinc-900 focus:outline-none p-1 rounded-lg hover:bg-zinc-100/50 transition-colors">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
        style="display: none;" class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm md:hidden"></div>

    <nav :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 shadow-2xl md:shadow-none">

        <div class="h-20 flex items-center justify-between px-6 border-b border-zinc-800/60">
            <a href="{{ route('dashboard') }}"
                class="text-2xl font-extrabold tracking-tighter text-[#FCBF49] flex items-center"
                style="font-family: 'Montserrat', sans-serif;">
                NextProject<span class="text-white text-lg font-bold ml-1">Film</span>
            </a>
        </div>

        <div class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                {{ __('Dashboard') }}
            </a>

            @if (Auth::user()->role === 'admin')
                <div class="pt-4 pb-1">
                    <p class="px-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Menu Admin</p>
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('admin.users.index') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    {{ __('Pelanggan') }}
                </a>

                <a href="{{ route('admin.paket.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('admin.paket.index') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    {{ __('Paket Layanan') }}
                </a>

                <a href="{{ route('admin.portofolio.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('admin.portofolio.index') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    {{ __('Portofolio') }}
                </a>

                <a href="{{ route('admin.pemesanan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('admin.pemesanan.index') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    {{ __('Pemesanan Masuk') }}
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('admin.laporan.index') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    {{ __('Laporan') }}
                </a>
            @endif

            @if (Auth::user()->role !== 'admin')
                <div class="pt-4 pb-1">
                    <p class="px-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Menu Pelanggan</p>
                </div>

                <a href="{{ route('rekomendasi.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('rekomendasi.*') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    {{ __('Rekomendasi Paket') }}
                </a>

                <a href="{{ route('booking.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 {{ request()->routeIs('booking.index') ? 'bg-zinc-800 text-[#FCBF49] shadow-md scale-[1.02]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }}">
                    {{ __('Riwayat Booking') }}
                </a>
            @endif
        </div>

        <div class="p-4 border-t border-zinc-800/60 bg-zinc-950/40">
            <div class="px-4 mb-4">
                <div class="font-bold text-base text-white truncate flex items-center gap-1.5">
                    {{ Auth::user()->name }}
                    <span class="text-xs font-semibold text-[#FCBF49] bg-[#FCBF49]/10 px-2 py-0.5 rounded-md">
                        ({{ Auth::user()->role === 'admin' ? 'Admin' : 'Pelanggan' }})
                    </span>
                </div>
                <div class="font-medium text-sm text-zinc-400 truncate mt-1">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 rounded-xl text-sm font-bold text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors">
                    {{ __('Profile') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-4 py-2 rounded-xl text-sm font-bold text-red-500 hover:text-red-400 hover:bg-red-500/10 transition-colors">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>

    </nav>
</div>
