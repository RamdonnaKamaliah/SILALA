<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use App\Models\DataPeminjam;
use App\Models\Rating;
use App\Models\RiwayatBaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DetailBukuController extends Controller
{
    public function index(Request $request, $id)
    {
        $buku = databuku::with('kategoris')->findOrFail($id); // 👈 Tambahkan relasi kategori
        
        // Cek apakah user sedang meminjam buku ini
        $userBorrow = DataPeminjam::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->where('status', 'dipinjam')
            ->first();

        // Cek apakah user sudah membaca buku ini
        $hasRead = RiwayatBaca::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->exists();

        // Cek stok buku
        $stokHabis = $buku->stok <= 0;

        // Cek apakah sudah difavoritkan
        $isFavorited = \App\Models\Favorit::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->exists();

        // Initialize rating variables
        $userRating = null;
        $averageRating = 0;
        $totalRatings = 0;
        $canRate = false;

        // Cek apakah tabel ratings ada
        $ratingTableExists = Schema::hasTable('ratings');
        
        if ($ratingTableExists) {
            // Cek apakah user sudah memberi rating
            $userRating = Rating::where('user_id', Auth::id())
                ->where('buku_id', $buku->id)
                ->first();

            // Hitung rating rata-rata
            $averageRating = Rating::where('buku_id', $buku->id)->avg('rating') ?? 0;
            $totalRatings = Rating::where('buku_id', $buku->id)->count();

            // User bisa rating jika sudah membaca/meminjam
            $canRate = ($hasRead || $userBorrow);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail buku ditemukan',
            'data' => [
                'buku' => $buku, // 👈 Data buku LENGKAP dari database
                'user_borrow' => $userBorrow,
                'has_read' => $hasRead,
                'stok_habis' => $stokHabis,
                'is_favorited' => $isFavorited,
                'user_rating' => $userRating,
                'average_rating' => round($averageRating, 1),
                'total_ratings' => $totalRatings,
                'can_rate' => $canRate
            ]
        ]); 
    }
}