<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataBuku; // tambahkan
use Illuminate\Http\Request;

class DaftarBukuController extends Controller
{
    public function index()
    {
        // Ambil semua data buku dari database
        $data_bukus = DataBuku::all();

        // Kirim ke view
        return view('user.daftarbuku', [
            'title' => 'Daftar Buku',
            'data_bukus' => $data_bukus
        ]);
    }
}
