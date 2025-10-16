@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Dashboard Orang Tua</h2>

    @if($child)
        <div class="bg-blue-50 p-4 rounded-lg shadow mb-6">
            <p class="font-bold text-blue-800">{{ $child->nama }}</p>
            <p class="text-gray-600">NIS: {{ $child->nis }}</p>
            <p class="text-gray-600">Kelas: {{ $child->kelas }}</p>
            <a href="{{ route('orangtua.izin.create', $child->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-3 inline-block">
               Ajukan Izin
            </a>
        </div>
    @else
        <p class="text-gray-600 mb-6">Belum ada data anak terkait NIS yang Anda daftarkan.</p>
    @endif

    <h3 class="text-lg font-semibold mb-3">📄 Riwayat Pengajuan Izin</h3>
    <table class="w-full border-collapse border border-gray-300 rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-blue-100 text-left">
                <th class="border px-3 py-2">Tanggal</th>
                <th class="border px-3 py-2">Jenis Izin</th>
                <th class="border px-3 py-2">Alasan</th>
                <th class="border px-3 py-2">Status</th>
                <th class="border px-3 py-2">Bukti</th>
            </tr>
        </thead>
        <tbody>
            @forelse($izins as $izin)
                <tr>
                    <td class="border px-3 py-2">{{ $izin->tanggal_mulai }} - {{ $izin->tanggal_selesai }}</td>
                    <td class="border px-3 py-2">{{ $izin->jenis_izin }}</td>
                    <td class="border px-3 py-2">{{ $izin->alasan }}</td>
                    <td class="border px-3 py-2">
                        @if($izin->status == 'Pending')
                            <span class="text-yellow-600 font-semibold">Menunggu</span>
                        @elseif($izin->status == 'Approved')
                            <span class="text-green-600 font-semibold">Disetujui</span>
                        @else
                            <span class="text-red-600 font-semibold">Ditolak</span>
                        @endif
                    </td>
                    <td class="border px-3 py-2">
                        @if($izin->bukti_foto)
                            <a href="{{ asset('storage/'.$izin->bukti_foto) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-3">Belum ada izin diajukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
