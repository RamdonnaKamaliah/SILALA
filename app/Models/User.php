<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,  HasApiTokens;

    protected $fillable = [
    'name',
    'phone',
    'email',
    'password',
    'membership_type',
    'gender',
    'foto_profil',
    'google_id',
    'google_token',
    'google_refresh_token',
    'password_setup',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Scope untuk user pengunjung
     */
    public function scopePengunjung($query)
    {
        return $query->where('membership_type', 'pengunjung');
    }

    /**
     * Scope untuk user anggota
     */
    public function scopeAnggota($query)
    {
        return $query->where('membership_type', 'anggota');
    }

    /**
     * Accessor untuk label membership type
     */
    public function getMembershipTypeLabelAttribute()
    {
        $labels = [
            'pengunjung' => 'Pengunjung',
            'anggota' => 'Anggota',
        ];

        return $labels[$this->membership_type] ?? 'Tidak Diketahui';
    }

    
    
}