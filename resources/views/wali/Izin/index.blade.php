@extends('layouts.app')

@section('title', 'Daftar Pengajuan Izin Siswa')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">📋 Pengajuan Izin Siswa</h1>

    @if($izins->isEmpty())
        <div class="text-center py-10 text-gray-600">
            <p class="text-lg">Belum ada izin yang diajukan oleh siswa kelas Anda.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border text-sm">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border px-3 py-2">Nama Siswa</th>
                        <th class="border px-3 py-2">Tanggal</th>
                        <th class="border px-3 py-2">Alasan</th>
                        <th class="border px-3 py-2">Status</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($izins as $izin)
                        <tr class="hover:bg-blue-50">
                            <td class="border px-3 py-2">{{ $izin->siswa->nama }}</td>
                            <td class="border px-3 py-2">{{ $izin->tanggal_mulai }} - {{ $izin->tanggal_selesai }}</td>
                            <td class="border px-3 py-2">{{ $izin->alasan }}</td>
                            <td class="border px-3 py-2 capitalize">
                                @if($izin->status == 'pending')
                                    <span class="text-yellow-600 font-semibold">Menunggu</span>
                                @elseif($izin->status == 'approved')
                                    <span class="text-green-600 font-semibold">Disetujui</span>
                                @else
                                    <span class="text-red-600 font-semibold">Ditolak</span>
                                @endif
                            </td>
                            <td class="border px-3 py-2">
                                <form action="{{ route('wali.izin.update', $izin->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="border p-1 rounded">
                                        <option value="approved">Setujui</option>
                                        <option value="rejected">Tolak</option>
                                    </select>
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded ml-2">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
