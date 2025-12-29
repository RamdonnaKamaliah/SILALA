<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use App\Models\DataPeminjam;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBuku'      => databuku::count(),
            'peminjamAktif'  => DataPeminjam::whereNull('tanggal_kembali')->count(),
            'bukuDipinjam'   => DataPeminjam::whereNull('tanggal_kembali')->count(),
            'bukuArsip'      => databuku::where('status', 'arsip')->count(),
        ]);
    }
}