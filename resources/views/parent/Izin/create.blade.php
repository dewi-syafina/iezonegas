@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 py-12 px-6">
    <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-md shadow-lg rounded-2xl p-8 border border-blue-100">
        
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('parent.dashboard') }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Notifikasi sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-medium flex items-center gap-2 shadow-sm animate-fadeIn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
                <span>✅ Izin telah terkirim, menunggu pembaruan status dari wali kelas.</span>
            </div>
        @endif

        <!-- Judul -->
        <h2 class="text-3xl font-bold text-blue-700 mb-8 text-center">
            📋 Ajukan Izin untuk {{ $siswa->nama }}
        </h2>

        <!-- Form -->
        <form action="{{ route('parent.izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

            <!-- Jenis Izin -->
            <div>
                <label for="jenis_izin" class="block font-semibold text-gray-700 mb-2">Jenis Izin</label>
                <select name="jenis_izin" id="jenis_izin"
                        class="w-full border-gray-300 rounded-xl px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                        required>
                    <option value="">-- Pilih Jenis Izin --</option>
                    <option value="ijin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="dispensasi">Dispensasi</option>
                </select>
            </div>

            <!-- Alasan -->
            <div>
                <label for="alasan" class="block font-semibold text-gray-700 mb-2">Alasan</label>
                <textarea name="alasan" id="alasan" rows="3"
                          class="w-full border-gray-300 rounded-xl px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                          placeholder="Tuliskan alasan izin dengan jelas..." required></textarea>
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_mulai" class="block font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                           required>
                </div>
                <div>
                    <label for="tanggal_selesai" class="block font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                           required>
                </div>
            </div>

            <!-- Upload Bukti -->
            <div>
                <label for="bukti_foto" class="block font-semibold text-gray-700 mb-2">Upload Bukti (Wajib)</label>
                <input type="file" name="bukti_foto" id="bukti_foto" accept="image/*"
                       class="w-full border-gray-300 rounded-xl px-4 py-2.5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                       required>
                <p class="text-sm text-gray-500 mt-1">Format: JPG/PNG | Maks: 2MB</p>

                <!-- Preview Gambar -->
                <div id="preview" class="mt-4 hidden">
                    <img id="preview_img" class="w-48 h-48 object-cover rounded-xl border shadow-md">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('parent.dashboard') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2.5 rounded-xl font-semibold shadow transition">
                    Batal
                </a>
                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl font-semibold shadow-md transition transform hover:scale-105">
                    💾 Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Preview Gambar --}}
<script>
document.getElementById('bukti_foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const img = document.getElementById('preview_img');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            img.src = event.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        img.src = '';
    }
});
</script>

{{-- Animasi halus --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.5s ease-out;
}
</style>
@endsection
