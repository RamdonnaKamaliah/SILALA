<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Ebook;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBuku'      => Buku::count(),
            'peminjamAktif'  => Peminjaman::whereNull('tgl_kembali')->count(),
            'bukuDipinjam'   => Peminjaman::whereNull('tgl_kembali')->count(),
            'totalEbook'     => Ebook::count(),
        ]);
    }
}
