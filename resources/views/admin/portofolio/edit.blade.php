<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Portofolio</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.portofolio.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Film</label>
                    <input type="text" name="judul_film" value="{{ old('judul_film', $portofolio->judul_film) }}" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Karya</label>
                    <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Link Video</label>
                    <input type="url" name="link_video" value="{{ old('link_video', $portofolio->link_video) }}" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Upload</label>
                    <input type="date" name="tanggal_upload" value="{{ old('tanggal_upload', $portofolio->tanggal_upload) }}" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail / Poster Film Baru</label>
                    @if($portofolio->thumbnail)
                        <div class="mb-2">
                            <span class="text-xs text-gray-500">Thumbnail saat ini:</span><br>
                            <img src="{{ asset('storage/' . $portofolio->thumbnail) }}" class="w-32 h-32 object-cover rounded mt-1 border">
                        </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-gray-700 px-3 py-2 border border-gray-300 rounded mt-2 focus:outline-none focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded transition">Perbarui Data</button>
                    <a href="{{ route('admin.portofolio.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Batal</a>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>