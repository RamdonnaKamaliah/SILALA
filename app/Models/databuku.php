<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
        $fotoUrl = $this->foto_buku; // ambil dari kolom model
        $localPath = null;

        if ($fotoUrl) {
            if (str_contains($fotoUrl, 'drive.google.com')) {
                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $fotoUrl, $matches)) {
                    $fileId = $matches[1];
                } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $fotoUrl, $matches)) {
                    $fileId = $matches[1];
                } else {
                    $fileId = null;
                }

                if ($fileId) {
                    $directUrl = "https://drive.google.com/uc?export=view&id={$fileId}";

                    try {
                        $response = Http::get($directUrl);

                        if ($response->ok()) {
                            $fileName = time() . '_' . uniqid() . '.jpg';
                            $path = 'photos/' . $fileName;
                            Storage::disk('public')->put($path, $response->body());
                            $localPath = 'storage/' . $path;
                        }
                    } catch (\Exception $e) {
                        Log::error('Gagal download foto: ' . $e->getMessage());
                    }
                }
            }
        }

        return $localPath ?? null;
    }
}
