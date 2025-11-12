@extends('layouts.app')

@section('title', 'Dashboard - IEZ-ONE')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-purple-200">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold text-purple-700 mb-4">Dashboard</h2>
                    {{ __("You're logged in!") }}
                    <p class="mt-4 text-gray-600">Selamat datang di IEZ-ONE. Kelola izin siswa Anda di sini.</p>
                    <!-- Tambahkan konten dashboard lainnya di sini, seperti tabel izin, dll. -->
                </div>
            </div>
        </div>
    </div>
@endsection