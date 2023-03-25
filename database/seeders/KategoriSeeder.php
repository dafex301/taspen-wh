<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = [
            [
                'name' => 'Kimia',
            ],
            [
                'name' => 'Fisik',
            ],
            [
                'name' => 'Biologi',
            ],
            [
                'name' => 'Ergonomi',
            ],
            [
                'name' => 'Psikososial',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
