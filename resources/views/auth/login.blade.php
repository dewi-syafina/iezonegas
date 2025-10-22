<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - IEZ-ONE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #bbdefb, #e3f2fd);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 40px rgba(30, 136, 229, 0.25);
            width: 90%;
            max-width: 400px;
            padding: 2rem;
        }
        h1 { color: #1e88e5; }
        .btn-primary {
            background-color: #1e88e5;
            color: white;
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #1565c0;
            transform: scale(1.03);
        }
        select, input {
            border: 2px solid #cfe0fc;
            background-color: #f8fafc;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }
        select:focus, input:focus {
            border-color: #64b5f6;
            outline: none;
            background-color: #ffffff;
        }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .alert-success { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .alert-error { background-color: #ffebee; color: #c62828; border: 1px solid #ef9a9a; }
        .text-error { color: #e53935; font-size: 0.85rem; margin-top: -0.75rem; margin-bottom: 0.75rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1 class="text-2xl font-extrabold text-center mb-2">Login IEZ-ONE</h1>
        <p class="text-center text-gray-500 mb-5 text-sm">Silakan login sesuai peran Anda</p>

        {{-- ✅ STATUS MESSAGE --}}
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        {{-- ✅ ERROR MESSAGES --}}
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" id="loginForm" action="{{ route('siswa.login.submit') }}">
            @csrf

            <select name="role" id="role" required>
                <option value="">Login Sebagai</option>
                <option value="siswa">👨‍🎓 Siswa</option>
                <option value="orangtua">👨‍👩‍👧 Orang Tua</option>
                <option value="walikelas">🧑‍🏫 Wali Kelas</option>
            </select>

            <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-error">{{ $message }}</p>
            @enderror

            <input id="password" type="password" name="password" placeholder="Password" required>
            @error('password')
                <p class="text-error">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn-primary">Login</button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar Sekarang</a>
        </p>
    </div>

    <script>
        const form = document.getElementById('loginForm');
        const roleSelect = document.getElementById('role');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // pastikan token selalu dikirim
        form.insertAdjacentHTML('afterbegin', `<input type="hidden" name="_token" value="${token}">`);

        // ubah action sesuai role
        roleSelect.addEventListener('change', function() {
            if (this.value === 'siswa') {
                form.action = "{{ route('siswa.login.submit') }}";
            } else if (this.value === 'orangtua') {
                form.action = "{{ route('parent.login.submit') }}";
            } else if (this.value === 'walikelas') {
                form.action = "{{ route('walikelas.login.submit') }}";
            }
        });
    </script> 
</body>
</html>
