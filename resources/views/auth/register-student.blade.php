<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h2 class="text-lg font-semibold">Registrasi Siswa</h2>
        </x-slot>

```
    <form method="POST" action="{{ route('siswa.register.store') }}">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
        </div>

        <!-- NIS -->
        <div class="mt-4">
            <x-input-label for="nis" value="NIS" />
            <x-text-input id="nis" name="nis" type="text" class="mt-1 block w-full" required />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
        </div>

        <!-- Konfirmasi Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
        </div>

        <!-- Jenis Kelamin -->
        <div class="mt-4">
            <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
            <select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <!-- Jurusan -->
        <div class="mt-4">
            <x-input-label for="jurusan" value="Jurusan" />
            <x-text-input id="jurusan" name="jurusan" type="text" class="mt-1 block w-full" required />
        </div>

        <!-- Kelas -->
        <div class="mt-4">
            <x-input-label for="kelas_id" value="Kelas" />
            <select id="kelas_id" name="kelas_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <!-- Wali Kelas -->
        <div class="mt-4">
            <x-input-label for="wali_kelas_id" value="Wali Kelas" />
            <select id="wali_kelas_id" name="wali_kelas_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Pilih Wali Kelas --</option>
                @foreach ($waliKelas as $wali)
                    <option value="{{ $wali->id }}">{{ $wali->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-4 flex justify-end">
            <x-primary-button>Daftar</x-primary-button>
        </div>
    </form>
</x-auth-card>
```

</x-guest-layout>
