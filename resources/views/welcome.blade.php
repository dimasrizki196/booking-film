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
    </style>
</head>

<body class="antialiased bg-[#141414] text-white overflow-x-hidden" style="font-family: 'Montserrat', sans-serif;">

    <nav x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)"
        :class="{ 'bg-[#141414]/95 shadow-2xl': scrolled, 'bg-transparent': !scrolled }"
        class="fixed w-full z-50 transition-all duration-500 py-5 px-6 md:px-12 flex items-center justify-between">

        <a href="/" class="text-3xl font-black tracking-tighter text-[#FCBF49] flex items-center">
            NEXTPROJECT<span class="text-white ml-1">FILM</span>
        </a>

        <div class="flex items-center gap-6">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="font-bold text-sm uppercase hover:text-[#FCBF49] transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-bold text-sm uppercase hover:text-zinc-300 transition">Masuk</a>
                <a href="{{ route('register') }}"
                    class="bg-[#FCBF49] text-black px-6 py-2 rounded font-black text-sm uppercase hover:bg-white transition">Daftar</a>
            @endauth
        </div>
    </nav>

    <div class="relative h-[90vh] w-full">
        <img src="https://images.unsplash.com/photo-1601506521937-0121a7fc2a6b?q=80&w=2071&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#141414] via-[#141414]/20 to-transparent"></div>

        <div class="absolute inset-0 flex flex-col justify-center px-6 md:px-12 w-full md:w-1/2 pt-20">
            <h1 class="text-6xl md:text-8xl font-black italic mb-6 leading-[0.9] tracking-tighter"
                style="font-family: 'Playfair Display', serif;">
                Beyond <span class="text-[#FCBF49]">The Lens</span>
            </h1>
            <p class="text-lg md:text-xl text-zinc-300 mb-8 font-medium leading-relaxed max-w-lg">
                NextProject adalah rumah produksi yang mengubah narasi menjadi mahakarya visual. Kami membangun emosi,
                memperkuat identitas, dan mengabadikan momen dengan standar sinematik dunia.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('register') }}"
                    class="bg-white text-black px-8 py-4 font-black uppercase text-sm hover:bg-[#FCBF49] transition rounded">Booking
                    Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Section Portofolio -->
    <section class="relative z-20 -mt-20 pb-20">
        <div class="mb-12">
            <h2 class="px-6 md:px-12 text-2xl font-black mb-6 uppercase tracking-widest text-[#FCBF49]">Karya Unggulan
            </h2>
            <div class="flex gap-4 px-6 md:px-12 overflow-x-auto no-scrollbar snap-x pb-8">
                @forelse($portofolio as $item)
                    <div
                        class="snap-start shrink-0 w-[300px] md:w-[450px] aspect-video bg-zinc-800 rounded-lg overflow-hidden relative group cursor-pointer border border-zinc-700/50 hover:border-[#FCBF49]/50 transition-all duration-500">
                        @if ($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-zinc-900">
                                <span class="text-zinc-600">No Image</span>
                            </div>
                        @endif
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#141414] via-[#141414]/40 to-transparent opacity-90">
                        </div>
                        <div class="absolute bottom-6 left-6">
                            <h3 class="font-bold text-xl mb-1 text-white">{{ $item->judul_film }}</h3>
                            <a href="{{ $item->link_video }}" target="_blank"
                                class="text-xs text-[#FCBF49] font-bold uppercase tracking-widest hover:text-white transition-colors">Tonton
                                Video &rarr;</a>
                        </div>
                    </div>
                @empty
                    <p class="px-12 text-zinc-500 italic">Belum ada karya yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section Paket Layanan -->
    <section class="py-20 bg-zinc-900/30 border-y border-zinc-800/50">
        <div class="max-w-7xl mx-auto px-6 md:px-12">

            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-widest text-white mb-4">
                    Pilih Paket <span class="text-[#FCBF49]">Produksi</span>
                </h2>
                <p class="text-zinc-400 max-w-2xl mx-auto">Solusi sinematik untuk berbagai kebutuhan visual Anda. Dari
                    film pendek hingga komersial, kami siap mengeksekusi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($paket as $p)
                    <div
                        class="bg-[#141414] border border-zinc-800 rounded-xl p-8 hover:border-[#FCBF49] transition-all duration-300 flex flex-col group">

                        <div class="flex-1">
                            <h3
                                class="text-2xl font-black text-white mb-3 group-hover:text-[#FCBF49] transition-colors">
                                {{ $p->nama_paket }}</h3>
                            <p class="text-zinc-400 text-sm leading-relaxed mb-6">{{ $p->deskripsi }}</p>
                        </div>

                        <div class="pt-6 border-t border-zinc-800/80">
                            <p class="text-3xl font-black text-white mb-2">Rp
                                {{ number_format($p->harga, 0, ',', '.') }}</p>
                            <p class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-6">Estimasi
                                Pengerjaan: <span class="text-[#FCBF49]">{{ $p->durasi_pengerjaan }} Hari</span></p>

                            <a href="{{ route('register') }}"
                                class="block w-full text-center py-3 border border-[#FCBF49] text-[#FCBF49] font-bold uppercase text-sm rounded hover:bg-[#FCBF49] hover:text-black transition-colors duration-300">
                                Booking Paket
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-zinc-500 italic">Belum ada paket layanan yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <!-- Banner Kalkulator -->
            <div
                class="mt-16 bg-gradient-to-r from-zinc-800 to-[#141414] rounded-xl p-8 md:p-12 border border-zinc-700/50 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div
                    class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]">
                </div>
                <div class="relative z-10 text-center md:text-left">
                    <h3 class="text-2xl font-black text-white uppercase tracking-wider mb-2">Bingung Memilih Paket?</h3>
                    <p class="text-zinc-400">Gunakan fitur rekomendasi kami untuk menyesuaikan budget dan tenggat waktu
                        Anda.</p>
                </div>
                <a href="{{ route('rekomendasi.index') }}"
                    class="relative z-10 whitespace-nowrap bg-white text-black px-8 py-4 font-black uppercase text-sm hover:bg-[#FCBF49] transition rounded">
                    Coba Kalkulator
                </a>
            </div>

        </div>
    </section>

    <footer class="py-10 text-center border-t border-zinc-900">
        <p class="text-zinc-500 text-sm font-bold tracking-wider uppercase">&copy; {{ date('Y') }} NextProjectFilm.
            All rights reserved.</p>
    </footer>

</body>

</html>
