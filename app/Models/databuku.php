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

public function getFotoUrlAttribute()
{
    if (empty($this->foto_buku)) {
        return asset('images/default-book.jpg');
    }
    
    // Debug: log the original value
    \Log::info("Foto buku original: " . $this->foto_buku);
    
    // Jika URL Google Drive
    if (filter_var($this->foto_buku, FILTER_VALIDATE_URL)) {
        if (str_contains($this->foto_buku, 'drive.google.com')) {
            // Ekstrak file ID
            if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $this->foto_buku, $matches)) {
                $fileId = $matches[1];
                $directUrl = "https://drive.google.com/uc?export=view&id={$fileId}";
                \Log::info("Converted Google Drive URL: " . $directUrl);
                return $directUrl;
            }
        }
        // Return URL asli untuk lainnya
        return $this->foto_buku;
    }
    
    // Jika path lokal
    if (str_contains($this->foto_buku, 'uploads/buku')) {
        return asset($this->foto_buku);
    }
    
    return asset('images/default-book.jpg');
}
}