<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\databuku;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataBukuImport; 
use App\Models\DataKategori;
use App\Models\GambarBuku;
use Illuminate\Support\Facades\Storage;



class DataBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $bukus = databuku::with('kategoris')->latest()->get();

    return view('admin.data_buku.index', compact('bukus'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $kategoris = DataKategori::all();
    $media = GambarBuku::all();

    return view('admin.data_buku.create', compact('kategoris', 'media'));
}



    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'foto_buku' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        'foto_id'   => 'nullable|exists:gambar_bukus,id',
        'judul_buku' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'bahasa' => 'required',
        'kategori_id' => 'required|array|min:1',
        'jumlah_halaman' => 'required',
        'edisi' => 'required',
        'deskripsi' => 'required',
        'stok' => 'required',
        'file_buku' => 'required|mimes:pdf|max:10240',
    ]);

    $foto_buku_path = null;

    //  Upload manual
    if ($request->hasFile('foto_buku')) {

        $file = $request->file('foto_buku');

        $path = $file->store('uploads/buku', 'public');  
        $foto_buku_path = $path;

        // Simpan ke tabel media
        GambarBuku::create([
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => $path,
            'judul_buku' => $request->judul_buku,
        ]);
    }

    // Pilih dari galeri
    if ($request->foto_id) {
        $media = GambarBuku::find($request->foto_id);
        if ($media) {
            $foto_buku_path = $media->path_file;
        }
    }

    //  Simpan data buku
    $buku = databuku::create([
        'judul_buku' => $request->judul_buku,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'tahun_terbit' => $request->tahun_terbit,
        'bahasa' => $request->bahasa,
        'jumlah_halaman' => $request->jumlah_halaman,
        'edisi' => $request->edisi,
        'deskripsi' => $request->deskripsi,
        'stok' => $request->stok,

        'file_buku' => $request->file_buku
    ? $request->file_buku->store('uploads/file_buku', 'public')
    : null,

        'foto_buku' => $foto_buku_path,

        'kategori_ids' => implode(',', $request->kategori_id),
    ]);

    $buku->kategoris()->attach($request->kategori_id);

    return redirect()->route('admin.data_buku.index')
        ->with('success', 'Data buku berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = databuku::findOrFail($id);
        return view('admin.data_buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(string $id)
{
    $buku = databuku::findOrFail($id);
    $kategoris = DataKategori::all();
    return view('admin.data_buku.edit', compact('buku', 'kategoris'));
}
    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $buku = databuku::findOrFail($id);

    $buku->update($request->except('kategori_id'));

    if ($request->hasFile('foto_buku')) {
        $buku->foto_buku = $request->file('foto_buku')->store('foto-buku', 'public');
    }

    if ($request->hasFile('file_buku')) {
        $buku->file_buku = $request->file('file_buku')->store('file-buku', 'public');
    }

    $buku->save();
    $buku->kategoris()->sync($request->kategori_id);

    return redirect()->route('admin.data_buku.index')
        ->with('success', 'Data buku berhasil diupdate');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = databuku::findOrFail($id);
    
        $buku->delete();
        return redirect()->route('admin.data_buku.index')
            ->with('success', 'Data buku berhasil dihapus!');
    }

       public function bulkDelete(Request $request)
{
    $selectedIds = $request->selected_ids ?? [];

    if (!is_array($selectedIds)) {
        $selectedIds = array_filter(array_map('trim', explode(',', $selectedIds)));
    }

    $selectedIds = array_filter($selectedIds, fn ($id) => is_numeric($id));
    $selectedIds = array_map('intval', $selectedIds);

    if (empty($selectedIds)) {
        return redirect()->back()->with('error', 'Tidak ada buku yang dipilih.');
    }

    $books = databuku::whereIn('id', $selectedIds)->get();


    // Hapus data dari database
    databuku::whereIn('id', $selectedIds)->delete();

    return redirect()->route('admin.data_buku.index')
        ->with('success', count($selectedIds) . ' buku berhasil dihapus.');
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

        return redirect()->route('admin.data_buku.index')->with('success', 'Data buku berhasil diimpor!');
    }

    private function isValidPdf($filePath)
{
    if (!Storage::disk('public')->exists($filePath)) {
        return false;
    }

    $content = Storage::disk('public')->get($filePath);

    // PDF selalu diawali dengan "%PDF-"
    return str_starts_with($content, '%PDF-');
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

public function bulkArchive(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'selected_ids' => 'required'
            ]);

            $selectedIds = $request->input('selected_ids');

            // Debug: uncomment untuk lihat raw input
            // \Log::info('Raw selected_ids: ' . $selectedIds);

            // Parse selected_ids
            if (is_string($selectedIds)) {
                // Hapus bracket JSON jika ada
                $selectedIds = trim($selectedIds, '[]"');
                // Split by comma
                $selectedIds = explode(',', $selectedIds);
            }

            // Pastikan array dan bersihkan
            if (!is_array($selectedIds)) {
                $selectedIds = [$selectedIds];
            }

            // Clean dan convert ke integer
            $selectedIds = array_map(function($id) {
                // Hapus quotes dan whitespace
                $id = trim($id, '"\' ');
                return intval($id);
            }, $selectedIds);

            // Filter hanya yang valid (> 0)
            $selectedIds = array_filter($selectedIds, function($id) {
                return $id > 0;
            });

            // Reset array keys
            $selectedIds = array_values($selectedIds);

            // Debug: uncomment untuk lihat hasil parsing
            // \Log::info('Parsed IDs: ' . json_encode($selectedIds));

            if (empty($selectedIds)) {
                return back()->with('error', 'Tidak ada buku yang dipilih untuk diarsipkan.');
            }

            // Update status
            $updated = databuku::whereIn('id', $selectedIds)
                ->where('status', 'aktif')
                ->update(['status' => 'arsip']);

            if ($updated > 0) {
                return redirect()->route('admin.data_arsip.index')
                    ->with('success', $updated . ' buku berhasil diarsipkan.');
            } else {
                return back()->with('error', 'Tidak ada buku yang berhasil diarsipkan. Pastikan buku berstatus aktif.');
            }

        } catch (\Exception $e) {    
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    //pulihkan buku dari arsip 
    public function restore($id)
    {
        try {
            $buku = databuku::findOrFail($id);
            $buku->status = 'aktif';
            $buku->save();

            return back()->with('success', 'Buku "' . $buku->judul_buku . '" berhasil dikembalikan dari arsip!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}