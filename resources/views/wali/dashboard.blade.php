@extends('layouts.app-siswa')

@section('title', 'Dashboard Wali Kelas | IEZ-ONE')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50/50 to-green-50/50 py-12 pt-32 px-4 sm:px-6 lg:px-12 relative overflow-hidden mt-4">

    {{-- 🌈 Floating Pastel Background --}}
    <div class="absolute -top-20 -left-20 w-72 h-72 sm:w-96 sm:h-96 bg-pink-200/30 rounded-full blur-3xl animate-float-slow"></div>
    <div class="absolute -bottom-20 -right-20 w-80 h-80 sm:w-[28rem] sm:h-[28rem] bg-blue-200/30 rounded-full blur-3xl animate-float-fast" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/3 right-1/4 w-56 h-56 sm:w-72 sm:h-72 bg-purple-200/30 rounded-full blur-3xl animate-float-slow" style="animation-delay: 2s;"></div>

    {{-- 🌟 Header --}}
    <div class="text-center max-w-3xl mx-auto mb-10 relative z-10 animate-fadeIn">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-blue-700 mb-2">Halo, {{ $wali->nama }} 👋</h1>
        <p class="text-gray-600 text-base sm:text-lg md:text-xl">Kelola dan pantau pengajuan izin siswa dengan tampilan modern & intuitif.</p>
    </div>

    {{-- 👨‍🏫 Profil + Statistik --}}
    <div class="relative z-10 mb-12 max-w-5xl mx-auto grid grid-cols-1 gap-6 lg:gap-8">

    {{-- 🧩 Card Profil Estetik --}}
    <div class="rounded-3xl p-6 sm:p-8 flex flex-col sm:flex-row lg:flex-col items-center gap-4 sm:gap-6 hover:shadow-3xl transition">
        <div class="relative">
            <div class="w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white text-3xl sm:text-4xl font-bold shadow-lg">
                {{ strtoupper(substr($wali->nama,0,1)) }}
            </div>
            <div class="absolute -bottom-1 -right-1 bg-green-400 border-2 border-white w-5 h-5 rounded-full animate-pulse"></div>
        </div>
        <div class="text-center sm:text-left lg:text-center space-y-1 sm:space-y-2 text-gray-700">
            <h2 class="text-xl sm:text-2xl font-bold text-purple-700">Profil Wali Kelas</h2>
            <div class="w-12 h-[2px] bg-purple-300 mx-auto sm:mx-0 lg:mx-auto mb-2"></div>
            <p><span class="font-semibold">Nama:</span> {{ $wali->nama }}</p>
            <p><span class="font-semibold">NIP:</span> {{ $wali->nip }}</p>
            <p><span class="font-semibold">Email:</span> {{ $wali->email }}</p>
            <p><span class="font-semibold">Jumlah Siswa:</span> {{ $wali->kelas->sum(fn($k) => $k->siswa->count()) }}</p>
        </div>
    </div>

    {{-- 📊 Statistik Modern --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mt-4">
        <div class="bg-gradient-to-br from-purple-100 to-purple-50 rounded-3xl p-4 sm:p-6 text-center shadow-lg hover:shadow-2xl transition">
            <p class="text-2xl sm:text-3xl font-extrabold text-purple-700">{{ $izins->count() }}</p>
            <p class="text-sm sm:text-base font-semibold text-gray-600 mt-1">Total Pengajuan</p>
        </div>
        <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-3xl p-4 sm:p-6 text-center shadow-lg hover:shadow-2xl transition">
            <p class="text-2xl sm:text-3xl font-extrabold text-green-600">{{ $izins->where('status','diizinkan')->count() }}</p>
            <p class="text-sm sm:text-base font-semibold text-gray-600 mt-1">Disetujui</p>
        </div>
        <div class="bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-3xl p-4 sm:p-6 text-center shadow-lg hover:shadow-2xl transition">
            <p class="text-2xl sm:text-3xl font-extrabold text-yellow-600">{{ $izins->where('status','pending')->count() }}</p>
            <p class="text-sm sm:text-base font-semibold text-gray-600 mt-1">Menunggu</p>
        </div>
        <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-3xl p-4 sm:p-6 text-center shadow-lg hover:shadow-2xl transition">
            <p class="text-2xl sm:text-3xl font-extrabold text-red-600">{{ $izins->where('status','tidak diizinkan')->count() }}</p>
            <p class="text-sm sm:text-base font-semibold text-gray-600 mt-1">Ditolak</p>
        </div>
    </div>
</div>


    {{-- 📋 Riwayat Pengajuan Izin Siswa --}}
    <div class="bg-white/80 backdrop-blur-xl border border-gray-200 rounded-2xl shadow-md overflow-x-auto mt-6">
        <div class="p-4 bg-gradient-to-r from-purple-500 to-indigo-500 text-white flex justify-between items-center rounded-t-2xl">
            <h3 class="text-base sm:text-lg md:text-xl font-semibold">Riwayat Pengajuan Izin</h3>
            <span class="text-xs sm:text-sm opacity-80">{{ $izins->count() }} Terbaru</span>
        </div>

        <div class="p-4 sm:p-6 overflow-x-auto">
            @if($izins->isEmpty())
                <p class="text-gray-500 italic text-center py-6">Belum ada pengajuan izin masuk 📭</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-[600px] sm:min-w-full text-sm sm:text-base text-gray-700 border border-gray-200 rounded-2xl overflow-hidden break-words">
                        <thead class="bg-purple-50 text-purple-800 uppercase text-xs sm:text-sm font-semibold">
                            <tr>
                                <th class="px-4 py-3 text-left">Siswa</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3 text-left">Alasan</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($izins as $izin)
                                <tr class="hover:bg-purple-50 transition-all duration-200 ease-in-out">
                                    <td class="px-4 py-3 font-medium text-purple-700">{{ $izin->siswa->nama }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $izin->alasan }}</td>
                                    <td class="px-4 py-3">
                                        @if($izin->status == 'pending')
                                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold animate-pulse">Menunggu</span>
                                        @elseif($izin->status == 'diizinkan')
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Disetujui</span>
                                        @elseif($izin->status == 'tidak diizinkan')
                                            <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($izin->status == 'pending')
                                            <form action="{{ route('walikelas.izin.update', $izin->id) }}" method="POST" class="flex gap-2 justify-center flex-wrap">
                                                @csrf
                                                <button name="status" value="diizinkan" class="px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600 transition text-sm shadow-md">Diizinkan</button>
                                                <button name="status" value="tidak diizinkan" class="px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition text-sm shadow-md">Ditolak</button>
                                            </form>
                                        @else
                                            <span class="text-gray-500 font-medium">Selesai</span>
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
</style>
@endsection
