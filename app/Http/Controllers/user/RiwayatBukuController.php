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
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua riwayat pinjam user (baik masih dipinjam atau sudah dikembalikan)
        $riwayat = DataPeminjam::where('user_id', $userId)
            ->with('buku')
            ->orderByDesc('created_at')
            ->get();

        return view('user.riwayatbuku', [
            'title' => 'Riwayat Buku',
            'riwayat' => $riwayat
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:data_bukus,id',
            'tanggal_kembali' => 'required|date'
        ]);

        $userId = Auth::id();

        DataPeminjam::create([
            'user_id' => $userId,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam'
        ]);

        // Kurangi stok buku
        $buku = DataBuku::find($request->buku_id);
        $buku->decrement('stok', 1);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil disimpan'
        ]);
    }

    public function kembalikanBuku($id)
{
    $peminjaman = DataPeminjam::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // Ubah status menjadi menunggu konfirmasi admin
    $peminjaman->status = 'menunggu_konfirmasi';
    $peminjaman->save();

    return redirect()->back()->with('success', 'Buku dikembalikan. Menunggu konfirmasi admin.');
}

}
