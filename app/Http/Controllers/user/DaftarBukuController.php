<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataKategori; // ✅ kamu lupa import ini
use Illuminate\Http\Request;

class DaftarBukuController extends Controller
{
    public function index()
    {
        // Ambil data kategori dari admin
        $data_kategori = DataKategori::all();

        // Ambil data buku
        $data_bukus = DataBuku::all();

        // Kirim ke view
        return view('user.daftarbuku', [
            'title' => 'Daftar Buku',
            'data_bukus' => $data_bukus,
            'data_kategori' => $data_kategori,
        ]);
    }
}
