<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataKategori;
use App\Models\Rating;
use Illuminate\Http\Request;

class DaftarBukuController extends Controller
{
    public function index(Request $request)
{
    $kategori = $request->kategori;

    $data_bukus = DataBuku::where('status', 'aktif')
        ->when($kategori && $kategori !== 'Semua', function ($query) use ($kategori) {
            $query->whereHas('kategoris', function ($q) use ($kategori) {
                $q->where('nama_kategori', $kategori);
            });
        })
        ->with('kategoris')
        ->get();

    $ratings = Rating::selectRaw('buku_id, AVG(rating) as avg_rating, COUNT(*) as total_ratings')
        ->groupBy('buku_id')
        ->get()
        ->keyBy('buku_id');

    $data_kategori = DataKategori::all();

    return view('user.daftarbuku', compact(
        'data_bukus',
        'data_kategori',
        'ratings',
        'kategori'
    ))->with('title', 'DAFTAR BUKU');
}

}