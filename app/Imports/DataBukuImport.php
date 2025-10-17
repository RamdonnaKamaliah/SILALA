<?php

namespace App\Imports;

use App\Models\DataBuku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataBukuImport implements ToModel, WithStartRow
{
    // ⬇️ Lewati baris pertama (header)
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new DataBuku([
            'judul'            => $row[0],
            'penulis'          => $row[1],
            'penerbit'         => $row[2],
            'tahun_terbit'     => (int) $row[3],  // pastikan ini angka
            'bahasa'           => $row[4],
            'data_kategori'      => $row[5],
            'jumlah_halaman'   => $row[6],
            'edisi'            => $row[7],
            'stok_buku'        => $row[8],
            'deskripsi'        => $row[9],
            'foto_buku'        => $row[10],
            'file_buku'        => $row[11],
        ]);
    }
}
