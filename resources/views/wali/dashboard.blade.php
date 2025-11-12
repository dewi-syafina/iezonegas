@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas')

@section('content')
<div class="container mx-auto p-6 space-y-10">

    {{-- 🔹 Profil Wali Kelas --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 space-y-4">
        <h2 class="text-2xl font-bold text-blue-600 mb-2">Profil Wali Kelas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div>
                <p><span class="font-semibold">Nama:</span> {{ $wali->nama }}</p>
                <p><span class="font-semibold">NIP:</span> {{ $wali->nip }}</p>
                <p><span class="font-semibold">Email:</span> {{ $wali->email }}</p>
                <p><span class="font-semibold">Jumlah Siswa:</span> {{ $wali->kelas->sum(fn($k) => $k->siswa->count()) }}</p>
            </div>
        </div>
    </div>

    {{-- 🔹 Daftar Izin Siswa --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 space-y-4">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Daftar Izin Siswa</h3>

        @if(session('status'))
            <div class="p-2 mb-4 bg-green-100 text-green-700 rounded">{{ session('status') }}</div>
        @endif

        @if($izins->isEmpty())
            <p class="text-gray-500">Belum ada izin masuk.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Siswa</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Alasan</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($izins as $izin)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $izin->siswa->nama }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y') }}</td>
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
                                <td class="px-4 py-2 text-center">
                                    
                                    @if($izin->status == 'pending')
                                        <form action="{{ route('walikelas.izin.update', $izin->id) }}" method="POST" class="flex gap-2 justify-center">
                                            @csrf
                                            <button name="status" value="diizinkan" class="px-3 py-1 bg-green-500 text-white rounded-xl hover:bg-green-600 transition">Diijinkan</button>
    <button name="status" value="tidak diizinkan" class="px-3 py-1 bg-red-500 text-white rounded-xl hover:bg-red-600 transition">Ditolak</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Selesai</span>
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
@endsection
