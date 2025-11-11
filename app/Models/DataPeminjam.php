<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DataPeminjam extends Model
{
    use HasFactory;

    protected $table = 'data_peminjams';
    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'denda',
        'status',
        'keterangan'
    ];

    protected $dates = [
        'tanggal_pinjam',
        'tanggal_kembali'
    ];

    // Hitung denda otomatis
    public function hitungDenda()
    {
        if ($this->status === 'dipinjam') {
            $hariTelat = Carbon::now()->diffInDays(Carbon::parse($this->tanggal_kembali), false);
            if ($hariTelat > 0) {
                $this->denda = $hariTelat * 1000;
                $this->save();
            }
        }
    }

    public function buku()
    {
        return $this->belongsTo(DataBuku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope untuk peminjaman aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'dipinjam');
    }

    // Scope untuk peminjaman terlambat
    public function scopeLate($query)
    {
        return $query->where('status', 'dipinjam')
                    ->where('tanggal_kembali', '<', now());
    }
}