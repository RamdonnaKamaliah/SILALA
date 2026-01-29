<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPeminjam;
use App\Models\DataBuku;
use App\Models\Rating;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $hariIni = Carbon::today();
    $activities = [];
    $limitWaktu = Carbon::now()->subDay(); // 24 jam terakhir


    $labels = [];
    $dataPeminjaman = [];

    for ($i = 6; $i >= 0; $i--) {
        $tanggal = $hariIni->copy()->subDays($i);

        $labels[] = $tanggal->format('d M');
        $dataPeminjaman[] = DataPeminjam::whereDate('created_at', $tanggal)->count();
    }

    $users = User::where('created_at', '>=', $limitWaktu)
    ->latest()
    ->get();

    foreach ($users as $user) {
        $activities[] = [
            'type'  => 'register',
            'icon'  => 'fa-user-plus',
            'bg'    => 'bg-blue-50',
            'iconColor' => 'text-blue-600',
            'title' => 'Anggota baru terdaftar',
            'desc'  => $user->name,
            'time'  => $user->created_at,
        ];
    }

    $peminjaman = DataPeminjam::with('user', 'buku')
    ->where('created_at', '>=', $limitWaktu)
    ->latest()
    ->get();

    foreach ($peminjaman as $pinjam) {
        $activities[] = [
            'type'  => 'pinjam',
            'icon'  => 'fa-book',
            'bg'    => 'bg-green-50',
            'iconColor' => 'text-green-600',
            'title' => 'Peminjaman buku',
            'desc'  => "{$pinjam->user->name} meminjam \"{$pinjam->buku->judul_buku}\"",
            'time'  => $pinjam->created_at,
        ];
    }


    $pengingat = DataPeminjam::with('user', 'buku')
    ->where('status', 'dipinjam')
    ->whereDate('tanggal_kembali', Carbon::tomorrow())
    ->get();

    foreach ($pengingat as $item) {
        $activities[] = [
            'type'  => 'pengingat',
            'icon'  => 'fa-exclamation',
            'bg'    => 'bg-yellow-50',
            'iconColor' => 'text-yellow-600',
            'title' => 'Pengingat pengembalian',
            'desc'  => "{$item->user->name} harus mengembalikan \"{$item->buku->judul_buku}\"",
            'time'  => Carbon::parse($item->tanggal_kembali),
        ];
    }

    usort($activities, fn ($a, $b) => $b['time'] <=> $a['time']);

    $activities = array_slice($activities, 0, 10);

    return view('admin.dashboard', [
        'totalBuku'      => DataBuku::count(),
        'peminjamAktif'  => DataPeminjam::where('status', 'dipinjam')
                                ->distinct('user_id')
                                ->count('user_id'),
        'bukuDipinjam'   => DataPeminjam::where('status', 'dipinjam')->count(),
        'bukuArsip'      => DataBuku::where('status', 'arsip')->count(),
        'pinjamHariIni'  => DataPeminjam::whereDate('created_at', today())->count(),
        'kembaliBesok'   => DataPeminjam::whereDate('tanggal_kembali', $hariIni->copy()->addDay())
                                ->where('status', 'dipinjam')
                                ->count(),
        'keterlambatan'  => DataPeminjam::where('status', 'dipinjam')
                                ->whereDate('tanggal_kembali', '<', $hariIni)
                                ->count(),
        'bukuPopuler'    => Rating::where('rating', '>=', 4)
                                ->distinct('buku_id')
                                ->count('buku_id'),
        'chartLabels'    => $labels,
        'chartData'      => $dataPeminjaman,
        'activities'     => $activities,
    ]);
}

}
