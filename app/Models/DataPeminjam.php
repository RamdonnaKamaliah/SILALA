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

    // Accessor untuk mengecek apakah ada teguran
public function getAdaTeguranAttribute()
{
    return str_contains($this->keterangan, 'Teguran:') && 
           $this->status === 'menunggu_konfirmasi' &&
           $this->metode_pengembalian === 'mandiri';
}

// Accessor untuk status display dengan teguran
public function getStatusDisplayAttribute()
{
    if ($this->status === 'menunggu_konfirmasi' && str_contains($this->keterangan, 'Teguran:')) {
        return 'perlu_foto_ulang';
    }
    return $this->status;
}

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


public function getHariTelatAttribute(): int
{
    if ($this->status !== 'dipinjam') {
        return 0;
    }

    $tanggalKembali = Carbon::parse($this->tanggal_kembali)->startOfDay();
    $hariIni = now()->startOfDay();

    if ($hariIni->lte($tanggalKembali)) {
        return 0;
    }

    // ⛔ JANGAN abs()
    // ⛔ JANGAN endOfDay()
    return $tanggalKembali->diffInDays($hariIni);
}



public function getIsTerlambatAttribute(): bool
{
    return $this->status === 'dipinjam'
        && now()->startOfDay()->gt(
            Carbon::parse($this->tanggal_kembali)->startOfDay()
        );
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
                    ->where('tanggal_kembali', '<', now()->startOfDay());
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