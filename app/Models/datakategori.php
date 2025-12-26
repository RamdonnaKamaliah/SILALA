<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datakategori extends Model
{
     // Pastikan ada ini
    public $timestamps = true;
    
    // Tambahkan cast untuk created_at dan updated_at
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    protected $fillable = ['nama_kategori'];
    protected $table = 'data_kategoris';
  
    public function bukus()
    {
        return $this->belongsToMany(DataBuku::class, 'buku_kategori', 'data_kategori_id', 'data_buku_id');
    }

}