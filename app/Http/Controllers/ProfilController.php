<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $user = Auth::user(); // Ambil data user yang login
        
        // Konversi gender untuk tampilan
        $genderDisplay = '';
        if ($user->gender == 'P') {
            $genderDisplay = 'Perempuan';
        } elseif ($user->gender == 'L') {
            $genderDisplay = 'Laki-laki';
        } else {
            $genderDisplay = $user->gender ?? 'Jenis kelamin belum diisi';
        }
        
        return view('user.profil', [
            'title' => 'PROFIL',
            'user' => $user,
            'genderDisplay' => $genderDisplay // Kirim gender yang sudah dikonversi
        ]);
    }
}
