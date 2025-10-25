<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - IEZ-ONE</title>
    @vite(['resources/css/app.css'])

    <style>
        body {
            background: linear-gradient(135deg, #bbdefb, #e3f2fd);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .register-card {
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
    </style>
</head>
<body>
    <div class="register-card">
        <h1 class="text-2xl font-extrabold text-center mb-2">Daftar IEZ-ONE</h1>
        <p class="text-center text-gray-500 mb-5 text-sm">Silakan daftar sesuai peran Anda</p>

        <!-- Dropdown pilih role -->
        <select id="role" required>
            <option value=""> Pilih Peran </option>
            <option value="siswa">👨‍🎓 Siswa</option>
            <option value="parent">👨‍👩‍👧 Orang Tua</option>
            <option value="wali">🧑‍🏫 Wali Kelas</option>
        </select>

        <!-- Form -->
        <form id="registerForm" method="POST" action="">
            @csrf
            <div id="formFields">
                <!-- Field akan diubah lewat JavaScript -->
            </div>
            <button type="submit" class="btn-primary">Daftar</button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
        </p>
    </div>

    <script>
    window.onload = function() {
        const roleSelect = document.getElementById('role');
        const formFields = document.getElementById('formFields');
        const registerForm = document.getElementById('registerForm');

        roleSelect.addEventListener('change', function() {
            const role = this.value;
            formFields.innerHTML = '';

            if (role === 'siswa') {
                registerForm.action = "{{ route('siswa.register.store') }}";
                formFields.innerHTML = `
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                    <input type="text" name="nis" placeholder="NIS" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                `;
            } 
            else if (role === 'parent') {
                registerForm.action = "{{ route('parent.register.store') }}";
                formFields.innerHTML = `
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="child_nis" placeholder="NIS Anak" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                `;
            } 
            else if (role === 'wali') {
                registerForm.action = "{{ route('walikelas.register.store') }}";
                formFields.innerHTML = `
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                    <input type="text" name="nip" placeholder="NIP (Hanya untuk Register)" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                `;
            }
        });
    }
    </script>

</body>
</html>
