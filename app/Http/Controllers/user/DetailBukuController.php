<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use Illuminate\Http\Request;

class DetailBukuController extends Controller
{
    public function index($id)
    {
        $buku = DataBuku::findOrFail($id);
        return view('user.detailbuku', compact('buku'));
    }
}
