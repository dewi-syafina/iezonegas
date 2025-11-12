<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'IEZ-ONE'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 1000, once: true });
        });
    </script>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.8s ease-in-out; }
        @keyframes float { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        .animate-float { animation: float 3s ease-in-out infinite; }

        body { background: linear-gradient(135deg, #F0E6FF 0%, #E6F7FF 50%, #FFF5E6 100%); }

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

    <!-- Navbar -->
    <header class="bg-gradient-to-r from-purple-100 to-green-100 text-purple-800 shadow-lg p-4 flex justify-between items-center backdrop-blur-md border-b border-purple-200 animate-fadeIn fixed top-0 w-full z-50">
        @php
            $user = null;
            $role = null;
            $logoutRoute = null;

            if(auth()->guard('parent')->check()){
                $user = auth()->guard('parent')->user();
                $role = 'Orang Tua';
                $logoutRoute = route('parent.logout');
            } elseif(auth()->guard('siswa')->check()){
                $user = auth()->guard('siswa')->user();
                $role = 'Siswa';
                $logoutRoute = route('siswa.logout');
            } elseif(auth()->guard('walikelas')->check()){
                $user = auth()->guard('walikelas')->user();
                $role = 'Wali Kelas';
                $logoutRoute = route('walikelas.logout');
            }
        @endphp

        <!-- Kiri: Logo + Nama + Role -->
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-orange-300 rounded-full flex items-center justify-center text-white font-bold shadow-md animate-float">📚</div>
                <h1 class="text-2xl font-bold tracking-wide text-purple-700">IEZ-ONE</h1>
            </div>

            @if($user)
                <div class="flex items-center gap-2 bg-white/30 backdrop-blur-md px-4 py-2 rounded-xl shadow-sm animate-fadeIn">
                    <div class="bg-purple-200 p-2 rounded-full">
                        <i class="bi bi-person-fill text-purple-700"></i>
                    </div>
                    <div class="text-purple-800 text-sm">
                        <span class="opacity-80">Login sebagai</span> 
                        <span class="font-semibold ml-1">{{ $user->name }}</span>
                        <span class="opacity-80">({{ $role }})</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Kanan: Menu Navigasi -->
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="nav-link bg-white/80 text-purple-700 hover:bg-white shadow-md hover:shadow-lg">
                🏠 Home
            </a>

            @guest
                <a href="{{ route('login') }}" class="nav-link nav-link-primary">🔐 Login</a>
                <a href="{{ route('register') }}" class="nav-link nav-link-secondary">🌟 Daftar Sekarang</a>
            @endguest

            @if($user)
                <a href="#" class="nav-link nav-link-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    🚪 Logout
                </a>

                <form id="logout-form" action="{{ $logoutRoute }}" method="POST" style="display:none;">
                    @csrf
                </form>
            @endif
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1 p-6 pt-24">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-orange-100 to-purple-100 text-purple-800 text-center py-4 mt-auto shadow-inner border-t border-purple-200">
        <p class="text-sm opacity-90">© 2025 IEZ-ONE. All rights reserved. | Dibuat dengan ❤️ untuk Pendidikan</p>
    </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
