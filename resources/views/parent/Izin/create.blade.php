@extends('layouts.app')

@section('title', 'Ajukan Izin Anak')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 py-12 px-6">
    <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-md shadow-lg rounded-2xl p-8 border border-blue-100">

        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('parent.dashboard') }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-medium flex items-center gap-2 shadow-sm animate-fadeIn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Judul --}}
        <h2 class="text-3xl font-bold text-blue-700 mb-8 text-center">
            📋 Ajukan Izin Anak
        </h2>

        {{-- Form Izin --}}
        <form action="{{ route('parent.izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Hidden siswa_id --}}
            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

            {{-- Jenis Izin --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Jenis Izin</label>
                <select name="jenis_izin" class="w-full border rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400" required>
                    <option value="">-- Pilih Jenis Izin --</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="dispensasi">Dispensasi</option>
                </select>
                @error('jenis_izin')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Alasan --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Alasan</label>
                <textarea name="alasan" class="w-full border rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400" rows="4" required></textarea>
                @error('alasan')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full border rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400" required>
                @error('tanggal')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Upload Bukti --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Upload Bukti (Opsional)</label>
                <input type="file" name="bukti_foto" class="w-full border rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400">
                @error('bukti_foto')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full flex justify-center items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-2xl shadow-lg hover:scale-105 hover:from-blue-600 hover:to-blue-800 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Kirim Izin
            </button>
        </form>
    </div>
</div>

<style>
@keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
.animate-fadeIn { animation: fadeIn 0.5s ease-out; }
</style>
@endsection
