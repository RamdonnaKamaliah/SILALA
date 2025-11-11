<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;

class LandingpageController extends Controller
{
     public function index()
    {
        // Ambil semua data buku dari database
        $data_buku = DataBuku::latest()->get();

        // Kirim ke view landing page
        return view('landingpage', compact('data_buku'));
    }
}
