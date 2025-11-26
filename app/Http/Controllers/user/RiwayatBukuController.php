<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPeminjam;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RiwayatBukuController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        // Query dasar
        $query = DataPeminjam::where('user_id', $userId)
            ->with('buku')
            ->orderByDesc('created_at');

        // Filter berdasarkan status
        if ($request->has('status')) {
            switch ($request->status) {
                case 'sudah':
                    $query->where('status', 'dikembalikan');
                    break;
                case 'pinjam':
                    $query->where('status', 'dipinjam');
                    break;
                case 'belum':
                    // Status terlambat: dipinjam dan tanggal kembali sudah lewat
                    $query->where('status', 'dipinjam')
                          ->where('tanggal_kembali', '<', now());
                    break;
            }
        }

        $riwayat = $query->get();

        return view('user.riwayatbuku', [
            'title' => 'RIWAYAT PINJAM & BACA',
            'riwayat' => $riwayat
        ]);
    }

    // Method untuk mengecek apakah user sedang meminjam buku
    public function checkActiveBorrow()
    {
        $userId = Auth::id();
        
        $activeBorrows = DataPeminjam::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->count();

        return response()->json([
            'hasActiveBorrow' => $activeBorrows > 0,
            'activeCount' => $activeBorrows
        ]);
    }

    // Method untuk mengecek apakah user sedang meminjam buku tertentu
    public function checkBookBorrowStatus($bookId)
    {
        $userId = Auth::id();
        
        $activeBorrow = DataPeminjam::where('user_id', $userId)
            ->where('buku_id', $bookId)
            ->where('status', 'dipinjam')
            ->first();

        return response()->json([
            'isBorrowed' => !is_null($activeBorrow),
            'borrowData' => $activeBorrow
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = new DataPeminjam();
        $data->user_id = $user->id;
        $data->buku_id = $request->buku_id;
        $data->tanggal_pinjam = now(); // realtime dari server
        $data->tanggal_kembali = $request->tanggal_kembali;
        $data->status = 'dipinjam';
        $data->keterangan = 'Sedang dipinjam';
        $data->save();

        return response()->json(['success' => true, 'message' => 'Buku berhasil dipinjam']);
    }

    public function kembalikanBuku($id)
    {
        $peminjaman = DataPeminjam::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Update keterangan jika terlambat
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);
        $sekarang = Carbon::now();
        
        // Reset waktu ke 00:00:00 untuk perhitungan hari murni
        $tanggalKembali->startOfDay();
        $sekarang->startOfDay();
        
        if ($sekarang->gt($tanggalKembali)) {
            $hariTelat = $sekarang->diffInDays($tanggalKembali);
            $peminjaman->keterangan = 'Terlambat ' . $hariTelat . ' hari - Sudah dikembalikan';
        } else {
            $peminjaman->keterangan = 'Tepat waktu - Sudah dikembalikan';
        }

        // Ubah status menjadi menunggu konfirmasi admin
        $peminjaman->status = 'menunggu_konfirmasi';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Buku dikembalikan. Menunggu konfirmasi admin.');
    }
}