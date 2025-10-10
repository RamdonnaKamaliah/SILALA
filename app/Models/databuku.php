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
        'kategori',
        'jumlah_halaman',
        'edisi',
        'deskripsi',
        'stok',
        'file_buku'
    ];
}
