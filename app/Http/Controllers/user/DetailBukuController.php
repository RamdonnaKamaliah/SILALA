<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataPeminjam;
use App\Models\RiwayatBaca;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
  use Illuminate\Support\Facades\Storage;

class DetailBukuController extends Controller
{
    public function index($id)
    {
        $buku = DataBuku::findOrFail($id);
        
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

        return view('user.detailbuku', compact(
            'buku', 
            'userBorrow', 
            'stokHabis', 
            'isFavorited',
            'hasRead',
            'userRating',
            'averageRating',
            'totalRatings',
            'canRate'
        ));
    }


public function baca($id)
{
    abort_if(!Auth::check(), 403);

    $buku = DataBuku::findOrFail($id);

    abort_if(!$buku->file_buku, 404);

    if (!Storage::disk('public')->exists($buku->file_buku)) {
        abort(404, 'File PDF tidak ditemukan');
    }

    RiwayatBaca::updateOrCreate(
        ['user_id' => Auth::id(), 'buku_id' => $buku->id],
        ['terakhir_dibaca' => now()]
    );

    return response()->file(
        Storage::disk('public')->path($buku->file_buku),
        ['Content-Type' => 'application/pdf']
    );


}
}