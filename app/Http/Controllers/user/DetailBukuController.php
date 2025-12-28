<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataBuku;
use App\Models\DataPeminjam;
use App\Models\RiwayatBaca;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class DetailBukuController extends Controller
{
     private $apiUrl = 'http://127.0.0.1:8000/api';
     
  public function index($id)
    {
        try {
            // Ambil SEMUA data dari API (termasuk data buku lengkap)
            $response = Http::get($this->apiUrl . '/detail-buku/' . $id);

            if (!$response->successful()) {
                return redirect()->back()->with('error', 'Buku tidak ditemukan');
            }

            $apiData = $response->json();
            $data = $apiData['data'];

            // Assign data dari API
            $buku = (object) $data['buku']; // 👈 Dari API, bukan database
            $userBorrow = $data['user_borrow'];
            $hasRead = $data['has_read'];
            $stokHabis = $data['stok_habis'];
            $isFavorited = $data['is_favorited'];
            $userRating = $data['user_rating'];
            $averageRating = $data['average_rating'];
            $totalRatings = $data['total_ratings'];
            $canRate = $data['can_rate'];

            return view('user.detailbuku', compact(
                'buku', 
                'userBorrow', 
                'stokHabis', 
                'isFavorited',
                'hasRead',
                'userRating',
                'averageRating',
                'totalRatings',
                'canRate'
            ));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function baca($id)
    {
        $buku = DataBuku::findOrFail($id);

        // Cek login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah file buku tersedia
        if (!$buku->file_buku) {
            return back()->with('error', 'File buku tidak tersedia.');
        }

        // Simpan riwayat baca (update atau buat baru)
        RiwayatBaca::updateOrCreate(
            ['user_id' => Auth::id(), 'buku_id' => $buku->id],
            ['terakhir_dibaca' => now()]
        );

        // Buka langsung file PDF
        return redirect(asset($buku->file_buku));
    }
}