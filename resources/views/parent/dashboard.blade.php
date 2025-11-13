@extends('layouts.app')

@section('title', 'Dashboard Orang Tua | IEZ-ONE')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50/50 to-green-50/50 py-12 pt-32 px-4 sm:px-6 lg:px-12 relative overflow-hidden">

    {{-- 🌈 Floating Pastel Background --}}
    <div class="absolute -top-20 -left-20 w-72 h-72 sm:w-96 sm:h-96 bg-pink-200/30 rounded-full blur-3xl animate-float-slow"></div>
    <div class="absolute -bottom-20 -right-20 w-80 h-80 sm:w-[28rem] sm:h-[28rem] bg-blue-200/30 rounded-full blur-3xl animate-float-fast" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/3 right-1/4 w-56 h-56 sm:w-72 sm:h-72 bg-purple-200/30 rounded-full blur-3xl animate-float-slow" style="animation-delay: 2s;"></div>

    {{-- 🌟 Header --}}
    <div class="text-center max-w-3xl mx-auto mb-12 relative z-10 animate-fadeIn">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-blue-700 mb-2">Selamat Datang, {{ $parent->nama }} 👋</h1>
        <p class="text-gray-600 text-base sm:text-lg md:text-xl">Ajukan & pantau pengajuan izin anak Anda dengan mudah dan cepat.</p>
    </div>

    {{-- 🔔 Notifikasi --}}
    <div class="relative z-20">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity x-transition.duration.500
                 class="relative p-4 mb-5 rounded-lg border text-sm sm:text-base shadow-md
                        bg-green-100 border-green-300 text-green-800 flex justify-between items-center">
                {{ session('success') }}
                <button @click="show=false" class="ml-4 text-green-700 font-bold hover:text-green-900">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity x-transition.duration.500
                 class="relative p-4 mb-5 rounded-lg border text-sm sm:text-base shadow-md
                        bg-red-100 border-red-300 text-red-800 flex justify-between items-center">
                {{ session('error') }}
                <button @click="show=false" class="ml-4 text-red-700 font-bold hover:text-red-900">&times;</button>
            </div>
        @endif
    </div>

    {{-- 👨‍👩‍👧 Profil Anak-anak --}}
    <div class="space-y-10 relative z-10">
        @foreach($siswaList as $siswa)
            @php
                $izinAnak = $izinList->where('siswa_id', $siswa->id)->take(5);
            @endphp

            {{-- 🧩 Card Profil Anak --}}
            <div class="flex flex-col sm:flex-row items-center gap-6 p-6 sm:p-8 bg-white shadow-xl rounded-3xl hover:shadow-2xl transition-transform transform hover:-translate-y-2 border border-gray-100">
                
                {{-- Foto Anak --}}
                <div class="relative flex-shrink-0 mb-4 sm:mb-0">
                    @if ($siswa->foto && file_exists(public_path('storage/foto_siswa/' . $siswa->foto)))
                        <img src="{{ asset('storage/foto_siswa/' . $siswa->foto) }}" 
                             alt="Foto {{ $siswa->nama }}"
                             class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full object-cover shadow-md border-4 border-white transition-transform hover:scale-105 duration-300">
                    @else
                        <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-4xl sm:text-5xl md:text-5xl font-bold shadow-md border-4 border-white transition-transform hover:scale-105 duration-300">
                            {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                        </div>
                    @endif
                    <span class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-xs sm:text-sm font-semibold px-3 py-1 rounded-full shadow-md">
                        NIS: {{ $siswa->nis }}
                    </span>
                </div>

                {{-- Info Profil --}}
                <div class="flex-1 flex flex-col justify-between space-y-4 p-4 sm:p-5">

                    {{-- Data Siswa --}}
                    <div class="space-y-2">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $siswa->nama }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                            <p class="flex items-center gap-2 text-sm sm:text-base text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4 1.79 4 4 4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 20v-2a4 4 0 014-4h4a4 4 0 014 4v2" />
                                </svg>
                                <span class="font-medium">Kelas:</span> {{ $siswa->kelas->nama }}
                            </p>
                            <p class="flex items-center gap-2 text-sm sm:text-base text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M4 19h16v2H4v-2z" />
                                </svg>
                                <span class="font-medium">Wali Kelas:</span> {{ $siswa->kelas->waliKelas->nama ?? '-' }}
                            </p>
                            <p class="flex items-center gap-2 text-sm sm:text-base text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="font-medium">Status:</span> Aktif
                            </p>
                        </div>
                    </div>

                    {{-- Tombol Ajukan Izin --}}
                    <a href="{{ route('parent.izin.create', $siswa->id) }}" 
                       class="inline-flex items-center gap-2 justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg hover:from-purple-700 hover:to-indigo-700 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajukan Izin
                    </a>
                </div>
            </div>

            {{-- 📋 Riwayat Izin Anak --}}
            <div class="bg-white/80 backdrop-blur-xl border border-gray-200 rounded-2xl shadow-md overflow-x-auto mt-4">
                <div class="p-4 bg-gradient-to-r from-purple-500 to-indigo-500 text-white flex justify-between items-center rounded-t-2xl">
                    <h3 class="text-lg sm:text-xl font-semibold">Riwayat Pengajuan Izin - {{ $siswa->nama }}</h3>
                    <span class="text-xs sm:text-sm opacity-80">{{ $izinAnak->count() }} Terbaru</span>
                </div>
                <div class="p-4 overflow-x-auto">
                    @if($izinAnak->isEmpty())
                        <p class="text-gray-500 text-center py-6">Belum ada izin yang diajukan 📭</p>
                    @else
                        <table class="min-w-[600px] sm:min-w-full text-sm sm:text-base text-gray-700 border border-gray-200 divide-y divide-gray-200 rounded-2xl overflow-hidden">
                            <thead class="bg-purple-50 text-purple-800 uppercase text-xs sm:text-sm font-semibold">
                                <tr>
                                    <th class="px-4 py-2 text-left">Tanggal</th>
                                    <th class="px-4 py-2 text-left">Jenis Izin</th>
                                    <th class="px-4 py-2 text-left">Alasan</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-center">Bukti</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($izinAnak as $izin)
                                    <tr class="hover:bg-purple-50 transition duration-200">
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y') }}</td>
                                        <td class="px-4 py-2">{{ ucfirst($izin->jenis_izin) }}</td>
                                        <td class="px-4 py-2">{{ $izin->alasan }}</td>
                                        <td class="px-4 py-2">
                                            @if($izin->status == 'pending')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold animate-pulse">Menunggu</span>
                                            @elseif(in_array($izin->status, ['diizinkan','approved']))
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold animate-pulse">Disetujui</span>
                                            @elseif(in_array($izin->status, ['tidak diizinkan','rejected']))
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold animate-pulse">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            @if($izin->bukti)
                                                @php $ext = pathinfo($izin->bukti, PATHINFO_EXTENSION); @endphp
                                                @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                                    <a href="{{ asset('storage/' . $izin->bukti) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $izin->bukti) }}" alt="Bukti Izin" class="w-12 h-12 object-cover rounded-lg shadow-md hover:scale-110 transition duration-200">
                                                    </a>
                                                @elseif(strtolower($ext) === 'pdf')
                                                    <a href="{{ asset('storage/' . $izin->bukti) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold hover:bg-blue-200 transition">
                                                        Lihat PDF
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $izin->bukti) }}" target="_blank" class="text-purple-600 hover:underline">Unduh File</a>
                                                @endif
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        @endforeach
    </div>
</div>

{{-- 🔹 Animasi --}}
<style>
@keyframes fadeIn { from { opacity:0; transform:translateY(10px);} to{opacity:1; transform:translateY(0);} }
@keyframes float-slow { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
@keyframes float-fast { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
.animate-fadeIn { animation: fadeIn 1s ease-out forwards; }
.animate-float-slow { animation: float-slow 7s ease-in-out infinite; }
.animate-float-fast { animation: float-fast 5s ease-in-out infinite; }
.animate-pulse { animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1;}50%{opacity:0.6;} }
.animate-bounce { animation: bounce 1s infinite; }
@keyframes bounce { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }
</style>

{{-- 🔹 Alpine.js --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection
