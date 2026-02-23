<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use Illuminate\Http\Request;

class SuperAdminDataBukuController extends Controller
{
    public function index()
{
    $bukus = databuku::with('kategoris')->latest()->get();

    return view('admin.data_buku.index', compact('bukus'));
}
}