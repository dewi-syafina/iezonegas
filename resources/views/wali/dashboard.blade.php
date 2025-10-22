@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-10">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-blue-800 mb-3">Dashboard Wali Kelas</h1>
        <p class="text-gray-600 mb-6">Selamat datang, 
            <span class="font-semibold text-blue-700">{{ auth('walikelas')->user()->name ?? 'Wali Kelas' }}</span> 👋
        </p>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="p-5 bg-white shadow-lg rounded-2xl border-t-4 border-blue-400">
                <h3 class="text-gray-700 font-semibold mb-2">Menunggu Persetujuan</h3>
                <p class="text-4xl font-extrabold text-blue-500">{{ $izinCount['pending'] }}</p>
            </div>
            <div class="p-5 bg-white shadow-lg rounded-2xl border-t-4 border-green-400">
                <h3 class="text-gray-700 font-semibold mb-2">Disetujui</h3>
                <p class="text-4xl font-extrabold text-green-500">{{ $izinCount['disetujui'] }}</p>
            </div>
            <div class="p-5 bg-white shadow-lg rounded-2xl border-t-4 border-red-400">
                <h3 class="text-gray-700 font-semibold mb-2">Ditolak</h3>
                <p class="text-4xl font-extrabold text-red-500">{{ $izinCount['ditolak'] }}</p>
            </div>
        </div>

        <!-- Notifikasi Izin Baru -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">🔔 Pengajuan Izin Baru</h2>

            @if($izinPending->isEmpty())
                <div class="bg-white shadow-md rounded-xl p-6 text-center text-gray-600">
                    Belum ada pengajuan izin baru dari orang tua siswa.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($izinPending as $izin)
                        <div class="bg-white shadow-md rounded-xl p-5 border border-blue-100">
                            <div class="flex justify-between items-center mb-3">
                                <div>
                                    <h3 class="font-bold text-blue-700">{{ $izin->siswa->nama ?? '-' }}</h3>
                                    <p class="text-gray-600 text-sm">
                                        Mengajukan izin: <span class="italic">{{ $izin->alasan }}</span><br>
                                        <span class="text-xs text-gray-400">
                                            Dikirim {{ $izin->created_at->diffForHumans() }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <form action="{{ route('walikelas.izin.update', $izin->id) }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                                @csrf
                                <select name="status" required class="border-2 border-blue-200 rounded-lg p-2 text-gray-700 w-full sm:w-auto">
                                    <option value="disetujui">Izinkan</option>
                                    <option value="ditolak">Tolak</option>
                                </select>
                                <input type="text" name="pesan" placeholder="Pesan singkat..." class="border-2 border-blue-200 rounded-lg p-2 flex-1 text-gray-700" />
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Kirim
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
