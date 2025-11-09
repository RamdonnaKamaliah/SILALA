<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $data_peminjam = \App\Models\DataPeminjam::with(['user', 'buku'])->get();
    return view('admin.data_peminjam.index', compact('data_peminjam'));
}

public function kembalikan($id)
{
    $peminjam = \App\Models\DataPeminjam::findOrFail($id);

    // Ubah status menjadi dikembalikan
    $peminjam->status = 'dikembalikan';

    // Hitung denda jika lewat tanggal kembali
    if (now()->gt($peminjam->tanggal_kembali)) {
        $hariTerlambat = now()->diffInDays($peminjam->tanggal_kembali);
        $peminjam->denda = $hariTerlambat * 1000; // contoh: Rp1000 per hari
    } else {
        $peminjam->denda = 0;
    }

    $peminjam->save();

    return redirect()->back()->with('success', 'Buku berhasil dikonfirmasi dikembalikan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Detail Favorit ID: $id (Percobaan)";
    }

    public function masalah($id)
{
    $peminjam = \App\Models\DataPeminjam::findOrFail($id);

    $peminjam->status = 'bermasalah';
    $peminjam->denda = 50000; // contoh nominal default
    $peminjam->save();

    return redirect()->back()->with('error', 'Buku dilaporkan bermasalah.');
}

}