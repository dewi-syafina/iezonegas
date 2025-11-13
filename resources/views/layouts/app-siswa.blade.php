<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'IEZ-ONE'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 1000, once: true });
        });
    </script>



    <style>
        body {
            background: linear-gradient(135deg, #F0E6FF 0%, #E6F7FF 50%, #FFF5E6 100%);
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.8s ease-in-out; }
        @keyframes float { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        .animate-float { animation: float 3s ease-in-out infinite; }

        .nav-link { 
            display: inline-flex; 
            align-items: center; 
            gap: 0.5rem; 
            padding: 0.5rem 1rem; 
            border-radius: 1rem; 
            font-weight: 600; 
            transition: all 0.3s ease; 
            text-decoration: none; 
        }
        .nav-link:hover { 
            transform: scale(1.05); 
            box-shadow: 0 4px 15px rgba(123, 104, 238, 0.3); 
        }
        .nav-link-primary { background: linear-gradient(135deg, #7B68EE, #20B2AA); color: white; }
        .nav-link-secondary { background: linear-gradient(135deg, #FFDAB9, #F0E68C); color: #7B68EE; }
        .nav-link-secondary:hover { background: linear-gradient(135deg, #FFA07A, #F0E68C); }
    </style>
</head>

<body class="font-sans text-gray-800 antialiased">
<div class="min-h-screen flex flex-col">

    <!-- 🔹 Navbar -->
    <header class="fixed top-0 w-full bg-white/80 backdrop-blur-lg border-b border-purple-200 shadow-sm z-50 animate-fadeIn">
        @php
            $user = null;
            $role = null;
            $logoutRoute = null;

            if (Auth::guard('parent')->check()) {
                $user = Auth::guard('parent')->user();
                $role = 'Orang Tua';
                $logoutRoute = route('parent.logout');
            } elseif (Auth::guard('siswa')->check()) {
                $user = Auth::guard('siswa')->user();
                $role = 'Siswa';
                $nama = 
                $logoutRoute = route('siswa.logout');
            } elseif (Auth::guard('walikelas')->check()) {
                $user = Auth::guard('walikelas')->user();
                $role = 'Wali Kelas';
                $logoutRoute = route('walikelas.logout');
            }
        @endphp

        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-wrap items-center justify-between gap-3">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-orange-300 rounded-full flex items-center justify-center text-white font-bold shadow-md animate-float">📚</div>
                <h1 class="text-xl sm:text-2xl font-bold tracking-wide text-purple-700">IEZ-ONE</h1>
            </div>

            <!-- Info User -->
            @if($user)
                <div class="hidden sm:flex items-center gap-2 bg-purple-50 px-3 py-2 rounded-xl border border-purple-100 shadow-sm">
                    <i class="bi bi-person-circle text-purple-600 text-lg"></i>
                    <span class="text-sm text-purple-700 font-semibold">{{ $user->name }}</span>
                    <span class="text-xs text-gray-500">({{ $role }})</span>
                </div>
            @endif

            <!-- Navigasi -->
            <div class="flex flex-wrap gap-2 justify-end items-center">
                <a href="{{ route('siswa.dashboard') }}" class="nav-link bg-white/70 text-purple-700 hover:bg-white shadow-sm hover:shadow-md">
                    🏠 Home
                </a>

                @guest
                    <a href="{{ route('login') }}" class="nav-link nav-link-primary text-sm sm:text-base">🔐 Login</a>
                    <a href="{{ route('register') }}" class="nav-link nav-link-secondary text-sm sm:text-base">🌟 Daftar</a>
                @endguest

                @if($user)
                    <a href="#" class="nav-link nav-link-primary text-sm sm:text-base"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        🚪 Logout
                    </a>
                    <form id="logout-form" action="{{ $logoutRoute }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endif
            </div>
        </nav>
    </header>

    <!-- 🔸 Main Content -->
    <main class="w-full min-h-screen bg-transparent overflow-hidden">
        @yield('content')
    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-gradient-to-r from-orange-100 to-purple-100 text-purple-800 text-center py-4 mt-auto shadow-inner border-t border-purple-200">
        <p class="text-xs sm:text-sm opacity-90">© 2025 IEZ-ONE. All rights reserved. | Dibuat dengan ❤️ untuk Pendidikan</p>
    </footer>
</div>
</body>
</html>
