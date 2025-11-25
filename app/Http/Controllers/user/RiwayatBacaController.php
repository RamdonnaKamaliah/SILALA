<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiwayatBaca;
use Illuminate\Support\Facades\Auth;

class RiwayatBacaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $riwayat = RiwayatBaca::with('buku')
            ->where('user_id', $user->id)
            ->orderByDesc('terakhir_dibaca')
            ->get();

        return view('user.riwayatbaca', [
            'title' => 'RIWAYAT PINJAM & BACA',
            'riwayat' => $riwayat
        ]);
    }
}
