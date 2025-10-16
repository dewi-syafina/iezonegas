@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <!-- Tombol Panah Kembali -->
    <div class="mb-4">
        <a href="{{ route('orangtua.dashboard') }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
            ← Kembali ke Dashboard
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-blue-700">Ajukan Izin untuk {{ $siswa->nama }}</h2>

    <form action="{{ route('orangtua.izin.store', $siswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Jenis Alasan -->
        <div class="mb-4">
            <label for="alasan" class="block font-semibold mb-2">Jenis Alasan</label>
            <select name="alasan" id="alasan" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Jenis Alasan --</option>
                <option value="Ijin">Ijin - Tidak hadir dengan ijin</option>
                <option value="Sakit">Sakit - Tidak hadir karena sakit</option>
                <option value="Dispensasi">Dispensasi - Ijin khusus sekolah</option>
            </select>
        </div>

        <!-- Tanggal Mulai -->
        <div class="mb-4">
            <label for="tanggal_mulai" class="block font-semibold mb-2">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Tanggal Selesai -->
        <div class="mb-4">
            <label for="tanggal_selesai" class="block font-semibold mb-2">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Upload Bukti -->
        <div class="mb-4">
            <label for="bukti" class="block font-semibold mb-2">Upload Bukti (wajib)</label>
            <input type="file" name="bukti" id="bukti" class="w-full border px-3 py-2 rounded" required>
        </div>


        <!-- Tombol -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('orangtua.dashboard') }}" 
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
