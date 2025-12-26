<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $apiUrl = 'http://127.0.0.1:8000/api';
    
   public function index()
{
    try {
        $response = Http::get($this->apiUrl . '/arsip');
        
        if ($response->successful()) {
            $buku_arsip = collect($response->json()['data'])->map(function($item) {
                $obj = (object) $item;
                
                // Convert kategoris jadi collection/array jika ada
                if (isset($item['kategoris'])) {
                    $obj->kategoris = collect($item['kategoris'])->map(fn($k) => (object)$k);
                } else {
                    $obj->kategoris = collect([]); // Empty collection
                }
                
                return $obj;
            });
            
            return view('admin.data_arsip.index', compact('buku_arsip'));
        } // ← Tutup if
        
        return back()->with('error', 'Gagal mengambil data arsip');
        
    } catch (\Exception $e) { // ← Tambahkan catch
        Log::error('Error fetching arsip: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    } 
} 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Halaman Tambah Favorit (Percobaan)";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Proses Simpan Favorit (Percobaan)";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $response = Http::get($this->apiUrl . '/arsip/' . $id);

            if ($response->successful()) {
                $buku = $response->json()['data'];
                $buku = (object) $buku;
                
                // Convert kategoris
                if (isset($buku->kategoris) && is_array($buku->kategoris)) {
                    $buku->kategoris = collect($buku->kategoris)->map(function($kategori) {
                        return (object) $kategori;
                    });
                } else {
                    $buku->kategoris = collect([]);
                }

                return view('admin.data_arsip.show', compact('buku'));
            }

            return redirect()->route('admin.data_arsip.index')
                ->with('error', 'Buku tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error showing book: ' . $e->getMessage());
            return redirect()->route('admin.data_arsip.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Halaman Edit Favorit ID: $id (Percobaan)";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Proses Update Favorit ID: $id (Percobaan)";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          try {
            $response = Http::delete($this->apiUrl . '/arsip/' . $id);

            if ($response->successful()) {
                return redirect()->route('admin.data_arsip.index')
                    ->with('success', 'Data buku berhasil dihapus');
            } else {
                return back()->with('error', 'Gagal menghapus data');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting book: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function bulkDeleteArchive(Request $request)
    {
       $selectedIds = explode(',', $request->selected_ids);

    if (empty($selectedIds)) {
        return redirect()->back()->with('error', 'Tidak ada buku yang dipilih untuk dihapus.');
    }

    DataBuku::whereIn('id', $selectedIds)->delete();

    return redirect()->route('admin.data_arsip.index')
        ->with('success', count($selectedIds) . ' buku arsip berhasil dihapus permanen.');
    }

    public function bulkRestore(Request $request)
    {
        $selectedIds = explode(',', $request->input('selected_ids', ''));

        if (empty($selectedIds)) {
            return back()->with('error', 'Tidak ada buku yang dipilih untuk dipulihkan.');
        }

        DataBuku::whereIn('id', $selectedIds)->update(['status' => 'aktif']);

        return redirect()->route('admin.data_buku.index')
            ->with('success', count($selectedIds) . ' buku berhasil dipulihkan.');
    }
}