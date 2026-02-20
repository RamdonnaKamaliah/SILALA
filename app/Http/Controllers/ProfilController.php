<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
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
            'genderDisplay' => $genderDisplay
        ]);
    }
}
