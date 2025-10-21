<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailBukuController extends Controller
{
    public function index()
    {
        return view('user.detailbuku' , ['title' => 'Detail Buku']);
    }
}
