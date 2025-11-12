@extends('layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')
<div class="container mx-auto p-6 space-y-10">

    {{-- 🔹 Profil Anak --}}
    @php
        $siswa = $parent->siswa;
        $izinAnak = $izinList->where('siswa_id', $siswa->id);
    @endphp

    <div class="bg-white shadow-lg rounded-2xl p-6 space-y-6">
        {{-- Header Profil --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-blue-600 mb-2">
                    Profil {{ $siswa->nama }} Anak dari {{ $parent->nama }}
                </h2>
                <p class="text-gray-700"><span class="font-semibold">Kelas:</span> {{ $siswa->kelas->nama }}</p>
                <p class="text-gray-700"><span class="font-semibold">Wali Kelas:</span> {{ $siswa->kelas->waliKelas->nama ?? '-' }}</p>
            </div>

            {{-- Tombol Ajukan Izin --}}
            <a href="{{ route('parent.izin.create', $siswa->id) }}"
   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-2xl shadow-lg transform hover:scale-105 hover:from-blue-600 hover:to-blue-800 transition-all duration-300">
   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
   </svg>
   Ajukan Izin
</a>

        </div>

        {{-- Riwayat Pengajuan Izin --}}
        <div>
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Riwayat Pengajuan Izin</h3>

            @if($izinAnak->isEmpty())
                <p class="text-gray-500">Belum ada izin yang diajukan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Jenis Izin</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Alasan</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($izinAnak as $izin)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-gray-700">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ ucfirst($izin->jenis_izin) }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $izin->alasan }}</td>
                                    <td class="px-4 py-2">
                                        @if($izin->status == 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Menunggu</span>
                                        @elseif($izin->status == 'diizinkan' || $izin->status == 'approved')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Disetujui</span>
                                        @elseif($izin->status == 'tidak diizinkan' || $izin->status == 'rejected')
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        @if($izin->bukti_foto)
                                            <a href="{{ asset('storage/' . $izin->bukti_foto) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
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
@endsection
