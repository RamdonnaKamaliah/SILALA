<?php
// app/Http\Controllers\User\DetailBukuController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataPeminjam;
use App\Models\RiwayatBaca;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

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
        $buku = DataBuku::findOrFail($id);

        // Cek login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah file buku tersedia
        if (!$buku->file_buku) {
            return back()->with('error', 'File buku tidak tersedia.');
        }

        // Simpan riwayat baca (update atau buat baru)
        RiwayatBaca::updateOrCreate(
            ['user_id' => Auth::id(), 'buku_id' => $buku->id],
            ['terakhir_dibaca' => now()]
        );

        // Buka langsung file PDF
        return redirect(asset($buku->file_buku));
    }
}