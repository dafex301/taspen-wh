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
                'nama' => 'Services and Membership',
            ],
            [
                'nama' => 'Finance Administration',
            ],
            [
                'nama' => 'HC & GA',
            ],
            [
                'nama' => 'Cash & Pension Verif',
            ],
            [
                'nama' => 'Branch Manager',
            ],
        ];

        foreach ($bidang as $bidang) {
            Bidang::create($bidang);
        }
    }
}
