<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\DataPeminjam;

class SuperAdminPeminjamController extends Controller
{
    public function index()
    {
        $data_peminjam = DataPeminjam::with(['user', 'buku'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('super_admin.data_peminjam.index', compact('data_peminjam'));
    }

     public function show(string $id)
    {
        $peminjam = DataPeminjam::with(['user', 'buku'])->findOrFail($id);
        
        return view('super_admin.data_peminjam.show', compact('peminjam'));
    }
}