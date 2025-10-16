@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Data Izin Anak</h2>
<table class="table-auto border w-full">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 border">Tanggal</th>
            <th class="px-4 py-2 border">Alasan</th>
            <th class="px-4 py-2 border">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($izins as $izin)
        <tr>
            <td class="border px-4 py-2">{{ $izin->tanggal }}</td>
            <td class="border px-4 py-2">{{ $izin->alasan }}</td>
            <td class="border px-4 py-2">{{ $izin->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
