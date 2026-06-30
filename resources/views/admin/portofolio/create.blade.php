<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Tambah Portofolio Baru') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border border-red-100 rounded-2xl">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan pada input Anda:</h3>
                        </div>
                        <ul class="list-disc pl-5 text-sm text-red-700 font-medium space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Judul Film</label>
                        <input type="text" name="judul_film" value="{{ old('judul_film') }}"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                            placeholder="Masukkan judul karya film..." required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Deskripsi Karya</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                            placeholder="Ceritakan singkat tentang film ini..." required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Link Video (YouTube/Vimeo)</label>
                        <input type="url" name="link_video" value="{{ old('link_video') }}"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                            placeholder="https://..." required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Upload ke Platform</label>
                        <input type="date" name="tanggal_upload" value="{{ old('tanggal_upload') }}"
                            class="w-full sm:w-1/3 rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Thumbnail / Poster Film
                            (Opsional)</label>
                        <input type="file" name="thumbnail" accept="image/*"
                            class="w-full text-zinc-600 bg-zinc-50 border border-zinc-200 rounded-2xl cursor-pointer focus:outline-none focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200
                            file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#FCBF49] file:text-zinc-900 hover:file:bg-yellow-500">
                        <p class="text-xs text-zinc-500 mt-2 font-medium ml-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                    </div>

                    <div class="flex items-center gap-4 pt-6 mt-6 border-t border-zinc-100">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-extrabold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            SIMPAN PORTOFOLIO
                        </button>

                        <a href="{{ route('admin.portofolio.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-zinc-100 border border-transparent rounded-xl font-extrabold text-sm text-zinc-800 tracking-widest hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                            BATAL
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
