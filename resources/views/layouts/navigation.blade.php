<!-- resources/views/layouts/navbar.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'IEZ-ONE'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 1000, once: true });
        });
    </script>

    <!-- Tailwind + custom styles -->
    <style>
        body { padding-top: 80px; background: linear-gradient(135deg, #F0E6FF 0%, #E6F7FF 50%, #FFF5E6 100%); }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .nav-link { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 1rem; font-weight: 500; transition: all 0.3s ease; text-decoration: none; }
        .nav-link:hover { transform: scale(1.05); box-shadow: 0 4px 15px rgba(123,104,238,0.3); }
        .nav-link-primary { background: linear-gradient(135deg, #7B68EE, #20B2AA); color: white; }
        .nav-link-secondary { background: linear-gradient(135deg, #FFDAB9, #F0E68C); color: #7B68EE; }
        .nav-link-secondary:hover { background: linear-gradient(135deg, #FFA07A, #F0E68C); }
    </style>
</head>
<body class="font-sans text-gray-800 antialiased">

@php
    $guards = ['siswa', 'parent', 'walikelas'];
    $loggedInGuard = null;
    foreach ($guards as $g) {
        if (auth()->guard($g)->check()) {
            $loggedInGuard = $g;
            break;
        }
    }
@endphp

<div class="flex flex-wrap justify-center gap-4 items-center">
    @if ($loggedInGuard)
        <a href="{{ url('/dashboard') }}" 
           class="bg-purple-400 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold shadow-lg hover:bg-purple-500 transition transform hover:scale-105">
           Buka Dashboard
        </a>

        {{-- Tombol Logout --}}
        @if($loggedInGuard == 'siswa')
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-siswa-form').submit();" 
               class="bg-red-400 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold shadow-lg hover:bg-red-500 transition transform hover:scale-105">
               Logout Siswa
            </a>
            <form id="logout-siswa-form" action="{{ route('siswa.logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @elseif($loggedInGuard == 'parent')
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-parent-form').submit();" 
               class="bg-red-400 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold shadow-lg hover:bg-red-500 transition transform hover:scale-105">
               Logout Orang Tua
            </a>
            <form id="logout-parent-form" action="{{ route('parent.logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @elseif($loggedInGuard == 'walikelas')
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-walikelas-form').submit();" 
               class="bg-red-400 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold shadow-lg hover:bg-red-500 transition transform hover:scale-105">
               Logout Wali Kelas
            </a>
            <form id="logout-walikelas-form" action="{{ route('walikelas.logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @endif

    @else
        <!-- Dropdown LOGIN -->
        <div class="relative inline-block text-left">
            <button type="button" 
                    class="bg-orange-400 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold shadow-lg hover:bg-orange-500 transition transform hover:scale-105 focus:outline-none"
                    id="login-button"
                    onclick="document.getElementById('dropdown-login').classList.toggle('hidden')">
                Masuk Sekarang
            </button>
            <div id="dropdown-login"
                 class="hidden absolute mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                <div class="py-2">
                    <a href="{{ route('siswa.login') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-orange-100">Login Siswa</a>
                    <a href="{{ route('parent.login') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-orange-100">Login Orang Tua</a>
                    <a href="{{ route('walikelas.login') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-orange-100">Login Wali Kelas</a>
                </div>
            </div>
        </div>
        <!-- Dropdown REGISTER -->
        <div class="relative inline-block text-left">
            <button type="button" 
                    class="bg-purple-400 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold shadow-lg hover:bg-purple-500 transition transform hover:scale-105 focus:outline-none"
                    id="register-button"
                    onclick="document.getElementById('dropdown-register').classList.toggle('hidden')">
                Daftar Sekarang
            </button>
            <div id="dropdown-register"
                 class="hidden absolute mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                <div class="py-2">
                    <a href="{{ route('siswa.register') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-purple-100">Daftar Siswa</a>
                    <a href="{{ route('parent.register') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-purple-100">Daftar Orang Tua</a>
                    <a href="{{ route('walikelas.register') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-purple-100">Daftar Wali Kelas</a>
                </div>
            </div>
        </div>
    @endif

    <!-- Tombol pelajari -->
    <a href="#fitur" 
       class="border-2 border-purple-400 text-purple-700 px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold hover:bg-purple-50 transition transform hover:scale-105">
       Pelajari Lebih Lanjut
    </a>
</div>

<script>
    // Klik di luar dropdown untuk menutup
    document.addEventListener('click', function(e) {
        const button = document.getElementById('menu-button');
        const dropdown = document.getElementById('dropdown-login');
        if (!button.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
</body>
</html>
