<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPeminjam;
use App\Models\Favorit;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hitung jumlah buku yang sedang dipinjam
        $dipinjam = DataPeminjam::where('user_id', $user->id)
                    ->where('status', 'dipinjam')
                    ->count();

        // Hitung jumlah buku yang kena denda
        $denda = DataPeminjam::where('user_id', $user->id)
                  ->where('status', 'denda')
                  ->count();

        
        return view('user.dashboard', [
            'title' => 'BERANDA',
            'dipinjam' => $dipinjam,
            'denda' => $denda,
            
        ]);
    }
}
