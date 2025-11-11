<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatBacaController extends Controller
{
     public function index()
    {
        return view('user.riwayatbaca' , ['title' => 'RIWAYAT PINJAM & BACA']);
    }

}
