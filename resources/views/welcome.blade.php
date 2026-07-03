<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NextProjectFilm - Cinematic Video Production</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&family=Playfair+Display:ital,wght@1,700;1,900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js (Diperlukan untuk Navbar Mobile jika belum ada di app.js) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hero-gradient {
            background: linear-gradient(to top, #141414 0%, transparent 60%);
        }

        .text-shadow-lg {
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="antialiased bg-[#141414] text-white overflow-x-hidden" style="font-family: 'Montserrat', sans-serif;">

    <!-- NAVBAR DENGAN FITUR MOBILE MENU -->
    <nav x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 50)"
        :class="{ 'bg-[#141414]/95 shadow-2xl backdrop-blur-md border-b border-white/10': scrolled, 'bg-transparent': !
            scrolled }"
        class="fixed w-full z-50 transition-all duration-500 py-4 px-6 md:px-12 flex items-center justify-between">

        <a href="/"
            class="text-2xl md:text-3xl font-black tracking-tighter text-[#FCBF49] flex items-center z-50">
            NEXTPROJECT<span class="text-white ml-1">FILM</span>
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-6">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="font-bold text-sm uppercase hover:text-[#FCBF49] transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-bold text-sm uppercase hover:text-zinc-300 transition">Masuk</a>
                <a href="{{ route('register') }}"
                    class="bg-[#FCBF49] text-black px-6 py-2.5 rounded font-black text-sm uppercase hover:bg-white transition shadow-lg hover:shadow-[#FCBF49]/20 hover:-translate-y-0.5">Daftar</a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white z-50 focus:outline-none p-2">
            <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
            <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-5"
            class="absolute top-full left-0 w-full bg-[#141414] border-b border-white/10 shadow-2xl py-6 px-6 flex flex-col gap-4 md:hidden"
            style="display: none;">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="block font-bold text-sm uppercase text-white hover:text-[#FCBF49] transition p-2">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="block font-bold text-sm uppercase text-white hover:text-zinc-300 transition p-2">Masuk</a>
                <a href="{{ route('register') }}"
                    class="block text-center bg-[#FCBF49] text-black px-6 py-3 rounded font-black text-sm uppercase hover:bg-white transition mt-2">Daftar
                    Sekarang</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="relative h-[100vh] min-h-[600px] w-full">
        <!-- Menggunakan gambar asli kru film/kamera yang otentik -->
        <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=2025&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover object-center opacity-80">

        <!-- Gradient Overlay yang lebih halus -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#141414] via-[#141414]/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#141414] via-transparent to-transparent"></div>

        <div class="absolute inset-0 flex flex-col justify-center px-6 md:px-12 w-full lg:w-2/3 pt-20">
            <h1 class="text-5xl sm:text-6xl lg:text-8xl font-black italic mb-6 leading-[1.1] tracking-tighter text-shadow-lg"
                style="font-family: 'Playfair Display', serif;">
                Beyond <span class="text-[#FCBF49]">The Lens</span>
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-zinc-300 mb-8 font-medium leading-relaxed max-w-xl">
                Next Project Film adalah rumah produksi yang mengubah narasi menjadi mahakarya visual. Kami membangun emosi,
                memperkuat identitas, dan mengabadikan momen dengan standar sinematik dunia.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('register') }}"
                    class="bg-white text-black px-8 py-4 font-black uppercase text-sm text-center hover:bg-[#FCBF49] hover:scale-105 transition-all duration-300 rounded shadow-xl">
                    Booking Sekarang
                </a>
                <a href="#portfolio"
                    class="border border-white/30 text-white px-8 py-4 font-black uppercase text-sm text-center hover:bg-white/10 hover:border-white transition-all duration-300 rounded">
                    Lihat Karya
                </a>
            </div>
        </div>
    </div>

    <!-- SECTION PORTOFOLIO -->
    <section id="portfolio" class="relative z-20 -mt-10 sm:-mt-20 pb-20">
        <div class="mb-12">
            <div class="flex items-center justify-between px-6 md:px-12 mb-6">
                <h2 class="text-xl sm:text-2xl font-black uppercase tracking-widest text-[#FCBF49]">Karya Unggulan</h2>
                <div class="hidden md:flex gap-2 text-zinc-500">
                    <span class="text-xs uppercase tracking-widest">Scroll untuk melihat &rarr;</span>
                </div>
            </div>

            <div class="flex gap-4 sm:gap-6 px-6 md:px-12 overflow-x-auto no-scrollbar snap-x pb-8">
                @forelse($portofolio as $item)
                    <div
                        class="snap-center sm:snap-start shrink-0 w-[85vw] sm:w-[350px] md:w-[450px] aspect-video bg-zinc-800 rounded-xl overflow-hidden relative group cursor-pointer border border-zinc-700/50 hover:border-[#FCBF49]/80 transition-all duration-500 shadow-lg">
                        @if ($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-zinc-900">
                                <span class="text-zinc-600 font-medium">No Image</span>
                            </div>
                        @endif
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#141414] via-[#141414]/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="font-bold text-lg md:text-xl mb-1 text-white truncate">{{ $item->judul_film }}
                            </h3>
                            <a href="{{ $item->link_video }}" target="_blank"
                                class="inline-block mt-2 text-xs text-[#FCBF49] font-bold uppercase tracking-widest hover:text-white transition-colors">
                                Tonton Video &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="w-full text-center py-12 bg-zinc-900/50 rounded-xl border border-zinc-800 border-dashed mr-6 md:mr-12">
                        <p class="text-zinc-500 italic">Belum ada karya yang diunggah.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- SECTION PAKET LAYANAN -->
    <section class="py-20 bg-zinc-900/30 border-y border-zinc-800/50 relative overflow-hidden">
        <!-- Dekorasi Latar Belakang -->
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#FCBF49]/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3">
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-widest text-white mb-4">
                    Pilih Paket <span class="text-[#FCBF49]">Produksi</span>
                </h2>
                <p class="text-zinc-400 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                    Solusi sinematik untuk berbagai kebutuhan visual Anda. Dari film pendek hingga komersial, kami siap
                    mengeksekusi dengan standar profesional.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse ($paket as $p)
                    <div
                        class="bg-[#141414] border border-zinc-800/80 rounded-2xl p-6 sm:p-8 hover:border-[#FCBF49] hover:shadow-[0_0_30px_rgba(252,191,73,0.1)] transition-all duration-300 flex flex-col group relative overflow-hidden">

                        <div class="flex-1 relative z-10">
                            <h3
                                class="text-2xl font-black text-white mb-3 group-hover:text-[#FCBF49] transition-colors leading-tight">
                                {{ $p->nama_paket }}
                            </h3>
                            <p class="text-zinc-400 text-sm leading-relaxed mb-6">{{ $p->deskripsi }}</p>
                        </div>

                        <div class="pt-6 border-t border-zinc-800/80 relative z-10">
                            <p class="text-3xl font-black text-white mb-1">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-[11px] font-bold text-zinc-500 uppercase tracking-wider mb-6">
                                Estimasi Pengerjaan: <span class="text-[#FCBF49]">{{ $p->durasi_pengerjaan }}
                                    Hari</span>
                            </p>

                            <a href="{{ route('register') }}"
                                class="block w-full text-center py-3.5 border-2 border-[#FCBF49] text-[#FCBF49] font-black uppercase text-sm rounded-lg hover:bg-[#FCBF49] hover:text-black transition-all duration-300">
                                Booking Paket
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full text-center py-16 bg-zinc-800/20 rounded-2xl border border-zinc-800 border-dashed">
                        <p class="text-zinc-500 italic">Belum ada paket layanan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- BANNER KALKULATOR -->
            <div
                class="mt-20 bg-gradient-to-r from-zinc-800 to-[#141414] rounded-2xl p-8 md:p-12 border border-zinc-700/50 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden shadow-2xl">
                <div
                    class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] mix-blend-overlay">
                </div>
                <div class="relative z-10 text-center md:text-left">
                    <h3 class="text-2xl md:text-3xl font-black text-white uppercase tracking-wider mb-3">Bingung
                        Memilih Paket?</h3>
                    <p class="text-zinc-300 text-sm md:text-base max-w-lg">
                        Gunakan fitur rekomendasi pintar kami untuk menyesuaikan budget dan tenggat waktu produksi Anda
                        secara otomatis.
                    </p>
                </div>
                <a href="{{ route('rekomendasi.index') }}"
                    class="relative z-10 whitespace-nowrap bg-[#FCBF49] text-black px-8 py-4 font-black uppercase text-sm hover:bg-white hover:scale-105 transition-all duration-300 rounded shadow-lg">
                    Coba Kalkulator
                </a>
            </div>

        </div>
    </section>

    <footer class="py-10 text-center border-t border-zinc-900 bg-[#141414]">
        <p class="text-zinc-500 text-sm font-bold tracking-wider uppercase">
            &copy; {{ date('Y') }} NextProjectFilm. All rights reserved.
        </p>
    </footer>

</body>

</html>
