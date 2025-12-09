<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPeminjam;
use App\Models\Favorit;
use App\Models\DataBuku;
use App\Models\Rating;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hitung jumlah buku yang sedang dipinjam
        $dipinjam = DataPeminjam::where('user_id', $user->id)
                    ->where('status', 'dipinjam')
                    ->count();

        // Hitung jumlah buku favorit
        $favorit = Favorit::where('user_id', $user->id)
                   ->count();

        // Hitung jumlah buku yang telat
        $telat = DataPeminjam::where('user_id', $user->id)
                 ->where('status', 'dipinjam')
                 ->where('tanggal_kembali', '<', Carbon::now())
                 ->count();

        // Ambil buku-buku dengan rating tertinggi (contoh: 5 buku teratas)
        $bukuRatingTertinggi = DataBuku::select('data_bukus.*')
            ->leftJoin('ratings', 'data_bukus.id', '=', 'ratings.buku_id')
            ->selectRaw('COALESCE(AVG(ratings.rating), 0) as avg_rating')
            ->selectRaw('COUNT(ratings.id) as total_ratings')
            ->groupBy('data_bukus.id')
            ->orderBy('avg_rating', 'DESC')
            ->orderBy('total_ratings', 'DESC')
            ->limit(6) // Ambil 6 buku teratas
            ->get();

        return view('user.dashboard', [
            'title' => 'BERANDA',
            'dipinjam' => $dipinjam,
            'favorit' => $favorit,
            'telat' => $telat,
            'bukuRatingTertinggi' => $bukuRatingTertinggi,
        ]);
    }
}