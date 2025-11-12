<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Login - IEZ-ONE' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 800, once: true });
        });
    </script>

        <style>
        /* Animasi lembut */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.8s ease-in-out; }

        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }

        /* Background pastel gradien */
        body {
            background: linear-gradient(135deg, #F0E6FF 0%, #E6F7FF 50%, #FFF5E6 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding: 1rem;
        }

        /* Kartu login */
        .login-card {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px rgba(147, 112, 219, 0.25);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 10;
        }

        /* Warna & tombol */
        h1 { color: #7B68EE; font-weight: 800; text-align: center; margin-bottom: 1.5rem; }
        .btn-primary {
            background: linear-gradient(135deg, #7B68EE, #20B2AA);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 20px rgba(123, 104, 238, 0.4);
        }

        /* Input */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        /* Ikon di input */
        .input-group svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #7B68EE;
            width: 1.2rem;
            height: 1.2rem;
            pointer-events: none; /* agar klik tetap fokus ke input */
        }

        input, select {
            border: 2px solid #E6E6FA;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.8rem; /* tambahan padding kiri agar teks tidak menabrak ikon */
            font-size: 1rem;
            color: #333;
        }
        input:focus, select:focus {
            border-color: #20B2AA;
            outline: none;
            background-color: #ffffff;
            box-shadow: 0 0 8px rgba(32, 178, 170, 0.25);
        }

        /* Placeholder warna lembut */
        input::placeholder {
            color: #9a9a9a;
            opacity: 0.9;
        }

        /* Alert */
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            animation: fadeIn 0.5s ease-in-out;
        }
        .alert-success { background-color: #E8F5E9; color: #2E7D32; border: 1px solid #A5D6A7; }
        .alert-error { background-color: #FFEBEE; color: #C62828; border: 1px solid #EF9A9A; }
        .text-error { color: #E53935; font-size: 0.85rem; margin-top: -1rem; margin-bottom: 0.75rem; animation: fadeIn 0.3s ease-in-out; }

        /* Elemen dekoratif */
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.6;
            z-index: 0;
        }
        .circle-1 { width: 200px; height: 200px; background: rgba(255, 182, 193, 0.4); top: 10%; left: 10%; animation: float 4s ease-in-out infinite; }
        .circle-2 { width: 160px; height: 160px; background: rgba(173, 216, 230, 0.4); bottom: 10%; right: 10%; animation: float 5s ease-in-out infinite reverse; }

        /* Responsif */
        @media (max-width: 480px) {
            .login-card {
                padding: 1.8rem;
                border-radius: 1rem;
            }
            h1 { font-size: 1.8rem; }
            .btn-primary { font-size: 0.95rem; }
        }
    </style>

</head>

<body>
    <!-- Elemen Dekoratif -->
    <div class="decorative-circle circle-1"></div>
    <div class="decorative-circle circle-2"></div>

   <!-- Kartu Login -->
<div class="login-card animate-fadeIn" data-aos="zoom-in">
    <div class="text-center mb-6">
        <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-green-400 rounded-full flex items-center justify-center text-white font-bold shadow-lg animate-float mx-auto mb-3">
            🔐
        </div>
        <h1 class="text-3xl font-extrabold">Login IEZ-ONE</h1>
        <p class="text-gray-500 text-sm mt-2">Silakan login sesuai peran Anda dengan sentuhan pastel yang menyenangkan</p>
    </div>

    {{-- Status & Error Messages --}}
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" id="loginForm" action="{{ route('siswa.login.submit') }}">
        @csrf

        <!-- Pilih Role -->
        <div class="mb-4 relative">
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Login Sebagai</label>
            <div class="flex items-center border border-gray-300 rounded-lg bg-white px-3">
                <svg class="w-5 h-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <select name="role" id="role" class="w-full bg-transparent focus:outline-none py-2" required>
                    <option value="">-- Pilih Peran --</option>
                    <option value="siswa">👨‍🎓 Siswa</option>
                    <option value="orangtua">👨‍👩‍👧 Orang Tua</option>
                    <option value="walikelas">🧑‍🏫 Wali Kelas</option>
                </select>
            </div>
        </div>

        <!-- Email -->
        <div class="mb-4 relative">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="flex items-center border border-gray-300 rounded-lg bg-white px-3">
                <svg class="w-5 h-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                <input id="email" type="email" name="email" placeholder="Masukkan email"
                    value="{{ old('email') }}" class="w-full bg-transparent focus:outline-none py-2" required>
            </div>
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="flex items-center border border-gray-300 rounded-lg bg-white px-3">
                <svg class="w-5 h-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <input id="password" type="password" name="password" placeholder="Masukkan password"
                    class="w-full bg-transparent focus:outline-none py-2" required>
            </div>
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-purple-500 to-green-400 text-white font-semibold py-2 rounded-lg hover:opacity-90 transition">
            Login
        </button>
    </form>

    <p class="text-center text-gray-600 text-sm mt-6">
        Belum punya akun?
        <a href="{{ route('register') }}"
            class="text-purple-600 font-semibold hover:text-purple-800 transition hover:underline">Daftar Sekarang</a>
    </p>
</div>


    <script>
        const form = document.getElementById('loginForm');
        const roleSelect = document.getElementById('role');

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
