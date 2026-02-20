<?php

namespace App\Http\Controllers;

use App\Models\DataBuku;

class LandingpageController extends Controller
{
    public function index()
    {
        $buku = DataBuku::withAvg('ratings', 'rating')
            ->having('ratings_avg_rating', '>=', 4)
            ->orderByDesc('ratings_avg_rating')
            ->get();

        return view('landingpage', compact('buku'));
    }
}
