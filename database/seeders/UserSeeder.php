<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'role' => 3,
            'nama' => 'Benhard',
            'nik' => 'Benhard2271',
            'password' => bcrypt('Taspen1234'),
            'bidang' => 3
        ]);

        User::factory()->create([
            'role' => 2,
            'nama' => 'Maizirwan',
            'nik' => 'Maizirwan2257',
            'password' => bcrypt('Taspen1234'),
            'bidang' => 1
        ]);

        User::factory()->create([
            'role' => 2,
            'nama' => 'Siswanto',
            'nik' => 'Siswanto1530',
            'password' => bcrypt('Taspen1234'),
            'bidang' => 2
        ]);

        User::factory()->create([
            'role' => 3,
            'nama' => 'RR Ratri Feminingrum',
            'nik' => 'Ratri3533',
            'password' => bcrypt('Taspen1234'),
            'bidang' => 3
        ]);

        User::factory()->create([
            'role' => 1,
            'nama' => 'Anantian Suryo Utomo',
            'nik' => 'Anantian4179',
            'password' => bcrypt('Taspen1234'),
            'bidang' => 1
        ]);

        User::factory()->create([
            'role' => 1,
            'nama' => 'Gilang Telaga Atmaja',
            'nik' => 'Gilang4063',
            'password' => bcrypt('Taspen1234'),
            'bidang' => 2
        ]);

        User::factory()->create([
            'role' => 1,
            'nama' => 'Gheanofanny Ramadayanti',
            'nik' => 'Gheanofanny4172',
            'password' => bcrypt('Taspen1234'),
            'bidang' => 3
        ]);

        // User::factory()->create([
        //     'role' => 3,
        //     'nama' => 'Benhard',
        //     'nik' => 'Benhard2271',
        //     'password' => bcrypt('Taspen1234'),
        //     'bidang' => 1
        // ]);



        User::factory()->create([
            'role' => 1,
            'nik' => 'staff-layanan',
            'bidang' => 1
        ]);

        User::factory()->create([
            'role' => 1,
            'nik' => 'staff-keuangan',
            'bidang' => 2
        ]);

        User::factory()->create([
            'role' => 1,
            'nik' => 'staff-sdm',
            'bidang' => 3
        ]);

        User::factory()->create([
            'role' => 2,
            'nik' => 'manajer-layanan',
            'bidang' => 1
        ]);

        User::factory()->create([
            'role' => 2,
            'nik' => 'manajer-keuangan',
            'bidang' => 2
        ]);

        User::factory()->create([
            'role' => 2,
            'nik' => 'manajer-sdm',
            'bidang' => 3
        ]);

        User::factory()->create([
            'role' => 3,
            'nik' => 'manajer-umum',
            'bidang' => 3
        ]);
    }
}
