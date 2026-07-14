<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Daftar Paket Layanan Produksi') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="text-center max-w-2xl mx-auto mb-10">
                <h3 class="text-2xl sm:text-3xl font-black text-zinc-900 tracking-tight"
                    style="font-family: 'Playfair Display', serif;">
                    Pilih Kualitas Terbaik untuk Project Anda
                </h3>
                <p class="text-sm sm:text-base text-zinc-500 mt-2 leading-relaxed">
                    Setiap paket dirancang dengan standar sinematik profesional, didukung oleh kru berpengalaman dan
                    peralatan produksi bertaraf industri.
                </p>
            </div>
            @if (Auth::user()->role === 'admin')
                <div class="flex justify-end mb-8">
                    <a href="{{ route('admin.paket.create') }}"
                        class="inline-flex items-center gap-2 bg-[#FCBF49] hover:bg-yellow-500 text-zinc-950 px-6 py-3 rounded-2xl font-bold shadow-lg transition-all hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Paket Baru
                    </a>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @forelse ($paket as $item)
                    <div
                        class="bg-white rounded-3xl p-6 sm:p-8 border border-zinc-200 shadow-xl hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden group hover:-translate-y-1">

                        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-[#FCBF49] to-yellow-600">
                        </div>

                        <div>
                            <div class="flex justify-between items-start gap-4 mb-4 mt-2">
                                <div>
                                    <span
                                        class="text-xs font-black uppercase tracking-widest text-[#FCBF49] bg-zinc-900 px-3 py-1 rounded-full">
                                        {{ $item->kategori ?? 'Cinematic Production' }}
                                    </span>
                                    <h4 class="text-2xl font-black text-zinc-900 mt-3 tracking-tight">
                                        {{ $item->nama_paket }}
                                    </h4>
                                </div>
                            </div>

                            <div class="mb-6 pb-6 border-b border-zinc-100">
                                <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Mulai Dari</p>
                                <div class="flex items-baseline gap-1 mt-1">
                                    <span class="text-3xl sm:text-4xl font-black text-zinc-900">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-sm font-medium text-zinc-600 leading-relaxed mb-4">
                                {{ $item->deskripsi }}
                            </p>

                            <div class="mb-6">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-zinc-100 text-zinc-700">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $item->durasi_pengerjaan }} Hari Kerja
                                </span>
                            </div>

                            <div class="space-y-3 mb-8">
                                <p
                                    class="text-xs font-extrabold uppercase tracking-wider text-zinc-900 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#FCBF49]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Spesifikasi & Include Layanan:
                                </p>

                                @if (!empty($item->detail_paket))
                                    @foreach (explode("\n", str_replace("\r", '', $item->detail_paket)) as $fitur)
                                        @if (trim($fitur) !== '')
                                            <div class="flex items-start gap-3 text-sm font-semibold text-zinc-700">
                                                <div
                                                    class="mt-1 w-5 h-5 rounded-full bg-green-50 border border-green-200 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-3 h-3 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <span class="leading-snug">{{ trim($fitur) }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="flex items-start gap-3 text-sm font-semibold text-zinc-700">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Kamera Sinematik 4K Resolution</span>
                                    </div>
                                    <div class="flex items-start gap-3 text-sm font-semibold text-zinc-700">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Professional Lighting & Audio Setup</span>
                                    </div>
                                    <div class="flex items-start gap-3 text-sm font-semibold text-zinc-700">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Editing, Color Grading & Sound Design</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4 border-t border-zinc-100 flex items-center gap-3">
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.paket.edit', $item->id) }}"
                                    class="flex-1 text-center py-3 bg-zinc-100 hover:bg-zinc-200 text-zinc-800 font-extrabold text-xs uppercase tracking-wider rounded-xl transition">
                                    Edit Paket
                                </a>
                                <form action="{{ route('admin.paket.destroy', $item->id) }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus paket layanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-3 bg-red-50 hover:bg-red-100 text-red-600 font-extrabold rounded-xl transition"
                                        title="Hapus Paket">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('booking.create', ['paket_id' => $item->id]) }}"
                                    class="w-full text-center py-4 bg-zinc-900 hover:bg-zinc-800 text-[#FCBF49] font-black text-sm uppercase tracking-widest rounded-2xl shadow-lg hover:scale-[1.02] transition-all duration-200">
                                    Pesan Paket Ini
                                </a>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-zinc-200">
                        <svg class="w-16 h-16 text-zinc-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        <h4 class="text-xl font-bold text-zinc-900">Belum Ada Paket Layanan</h4>
                        <p class="text-sm text-zinc-500 mt-1 max-w-sm mx-auto">
                            Daftar paket layanan produksi saat ini belum tersedia atau sedang dalam tahap pembaruan oleh
                            tim admin.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
