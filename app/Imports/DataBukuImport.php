<?php

namespace App\Imports;

use App\Models\DataBuku;
use App\Models\DataKategori;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataBukuImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        // Foto buku lokal
        $foto = trim($row[10]);
        $localFotoPath = null;

        if ($foto && Storage::disk('public')->exists("uploads/buku/" . $foto)) {
            $localFotoPath = "uploads/buku/" . $foto;
        }

        // File PDF lokal
        $pdf = trim($row[11]);
        $localPdfPath = null;

        if ($pdf && Storage::disk('public')->exists("uploads/file_buku/" . $pdf)) {
            $localPdfPath = "uploads/file_buku/" . $pdf;
        }

        // Simpan data buku
        $buku = DataBuku::create([
            'judul_buku'     => $row[0],
            'penulis'        => $row[1],
            'penerbit'       => $row[2],
            'tahun_terbit'   => (int)$row[3],
            'bahasa'         => $row[4],
            'jumlah_halaman' => (int)$row[6],
            'edisi'          => $row[7],
            'stok'           => (int)$row[8],
            'deskripsi'      => $row[9],
            'foto_buku'      => $localFotoPath,
            'file_buku'      => $localPdfPath,
            'kategori_ids'   => null,
        ]);

        // Kategori
        $kategoriNama = trim($row[5]);
        if ($kategoriNama) {
            $kategori = DataKategori::firstOrCreate(['nama_kategori' => $kategoriNama]);
            $buku->kategoris()->attach($kategori->id);
        }

        return $buku;
    }
}
