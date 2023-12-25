<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create role seeder that is staff, PIC, and DPP
        $roles = [
            [
                'nama' => 'Staff',
            ],
            [
                'nama' => 'Sector Head',
            ],
            [
                'nama' => 'Manager',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
