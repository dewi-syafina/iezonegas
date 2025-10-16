<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'IEZ-ONE') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">IEZ-ONE</h1>
            <div>
                <!-- Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">
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
        <footer class="bg-gray-800 text-white text-center p-3">
            <p>© 2025 IEZ-ONE. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
