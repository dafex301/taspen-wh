<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuan = [
            [
                'nama' => 'CAR',
            ],
            [
                'nama' => 'PCE',
            ],
            [
                'nama' => 'PAC',
            ],
            [
                'nama' => 'BOX',
            ],
            [
                'nama' => 'BK',
            ],
            [
                'nama' => 'EA'
            ],
            [
                'nama' => 'RIM'
            ],
            [
                'nama' => 'BH'
            ],

        ];

        foreach ($satuan as $s) {
            Satuan::create($s);
        }
    }
}
