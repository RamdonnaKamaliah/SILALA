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

        'name',
        'email',
        'phone',       
        'foto',        
        'password',
        'plain_password',
        'remember_token',
        'email_verified_at',
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
    
   public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isSuperAdmin(): bool
{
    return $this->role === 'super_admin';
}
}