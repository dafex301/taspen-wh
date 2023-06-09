<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'kode' => '123-01-114-0006',
                'nama' => 'Paper Clip',
                'kategori' => 1,
                'satuan' => 1,
                'harga' => 220000,
            ],
            [
                'kode' => '123-01-114-0009',
                'nama' => 'Remover (Pembuka Isi Staples)',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 107250,
            ],
            [
                'kode' => '123-01-127-0006',
                'nama' => 'Karton Bufalo Cover',
                'kategori' => 1,
                'satuan' => 3,
                'harga' => 159500,
            ],
            [
                'kode' => '612-01-100-4001',
                'nama' => 'Kertas HVS A4',
                'kategori' => 1,
                'satuan' => 4,
                'harga' => 9256500,
            ],
            [
                'kode' => '612-01-101-0022',
                'nama' => 'Pulpen',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 1320000,
            ],
            [
                'kode' => '612-01-104-0021',
                'nama' => 'Spidol Snowman Boardmarker 3 warna B4 H8',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 594000,
            ],
            [
                'kode' => '612-01-110-0011',
                'nama' => 'Buku Ekspedisi',
                'kategori' => 1,
                'satuan' => 5,
                'harga' => 102300,
            ],
            [
                'kode' => '612-01-113-0079',
                'nama' => 'Kertas Nomor Panggilan SPP',
                'kategori' => 1,
                'satuan' => 6,
                'harga' => 1991000,
            ],
            [
                'kode' => '612-01-113-0150',
                'nama' => 'Sticky Note Pronto',
                'kategori' => 1,
                'satuan' => 6,
                'harga' => 792000,
            ],
            [
                'kode' => '612-01-116-0211',
                'nama' => 'Baterai Alkaline AAA',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 462000,
            ],
            [
                'kode' => '612-01-116-0212',
                'nama' => 'Baterai Alkaline AA',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 862400,
            ],
            [
                'kode' => '612-01-117-0008',
                'nama' => 'Stabillo',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 445500,
            ],
            [
                'kode' => '612-01-300-0340',
                'nama' => 'Stapler HD-10',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 403194,
            ],
            [
                'kode' => '612-01-300-0362',
                'nama' => 'Ballpoint Ball Liner',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 616000,
            ],
            [
                'kode' => '612-01-300-0371',
                'nama' => 'Tinta Stempel Biru',
                'kategori' => 1,
                'satuan' => 2,
                'harga' => 84150,
            ],
            [
                'kode' => '612-04-101-0035',
                'nama' => 'CF 14 7/8 X 11 2 PLY',
                'satuan' => 4,
                'harga' => 577500,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-101-0291',
                'nama' => 'CF 9 1/2 x 11" 3 PLY (NCR)',
                'satuan' => 3,
                'harga' => 526600,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-104-0475',
                'nama' => 'Toner HP Laserjet 204 Cyan',
                'satuan' => 6,
                'harga' => 387200,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-104-0476',
                'nama' => 'Toner HP Laserjet 204 Magenta',
                'satuan' => 6,
                'harga' => 387200,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-104-0477',
                'nama' => 'Toner HP Laserjet 204 Yellow',
                'satuan' => 6,
                'harga' => 387200,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-104-0478',
                'nama' => 'Toner HP Laserjet 204 Black',
                'satuan' => 6,
                'harga' => 387200,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-112-0005',
                'nama' => 'TONER XEROX DOCUPRINT CP315 DW CYAN',
                'satuan' => 6,
                'harga' => 67700,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-112-0006',
                'nama' => 'TONER XEROX DOCUPRINT CP315 DW MAGENTA',
                'satuan' => 6,
                'harga' => 67700,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-112-0007',
                'nama' => 'TONER XEROX DOCUPRINT CP315 DW YELLOW',
                'satuan' => 6,
                'harga' => 67700,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-112-0008',
                'nama' => 'TONER XEROX DOCUPRINT CP315 DW BLACK',
                'satuan' => 6,
                'harga' => 1249600,
                'kategori' => 2,
            ],
            [
                'kode' => '612-04-112-0628',
                'nama' => 'Toner HP Laserjet 76A',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 350900,
            ],
            [
                'kode' => '612-04-300-0131',
                'nama' => 'Toner HP LaserJet 400 305A Cyan',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 141800,
            ],
            [
                'kode' => '612-04-300-0136',
                'nama' => 'Toner HP LaserJet 400 305A Magenta',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 141800,
            ],
            [
                'kode' => '612-04-300-0137',
                'nama' => 'Toner HP LaserJet 400 305A Yellow',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 141800,
            ],
            [
                'kode' => '612-04-300-0138',
                'nama' => 'Toner HP LaserJet 400 305A Black',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 141800,
            ],
            [
                'kode' => '612-04-300-0139',
                'nama' => 'Toner Hp Laserjet P1005 35A',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 110500,
            ],
            [
                'kode' => '612-04-300-0140',
                'nama' => 'Toner TN-261 Brother HL-3170CDW Cyan',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 338800,
            ],
            [
                'kode' => '612-04-300-0141',
                'nama' => 'Toner TN-261 Brother HL-3170CDW Magenta',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 338800,
            ],
            [
                'kode' => '612-04-300-0142',
                'nama' => 'Toner TN-261 Brother HL-3170CDW Yellow',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 338800,
            ],
            [
                'kode' => '612-04-300-0143',
                'nama' => 'Toner TN-261 Brother HL-3170CDW Black',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 338800,
            ],
            [
                'kode' => '612-04-300-0146',
                'nama' => 'Toner HP Laserjet Pro M402n 26A',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 1123500,
            ],
            [
                'kode' => '612-04-300-0147',
                'nama' => 'Toner Hp Laserjet Pro 400 80A',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 332750,
            ],
            [
                'kode' => '612-04-300-0150',
                'nama' => 'Toner TN-351 Brother MFC-L8850CDW Cyan',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 805475,
            ],
            [
                'kode' => '612-04-300-0151',
                'nama' => 'Toner TN-351 Brother MFC-L8850CDWMagenta',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 238975,
            ],
            [
                'kode' => '612-04-300-0152',
                'nama' => 'Toner TN-351 Brother MFC-L8850CDW Yellow',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 477950,
            ],
            [
                'kode' => '612-04-300-0153',
                'nama' => 'Toner TN-351 Brother MFC-L8850CDW Black',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 2732950,
            ],
            [
                'kode' => '612-04-300-8032',
                'nama' => 'Mouse Wireless',
                'kategori' => 2,
                'satuan' => 6,
                'harga' => 407000,
            ],
            [
                'kode' => '612-04-900-0135',
                'nama' => 'Ribbon Epson Lq-2190',
                'kategori' => 2,
                'satuan' => 1,
                'harga' => 2117500,
            ],
            [
                'nama' => 'Amplop Coklat Logo Taspen',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Blanko FPP',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'SPTB',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Formulir Persyaratan',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Blanko KPPG',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Formulir AKT 2',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Map Dosir Pensiun',
                'kategori' => 3,
                'satuan' => 8,
                'harga' => 0,
            ],
            [
                'nama' => 'Formulir Wawancara Beasiswa',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Formulir Surat Kuasa Ahli Waris',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Formulir Keterangan Ahli Waris',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Formulir Mutasi',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Formulir Keterangan Janda/Duda',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
            [
                'nama' => 'Blanko Wawancara',
                'kategori' => 3,
                'satuan' => 7,
                'harga' => 0,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
