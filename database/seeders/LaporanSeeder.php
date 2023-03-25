<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Laporan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 50 Laporan
        // pelapor is between 7 to 11
        // kategori is between 0 to 5
        // When the kategori is 0, kategori_lain is not null (random string 1 word)
        // Random the date between 2023-01-01 to 2023-12-31
        // Deskripsi, lokasi, image is random string 1 word
        // pic_checked is random boolean
        // pic_checked_at is random date between 2023-01-01 to 2023-12-31
        // pic is 4
        // branch_manager is 6
        // branch_manager_checked is random boolean
        // branch_manager_checked_at is random date between 2023-01-01 to 2023-12-31
        // immediate_action, prevention, completed_image is random string 1 word
        // completed is random boolean
        // dpnp is 4 or 5
        // dpnp_checked_at is not so far from created_at, maximum 1 day


        $faker = Factory::create('id_ID');

        for ($i = 0; $i < 0; $i++) {
            $pelapor = $faker->numberBetween(7, 11);
            $kategori = $faker->numberBetween(0, 5);
            $kategori_lain = $kategori == 0 ? $faker->word : null;
            $tanggal = $faker->dateTimeBetween('2022-01-01', '2023-02-21');
            $created_at = $faker->dateTimeBetween($tanggal, $tanggal->modify('+1 day'));
            $deskripsi = $faker->word;
            $lokasi = $faker->word;
            $image = $faker->word;
            $pic_checked = $faker->boolean;
            $pic_checked_at = $pic_checked ? $faker->dateTimeBetween($created_at, $tanggal->modify('+1 day')) : null;
            $pic = 4;
            $branch_manager = 6;
            $branch_manager_checked = $faker->boolean;
            $branch_manager_checked_at = $branch_manager_checked ? $faker->dateTimeBetween($created_at, $tanggal->modify('+1 day')) : null;
            $immediate_action = $faker->word;
            $prevention = $faker->word;
            $completed_image = $faker->word;
            $completed = $faker->boolean;
            $dpnp = $completed ? $faker->numberBetween(4, 5) : null;
            $dpnp_checked_at = $completed ? $faker->dateTimeBetween($created_at, $tanggal->modify('+1 day')) : null;


            Laporan::create([
                'pelapor' => $pelapor,
                'tanggal' => $tanggal,
                'lokasi' => $lokasi,
                'kategori' => $kategori,
                'kategori_lain' => $kategori_lain,
                'deskripsi' => $deskripsi,
                'image' => $image,
                'pic_checked' => $pic_checked,
                'pic_checked_at' => $pic_checked_at,
                'pic' => $pic,
                'branch_manager' => $branch_manager,
                'branch_manager_checked' => $branch_manager_checked,
                'branch_manager_checked_at' => $branch_manager_checked_at,
                'immediate_action' => $immediate_action,
                'prevention' => $prevention,
                'completed' => $completed,
                'completed_image' => $completed_image,
                'dpnp_checked_at' => $dpnp_checked_at,
                'dpnp' => $dpnp,
                'created_at' => $created_at,
            ]);
        }
    }
}
