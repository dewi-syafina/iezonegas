<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Izin;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun orang tua
        $parent = User::firstOrCreate(
            ['email' => 'parent@example.com'],
            [
                'name' => 'Orang Tua Budi',
                'password' => Hash::make('password'),
                'role' => 'parent',
            ]
        );

        // Buat siswa dan hubungkan dengan parent
        $siswa = Siswa::firstOrCreate(
            ['nis' => '123456'],
            [
                'nama' => 'Budi Siswa',
                'password' => Hash::make('password'),
                'parent_id' => $parent->id,
            ]
        );

        // Buat riwayat izin untuk siswa tsb
        Izin::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'alasan' => 'Sakit',
            ],
            [
                'parent_id' => $parent->id, // 👈 WAJIB diisi
                'tanggal_mulai' => '2025-10-02',
                'tanggal_selesai' => '2025-10-05',
                'jenis_izin' => 'sakit',
                'status' => 'Rejected',
                'bukti_foto' => null,
            ]
        );
    }
}
