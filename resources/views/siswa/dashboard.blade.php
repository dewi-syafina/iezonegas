@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 py-16 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- 🔔 Notifikasi --}}
        @if(session('success'))
            <div class="p-4 bg-green-100 border border-green-300 rounded-xl shadow-md flex items-center justify-between animate-fade-in">
                <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">&times;</button>
            </div>
        @elseif(session('error'))
            <div class="p-4 bg-red-100 border border-red-300 rounded-xl shadow-md flex items-center justify-between animate-fade-in">
                <p class="text-red-800 font-semibold">{{ session('error') }}</p>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">&times;</button>
            </div>
        @endif

        {{-- 👨‍🎓 Profil Siswa --}}
        <div class="bg-white/90 backdrop-blur-md shadow-xl rounded-2xl border border-blue-100 overflow-hidden transition transform hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-400 text-white flex justify-between items-center">
                <h2 class="text-2xl font-bold">Profil Siswa</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.082 12.082 0 0118 20H6a12.082 12.082 0 01-.16-9.422L12 14z" />
                </svg>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-lg">
                <p><span class="font-semibold text-blue-700">Nama:</span> {{ $siswa->nama }}</p>
                <p><span class="font-semibold text-blue-700">NIS:</span> {{ $siswa->nis }}</p>
                <p><span class="font-semibold text-blue-700">Email:</span> {{ $siswa->email ?? '-' }}</p>
                <p><span class="font-semibold text-blue-700">Kelas:</span> {{ $siswa->kelas }}</p>
                <p><span class="font-semibold text-blue-700">Jurusan:</span> {{ $siswa->jurusan ?? '-' }}</p>
            </div>
        </div>

        {{-- 📋 Riwayat Pengajuan Izin --}}
        <div class="bg-white/90 backdrop-blur-md shadow-xl rounded-2xl border border-blue-100 overflow-hidden transition transform hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-400 text-white flex justify-between items-center">
                <h2 class="text-2xl font-bold">Riwayat Pengajuan Izin</h2>
            </div>

            <div class="p-6">
                @if($izinList->isEmpty())
                    <div class="text-center py-10 text-gray-600">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="No Data" class="mx-auto w-28 mb-3 opacity-80">
                        <p class="text-lg">Belum ada izin yang diajukan oleh orang tua.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full border border-gray-200 shadow-md rounded-lg overflow-hidden text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-500 to-blue-400 text-white">
                                    <th class="border px-4 py-3 text-left">Tanggal</th>
                                    <th class="border px-4 py-3 text-left">Jenis Izin</th>
                                    <th class="border px-4 py-3 text-left">Alasan</th>
                                    <th class="border px-4 py-3 text-left">Status</th>
                                    <th class="border px-4 py-3 text-left">Wali Kelas</th>
                                    <th class="border px-4 py-3 text-left">Pesan</th>
                                    <th class="border px-4 py-3 text-left">Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($izinList as $izin)
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="border px-4 py-2">{{ $izin->created_at->format('d-m-Y') }}</td>
                                        <td class="border px-4 py-2 capitalize">{{ $izin->jenis_izin }}</td>
                                        <td class="border px-4 py-2">{{ $izin->alasan }}</td>
                                        <td class="border px-4 py-2">
                                            @if($izin->status === 'pending')
                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span>
                                            @elseif($izin->status === 'approved')
                                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Disetujui</span>
                                            @elseif($izin->status === 'rejected')
                                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2">{{ $izin->waliKelas->name ?? '-' }}</td>
                                        <td class="border px-4 py-2 italic text-gray-600">
                                            {{ $izin->pesan_wali ?? '-' }}
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            @if($izin->bukti_foto)
                                                <a href="{{ asset('storage/' . $izin->bukti_foto) }}" target="_blank"
                                                    class="text-blue-600 font-semibold hover:underline flex items-center justify-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15 10l4.553 4.553a2 2 0 01-2.828 2.828L12 12.828l-4.725 4.553a2 2 0 01-2.828-2.828L9 10m6 0V4m0 6l-6-6" />
                                                        </svg>
                                                        Lihat
                                                </a>
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

{{-- Animasi kecil --}}
<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.4s ease-out; }
</style>
@endsection
