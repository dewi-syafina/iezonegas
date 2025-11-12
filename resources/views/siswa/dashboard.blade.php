@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container mx-auto p-6 space-y-10">

    {{-- 🔹 Profil Siswa --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 space-y-4">
        <h2 class="text-2xl font-bold text-blue-600 mb-4">Profil Siswa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p><span class="font-semibold">Nama:</span> {{ $siswa->nama }}</p>
                <p><span class="font-semibold">NIS:</span> {{ $siswa->nis }}</p>
                <p><span class="font-semibold">Email:</span> {{ $siswa->email ?? '-' }}</p>
            </div>
            <div>
                <p><span class="font-semibold">Kelas:</span> {{ $siswa->kelas->nama ?? '-' }}</p>
                <p><span class="font-semibold">Wali Kelas:</span> {{ $siswa->kelas->waliKelas->nama ?? '-' }}</p>
                <p><span class="font-semibold">Orang Tua:</span> {{ $siswa->orangTua->nama ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- 🔹 Riwayat Pengajuan Izin --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Riwayat Pengajuan Izin oleh Orang Tua</h2>

        @if($izinList->isEmpty())
            <p class="text-gray-500">Belum ada izin yang diajukan.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium">Tanggal</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Jenis Izin</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Alasan</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Wali Kelas</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Orang Tua</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($izinList as $izin)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-700">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 text-gray-700 capitalize">{{ $izin->jenis_izin }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $izin->alasan }}</td>
                            <td class="px-4 py-2">
                                @if($izin->status == 'pending')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Menunggu</span>
                                @elseif($izin->status == 'diijinkan' || $izin->status == 'approved')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Disetujui</span>
                                @elseif($izin->status == 'ditolak' || $izin->status == 'rejected')
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-700">{{ $izin->siswa->kelas->waliKelas->nama ?? '-' }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $izin->orangTua->nama ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
