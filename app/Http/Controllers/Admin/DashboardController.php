<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\DataBuku;
use App\Models\DataPeminjam;
use App\Models\Peminjaman;
use App\Models\Ebook;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBuku'      => DataBuku::count(),
            'peminjamAktif'  => DataPeminjam::whereNull('tgl_kembali')->count(),
            'bukuDipinjam'   => DataPeminjam::whereNull('tgl_kembali')->count(),
        ]);
    }
}