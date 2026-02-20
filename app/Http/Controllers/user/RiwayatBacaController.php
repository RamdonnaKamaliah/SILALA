<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiwayatBaca;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RiwayatBacaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $riwayat = RiwayatBaca::with(['buku'])
            ->where('user_id', $user->id)
            ->orderByDesc('terakhir_dibaca')
            ->get();

        // Ambil rating rata-rata untuk setiap buku
        $riwayat->each(function ($item) {
            $item->buku->average_rating = Rating::where('buku_id', $item->buku_id)
                ->avg('rating') ?? 0;
            $item->buku->total_ratings = Rating::where('buku_id', $item->buku_id)
                ->count();
        });

        return view('user.riwayatbaca', [
            'title' => 'RIWAYAT PINJAM & BACA',
            'riwayat' => $riwayat
        ]);
    }
}