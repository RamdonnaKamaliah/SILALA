<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class DaftarBukuController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api';
    
    public function index(Request $request)
    {
        try {
            // Ambil parameter kategori dari request
            $kategori = $request->get('kategori', 'Semua');

            // Panggil API daftar buku dengan parameter kategori
            $response = Http::get($this->apiUrl . '/daftarBuku', [
                'kategori' => $kategori
            ]);

            if (!$response->successful()) {
                return redirect()->back()->with('error', 'Gagal mengambil data buku');
            }

            $apiData = $response->json();

            // Parse data dari API
            $data_bukus = collect($apiData['data_bukus'])->map(function($buku) use ($apiData) {
                // Tambahkan rating ke setiap buku
                $bukuId = $buku['id'];
                $rating = isset($apiData['ratings'][$bukuId]) ? $apiData['ratings'][$bukuId] : null;
                
                $buku['avg_rating'] = $rating ? round($rating['avg_rating'], 1) : 0;
                $buku['total_ratings'] = $rating ? $rating['total_ratings'] : 0;
                 $buku['kategoris'] = collect($buku['kategoris'] ?? []);
                
                return (object) $buku;
            });

            $data_kategoris = collect($apiData['data_kategoris'])->map(fn($kat) => (object) $kat);
            $selectedKategori = $kategori;

            return view('user.daftarbuku', compact(
                'data_bukus',
                'data_kategoris',
                'selectedKategori'
            ));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}