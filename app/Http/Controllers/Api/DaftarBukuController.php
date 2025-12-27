<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use App\Models\datakategori;
use App\Models\Rating;
use Illuminate\Http\Request;
 

class DaftarBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    $data_kategori = datakategori::all();

    return response()->json([
        'status' => true,
        'message' => 'daftar buku ditemukan',
        'data_bukus' => $data_bukus,
        'ratings' => $ratings,
        'data_kategoris' => $data_kategori
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}