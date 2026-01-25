<?php

namespace Database\Seeders;

use App\Models\databuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            databuku::create([
                'foto_buku' => "assets/image_default_book{$i}.png",
                'foto_id' => "{$i}",
                'judul_buku' => "Judul Buku Ke-{$i}",
                'penulis' => "Penulis {$i}",
                'penerbit' => "Penerbit {$i}",
                'tahun_terbit' => 2020 + ($i % 5),
                'bahasa' => 'Indonesia',
                'jumlah_halaman' => 100 + ($i * 10),
                'edisi' => (string) $i,
                'deskripsi' => "Ini adalah deskripsi untuk buku ke-{$i}.",
                'stok' => rand(1, 20),
                'file_buku' => "assets/contoh pdf{$i}.pdf",
                'status' => 'tersedia',
                'kategori_ids' => rand(1, 3)
            ]);
        }
    }
}