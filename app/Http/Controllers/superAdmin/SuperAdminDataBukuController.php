<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use Illuminate\Http\Request;

class SuperAdminDataBukuController extends Controller
{
    public function index()
{
    $bukus = databuku::with('kategoris')->latest()->get();

    return view('super_admin.data_buku.index', compact('bukus'));
}

 public function show(string $id)
    {
        $buku = databuku::findOrFail($id);
        return view('super_admin.data_buku.show', compact('buku'));
    }
}