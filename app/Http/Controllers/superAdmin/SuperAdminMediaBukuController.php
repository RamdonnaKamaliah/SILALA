<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\GambarBuku;
use Illuminate\Http\Request;

class SuperAdminMediaBukuController extends Controller
{
     public function index()
    {
      $media = GambarBuku::with('buku')->get();
      return view('super_admin.media_buku.index', compact('media'));
    }
}