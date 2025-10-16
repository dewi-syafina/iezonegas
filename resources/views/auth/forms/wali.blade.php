<form method="POST" action="{{ route('register.wali.store') }}">
    @csrf
    <x-input-label value="Nama Lengkap" />
    <x-text-input name="name" class="block w-full mb-2" />

    <x-input-label value="Email" />
    <x-text-input name="email" type="email" class="block w-full mb-2" />

    <x-input-label value="Password" />
    <x-text-input name="password" type="password" class="block w-full mb-2" />

    <x-input-label value="Konfirmasi Password" />
    <x-text-input name="password_confirmation" type="password" class="block w-full mb-4" />

    <x-primary-button>Daftar Wali Kelas</x-primary-button>
</form>
