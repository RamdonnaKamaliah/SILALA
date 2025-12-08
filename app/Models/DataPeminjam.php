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
        'status',
        'keterangan',
        'metode_pengembalian',
        'waktu_pengembalian_aktual',
        'foto_bukti_pengembalian'
    ];

    protected $dates = [
        'tanggal_pinjam',
        'tanggal_kembali',
        'waktu_pengembalian_aktual'
    ];

    protected $casts = [
        'waktu_pengembalian_aktual' => 'datetime',
    ];

    // Hitung keterlambatan untuk teguran
    public function hitungKeterlambatan()
    {
        if ($this->status === 'dipinjam') {
            $hariTelat = $this->hitungHariTelat();
            if ($hariTelat > 0) {
                $this->keterangan = 'Terlambat ' . $hariTelat . ' hari - Teguran';
                $this->save();
            }
        }
    }

    // Method untuk menghitung hari telat
    private function hitungHariTelat()
    {
        if ($this->status === 'dipinjam' && now()->gt($this->tanggal_kembali)) {
            $tanggalKembali = Carbon::parse($this->tanggal_kembali);
            $sekarang = Carbon::now();
            
            // Reset waktu ke 00:00:00 untuk perhitungan hari murni
            $tanggalKembali->startOfDay();
            $sekarang->startOfDay();
            
            // GUNAKAN abs() UNTUK MENGHILANGKAN TANDA MINUS
            return abs($sekarang->diffInDays($tanggalKembali));
        }
        return 0;
    }

    // Accessor untuk hari telat - PERBAIKAN DENGAN abs()
    public function getHariTelatAttribute()
    {
        if ($this->status === 'dipinjam' && now()->gt($this->tanggal_kembali)) {
            $tanggalKembali = Carbon::parse($this->tanggal_kembali);
            $sekarang = Carbon::now();
            
            // Reset waktu ke 00:00:00 untuk perhitungan hari murni
            $tanggalKembali->startOfDay();
            $sekarang->startOfDay();
            
            // PERBAIKAN: GUNAKAN abs() UNTUK NILAI POSITIF
            return abs($sekarang->diffInDays($tanggalKembali));
        }
        return 0;
    }

    public function getIsTerlambatAttribute()
    {
        return $this->status === 'dipinjam' && now()->gt($this->tanggal_kembali);
    }

    // Accessor untuk foto bukti pengembalian (full URL)
    public function getFotoBuktiPengembalianUrlAttribute()
    {
        if ($this->foto_bukti_pengembalian) {
            return asset('storage/' . $this->foto_bukti_pengembalian);
        }
        return null;
    }

    // Accessor untuk format waktu pengembalian
    public function getWaktuPengembalianFormattedAttribute()
    {
        if ($this->waktu_pengembalian_aktual) {
            return $this->waktu_pengembalian_aktual->translatedFormat('d F Y H:i:s');
        }
        return null;
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

    // Scope untuk peminjaman yang sudah dikembalikan
    public function scopeReturned($query)
    {
        return $query->where('status', 'dikembalikan');
    }

    // Scope untuk peminjaman menunggu konfirmasi
    public function scopeWaitingConfirmation($query)
    {
        return $query->where('status', 'menunggu_konfirmasi');
    }
}