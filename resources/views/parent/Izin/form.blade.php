@extends('layouts.app')

@section('title', 'Ajukan Izin')

@section('content')
<div class="min-h-screen bg-blue-50 py-8 px-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Ajukan Izin Anak</h2>

        <form action="{{ route('parent.izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Pilih Anak</label>
                <select name="siswa_id" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @foreach(Auth::user()->students as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->nis }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Jenis Izin</label>
                <select name="jenis_izin" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="ijin">Ijin - Tidak hadir dengan ijin</option>
                    <option value="sakit">Sakit - Tidak hadir karena sakit</option>
                    <option value="dispensasi">Dispensasi - Ijin khusus sekolah</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Alasan</label>
                <textarea name="alasan" rows="3" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan alasan izin..."></textarea>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Bukti Foto (Opsional)</label>
                <input type="file" name="bukti_foto" accept="image/*" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <p class="text-sm text-gray-400 mt-1">*Format JPG/PNG maksimal 2MB</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Ajukan Izin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
