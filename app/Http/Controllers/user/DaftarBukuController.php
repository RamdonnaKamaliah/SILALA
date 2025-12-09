<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataKategori;
use App\Models\Rating;
use Illuminate\Http\Request;

class DaftarBukuController extends Controller
{
    public function index()
    {
        // Ambil Buku Aktif
        $data_bukus = DataBuku::where('status', 'aktif')->get();
        
        // Ambil Rating Buku
        $ratings = Rating::selectRaw('buku_id, AVG(rating) as avg_rating, COUNT(*) as total_ratings')
            ->groupBy('buku_id')
            ->get()
            ->keyBy('buku_id');
        
        // Ambil Kategori
        $data_kategori = DataKategori::all();

        return view('user.daftarbuku', [
            'title' => 'DAFTAR BUKU',
            'data_bukus' => $data_bukus,
            'data_kategori' => $data_kategori,
            'ratings' => $ratings,
        ]);
    }
}