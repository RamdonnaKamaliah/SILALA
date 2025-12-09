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
        // Ambil hanya buku dengan status aktif
        $data_bukus = DataBuku::where('status', 'aktif')->get();
        
        // Ambil rating rata-rata untuk setiap buku
        $ratings = Rating::selectRaw('buku_id, AVG(rating) as avg_rating, COUNT(*) as total_ratings')
            ->groupBy('buku_id')
            ->get()
            ->keyBy('buku_id');
        
        // Ambil semua kategori
        $data_kategori = DataKategori::all();

        // Kirim ke view
        return view('user.daftarbuku', [
            'title' => 'DAFTAR BUKU',
            'data_bukus' => $data_bukus,
            'data_kategori' => $data_kategori,
            'ratings' => $ratings, // Kirim data rating ke view
        ]);
    }
}