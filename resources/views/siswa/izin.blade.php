@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Form Pengajuan Izin</h2>
<form action="{{ route('siswa.izin.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block">Tanggal:</label>
        <input type="date" name="tanggal" class="border p-2 w-full">
    </div>
    <div>
        <label class="block">Alasan:</label>
        <textarea name="alasan" class="border p-2 w-full"></textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
</form>
@endsection
