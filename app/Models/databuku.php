<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class DataBuku extends Model
{
    use HasFactory;

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
        'file_buku',
        'status',
    ];

    public function kategoris()
    {
        return $this->belongsToMany(DataKategori::class, 'buku_kategori', 'data_buku_id', 'data_kategori_id');
    }

    public function getFotoUrlAttribute()
    {
       
        // Jika foto yg di input adalah URL
        if (filter_var($this->foto_buku, FILTER_VALIDATE_URL)) {

            // Kalau link Google Drive
            if (str_contains($this->foto_buku, 'drive.google.com')) {

                // Ambil ID file dari URL
                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $this->foto_buku, $matches)) {
                    $fileId = $matches[1];
                } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $this->foto_buku, $matches)) {
                    $fileId = $matches[1];
                } else {
                    $fileId = null;
                }

                // Kalau ID ketemu → ubah jadi direct link
                if ($fileId) {
                    $directUrl = "https://drive.google.com/uc?export=view&id={$fileId}";
                    Log::info("Converted Google Drive URL: " . $directUrl);
                    return $directUrl;
                }
            }

            // Kalau bukan link Google Drive, tampilkan apa adanya
            return $this->foto_buku;
        }

        // Kalau path lokal (misal dari storage atau upload)
        if (str_contains($this->foto_buku, 'uploads/buku')) {
            return asset($this->foto_buku);
        }
    }
}
