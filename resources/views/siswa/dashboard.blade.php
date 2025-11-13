@extends('layouts.app-siswa')

@section('title', 'Profil Siswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50/50 to-blue-100/50 pt-32 px-4 sm:px-6 lg:px-12 relative overflow-hidden">

    {{-- 🌈 Floating Pastel Background --}}
    <div class="absolute -top-20 -left-20 w-72 h-72 sm:w-96 sm:h-96 bg-pink-200/30 rounded-full blur-3xl animate-float-slow"></div>
    <div class="absolute -bottom-20 -right-20 w-80 h-80 sm:w-[28rem] sm:h-[28rem] bg-blue-200/30 rounded-full blur-3xl animate-float-fast" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/3 right-1/4 w-56 h-56 sm:w-72 sm:h-72 bg-purple-200/30 rounded-full blur-3xl animate-float-slow" style="animation-delay: 2s;"></div>

    {{-- 🌟 Header Welcome --}}
    <div class="text-center max-w-3xl mx-auto mb-10 relative z-10 animate-fadeIn">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-blue-700 mb-2">Selamat Datang, {{ $siswa->nama }} 👋</h1>
        <p class="text-gray-600 text-base sm:text-lg md:text-xl">Lihat profilmu dan pantau pengajuan izin terbaru.</p>
    </div>

    {{-- 👨‍🎓 Profil Siswa Card Modern --}}
    <div class="relative z-10 mb-12 max-w-4xl mx-auto grid grid-cols-1 gap-6">

        <div class="p-6 sm:p-8 flex flex-col sm:flex-row lg:flex-col items-center gap-4 sm:gap-6 hover:shadow-3xl transition">
            
            {{-- Foto Profil --}}
            <div class="relative flex-shrink-0">
                @if ($siswa->foto && file_exists(public_path('storage/foto_siswa/' . $siswa->foto)))
                    <img src="{{ asset('storage/foto_siswa/' . $siswa->foto) }}" 
                         alt="Foto {{ $siswa->nama }}"
                         class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover shadow-lg border-4 border-white transform hover:scale-110 transition duration-500">
                @else
                    <div class="w-28 h-28 sm:w-32 sm:h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-4xl font-bold shadow-lg border-4 border-white transform hover:scale-110 transition duration-500">
                        {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                    </div>
                @endif

                {{-- Glow shadow effect --}}
                <div class="absolute inset-0 rounded-full bg-blue-300/20 blur-3xl -z-10 animate-float"></div>

                {{-- Badge mini NIS --}}
                <span class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-400 to-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                    NIS : {{ $siswa->nis }}
                </span>
            </div>

            {{-- Info Profil --}}
            <div class="flex-1 space-y-4 text-gray-700 relative z-10 text-center sm:text-left lg:text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-purple-700">Profil Siswa</h2>
                <div class="w-12 h-[2px] bg-purple-300 mx-auto sm:mx-0 lg:mx-auto mb-2"></div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <p><span class="font-semibold text-gray-900">Nama :</span> {{ $siswa->nama }}</p>
                        <p><span class="font-semibold text-gray-900">Email :</span> {{ $siswa->email ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-900">Orang Tua :</span> {{ $siswa->orangTua->nama ?? '-' }}</p>
                    </div>
                    <div class="space-y-2">
                        <p><span class="font-semibold text-gray-900">Kelas :</span> {{ $siswa->kelas->nama ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-900">Wali Kelas :</span> {{ $siswa->kelas->waliKelas->nama ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-900">Status :</span> Aktif</p>
                    </div>
                </div>
            </div>

            {{-- Decorative Floating Circles --}}
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-blue-300/40 to-indigo-300/40 rounded-full blur-2xl animate-float"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-gradient-to-br from-purple-300/40 to-pink-300/40 rounded-full blur-3xl animate-float" style="animation-delay: 1s;"></div>

        </div>

        {{-- 📋 Riwayat Pengajuan Izin Siswa --}}
        <div class="bg-white/80 backdrop-blur-xl border border-gray-200 rounded-2xl shadow-md overflow-x-auto mt-4">
            <div class="p-4 bg-gradient-to-r from-purple-500 to-indigo-500 text-white flex justify-between items-center rounded-t-2xl">
                <h3 class="text-base sm:text-lg md:text-xl font-semibold">Riwayat Pengajuan Izin</h3>
                <span class="text-xs sm:text-sm opacity-80">{{ $izinList->count() }} Terbaru</span>
            </div>

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="p-3 mb-5 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="p-3 mb-5 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="p-4 sm:p-6 overflow-x-auto">
                @if($izinList->isEmpty())
                    <p class="text-gray-500 text-center py-6">Belum ada izin yang diajukan 📭</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-[600px] sm:min-w-full text-sm sm:text-base text-gray-700 border border-gray-200 rounded-2xl overflow-hidden break-words">
                            <thead class="bg-purple-50 text-purple-800 uppercase text-xs sm:text-sm font-semibold">
                                <tr>
                                    <th class="px-4 py-3 text-left">Tanggal</th>
                                    <th class="px-4 py-3 text-left">Jenis Izin</th>
                                    <th class="px-4 py-3 text-left">Alasan</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                    <th class="px-4 py-3 text-left">Bukti</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($izinList as $izin)
                                    <tr class="hover:bg-purple-50 transition duration-200">
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y') }}</td>
                                        <td class="px-4 py-2 capitalize">{{ $izin->jenis_izin }}</td>
                                        <td class="px-4 py-2">{{ $izin->alasan }}</td>
                                        <td class="px-4 py-2">
                                            @if($izin->status == 'pending')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold animate-pulse">Menunggu</span>
                                            @elseif(in_array($izin->status, ['diijinkan', 'approved']))
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold animate-pulse">Disetujui</span>
                                            @elseif(in_array($izin->status, ['ditolak', 'rejected']))
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold animate-pulse">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 ">
                                            @if($izin->bukti)
                                                @php $ext = pathinfo($izin->bukti, PATHINFO_EXTENSION); @endphp
                                                @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                                    <a href="{{ asset('storage/' . $izin->bukti) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $izin->bukti) }}" 
                                                             alt="Bukti Izin" 
                                                             class="w-12 h-12 object-cover rounded-lg shadow-md hover:scale-110 transition duration-200">
                                                    </a>
                                                @elseif(strtolower($ext) === 'pdf')
                                                    <a href="{{ asset('storage/' . $izin->bukti) }}" target="_blank"
                                                       class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold hover:bg-blue-200 transition">
                                                        PDF
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
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

{{-- 🔹 Animasi --}}
<style>
@keyframes fadeIn { from { opacity:0; transform:translateY(10px);} to{opacity:1; transform:translateY(0);} }
@keyframes float-slow { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
@keyframes float-fast { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
@keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
.animate-fadeIn { animation: fadeIn 1s ease-out forwards; }
.animate-float-slow { animation: float-slow 7s ease-in-out infinite; }
.animate-float-fast { animation: float-fast 5s ease-in-out infinite; }
.animate-float { animation: float 3s ease-in-out infinite; }
.animate-pulse { animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1;}50%{opacity:0.6;} }
</style>
@endsection
