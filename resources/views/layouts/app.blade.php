<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'IEZ-ONE'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

            <div class="flex items-center gap-4">
               <!-- <span class="hidden sm:inline text-sm opacity-90">
                    {{ auth()->user()->name ?? 'User' }}
                </span>-->

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
