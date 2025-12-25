<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        // Data dasar admin
        'name',
        'email',
        'phone',        // ← ganti dari telp, sesuai DB
        'foto',         // ← buat foto profile

        // Authentication
        'password',
        'remember_token',

        // Google Login (AMAN! TETAP ADA)
        'google_id',
        'google_token',
        'google_refresh_token',

        // Field tambahan lain
        'membership_type',
        'gender',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
        'google_refresh_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
