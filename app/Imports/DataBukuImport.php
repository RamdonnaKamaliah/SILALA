<?php

namespace App\Imports;

use App\Models\DataBuku;
use App\Models\DataKategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataBukuImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Lewati header
    }

    public function model(array $row)
    {
        // Simpan data buku terlebih dahulu
        $buku = new DataBuku([
            'judul_buku'      => $row[0],
            'penulis'         => $row[1],
            'penerbit'        => $row[2],
            'tahun_terbit'    => (int) $row[3],
            'bahasa'          => $row[4],
            'data_kategori'   => $row[5],
            'jumlah_halaman'  => (int) $row[6],
            'edisi'           => $row[7],
            'stok'       => (int) $row[8],
            'deskripsi'       => $row[9],
            'foto_buku'       => $row[10],
            'file_buku'       => $row[11],
        ]);

        $buku->save();

        // Hubungkan kategori
        $kategoriNama = trim($row[5]);
        if ($kategoriNama) {
            $kategori = DataKategori::firstOrCreate(['nama_kategori' => $kategoriNama]);
            $buku->kategoris()->attach($kategori->id);
        }

        return $buku;
    }
} 
