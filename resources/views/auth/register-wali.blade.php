<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h2>Registrasi Wali Kelas</h2>
        </x-slot>

        <form method="POST" action="{{ route('wali.register.store') }}">
            @csrf
            <div>
                <x-input-label for="name" value="Nama Lengkap" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
            </div>

            <div class="mt-4">
                <x-input-label for="nip" value="NIP" />
                <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" required />
            </div>

            <div class="mt-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
            </div>

            <div class="mt-4 flex justify-end">
                <x-primary-button>Daftar</x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
