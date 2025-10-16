@extends('layouts.app')

@section('title', 'Izin Anak')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Izin Anak</h1>

    {{-- Form Ajukan Izin --}}
    <div class="mb-6 p-4 border rounded bg-gray-50">
        <h2 class="text-xl font-semibold mb-2">Ajukan Izin</h2>
        <form action="{{ route('parent.izin.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="siswa_id">Pilih Anak</label>
                <select name="siswa_id" id="siswa_id" class="border p-1 w-full">
                    @foreach(Auth::user()->students as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->nis }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="border p-1 w-full" required>
            </div>
            <div class="mb-2">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="border p-1 w-full" required>
            </div>
            <div class="mb-2">
                <label for="alasan">Alasan</label>
                <textarea name="alasan" id="alasan" class="border p-1 w-full" required></textarea>
            </div>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Ajukan</button>
        </form>
    </div>

    {{-- Riwayat Izin --}}
    <h2 class="text-xl font-semibold mb-2">Riwayat Izin</h2>
    @if($izins->count())
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-2 py-1">Anak</th>
                    <th class="border px-2 py-1">Mulai</th>
                    <th class="border px-2 py-1">Selesai</th>
                    <th class="border px-2 py-1">Alasan</th>
                    <th class="border px-2 py-1">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($izins as $izin)
                    <tr>
                        <td class="border px-2 py-1">{{ $izin->siswa->nama }}</td>
                        <td class="border px-2 py-1">{{ $izin->tanggal_mulai }}</td>
                        <td class="border px-2 py-1">{{ $izin->tanggal_selesai }}</td>
                        <td class="border px-2 py-1">{{ $izin->alasan }}</td>
                        <td class="border px-2 py-1 capitalize">
                            @if($izin->status == 'pending')
                                <span class="text-yellow-600 font-bold">Pending</span>
                            @elseif($izin->status == 'approved')
                                <span class="text-green-600 font-bold">Approved</span>
                            @else
                                <span class="text-red-600 font-bold">Rejected</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada izin yang diajukan.</p>
    @endif
</div>
@endsection
