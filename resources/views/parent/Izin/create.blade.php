@extends('layouts.app')

@section('title', 'Ajukan Izin Anak | IEZ-ONE')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-blue-100 py-12 px-6 relative overflow-hidden">

    {{-- 🌈 Floating Pastel Background --}}
    <div class="absolute -top-20 -left-20 w-72 h-72 sm:w-96 sm:h-96 bg-purple-200/30 rounded-full blur-3xl animate-float-slow"></div>
    <div class="absolute -bottom-20 -right-20 w-80 h-80 sm:w-[28rem] sm:h-[28rem] bg-blue-200/30 rounded-full blur-3xl animate-float-fast"></div>
    <div class="absolute top-1/2 left-1/3 w-56 h-56 bg-pink-200/30 rounded-full blur-3xl animate-float-slow" style="animation-delay: 1.5s;"></div>

    {{-- 📋 Card Form --}}
    <div class="relative max-w-3xl mx-auto bg-white/80 backdrop-blur-xl border border-blue-100 shadow-2xl rounded-3xl p-8 sm:p-10 z-10">

        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('parent.dashboard') }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali 
            </a>
        </div>

        {{-- Judul --}}
        <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-700 text-center mb-8">
            📑 Form Pengajuan Izin Anak
        </h2>
        <p class="text-center text-gray-600 mb-10 max-w-md mx-auto">
            Lengkapi formulir berikut untuk mengajukan izin anak Anda dengan mudah dan cepat.
        </p>

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

        {{-- 📝 Form Izin --}}
        <form action="{{ route('parent.izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

            {{-- Jenis Izin --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Jenis Izin</label>
                <select name="jenis_izin"
                    class="w-full border border-blue-100 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                    required>
                    <option value="">-- Pilih Jenis Izin --</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>
                @error('jenis_izin')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Alasan --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Alasan</label>
                <textarea name="alasan"
                    class="w-full border border-blue-100 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                    rows="4" required></textarea>
                @error('alasan')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                    class="w-full border border-blue-100 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required>
                @error('tanggal')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Bukti Upload --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Upload Bukti (Opsional)</label>
                <input id="bukti" type="file" name="bukti"
                    accept="image/*"
                    class="w-full border border-blue-100 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                @error('bukti')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                {{-- 🔍 Preview Foto --}}
                <div id="preview" class="hidden mt-4 text-center">
                    <p class="text-sm text-gray-600 mb-2">📸 Pratinjau Bukti:</p>
                    <img id="preview_img" src="" alt="Preview Bukti" class="max-h-56 mx-auto rounded-xl shadow-md border border-blue-100 object-cover">
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full flex justify-center items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 text-white font-semibold rounded-2xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
                Kirim Pengajuan
            </button>
        </form>
    </div>
</div>

{{-- 🔹 Animasi --}}
<style>
@keyframes fadeIn { from { opacity: 0; transform: translateY(-5px);} to { opacity: 1; transform: translateY(0);} }
@keyframes float-slow { 0%,100% { transform: translateY(0);} 50% { transform: translateY(-10px);} }
@keyframes float-fast { 0%,100% { transform: translateY(0);} 50% { transform: translateY(-15px);} }
.animate-fadeIn { animation: fadeIn 0.6s ease-out; }
.animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
.animate-float-fast { animation: float-fast 6s ease-in-out infinite; }
</style>
@endsection
