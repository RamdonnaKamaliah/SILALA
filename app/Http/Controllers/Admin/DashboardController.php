<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataPeminjam;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBuku'      => DataBuku::count(),
            'totalUser'  => DB::table('users')->count(),
            'totalPeminjam'  => DataPeminjam::count(),
            'totalArsip'  => DataBuku::where('status', 'arsip')->count(),
        ]);

        $filter =request()->filter ?? 'Mingguan';
        
        $labels = [];
        $dataPeminjaman = [];
        $dataPengembalian = [];

        if ($filter === 'Harian') {
            // 7 hari terakhir
            for ($i = 6; $i >=0; $i--) {
                 $tgl = Carbon::today()->subDays($i);

                $labels[] = $tgl->translatedFormat('d M');
                $peminjaman[] = DataPeminjam::whereDate('tgl_pinjam', $tgl)->count();
                $pengembalian[] = DataPeminjam::whereDate('tgl_kembali', $tgl)->count();
            }
        }
        elseif($filter === 'Mingguan'){
            for ($i = 3; $i >= 0; $i--) {
            $start = Carbon::now()->subWeeks($i)->startOfWeek();
            $end = Carbon::now()->subWeeks($i)->endOfWeek();

            $labels[] = 'Minggu ' . $start->weekOfMonth;
            $peminjaman[] = DataPeminjam::whereBetween('tgl_pinjam', [$start, $end])->count();
            $pengembalian[] = DataPeminjam::whereBetween('tgl_kembali', [$start, $end])->count();
        }
        }

        elseif ($filter === 'Bulanan') {
            // 6 bulan terakhir
            for ($i = 5; $i >= 0; $i--) {
                 $labels[] = $bulan->translatedFormat('M Y');
            $peminjaman[] = DataPeminjam::whereMonth('tgl_pinjam', $bulan->month)
                ->whereYear('tgl_pinjam', $bulan->year)
                ->count();

            $pengembalian[] = DataPeminjam::whereMonth('tgl_kembali', $bulan->month)
                ->whereYear('tgl_kembali', $bulan->year)
                ->count();
            }
        }

        return response()->json([
            'labels' => $labels,
            'dataPeminjaman' => $dataPeminjaman,
            'dataPengembalian' => $dataPengembalian,
        ]);
    }
}