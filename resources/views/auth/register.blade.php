<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Daftar - IEZ-ONE' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AOS Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 800,
                once: true,
            });
        });
    </script>

    <style>
        @keyframes fadeIn { from { opacity:0; transform: translateY(-10px);} to {opacity:1; transform: translateY(0);} }
        .animate-fadeIn { animation: fadeIn 0.8s ease-in-out; }

        @keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-5px);} }
        .animate-float { animation: float 3s ease-in-out infinite; }

        body {
            background: linear-gradient(135deg, #F0E6FF 0%, #E6F7FF 50%, #FFF5E6 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .login-card {
            background-color: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 50px rgba(147,112,219,0.3);
            width: 90%;
            max-width: 420px;
            padding: 2.5rem;
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            z-index: 10;
        }

        h1 { color:#7B68EE; font-weight:800; }

        .btn-primary {
            background: linear-gradient(135deg, #7B68EE, #20B2AA);
            color:white;
            font-weight:600;
            padding:0.75rem 1.5rem;
            border-radius:1rem;
            transition: all 0.3s ease;
            width:100%;
            border:none;
            cursor:pointer;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(123,104,238,0.4);
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            border: 2px solid #E6E6FA;
            background-color: rgba(255,255,255,0.8);
            border-radius: 1rem;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }

        .input-group:hover {
            box-shadow: 0 0 8px rgba(123,104,238,0.3);
        }

        .input-group svg {
            flex-shrink: 0;
            color: #7B68EE;
            width: 1.2rem;
            height: 1.2rem;
            margin-right: 0.75rem;
        }

        select {
            flex: 1;
            background: transparent;
            border: none;
            font-size: 1rem;
            padding: 0.5rem 0;
            outline: none;
            color: #333;
            width: 100%;
        }

        select:focus {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(32,178,170,0.3);
            border-radius: 0.8rem;
        }

        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.6;
        }

        .circle-1 { width: 200px; height: 200px; background: rgba(255,182,193,0.4); top:10%; left:10%; animation: float 4s ease-in-out infinite; }
        .circle-2 { width: 150px; height: 150px; background: rgba(173,216,230,0.4); bottom:10%; right:10%; animation: float 5s ease-in-out infinite reverse; }

    </style>
</head>
<body>
    <!-- Elemen dekoratif -->
    <div class="decorative-circle circle-1"></div>
    <div class="decorative-circle circle-2"></div>

    <!-- Kartu Form -->
    <div class="login-card animate-fadeIn" data-aos="zoom-in">
        <div class="text-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-green-400 rounded-full flex items-center justify-center text-white font-bold shadow-lg animate-float mx-auto mb-3">
                📝
            </div>
            <h1 class="text-3xl font-extrabold">Daftar IEZ-ONE</h1>
            <p class="text-gray-500 text-sm mt-2">Pilih peran Anda untuk mendaftar</p>
        </div>

        {{-- Status/Error --}}
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

        <!-- Pilih Role -->
        <div class="input-group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <select id="role" required>
                <option value="">-- Pilih Peran --</option>
                <option value="siswa">👨‍🎓 Siswa</option>
                <option value="parent">👨‍👩‍👧 Orang Tua</option>
                <option value="wali">🧑‍🏫 Wali Kelas</option>
            </select>
        </div>

        <p class="text-center text-gray-600 text-sm mt-6">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:text-purple-800 transition hover:underline">Masuk di sini</a>
        </p>
    </div>

    <script>
        const roleSelect = document.getElementById('role');
        roleSelect.addEventListener('change', function() {
            if(this.value === 'siswa') {
                window.location.href = "{{ route('siswa.register') }}";
            } else if(this.value === 'parent') {
                window.location.href = "{{ route('parent.register') }}";
            } else if(this.value === 'wali') {
                window.location.href = "{{ route('walikelas.register') }}";
            }
        });
    </script>
</body>
</html>
