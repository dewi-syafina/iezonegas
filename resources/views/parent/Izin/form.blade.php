@extends('layouts.app')

@section('title', 'Ajukan Izin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 py-12 px-6">
    <div class="max-w-2xl mx-auto bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-xl border border-blue-100">
        <div class="flex items-center mb-6">
            <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <h2 class="ml-4 text-2xl font-bold text-gray-800">Ajukan Izin Anak</h2>
        </div>

        {{-- 🔔 Notifikasi --}}
        @if(session('success'))
            <div class="p-3 mb-5 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="p-3 mb-5 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('parent.izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Pilih Anak -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">👧 Pilih Anak</label>
                <select name="siswa_id" required
                    class="w-full border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200">
                    @foreach(Auth::user()->students as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->nis }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis Izin -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">📄 Jenis Izin</label>
                <select name="jenis_izin" required
                    class="w-full border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200">
                    <option value="ijin">Izin - Tidak hadir dengan izin</option>
                    <option value="sakit">Sakit - Tidak hadir karena sakit</option>
                    <option value="dispensasi">Dispensasi - Izin khusus sekolah</option>
                </select>
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">📅 Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" required
                        class="w-full border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">📅 Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" required
                        class="w-full border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200">
                </div>
            </div>

            <!-- Alasan -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">📝 Alasan</label>
                <textarea name="alasan" rows="3" required
                    class="w-full border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200"
                    placeholder="Tuliskan alasan izin anak Anda..."></textarea>
            </div>

            <!-- Upload Bukti -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">📸 Bukti Foto (Opsional)</label>
                <input type="file" name="bukti_foto" accept="image/*" id="bukti_foto"
                    class="w-full border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200">
                <p class="text-sm text-gray-500 mt-1">Format: JPG/PNG | Maks: 2MB</p>

                <!-- Preview Gambar -->
                <div id="preview" class="mt-3 hidden">
                    <img id="preview_img" class="w-40 h-40 object-cover rounded-xl border shadow-sm">
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-8 py-2.5 rounded-xl font-semibold shadow-md transition transform hover:scale-105">
                    💌 Ajukan Izin
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script Preview Foto --}}
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
@endsection
