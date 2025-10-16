@extends('layouts.app')


<pre>
{{ dd($siswa, $izinList) }}
</pre>

@section('content')
<div class="container mx-auto px-6 pt-20">

    {{-- Profil Siswa --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-6 border border-blue-100">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Profil Siswa</h2>
        <div class="text-gray-700 text-lg space-y-2">
            <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
            <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
            <p><strong>Email:</strong> {{ $siswa->email ?? '-' }}</p>
            <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
            <p><strong>Jurusan:</strong> {{ $siswa->jurusan ?? '-' }}</p>
        </div>
    </div>

    {{-- Riwayat Izin --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 border border-blue-100">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Riwayat Izin</h2>

        @if($izinList->isEmpty())
            <p class="text-gray-600">Belum ada izin yang diajukan oleh orang tua.</p>
        @else
            <table class="min-w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Alasan</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Wali Kelas</th>
                        <th class="border px-4 py-2">Surat Izin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($izinList as $izin)
                        <tr>
                            <td class="border px-4 py-2">{{ $izin->created_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">{{ $izin->alasan }}</td>
                            <td class="border px-4 py-2">{{ $izin->status }}</td>
                            <td class="border px-4 py-2">{{ $izin->waliKelas->name ?? '-' }}</td>
                            <td class="border px-4 py-2">
                                @if($izin->surat_path)
                                    <a href="{{ asset('storage/bukti_izin/' . $izin->bukti_foto) }}" target="_blank" class="text-blue-600 underline">
                                        Lihat Surat
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection
