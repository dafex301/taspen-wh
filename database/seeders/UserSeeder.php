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
            'nama' => 'MUHAMMAD ABDUL GOFUR',
            'username' => 'Muhammad1585',
            'nik' => '1585',
            'password' => 'Taspen1234',
            'bidang' => 5
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'ANISA NURIKA AMALIA',
            'username' => 'Anisa3505',
            'nik' => '3505',
            'password' => 'Taspen1234',
            'bidang' => 4
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'KHAIRURRIZKA MUAMAL',
            'username' => 'Khairurrizka3158',
            'nik' => '3158',
            'password' => 'Taspen1234',
            'bidang' => 4
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'OLZA GHEA SAVIRA',
            'username' => 'Olza3578',
            'nik' => '3578',
            'password' => 'Taspen1234',
            'bidang' => 4
        ]);
        User::factory()->create([
            'role' => 2,
            'nama' => 'ACHMAD MUNADI',
            'username' => 'Achmad1630',
            'nik' => '1630',
            'password' => 'Taspen1234',
            'bidang' => 4
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'DIAH PUTPITASARI',
            'username' => 'Diah4068',
            'nik' => '4068',
            'password' => 'Taspen1234',
            'bidang' => 2
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'GILANG TELAGA ATMAJA',
            'username' => 'Gilang4063',
            'nik' => '4063',
            'password' => 'Taspen1234',
            'bidang' => 2
        ]);
        User::factory()->create([
            'role' => 2,
            'nama' => 'DIMAS ALDI SAIFUDDIN',
            'username' => 'Dimas3573',
            'nik' => '3573',
            'password' => 'Taspen1234',
            'bidang' => 2
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'BAYU PUTRA PAMUNGKAS',
            'username' => 'Bayu4064',
            'nik' => '4064',
            'password' => 'Taspen1234',
            'bidang' => 3
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'CAHYA MAHARDIKA',
            'username' => 'Cahya4070',
            'nik' => '4070',
            'password' => 'Taspen1234',
            'bidang' => 3
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'GHEANOFANY RAMADAYANTI',
            'username' => 'Gheanofany4172',
            'nik' => '4172',
            'password' => 'Taspen1234',
            'bidang' => 3
        ]);
        User::factory()->create([
            'role' => 3,
            'nama' => 'RADEN RARA RATRI FEMININGRUM',
            'username' => 'Raden3533',
            'nik' => '3533',
            'password' => 'Taspen1234',
            'bidang' => 3
        ]);
        User::factory()->create([
            'role' => 2,
            'nama' => 'MAIZIRWAN',
            'username' => 'Maizirwan2257',
            'nik' => '2257',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'ADE KURNIASARI',
            'username' => 'Ade4067',
            'nik' => '4067',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'AGUS ALIM',
            'username' => 'Agus2375',
            'nik' => '2375',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'AJENG PUSPITA NINGRUM',
            'username' => 'Ajeng3399',
            'nik' => '3399',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'ALLGA MANORA HAYUNDANISWARA',
            'username' => 'Allga4083',
            'nik' => '4083',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'ANANTIAN SURYO UTOMO',
            'username' => 'Anantian4179',
            'nik' => '4179',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'ANINDITYA SALSABILA AZAHRA',
            'username' => 'Aninditya4062',
            'nik' => '4062',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'BHINATORO TUNGGUL BAWON',
            'username' => 'Bhinatoro1508',
            'nik' => '1508',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'DWIKY AULIA BRAMANTO',
            'username' => 'Dwiky4069',
            'nik' => '4069',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'ERVINA ARI SAFITRI',
            'username' => 'Ervina3495',
            'nik' => '3495',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'FAHMA FITROTUL MUNA',
            'username' => 'Fahma4065',
            'nik' => '4065',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'FITRIA RATNA FATMAWATI',
            'username' => 'Fitria3493',
            'nik' => '3493',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'GABRIELLA UNDAP',
            'username' => 'Gabriella4203',
            'nik' => '4203',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'MOHAMMAD MAFTUH BASTUL BISRI',
            'username' => 'Mohammad4059',
            'nik' => '4059',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'PASHA HAKIM PRAPTAMA',
            'username' => 'Pasha4066',
            'nik' => '4066',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'RAMA FIKY ADITAMA',
            'username' => 'Rama4060',
            'nik' => '4060',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'RUSDIYATI',
            'username' => 'Rusdiyati1328',
            'nik' => '1328',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'SEPTIAYU KUSUMA MURDIONO',
            'username' => 'Septiayu3784',
            'nik' => '3784',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'STELLA NADINE ALVARITA',
            'username' => 'Stella4061',
            'nik' => '4061',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'SUGIHARTI MADYO',
            'username' => 'Sugiharti1152',
            'nik' => '1152',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'SUMARWANTO',
            'username' => 'Sumarwanto3181',
            'nik' => '3181',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
        User::factory()->create([
            'role' => 1,
            'nama' => 'USWATUN KHASANAH',
            'username' => 'Uswatun3611',
            'nik' => '3611',
            'password' => 'Taspen1234',
            'bidang' => 1
        ]);
    }
}
