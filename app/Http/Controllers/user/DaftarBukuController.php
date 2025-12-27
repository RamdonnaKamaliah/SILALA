<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use App\Models\datakategori;
use Illuminate\Http\Request;

class DaftarBukuController extends Controller
{
    public function index(Request $request)
    {
        
        $data_kategori = datakategori::all();

        $query = databuku::with(['kategoris', 'ratings']);

        // filter kategori (kecuali "Semua")
        if ($request->kategori && $request->kategori !== 'Semua') {
            $query->whereHas('kategoris', function ($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        $data_bukus = $query->get();

        // hitung rating
        $ratings = $data_bukus->mapWithKeys(function ($buku) {
            return [
                $buku->id => (object) [
                    'avg_rating' => $buku->ratings->avg('rating') ?? 0,
                    'total_ratings' => $buku->ratings->count(),
                ]
            ];
        });

        return view('user.daftarbuku', compact(
            'data_bukus',
            'ratings',
            'data_kategori'
        ));
    }
}