@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Izin</h2>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Tanggal</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($izin as $i)
            <tr>
                <td>{{ $i->student->nama }}</td>
                <td>{{ $i->tanggal }}</td>
                <td>{{ $i->alasan }}</td>
                <td>{{ $i->status }}</td>
                <td>
                    @if($i->status == 'Menunggu')
                    <form action="{{ route('wali.izin.update', $i->id) }}" method="POST">
                        @csrf
                        <select name="status">
                            <option value="Diizinkan">Setujui</option>
                            <option value="Ditolak">Tolak</option>
                        </select>
                        <button type="submit">Simpan</button>
                    </form>
                    @else
                        {{ $i->status }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
