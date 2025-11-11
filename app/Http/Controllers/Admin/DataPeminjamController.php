<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPeminjam;
use App\Models\DataBuku;

class DataPeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_peminjam = DataPeminjam::with(['user', 'buku'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.data_peminjam.index', compact('data_peminjam'));
    }

    public function kembalikan($id)
    {
        $peminjam = DataPeminjam::findOrFail($id);

        // Ubah status menjadi dikembalikan
        $peminjam->status = 'dikembalikan';

        // Hitung denda jika lewat tanggal kembali
        if (now()->gt($peminjam->tanggal_kembali)) {
    $hariTerlambat = now()->diffInDays($peminjam->tanggal_kembali);
    $peminjam->denda = $hariTerlambat * 1000;
} else {
    $hariTerlambat = 0;
    $peminjam->denda = 0;
}


        $peminjam->save();

        // Tambah stok buku
        $buku = DataBuku::find($peminjam->buku_id);
        if ($buku) {
            $buku->increment('stok', 1);
        }

        return redirect()->back()->with('success', 'Buku berhasil dikonfirmasi dikembalikan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjam = DataPeminjam::with(['user', 'buku'])->findOrFail($id);
        
        return view('admin.data_peminjam.show', compact('peminjam'));
    }

    public function masalah($id)
    {
        $peminjam = DataPeminjam::findOrFail($id);

        $peminjam->status = 'bermasalah';
        $peminjam->denda = 50000; // contoh nominal default
        $peminjam->save();

        return redirect()->back()->with('error', 'Buku dilaporkan bermasalah.');
    }

    // Tambahkan method untuk konfirmasi peminjaman
    public function konfirmasiPinjam($id)
    {
        $peminjam = DataPeminjam::findOrFail($id);

        // Ubah status dari menunggu_konfirmasi menjadi dipinjam
        if ($peminjam->status == 'menunggu_konfirmasi') {
            $peminjam->status = 'dipinjam';
            $peminjam->save();

            return redirect()->back()->with('success', 'Peminjaman berhasil dikonfirmasi.');
        }

        return redirect()->back()->with('error', 'Status peminjaman tidak valid.');
    }

    // Method untuk batalkan peminjaman
    public function batalkan($id)
    {
        $peminjam = DataPeminjam::findOrFail($id);

        if ($peminjam->status == 'menunggu_konfirmasi') {
            // Kembalikan stok buku
            $buku = DataBuku::find($peminjam->buku_id);
            if ($buku) {
                $buku->increment('stok', 1);
            }
            
            // Hapus data peminjaman
            $peminjam->delete();

            return redirect()->back()->with('success', 'Peminjaman berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Tidak dapat membatalkan peminjaman dengan status ini.');
    }
}