<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;

class LandingpageController extends Controller
{
     public function index()
    {
        // Semua Data Buku
        $data_buku = DataBuku::latest()->get();

        return view('landingpage', compact('data_buku'));
    }
}
