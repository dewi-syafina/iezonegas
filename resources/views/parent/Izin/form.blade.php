@extends('layouts.app')

@section('title', 'Ajukan Izin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 py-12 px-6">
    <div class="max-w-2xl mx-auto bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-xl border border-blue-100">
        <div class="flex items-center mb-6">
            <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <h2 class="ml-4 text-2xl font-bold text-gray-800">Ajukan Izin Anak</h2>
        </div>

        {{-- 🔔 Notifikasi --}}
        @if(session('success'))
            <div class="p-3 mb-5 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="p-3 mb-5 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        
    </div>
</div>

{{-- Script Preview Foto --}}
<script>
document.getElementById('bukti_foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const img = document.getElementById('preview_img');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            img.src = event.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        img.src = '';
    }
});

const jenis = document.querySelector('select[name="jenis_izin"]');
const alasan = document.querySelector('textarea[name="alasan"]');
const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');

function updatePreview() {
    document.getElementById('preview-surat').classList.remove('hidden');
    document.getElementById('preview-nomor').innerText = 'IZIN/' + new Date().getFullYear() + '/AUTO';
    document.getElementById('preview-nama').innerText = document.querySelector('select[name="siswa_id"] option:checked').text;
    document.getElementById('preview-jenis').innerText = jenis.value;
    document.getElementById('preview-tanggal').innerText = tanggalMulai.value + ' s.d ' + tanggalSelesai.value;
    document.getElementById('preview-alasan').innerText = alasan.value;
}

jenis.addEventListener('change', updatePreview);
alasan.addEventListener('input', updatePreview);
tanggalMulai.addEventListener('change', updatePreview);
tanggalSelesai.addEventListener('change', updatePreview);
document.querySelector('select[name="siswa_id"]').addEventListener('change', updatePreview);

</script>
@endsection
