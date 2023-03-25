<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidang = [
            [
                'nama' => 'Bidang Layanan dan Kepesertaan',
            ],
            [
                'nama' => 'Bidang Keuangan',
            ],
            [
                'nama' => 'Bidang Umum dan SDM',
            ],
        ];

        foreach ($bidang as $bidang) {
            Bidang::create($bidang);
        }
    }
}
