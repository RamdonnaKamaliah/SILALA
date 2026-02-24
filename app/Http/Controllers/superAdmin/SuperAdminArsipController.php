<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use Illuminate\Http\Request;

class SuperAdminArsipController extends Controller
{
     public function index()
    {
       // hanya tampilkan buku yang statusnya arsip
    $buku_arsip = databuku::where('status', 'arsip')->latest()->get();

    return view('super_admin.data_arsip.index', compact('buku_arsip'));
    }

    public function show(String $id){
        $buku = databuku::findOrFail($id);
        return view('super_admin.data_arsip.show', compact('buku'));
    }
}