<?php

namespace Database\Seeders;

use App\Models\DaftarJenisModel;
use App\Models\DaftartipeModel;
use App\Models\DaftarTipeSubKategoriModel;
use App\Models\DaftarwarnaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe = [
            [
                'kode' => 'F',
                'nama' => 'Flake',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode' => 'P',
                'nama' => 'Popcorn',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode' => 'W',
                'nama' => 'Waste',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $kategori = [
            [
                'kode_kategori' => 'B',
                'nama_kategori' => 'Bekuan',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_kategori' => 'K',
                'nama_kategori' => 'Kerikil',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $warna = [
            [
                'kode_warna' => 'H',
                'warna' => 'Hijau',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_warna' => 'C',
                'warna' => 'Clear',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_warna' => 'P',
                'warna' => 'Putih',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_warna' => 'B',
                'warna' => 'Bening',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_warna' => 'M',
                'warna' => 'Mambo',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $jenis = [
            [
                'nama_jenis' => 'Jumbo Bag',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_jenis' => 'Karung',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($tipe as $key => $value) {
            DaftartipeModel::insert($value);
        }
        foreach ($kategori as $key => $value) {
            DaftarTipeSubKategoriModel::insert($value);
        }
        foreach ($warna as $key => $value) {
            DaftarwarnaModel::insert($value);
        }
        foreach ($jenis as $key => $value) {
            DaftarJenisModel::insert($value);
        }
    }
}
