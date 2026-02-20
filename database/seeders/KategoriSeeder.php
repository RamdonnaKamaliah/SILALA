<?php

namespace Database\Seeders;

use App\Models\datakategori;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Fiksi',
            'Non-Fiksi',
            'Sains',
            'Sejarah',
            'Teknologi',
            'Biografi',
            'Agama',
            'Psikologi',
            'Bisnis',
            'Self Improvement',
        ];

        foreach ($kategoris as $kategori) {
            datakategori::create([
                'nama_kategori' => $kategori,
            ]);
        }
    }
}