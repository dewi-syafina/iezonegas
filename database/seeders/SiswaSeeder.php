<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::firstOrCreate(
            ['nis' => '123455'],
            [
                'nama' => 'Bagus',
                'password' => Hash::make('password123'),
            ]
        );

        Siswa::firstOrCreate(
            ['nis' => '67890'],
            [
                'nama' => 'Siti',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
