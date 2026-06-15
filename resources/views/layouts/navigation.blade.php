<nav x-data="{ open: false }" class="bg-zinc-900 border-b border-zinc-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-2xl font-extrabold text-[#FCBF49] tracking-tight hover:text-yellow-500 transition-colors">
                        NextProject<span class="text-white text-lg font-medium ml-1">Film</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="{{ request()->routeIs('dashboard') ? 'border-[#FCBF49] text-white' : 'border-transparent text-zinc-400 hover:text-white hover:border-zinc-300' }} font-bold transition-colors">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')"
                        class="{{ request()->routeIs('admin.users.index') ? 'border-[#FCBF49] text-white' : 'border-transparent text-zinc-400 hover:text-white hover:border-zinc-300' }} font-bold transition-colors">
                        {{ __('Pelanggan') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.paket.index')" :active="request()->routeIs('admin.paket.index')"
                        class="{{ request()->routeIs('admin.paket.index') ? 'border-[#FCBF49] text-white' : 'border-transparent text-zinc-400 hover:text-white hover:border-zinc-300' }} font-bold transition-colors">
                        {{ __('Paket Layanan') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-xl text-[#FCBF49] bg-zinc-800 hover:bg-zinc-700 hover:text-yellow-500 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')"
                            class="font-bold text-zinc-700 hover:bg-zinc-50 hover:text-[#FCBF49]">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="font-bold text-red-500 hover:bg-red-50 hover:text-red-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-white hover:bg-zinc-800 focus:outline-none focus:bg-zinc-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-zinc-900 border-t border-zinc-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="{{ request()->routeIs('dashboard') ? 'text-[#FCBF49] bg-zinc-800 border-[#FCBF49]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} font-bold">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')"
                class="{{ request()->routeIs('admin.users.index') ? 'text-[#FCBF49] bg-zinc-800 border-[#FCBF49]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} font-bold">
                {{ __('Pelanggan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.paket.index')" :active="request()->routeIs('admin.paket.index')"
                class="{{ request()->routeIs('admin.paket.index') ? 'text-[#FCBF49] bg-zinc-800 border-[#FCBF49]' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} font-bold">
                {{ __('Paket Layanan') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-zinc-800">
            <div class="px-4">
                <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-zinc-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-zinc-400 hover:text-white hover:bg-zinc-800 font-bold">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-500 hover:text-red-400 hover:bg-zinc-800 font-bold">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
