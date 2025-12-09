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

        // Jumlah Dipinjam
        $dipinjam = DataPeminjam::where('user_id', $user->id)
                    ->where('status', 'dipinjam')
                    ->count();

        // Jumlah Favorit
        $favorit = Favorit::where('user_id', $user->id)
                   ->count();

        // Jumlah Telat
        $telat = DataPeminjam::where('user_id', $user->id)
                 ->where('status', 'dipinjam')
                 ->where('tanggal_kembali', '<', Carbon::now())
                 ->count();

        // Rekomendasi
        $bukuRatingTertinggi = DataBuku::select('data_bukus.*')
            ->leftJoin('ratings', 'data_bukus.id', '=', 'ratings.buku_id')
            ->selectRaw('COALESCE(AVG(ratings.rating), 0) as avg_rating')
            ->selectRaw('COUNT(ratings.id) as total_ratings')
            ->groupBy('data_bukus.id')
            ->having('avg_rating', '>', 0)
            ->orderBy('avg_rating', 'DESC')
            ->orderBy('total_ratings', 'DESC')
            ->limit(3)
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