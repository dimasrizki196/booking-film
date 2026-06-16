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

    <section class="relative z-20 -mt-20 pb-20">
        @php
            // Mengambil portofolio dan membaginya ke dalam kategori (jika ada)
            // Di sini kita tampilkan semua sebagai satu baris besar
            $portofolio = \App\Models\Portofolio::all();
        @endphp

        <div class="mb-12">
            <h2 class="px-6 md:px-12 text-2xl font-black mb-6 uppercase tracking-widest text-[#FCBF49]">Karya Unggulan
            </h2>
            <div class="flex gap-4 px-6 md:px-12 overflow-x-auto no-scrollbar snap-x">
                @forelse($portofolio as $item)
                    <div
                        class="snap-start shrink-0 w-[300px] md:w-[450px] aspect-video bg-zinc-800 rounded-lg overflow-hidden relative group cursor-pointer border border-zinc-700 hover:scale-105 transition-transform duration-500">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-80"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="font-bold text-lg">{{ $item->judul_film }}</h3>
                            <a href="{{ $item->link_video }}" target="_blank"
                                class="text-xs text-[#FCBF49] font-bold uppercase tracking-widest hover:underline">Tonton
                                Video</a>
                        </div>
                    </div>
                @empty
                    <p class="px-12 text-zinc-500">Belum ada karya yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </section>

</body>

</html>
