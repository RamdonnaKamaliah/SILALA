<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_file',
        'path_file',
    ];
}
