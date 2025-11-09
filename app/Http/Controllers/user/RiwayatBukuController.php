<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatBukuController extends Controller
{
    public function index()
    {
        return view('user.riwayatbuku' , ['title' => 'RIWAYAT PINJAM DAN BACA']);
    }
}
