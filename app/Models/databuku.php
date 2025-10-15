<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBuku extends Model
{
    protected $table = 'data_bukus';
   protected $fillable = [
    'foto_buku',
    'judul_buku',
    'penulis',
    'penerbit',
    'tahun_terbit',
    'bahasa',
    'jumlah_halaman',
    'edisi',
    'deskripsi',
    'stok',
    'file_buku'
];


public function kategoris()
{
    return $this->belongsToMany(DataKategori::class, 'buku_kategori', 'data_buku_id', 'data_kategori_id');
}


    

}
