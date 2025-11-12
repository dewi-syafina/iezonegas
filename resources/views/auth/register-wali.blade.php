<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Wali Kelas - IEZ-ONE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => AOS.init({ duration: 800, once: true }));
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #F0E6FF 0%, #E6F7FF 50%, #FFF5E6 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .register-card {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px rgba(147, 112, 219, 0.3);
            width: 90%;
            max-width: 420px;
            padding: 2.5rem;
        }
        h1 {
            color: #7B68EE;
            font-weight: 800;
            text-align: center;
        }
        input {
            border: 2px solid #E6E6FA;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        input:focus {
            border-color: #20B2AA;
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(32, 178, 170, 0.3);
        }
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
            box-shadow: 0 8px 20px rgba(123, 104, 238, 0.4);
        }
        .alert-error {
            background-color: #FFEBEE;
            color: #C62828;
            border: 1px solid #EF9A9A;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            text-align: left;
            font-size: 0.9rem;
        }
        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }
        .footer-text a {
            color: #7B68EE;
            font-weight: 600;
            text-decoration: none;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-card" data-aos="zoom-in">
        <div class="text-center mb-6">
            <h1 class="text-3xl mb-2">Registrasi Wali Kelas</h1>
            <p class="text-gray-500 text-sm">Daftarkan akun Wali Kelas Anda di IEZ-ONE</p>
        </div>

        {{-- Error validation --}}
        @if ($errors->any())
            <div class="alert-error">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('walikelas.register.store') }}">
            @csrf

            <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
            <input id="nama" name="nama" type="text" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>

            <label for="nip" class="block text-gray-700 font-semibold mb-1">NIP</label>
            <input id="nip" name="nip" type="text" placeholder="Masukkan NIP" value="{{ old('nip') }}" required>

            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
            <input id="email" name="email" type="email" placeholder="Masukkan email" value="{{ old('email') }}" required>

            <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
            <input id="password" name="password" type="password" placeholder="Masukkan password" required>

            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ulangi password" required>

            <button type="submit" class="btn-primary mt-3">Daftar Sekarang</button>
        </form>

        <p class="footer-text">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</body>
</html>
