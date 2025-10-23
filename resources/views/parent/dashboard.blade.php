@extends('layouts.app')
@section('title', 'Dashboard Orang Tua')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 py-16 px-6">
    <div class="max-w-6xl mx-auto space-y-10 animate-fade-in">

    {{-- Judul --}}
    <div class="text-center mb-8">
        <h2 class="text-3xl font-extrabold text-blue-700">📋 Dashboard Orang Tua</h2>
        <p class="text-gray-500 mt-2 text-sm">Pantau dan ajukan izin untuk anak Anda dengan mudah</p>
    </div>

    {{-- Profil Anak --}}
    @if($child)
    <div class="bg-white/90 backdrop-blur-md shadow-xl rounded-2xl border border-blue-100 overflow-hidden transition transform hover:-translate-y-1 hover:shadow-2xl">
        <div class="p-6 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-400 text-white flex justify-between items-center">
            <h2 class="text-2xl font-bold">Data Anak</h2>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-base">
            <p><span class="font-semibold text-blue-700">Nama:</span> {{ $child->nama }}</p>
            <p><span class="font-semibold text-blue-700">NIS:</span> {{ $child->nis }}</p>
            <p><span class="font-semibold text-blue-700">Kelas:</span> {{ $child->kelas }}</p>
            <p><span class="font-semibold text-blue-700">Jurusan:</span> {{ $child->jurusan ?? '-' }}</p>
        </div>

        <div class="p-6 border-t border-blue-100 flex justify-end bg-blue-50/50">
            <a href="{{ route('parent.izin.create', $child->id) }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition duration-200 ease-in-out">
                + Ajukan Izin
            </a>
        </div>
    </div>
    @else
    <div class="bg-white/90 backdrop-blur-md shadow-md rounded-2xl p-10 text-center border border-blue-100">
        <img src="https://cdn-icons-png.flaticon.com/512/7476/7476362.png" alt="No Child" class="w-24 mx-auto mb-4 opacity-80">
        <p class="text-gray-600 text-lg">Belum ada data anak terkait NIS yang Anda daftarkan.</p>
    </div>
    @endif

    {{-- Riwayat Pengajuan Izin --}}
    <div class="bg-white/90 backdrop-blur-md shadow-xl rounded-2xl border border-blue-100 overflow-hidden transition transform hover:-translate-y-1 hover:shadow-2xl">
        <div class="p-6 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-400 text-white flex justify-between items-center">
            <h2 class="text-2xl font-bold">Riwayat Pengajuan Izin</h2>
        </div>

        <div class="p-6">
            @if($izins->isEmpty())
                <div class="text-center py-10 text-gray-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="No Data" class="mx-auto w-28 mb-3 opacity-80">
                    <p class="text-lg">Belum ada izin yang diajukan.</p>
                </div>
            @else
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($izins as $izin)
                        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-5 hover:shadow-lg transition duration-300 ease-in-out">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-blue-700 font-bold text-lg capitalize">{{ $izin->jenis_izin }}</h3>
                               @if($izin->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span>
                            @elseif($izin->status == 'approved')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Disetujui</span>
                            @elseif($izin->status == 'rejected')
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Ditolak</span>
                            @endif
                            </div>

                            <p class="text-gray-600 text-sm mb-2">
                                <span class="font-semibold text-gray-800">Tanggal:</span><br>
                                {{ $izin->tanggal_mulai }} s.d {{ $izin->tanggal_selesai }}
                            </p>
                            <p class="text-gray-600 text-sm mb-3">
                                <span class="font-semibold text-gray-800">Alasan:</span><br>
                                {{ $izin->alasan }}
                            </p>

                            @if($izin->status == 'Rejected' && !empty($izin->pesan_wali))
                                <div class="text-sm text-red-600 bg-red-50 p-2 rounded-md mb-3 border border-red-100">
                                    <span class="font-semibold">Catatan Wali:</span> {{ $izin->pesan_wali }}
                                </div>
                            @elseif($izin->status == 'Approved' && !empty($izin->pesan_wali))
                                <div class="text-sm text-green-600 bg-green-50 p-2 rounded-md mb-3 border border-green-100">
                                    <span class="font-semibold">Catatan Wali:</span> {{ $izin->pesan_wali }}
                                </div>
                            @endif

                            <div class="flex justify-end">
                                @if($izin->bukti_foto)
                                    <a href="{{ asset('storage/'.$izin->bukti_foto) }}" target="_blank"
                                    class="text-blue-600 font-semibold hover:underline flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553 4.553a2 2 0 01-2.828 2.828L12 12.828l-4.725 4.553a2 2 0 01-2.828-2.828L9 10m6 0V4m0 6l-6-6" />
                                        </svg>
                                        Lihat Bukti
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada bukti</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    </div>

</div>


</div>

{{-- Animasi lembut --}}

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.6s ease-out; }
</style>

@endsection
