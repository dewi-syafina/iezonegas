<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login Siswa</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('siswa.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">NIS</label>
                <input type="text" name="nis" class="w-full border px-3 py-2 rounded" value="{{ old('nis') }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
