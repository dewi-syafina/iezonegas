<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IEZ-ONE | Sistem Izin Siswa</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 1000,
                once: true,
            });
        });
    </script>
</head>
<body class="antialiased bg-gradient-to-b from-blue-100 via-blue-50 to-white text-gray-800 selection:bg-blue-600 selection:text-white">

    {{-- 🌐 Navbar --}}
    <nav class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-md shadow-sm border-b border-blue-100">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">I</div>
                <span class="text-2xl font-extrabold text-blue-700">IEZ-ONE</span>
            </div>
            @if (Route::has('login'))
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 font-semibold hover:text-blue-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 font-semibold hover:text-blue-600">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-700 font-semibold hover:text-blue-600">Daftar</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    {{-- 🏠 Hero Section --}}
    <section class="flex flex-col items-center justify-center text-center min-h-screen px-6 pt-24">
        <h1 data-aos="fade-up" class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight text-blue-800">
            Selamat Datang di <span class="text-blue-500">IEZ-ONE</span>
        </h1>
        <p data-aos="fade-up" data-aos-delay="200" class="text-lg text-gray-600 max-w-2xl leading-relaxed">
            Sistem Izin Tidak Masuk Sekolah berbasis web yang mempermudah komunikasi antara siswa, orang tua, dan pihak sekolah.
        </p>

        <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap justify-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full font-semibold shadow-md hover:bg-blue-700 transition">
                    Buka Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full font-semibold shadow-md hover:bg-blue-700 transition">
                    Masuk Sekarang
                </a>
            @endauth
            <a href="#fitur" class="border border-blue-600 text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition">
                Pelajari Lebih Lanjut
            </a>
        </div>

        <!-- Efek lingkaran cahaya -->
        <div class="absolute w-72 h-72 bg-blue-400/20 rounded-full blur-3xl top-1/3 left-1/4 -z-10"></div>
        <div class="absolute w-96 h-96 bg-blue-500/10 rounded-full blur-3xl bottom-10 right-10 -z-10"></div>
    </section>

    {{-- 💡 Fitur Section --}}
    <section id="fitur" class="bg-gradient-to-r from-blue-50 to-blue-100 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 data-aos="fade-up" class="text-3xl font-bold text-center text-blue-700 mb-12">Fitur Unggulan IEZ-ONE</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div data-aos="fade-up" data-aos-delay="100" class="p-6 bg-white rounded-2xl shadow-md text-center hover:scale-105 transition">
                    <div class="text-blue-600 text-5xl mb-4">📱</div>
                    <h3 class="text-xl font-semibold mb-2">Mudah Digunakan</h3>
                    <p class="text-gray-600 text-sm">
                        Antarmuka intuitif dan responsif membuat pengguna dapat mengajukan izin kapan pun dan di mana pun.
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" class="p-6 bg-white rounded-2xl shadow-md text-center hover:scale-105 transition">
                    <div class="text-blue-600 text-5xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold mb-2">Data Aman</h3>
                    <p class="text-gray-600 text-sm">
                        Data izin disimpan aman di server dan hanya dapat diakses oleh pihak yang berwenang.
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-delay="300" class="p-6 bg-white rounded-2xl shadow-md text-center hover:scale-105 transition">
                    <div class="text-blue-600 text-5xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-2">Proses Cepat</h3>
                    <p class="text-gray-600 text-sm">
                        Orang tua dapat mengajukan izin hanya dalam hitungan detik, tanpa harus datang ke sekolah.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 📊 Statistik --}}
    <section class="py-16 bg-blue-600 text-white text-center">
        <h2 data-aos="fade-up" class="text-3xl font-bold mb-8">Statistik Penggunaan</h2>
        <div data-aos="zoom-in" class="flex justify-center gap-10 flex-wrap">
            <div>
                <div class="text-5xl font-extrabold">250+</div>
                <p class="text-sm opacity-80">Siswa Terdaftar</p>
            </div>
            <div>
                <div class="text-5xl font-extrabold">120+</div>
                <p class="text-sm opacity-80">Izin Terkirim</p>
            </div>
            <div>
                <div class="text-5xl font-extrabold">10+</div>
                <p class="text-sm opacity-80">Guru Terhubung</p>
            </div>
        </div>
    </section>

    {{-- ⚙️ Footer --}}
    <footer class="text-center py-6 bg-white text-gray-600 text-sm border-t border-gray-200">
        <p>© {{ date('Y') }} <span class="font-semibold text-blue-600">IEZ-ONE</span> — Sistem Izin Tidak Masuk Sekolah.</p>
        <p class="mt-1">Kelompok 7 XII PPLG 2 SMK Negeri 1 Sayung.</p>
    </footer>

</body>
</html>
