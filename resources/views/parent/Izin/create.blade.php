@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="mb-4">
        <a href="{{ route('parent.dashboard') }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
            ← Kembali ke Dashboard
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-blue-700">Ajukan Izin untuk {{ $siswa->nama }}</h2>

    <form action="{{ route('parent.izin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

        <!-- Jenis Izin -->
        <div class="mb-4">
            <label for="jenis_izin" class="block font-semibold mb-2">Jenis Izin</label>
            <select name="jenis_izin" id="jenis_izin" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Jenis Izin --</option>
                <option value="ijin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="dispensasi">Dispensasi</option>
            </select>
        </div>

        <!-- Alasan -->
        <div class="mb-4">
            <label for="alasan" class="block font-semibold mb-2">Alasan</label>
            <textarea name="alasan" id="alasan" rows="3"
                      class="w-full border px-3 py-2 rounded"
                      placeholder="Tuliskan alasan izin dengan jelas..." required></textarea>
        </div>

        <!-- Tanggal Mulai -->
        <div class="mb-4">
            <label for="tanggal_mulai" class="block font-semibold mb-2">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Tanggal Selesai -->
        <div class="mb-4">
            <label for="tanggal_selesai" class="block font-semibold mb-2">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Upload Bukti -->
        <div class="mb-4">
            <label for="bukti_foto" class="block font-semibold mb-2">Upload Bukti (wajib)</label>
            <input type="file" name="bukti_foto" id="bukti_foto"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('parent.dashboard') }}" 
               class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
