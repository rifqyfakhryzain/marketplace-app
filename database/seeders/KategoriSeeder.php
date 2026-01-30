<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Elektronik',
            'Rumah',
            'Otomotif',
            'Olahraga',
            'Musik',
            'Fashion',
            'Hobi',

            'Lainnya',
        ];

        foreach ($kategori as $nama) {
            Kategori::create([
                'nama_kategori' => $nama,
            ]);
        }
    }
}
