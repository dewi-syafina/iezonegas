<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'IEZ-ONE'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 font-sans text-gray-800">
    <!DOCTYPE html>
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.6s ease-in-out;
    }
</style>


</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 font-sans text-gray-800">
    <div class="min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-md p-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8m12 4V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h12z"/>
            </svg>
            <h1 class="text-2xl font-bold tracking-wide">IEZ-ONE</h1>
        </div>

        @auth
            <div class="flex items-center gap-3 bg-white/20 backdrop-blur-md px-4 py-2 rounded-xl shadow-sm border border-white/30 animate-fadeIn">
                <div class="bg-white/30 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M5.121 17.804A10.97 10.97 0 0112 15c2.21 0 4.267.64 5.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="text-white text-sm">
                    <span class="opacity-80">Login sebagai</span> 
                    <span class="font-semibold ml-1">{{ Auth::user()->name }}</span>
                    <span class="opacity-80">
                        ({{ 
                            Auth::user()->role == 'siswa' ? 'Siswa' : 
                            (Auth::user()->role == 'wali_kelas' ? 'Wali Kelas' : 
                            (Auth::user()->role == 'parent' ? 'Orang Tua' : 'Admin')) 
                        }})
                    </span>
                </div>
            </div>
        @endauth

        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" 
                class="bg-white/80 text-blue-700 hover:bg-white px-4 py-2 rounded-lg font-semibold transition">
                Home
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="bg-white text-blue-600 font-medium px-4 py-2 rounded-lg shadow hover:bg-blue-50 transition">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-3 mt-auto shadow-inner">
        <p class="text-sm opacity-90">© 2025 IEZ-ONE. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
