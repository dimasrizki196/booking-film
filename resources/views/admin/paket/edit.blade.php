<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.paket.update', $paket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label>Nama Paket</label>
                    <input type="text" name="nama_paket" value="{{ $paket->nama_paket }}" class="border w-full p-2" required>
                </div>
                <div class="mb-4">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="border w-full p-2" required>{{ $paket->deskripsi }}</textarea>
                </div>
                <div class="mb-4">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ $paket->harga }}" class="border w-full p-2" required>
                </div>
                <div class="mb-4">
                    <label>Durasi Pengerjaan (Hari)</label>
                    <input type="number" name="durasi_pengerjaan" value="{{ $paket->durasi_pengerjaan }}" class="border w-full p-2" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui</button>
            </form>
        </div>
    </div>
</x-app-layout>