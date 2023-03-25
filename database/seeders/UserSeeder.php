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
            'username' => 'admin',
            'cabang' => 1
        ]);

        User::factory()->create([
            'role' => 2,
            'username' => 'staff-jkt',
            'cabang' => 1
        ]);

        User::factory()->create([
            'role' => 2,
            'username' => 'staff-smg',
            'cabang' => 2
        ]);

        User::factory()->create([
            'role' => 3,
            'username' => 'pic-jkt',
            'cabang' => 1
        ]);

        User::factory()->create([
            'role' => 3,
            'username' => 'pic-smg',
            'cabang' => 2
        ]);

        User::factory()->create([
            'role' => 4,
            'username' => 'dpnp',
            'cabang' => 1
        ]);

        User::factory()->create([
            'role' => 5,
            'username' => 'bm-jkt',
            'cabang' => 1
        ]);


        User::factory()->create([
            'role' => 5,
            'username' => 'bm-smg',
            'cabang' => 2
        ]);



        User::factory()->count(5)->create();
    }
}
