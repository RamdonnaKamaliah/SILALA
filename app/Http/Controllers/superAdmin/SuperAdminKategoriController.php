<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\datakategori;
use Illuminate\Http\Request;

class SuperAdminKategoriController extends Controller
{
     public function index()
    {
        $data_kategori = datakategori::all();
        return view('super_admin.kategori.index', compact('data_kategori'));
    }

     public function show(string $id)
    {
        $kategori = datakategori::findOrFail($id);
        return view('super_admin.kategori.show', compact('kategori'));
    }
}