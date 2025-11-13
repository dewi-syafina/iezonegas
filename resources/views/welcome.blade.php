@extends('layouts.app')

@section('title', 'IEZ-ONE | Sistem Izin Siswa')

@section('content')
{{-- 🏠 Hero Section --}}
<div class=>
<section class="relative flex flex-col items-center justify-center text-center min-h-screen px-6  overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-green-50/50"></div>

    <h1 data-aos="fade-up" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight text-purple-800 relative z-10">
        Selamat Datang di <span class="text-orange-500 animate-float">IEZ-ONE</span>
    </h1>

    <p data-aos="fade-up" data-aos-delay="200" class="text-base sm:text-lg md:text-xl text-gray-600 max-w-xl md:max-w-2xl leading-relaxed relative z-10">
        Sistem Izin Tidak Masuk Sekolah berbasis web yang mempermudah komunikasi antara siswa, orang tua, dan pihak sekolah dengan sentuhan pastel yang menyenangkan.
    </p>

    {{-- 🔽 Tombol Login Dropdown --}}
    <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap justify-center gap-4 relative z-10">
        @php
            $guards = ['web', 'siswa', 'parent', 'walikelas'];
            $isLoggedIn = false;
            foreach ($guards as $g) {
                if (auth()->guard($g)->check()) {
                    $isLoggedIn = true;
                    break;
                }
            }
        @endphp

            <a href="{{ route('login') }}" 
                        class="bg-orange-400 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold shadow-lg hover:bg-orange-500 transition transform hover:scale-105 focus:outline-none"
>               Masuk Sekarang
            </a>
        

        <a href="#fitur" class="border-2 border-purple-400 text-purple-700 px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold hover:bg-purple-50 transition transform hover:scale-105">
            Pelajari Lebih Lanjut
        </a>
    </div>

    <!-- Efek lingkaran pastel -->
    <div class="absolute w-56 h-56 sm:w-72 sm:h-72 bg-orange-200/20 rounded-full blur-3xl top-1/4 left-1/4 -z-10 animate-float"></div>
    <div class="absolute w-80 h-80 sm:w-96 sm:h-96 bg-green-200/20 rounded-full blur-3xl bottom-10 right-10 -z-10 animate-float" style="animation-delay: 1.5s;"></div>
    <div class="absolute w-48 h-48 sm:w-64 sm:h-64 bg-purple-200/20 rounded-full blur-3xl top-1/2 right-1/4 -z-10 animate-float" style="animation-delay: 3s;"></div>
</section>

{{-- 💡 Fitur Section --}}
<section id="fitur" class="bg-gradient-to-r from-green-50 to-orange-50 py-16">
    <div class="max-w-6xl mx-auto px-6">
        <h2 data-aos="fade-up" class="text-2xl sm:text-3xl font-bold text-center text-purple-700 mb-12">Fitur Unggulan IEZ-ONE</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @php
            $features = [
                ['icon'=>'📱','title'=>'Mudah Digunakan','desc'=>'Antarmuka intuitif dan responsif membuat pengguna dapat mengajukan izin kapan pun dan di mana pun.','color'=>'orange-500','border'=>'green-200'],
                ['icon'=>'🔒','title'=>'Data Aman','desc'=>'Data izin disimpan aman di server dan hanya dapat diakses oleh pihak yang berwenang.','color'=>'green-500','border'=>'purple-200'],
                ['icon'=>'⚡','title'=>'Proses Cepat','desc'=>'Orang tua dapat mengajukan izin hanya dalam hitungan detik, tanpa harus datang ke sekolah.','color'=>'purple-500','border'=>'orange-200']
            ];
            @endphp

            @foreach($features as $feature)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index*100 }}" class="p-6 bg-white rounded-2xl shadow-lg text-center hover:scale-105 transition transform border border-{{ $feature['border'] }} hover:shadow-xl">
                    <div class="text-4xl sm:text-5xl mb-4 animate-float">{{ $feature['icon'] }}</div>
                    <h3 class="text-xl font-semibold mb-2 text-purple-700">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600 text-sm sm:text-base">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

</div>


<script>
    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function(e) {
        const button = document.getElementById('menu-button');
        const dropdown = document.getElementById('dropdown-login');
        if (dropdown && !button.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endsection
