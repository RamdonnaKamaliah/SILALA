<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPeminjam;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
    $peminjaman = \App\Models\DataPeminjam::findOrFail($id);
    $peminjaman->status = 'dikembalikan';
    $peminjaman->save();

    $buku = \App\Models\DataBuku::find($peminjaman->buku_id);
    if ($buku) {
        $buku->stok += 1;
        $buku->save();
    }

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan dan stok diperbarui.');
}


    public function konfirmasiKembali($id)
{
    $data = \App\Models\DataPeminjam::findOrFail($id);
    $buku = \App\Models\DataBuku::findOrFail($data->buku_id);

    if ($data->status == 'dipinjam') {
        $data->status = 'dikembalikan';
        $data->save();

        // tambah stok buku
        $buku->increment('stok', 1);
    }

    return redirect()->back()->with('success', 'Buku telah dikembalikan.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjam = DataPeminjam::with(['user', 'buku'])->findOrFail($id);
        
        return view('admin.data_peminjam.show', compact('peminjam'));
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


public function store(Request $request)
{
    try {
        Log::info('Store method dipanggil', ['request' => $request->all()]);
        
        // Validasi request
        $validated = $request->validate([
            'buku_id' => 'required|exists:data_bukus,id',
            'tanggal_kembali' => 'required|date'
        ]);

        $user = Auth::user();
        
        if (!$user) {
            Log::warning('User tidak terautentikasi');
            return response()->json([
                'success' => false,
                'message' => 'User tidak terautentikasi'
            ], 401);
        }

        $buku = DataBuku::findOrFail($request->buku_id);
        Log::info('Buku ditemukan', ['buku_id' => $buku->id, 'stok' => $buku->stok]);

        // Validasi stok
        if ($buku->stok <= 0) {
            Log::warning('Stok buku habis', ['buku_id' => $buku->id]);
            return response()->json([
                'success' => false,
                'message' => 'Stok buku habis!'
            ], 400);
        }

        // Cek apakah user sudah meminjam buku ini
        $existingBorrow = DataPeminjam::where('user_id', $user->id)
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['dipinjam', 'menunggu_konfirmasi'])
            ->first();

        if ($existingBorrow) {
            Log::warning('User sudah meminjam buku ini', ['user_id' => $user->id, 'buku_id' => $buku->id]);
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah meminjam buku ini!'
            ], 400);
        }

        // Cek jumlah buku yang sedang dipinjam
        $activeBorrows = DataPeminjam::where('user_id', $user->id)
            ->whereIn('status', ['dipinjam', 'menunggu_konfirmasi'])
            ->count();

        if ($activeBorrows >= 4) {
            Log::warning('User mencapai batas peminjaman', ['user_id' => $user->id, 'active_borrows' => $activeBorrows]);
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah mencapai batas maksimal peminjaman (3 buku)!'
            ], 400);
        }

        // Buat data peminjaman
        $peminjaman = new DataPeminjam();
        $peminjaman->user_id = $user->id;
        $peminjaman->buku_id = $buku->id;
        $peminjaman->tanggal_pinjam = now();
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        Log::info('Peminjaman berhasil dibuat', ['peminjaman_id' => $peminjaman->id]);

        // Kurangi stok buku
        $buku->decrement('stok', 1);
        Log::info('Stok buku dikurangi', ['buku_id' => $buku->id, 'stok_baru' => $buku->stok]);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dipinjam!'
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation error', ['errors' => $e->errors()]);
        return response()->json([
            'success' => false,
            'message' => 'Data tidak valid',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        Log::error('Error saat meminjam buku: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'request' => $request->all()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
        ], 500);
    }
}

public function konfirmasiPengembalian($id)
    {
        $peminjaman = DataPeminjam::findOrFail($id);
        
        // Validasi hanya bisa konfirmasi yang statusnya menunggu_konfirmasi
        if ($peminjaman->status !== 'menunggu_konfirmasi') {
            return redirect()->back()->with('error', 'Hanya bisa mengkonfirmasi pengembalian yang menunggu konfirmasi.');
        }
        
        // Update status menjadi dikembalikan
        $peminjaman->status = 'dikembalikan';
        
        // Update metode pengembalian jika belum ada
        if (!$peminjaman->metode_pengembalian) {
            $peminjaman->metode_pengembalian = 'mandiri';
        }
        
        // Update waktu pengembalian aktual jika belum ada
        if (!$peminjaman->waktu_pengembalian_aktual) {
            $peminjaman->waktu_pengembalian_aktual = Carbon::now();
        }
        
        // Update keterangan
        if (strpos($peminjaman->keterangan, 'Menunggu konfirmasi admin') !== false) {
            $peminjaman->keterangan = str_replace('Menunggu konfirmasi admin', 'Terkonfirmasi admin', $peminjaman->keterangan);
        } else {
            $peminjaman->keterangan .= ' - Terkonfirmasi admin';
        }
        
        $peminjaman->save();
        
        // Update stok buku
        if ($peminjaman->buku) {
            $buku = $peminjaman->buku;
            $buku->stok += 1;
            $buku->save();
        }
        
        return redirect()->back()->with('success', 'Pengembalian buku berhasil dikonfirmasi.');
    }

    // Method untuk mengembalikan buku (untuk admin)
    public function kembalikanBuku($id)
    {
        $peminjaman = DataPeminjam::findOrFail($id);
        
        // Update status dan keterangan
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);
        $sekarang = Carbon::now();
        
        if ($sekarang->gt($tanggalKembali)) {
            $hariTelat = abs($sekarang->diffInDays($tanggalKembali));
            $peminjaman->keterangan = 'Terlambat ' . $hariTelat . ' hari - Dikembalikan oleh admin';
        } else {
            $peminjaman->keterangan = 'Tepat waktu - Dikembalikan oleh admin';
        }
        
        $peminjaman->status = 'dikembalikan';
        $peminjaman->metode_pengembalian = 'admin';
        $peminjaman->waktu_pengembalian_aktual = $sekarang;
        $peminjaman->save();
        
        // Update stok buku
        if ($peminjaman->buku) {
            $buku = $peminjaman->buku;
            $buku->stok += 1;
            $buku->save();
        }
        
        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // Method untuk melaporkan masalah
    public function laporkanMasalah($id)
    {
        $peminjaman = DataPeminjam::findOrFail($id);
        
        $peminjaman->status = 'bermasalah';
        $peminjaman->keterangan = 'Dilaporkan bermasalah oleh admin';
        $peminjaman->save();
        
        return redirect()->back()->with('warning', 'Peminjaman dilaporkan bermasalah.');
    }

}