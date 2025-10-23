@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-10">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-blue-800 mb-3">Dashboard Wali Kelas</h1>
        <p class="text-gray-600 mb-6">
            Selamat datang, <span class="font-semibold text-blue-700">{{ auth('walikelas')->user()->name ?? 'Wali Kelas' }}</span> 👋
        </p>

        <!-- 🔔 Notifikasi -->
        @if(session('success'))
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-xl shadow-md transition-all duration-500">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

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

        <!-- Pengajuan Izin Baru -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">📩 Pengajuan Izin Baru</h2>

            @if($izinPending->isEmpty())
                <div class="bg-white shadow-md rounded-xl p-6 text-center text-gray-600">
                    Belum ada pengajuan izin baru dari orang tua siswa.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($izinPending as $izin)
                        <div class="bg-white shadow-md rounded-xl p-5 border border-blue-100 hover:shadow-lg transition">
                            <div class="flex justify-between items-center mb-3">
                                <div>
                                    <h3 class="font-bold text-blue-700">{{ $izin->siswa->nama ?? '-' }}</h3>
                                    <p class="text-gray-600 text-sm">
                                        Alasan: <span class="italic">{{ $izin->alasan }}</span><br>
                                        <span class="text-xs text-gray-400">Dikirim {{ $izin->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                            </div>
                            <form action="{{ route('walikelas.izin.update', $izin->id) }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full">
                                @csrf
                                <div class="flex items-center gap-2 w-full sm:w-auto">
                                    <select name="status" required class="border border-blue-300 rounded-lg p-2 text-gray-700 w-full sm:w-40">
                                        <option value="disetujui">Izinkan</option>
                                        <option value="ditolak">Tolak</option>
                                    </select>
                                </div>
                                <input 
                                    type="text" 
                                    name="pesan" 
                                    placeholder="Pesan singkat..." 
                                    class="border border-blue-300 rounded-lg p-2 text-gray-700 w-full sm:flex-1" 
                                />
                                <button 
                                    type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition w-full sm:w-auto"
                                >
                                    Kirim
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Riwayat Semua Izin -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">📜 Riwayat Semua Pengajuan Izin</h2>

            @if($izinAll->isEmpty())
                <div class="bg-white shadow-md rounded-xl p-6 text-center text-gray-600">
                    Belum ada data izin dari siswa.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">Nama Siswa</th>
                                <th class="py-3 px-4 text-left">Alasan</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Pesan Wali</th>
                                <th class="py-3 px-4 text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($izinAll as $izin)
                                <tr class="border-b hover:bg-blue-50 transition">
                                    <td class="py-3 px-4">{{ $izin->siswa->nama ?? '-' }}</td>
                                    <td class="py-3 px-4">{{ $izin->alasan }}</td>
                                    <td class="py-3 px-4">
                                        @if($izin->status === 'approved')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Disetujui</span>
                                        @elseif($izin->status === 'rejected')
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Ditolak</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Menunggu</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-gray-600">{{ $izin->pesan_wali ?? '-' }}</td>
                                    <td class="py-3 px-4 text-gray-500 text-sm">{{ $izin->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Alpine.js untuk notifikasi -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
