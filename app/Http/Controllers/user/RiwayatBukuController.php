<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPeminjam;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
            $hariTelat = abs($sekarang->diffInDays($tanggalKembali));
            $peminjaman->keterangan = 'Terlambat ' . $hariTelat . ' hari - Sudah dikembalikan';
        } else {
            $peminjaman->keterangan = 'Tepat waktu - Sudah dikembalikan';
        }

        // Ubah status menjadi menunggu konfirmasi admin
        $peminjaman->status = 'menunggu_konfirmasi';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Buku dikembalikan. Menunggu konfirmasi admin.');
    }

    public function kembalikanBukuWithPhoto(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:data_peminjams,id',
            'foto' => 'required|image|max:5120' // Maksimal 5MB
        ]);

        // Cari data peminjaman
        $peminjaman = DataPeminjam::where('id', $request->buku_id)
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->firstOrFail();

        // Simpan foto ke storage
        if ($request->hasFile('foto')) {
            // Generate nama file yang unik
            $fileName = 'pengembalian_' . time() . '_' . uniqid() . '.' . $request->file('foto')->getClientOriginalExtension();
            
            // Simpan file ke storage
            $path = $request->file('foto')->storeAs('pengembalian', $fileName, 'public');
            
            // Update data peminjaman
            $peminjaman->foto_bukti_pengembalian = $path;
        }

        // Hitung keterlambatan
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);
        $sekarang = Carbon::now();
        
        // Reset waktu ke 00:00:00 untuk perhitungan hari murni
        $tanggalKembali->startOfDay();
        $sekarang->startOfDay();
        
        // Update keterangan berdasarkan keterlambatan
        if ($sekarang->gt($tanggalKembali)) {
            $hariTelat = abs($sekarang->diffInDays($tanggalKembali));
            $peminjaman->keterangan = 'Terlambat ' . $hariTelat . ' hari - Menunggu konfirmasi admin';
        } else {
            $peminjaman->keterangan = 'Tepat waktu - Menunggu konfirmasi admin';
        }

        // Update data pengembalian
        $peminjaman->status = 'menunggu_konfirmasi';
        $peminjaman->metode_pengembalian = 'mandiri';
        $peminjaman->waktu_pengembalian_aktual = $sekarang;
        $peminjaman->save();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dikembalikan dengan foto. Menunggu konfirmasi admin.',
            'data' => [
                'peminjaman_id' => $peminjaman->id,
                'buku' => $peminjaman->buku->judul_buku,
                'waktu_pengembalian' => $sekarang->format('d F Y H:i:s'),
                'status' => 'menunggu_konfirmasi'
            ]
        ]);
    }
}