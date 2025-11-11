<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataPeminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Cek stok buku
        $stokHabis = $buku->stok <= 0;

        return view('user.detailbuku', compact('buku', 'userBorrow', 'stokHabis'));
    }
}