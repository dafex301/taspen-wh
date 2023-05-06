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
            'role' => 1,
            'nama' => 'Test',
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
