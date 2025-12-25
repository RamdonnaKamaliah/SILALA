<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataKategoriController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api/kategori';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = Http::get($this->apiUrl);

            if ($response->successful()) {
                $data = $response->json()['data'] ?? [];
                
                $kategoris = collect($data)->map(function($item) {
                    return (object) $item;
                });
            } else {
                $kategoris = collect([]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            $kategoris = collect([]);
        }

        return view('admin.data_kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            $response = Http::post($this->apiUrl, [
                'nama_kategori' => $request->nama_kategori,
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.data_kategori.index')
                    ->with('success', 'Kategori berhasil ditambahkan');
            } else {
                $error = $response->json()['message'] ?? 'Gagal menambahkan kategori';
                return back()->withInput()->with('error', $error);
            }
        } catch (\Exception $e) {
            Log::error('Error storing category: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $response = Http::get($this->apiUrl . '/' . $id);

            if ($response->successful()) {
                $kategori = (object) $response->json()['data'];
                return view('admin.data_kategori.show', compact('kategori'));
            }

            return redirect()->route('admin.data_kategori.index')
                ->with('error', 'Kategori tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error showing category: ' . $e->getMessage());
            return redirect()->route('admin.data_kategori.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $response = Http::get($this->apiUrl . '/' . $id);

            if ($response->successful()) {
                $kategori = (object) $response->json()['data'];
                return view('admin.data_kategori.edit', compact('kategori'));
            }

            return redirect()->route('admin.data_kategori.index')
                ->with('error', 'Kategori tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error editing category: ' . $e->getMessage());
            return redirect()->route('admin.data_kategori.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            $response = Http::put($this->apiUrl . '/' . $id, [
                'nama_kategori' => $request->nama_kategori,
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.data_kategori.index')
                    ->with('success', 'Kategori berhasil diupdate');
            } else {
                $error = $response->json()['message'] ?? 'Gagal mengupdate kategori';
                return back()->withInput()->with('error', $error);
            }
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $response = Http::delete($this->apiUrl . '/' . $id);

            if ($response->successful()) {
                return redirect()->route('admin.data_kategori.index')
                    ->with('success', 'Kategori berhasil dihapus');
            } else {
                $error = $response->json()['message'] ?? 'Gagal menghapus kategori';
                return back()->with('error', $error);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('selected_ids', []);
            
            if (empty($ids)) {
                return back()->with('error', 'Tidak ada data yang dipilih');
            }

            $successCount = 0;
            $failCount = 0;

            foreach ($ids as $id) {
                $response = Http::delete($this->apiUrl . '/' . $id);
                if ($response->successful()) {
                    $successCount++;
                } else {
                    $failCount++;
                }
            }

            if ($successCount > 0) {
                $message = "Berhasil menghapus {$successCount} kategori";
                if ($failCount > 0) {
                    $message .= ", gagal menghapus {$failCount} kategori";
                }
                return redirect()->route('admin.data_kategori.index')
                    ->with('success', $message);
            }

            return back()->with('error', 'Gagal menghapus kategori');
        } catch (\Exception $e) {
            Log::error('Error bulk deleting categories: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}