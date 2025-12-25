<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DataBukuImport;
use App\Models\DataBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class DataBukuController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:8000/api';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = Http::get($this->apiUrl . '/dataBuku');

            if ($response->successful()) {
                $data = $response->json()['data'] ?? [];
                
                $bukus = collect($data)->map(function($item) {
                    $buku = (object) $item;
                    
                    // Convert kategoris jadi collection of objects
                    if (isset($buku->kategoris) && is_array($buku->kategoris)) {
                        $buku->kategoris = collect($buku->kategoris)->map(function($kategori) {
                            return (object) $kategori;
                        });
                    } else {
                        $buku->kategoris = collect([]);
                    }
                    
                    return $buku;
                });
            } else {
                $bukus = collect([]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching books: ' . $e->getMessage());
            $bukus = collect([]);
        }

        return view('admin.data_buku.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    try {
        // Ambil data kategori
        $responseKategori = Http::get($this->apiUrl . '/kategori');
        
        // Ambil data media dari API
        $responseMedia = Http::get($this->apiUrl . '/media');
        
        if ($responseKategori->successful()) {
            $kategoris = collect($responseKategori->json()['data'] ?? [])->map(function($item) {
                return (object) $item;
            });
        } else {
            $kategoris = collect([]);
        }

        if ($responseMedia->successful()) {
            $media = collect($responseMedia->json()['data'] ?? [])->map(function($item) {
                return (object) $item;
            });
        } else {
            $media = collect([]);
        }
    } catch (\Exception $e) {
        Log::error('Error fetching data: ' . $e->getMessage());
        $kategoris = collect([]);
        $media = collect([]);
    }

    return view('admin.data_buku.create', compact('kategoris', 'media'));
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'foto_buku' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'judul_buku' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|digits:4',
                'bahasa' => 'required',
                'kategori_id' => 'required|array|min:1',
                'jumlah_halaman' => 'required|integer|min:1',
                'edisi' => 'required',
                'deskripsi' => 'required',
                'stok' => 'required|integer|min:0',
                'file_buku' => 'required|mimes:pdf|max:10240',
            ]);

            // Kirim ke API dengan multipart/form-data
            $response = Http::asMultipart()->post($this->apiUrl . '/dataBuku', [
                // File uploads
                ['name' => 'foto_buku', 'contents' => $request->hasFile('foto_buku') 
                    ? fopen($request->file('foto_buku')->getRealPath(), 'r') 
                    : '', 'filename' => $request->hasFile('foto_buku') 
                    ? $request->file('foto_buku')->getClientOriginalName() 
                    : ''],
                
                ['name' => 'file_buku', 'contents' => fopen($request->file('file_buku')->getRealPath(), 'r'), 
                    'filename' => $request->file('file_buku')->getClientOriginalName()],
                
                // Text fields
                ['name' => 'media_id', 'contents' => $request->foto_id ?? ''],
                ['name' => 'judul_buku', 'contents' => $request->judul_buku],
                ['name' => 'penulis', 'contents' => $request->penulis],
                ['name' => 'penerbit', 'contents' => $request->penerbit],
                ['name' => 'tahun_terbit', 'contents' => $request->tahun_terbit],
                ['name' => 'bahasa', 'contents' => $request->bahasa],
                ['name' => 'jumlah_halaman', 'contents' => $request->jumlah_halaman],
                ['name' => 'edisi', 'contents' => $request->edisi],
                ['name' => 'deskripsi', 'contents' => $request->deskripsi],
                ['name' => 'stok', 'contents' => $request->stok],
                
                
                // Kategori (array)
                ...collect($request->kategori_id)->map(function($id, $index) {
                    return ['name' => "kategori_id[{$index}]", 'contents' => $id];
                })->toArray(),
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.data_buku.index')
                    ->with('success', 'Data buku berhasil ditambahkan');
            } else {
                $error = $response->json()['message'] ?? 'Gagal menambahkan data';
                return back()->withInput()->with('error', $error);
            }
        } catch (\Exception $e) {
            Log::error('Error storing book: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $response = Http::get($this->apiUrl . '/dataBuku/' . $id);

            if ($response->successful()) {
                $data = $response->json()['data'];
                $buku = (object) $data;
                
                // Convert kategoris
                if (isset($buku->kategoris) && is_array($buku->kategoris)) {
                    $buku->kategoris = collect($buku->kategoris)->map(function($kategori) {
                        return (object) $kategori;
                    });
                } else {
                    $buku->kategoris = collect([]);
                }

                return view('admin.data_buku.show', compact('buku'));
            }

            return redirect()->route('admin.data_buku.index')
                ->with('error', 'Buku tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error showing book: ' . $e->getMessage());
            return redirect()->route('admin.data_buku.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // Ambil data buku
            $responseBuku = Http::get($this->apiUrl . '/dataBuku/' . $id);
            
            // Ambil data kategori
            $responseKategori = Http::get($this->apiUrl . '/kategori');

            if ($responseBuku->successful() && $responseKategori->successful()) {
                $buku = (object) $responseBuku->json()['data'];
                
                // Convert kategoris
                if (isset($buku->kategoris) && is_array($buku->kategoris)) {
                    $buku->kategoris = collect($buku->kategoris)->map(function($kategori) {
                        return (object) $kategori;
                    });
                } else {
                    $buku->kategoris = collect([]);
                }
                
                $kategoris = collect($responseKategori->json()['data'] ?? [])->map(function($item) {
                    return (object) $item;
                });

                return view('admin.data_buku.edit', compact('buku', 'kategoris'));
            }

            return redirect()->route('admin.data_buku.index')
                ->with('error', 'Buku tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error editing book: ' . $e->getMessage());
            return redirect()->route('admin.data_buku.index')
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
                'foto_buku' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'judul_buku' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|digits:4',
                'bahasa' => 'required',
                'kategori_id' => 'required|array|min:1',
                'jumlah_halaman' => 'required|integer|min:1',
                'edisi' => 'required',
                'deskripsi' => 'required',
                'stok' => 'required|integer|min:0',
                'file_buku' => 'nullable|mimes:pdf|max:10240',
            ]);

            $multipart = [
                ['name' => 'judul_buku', 'contents' => $request->judul_buku],
                ['name' => 'penulis', 'contents' => $request->penulis],
                ['name' => 'penerbit', 'contents' => $request->penerbit],
                ['name' => 'tahun_terbit', 'contents' => $request->tahun_terbit],
                ['name' => 'bahasa', 'contents' => $request->bahasa],
                ['name' => 'jumlah_halaman', 'contents' => $request->jumlah_halaman],
                ['name' => 'edisi', 'contents' => $request->edisi],
                ['name' => 'deskripsi', 'contents' => $request->deskripsi],
                ['name' => 'stok', 'contents' => $request->stok],
                ['name' => '_method', 'contents' => 'PUT'], // Method spoofing
            ];

            // Tambahkan
            if ($request->hasFile('foto_buku')) {
                $multipart[] = [
                    'name' => 'foto_buku',
                    'contents' => fopen($request->file('foto_buku')->getRealPath(), 'r'),
                    'filename' => $request->file('foto_buku')->getClientOriginalName()
                ];
            }

            if ($request->hasFile('file_buku')) {
                $multipart[] = [
                    'name' => 'file_buku',
                    'contents' => fopen($request->file('file_buku')->getRealPath(), 'r'),
                    'filename' => $request->file('file_buku')->getClientOriginalName()
                ];
            }

            // Tambahkan kategori
            foreach ($request->kategori_id as $index => $kategoriId) {
                $multipart[] = ['name' => "kategori_id[{$index}]", 'contents' => $kategoriId];
            }

            // Kirim sebagai POST dengan method spoofing
            $response = Http::asMultipart()->post($this->apiUrl . '/dataBuku/' . $id, $multipart);

            if ($response->successful()) {
                return redirect()->route('admin.data_buku.index')
                    ->with('success', 'Data buku berhasil diupdate');
            } else {
                $error = $response->json()['message'] ?? 'Gagal mengupdate data';
                return back()->withInput()->with('error', $error);
            }
        } catch (\Exception $e) {
            Log::error('Error updating book: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $response = Http::delete($this->apiUrl . '/dataBuku/' . $id);

            if ($response->successful()) {
                return redirect()->route('admin.data_buku.index')
                    ->with('success', 'Data buku berhasil dihapus');
            } else {
                return back()->with('error', 'Gagal menghapus data');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting book: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

        public function downloadTemplate()
    {
        return response()->download(public_path('uploads/template/TEMPLATE_INPUT_DATA_BUKU_SILALA_NEW.xlsx'));
    }

     public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new DataBukuImport, $request->file('file'));

        return redirect()->route('admin.data_buku.index')->with('succes', 'Data buku berhasil di import');
    }
    
    public function archive(Request $request, $id = null)
    {
    if ($id) {
        $buku = databuku::findOrFail($id);
        $buku->status = 'arsip';
        $buku->save();

        return redirect()->route('admin.data_arsip.index')
            ->with('success', 'Buku "' . $buku->judul_buku . '" berhasil diarsipkan!');
    }

    return back()->with('error', 'Tidak ada buku yang dipilih untuk diarsipkan.');
}

    public function restore ($id)
    {
        $buku = DataBuku::findOrFail($id);
        $buku->status = 'aktif';
        $buku->save();

        return redirect()->route('admin.data_buku.index')->with('success', 'Buku berhasil dipulihkan!');
    }

    public function bulkArchive(Request $request)
{
    $selectedIds = $request->input('selected_ids', []);

    if (!is_array($selectedIds)) {
        $selectedIds = array_filter(array_map('trim', explode(',', $selectedIds)));
    }

    $selectedIds = array_filter($selectedIds, function ($id) {
        return is_numeric($id);
    });

    $selectedIds = array_map('intval', $selectedIds);

    if (empty($selectedIds)) {
        return back()->with('error', 'Tidak ada buku yang dipilih untuk diarsipkan.');
    }

    DataBuku::whereIn('id', $selectedIds)->update(['status' => 'arsip']);

    return redirect()->route('admin.data_arsip.index')
        ->with('success', count($selectedIds) . ' buku berhasil diarsipkan.');
}

     public function bulkDelete(Request $request)
{
    $selectedIds = $request->input('selected_ids', []);

    if (!is_array($selectedIds)) {
        $selectedIds = array_filter(array_map('trim', explode(',', $selectedIds)));
    }

    $selectedIds = array_filter($selectedIds, function ($id) {
        return is_numeric($id);
    });

    $selectedIds = array_map('intval', $selectedIds);

    if (empty($selectedIds)) {
        return back()->with('error', 'Tidak ada buku yang dipilih untuk diarsipkan.');
    }

    databuku::whereIn('id', $selectedIds)->delete();

   return redirect()->route('admin.data_buku.index')->with('succes', count($selectedIds). 'buku berhasil di hapus');


}

}