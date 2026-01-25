<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\databuku;

class LandingpageController extends Controller
{
     public function index()
    {
        
        $buku = databuku::latest()->get();

        return view('landingpage', compact('buku'));
    }
}