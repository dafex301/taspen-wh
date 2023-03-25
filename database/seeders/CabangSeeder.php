<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cabangs = [
            [
                'name' => 'Jakarta',
            ],
            [
                'name' => 'Semarang',
            ],
            [
                'name' => 'Bandung',
            ],
        ];

        foreach ($cabangs as $cabang) {
            Cabang::create($cabang);
        }
    }
}
