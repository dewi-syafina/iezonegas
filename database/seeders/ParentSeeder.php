<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    public function run(): void
    {
        // Buat beberapa orang tua
        $parents = [
            ['name' => 'Orang Tua Bagus', 'email' => 'parent1@example.com'],
            ['name' => 'Orang Tua Siti', 'email' => 'parent2@example.com'],
        ];

        foreach ($parents as $index => $data) {
            $parent = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => 'parent',
                ]
            );

            // Buat anak sesuai orang tua
            $anak = [
                ['nama' => 'Bagus', 'nis' => '123455'],
                ['nama' => 'Siti', 'nis' => '67890'],
            ][$index];

            $siswa = Siswa::firstOrCreate(
                ['nis' => $anak['nis']],
                [
                    'nama' => $anak['nama'],
                    'password' => Hash::make('password123'),
                    'parent_id' => $parent->id,
                ]
            );
        }
    }
}
