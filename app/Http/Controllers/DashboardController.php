<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPeminjam;
use App\Models\Favorit;
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

        return view('user.dashboard', [
            'title' => 'BERANDA',
            'dipinjam' => $dipinjam,
            'favorit' => $favorit,
            // 'telat' => $telat,
        ]);
    }
}