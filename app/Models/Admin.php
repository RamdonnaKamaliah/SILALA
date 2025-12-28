<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'admins';

    protected $fillable = [
        // Data dasar admin
        'name',
        'email',
        'phone',       
        'foto',        
        'password',
        'remember_token',
        'google_id',
        'google_token',
        'google_refresh_token',
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