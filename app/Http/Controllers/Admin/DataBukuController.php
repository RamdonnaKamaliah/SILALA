<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBuku;
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
        $data_buku = DataBuku::all();
        return view('admin.data_buku.index', compact('data_buku'));
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
    $validated = $request->validate([
        'foto_buku' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        'foto_id'   => 'required|exists:gambar_bukus,id',
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

    // 1️⃣ Upload manual
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

    // 2️⃣ Pilih dari galeri
    if ($request->foto_id) {
        $media = GambarBuku::find($request->foto_id);
        if ($media) {
            $foto_buku_path = $media->path_file;
        }
    }

    // 3️⃣ Simpan data buku
    $buku = DataBuku::create([
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

    // 4️⃣ Pivot kategori
    $buku->kategoris()->attach($request->kategori_id);

    return redirect()->route('admin.data_buku.index')
        ->with('success', 'Data buku berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = DataBuku::findOrFail($id);
        return view('admin.data_buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(string $id)
{
    $buku = DataBuku::findOrFail($id);
    $kategoris = DataKategori::all();
    return view('admin.data_buku.edit', compact('buku', 'kategoris'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'foto_buku' => 'nullable|image|mimes:png,jpg|max:2048',
        'judul_buku' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . (date('Y') + 1),
        'bahasa' => 'required|string|max:100',
        'kategori_id' => 'required|array',
        'kategori_id.*' => 'exists:data_kategoris,id',
        'jumlah_halaman' => 'required|integer|min:1',
        'edisi' => 'required|string|max:100',
        'deskripsi' => 'required|string',
        'stok' => 'required|integer|min:0',
        'file_buku' => 'required|mimes:pdf|max:255',
    ]);

    $buku = DataBuku::findOrFail($id);

    if ($request->hasFile('foto_buku')) {
    if ($buku->foto_buku && file_exists(storage_path('app/public/' . $buku->foto_buku))) {
        unlink(storage_path('app/public/' . $buku->foto_buku));
    }

    $path = $request->file('foto_buku')->store('upload/foto_buku', 'public');
    $validated['foto_buku'] = $path;
}

   if ($request->hasFile('file_buku')) {
    if ($buku->file_buku && file_exists(storage_path('app/public/' . $buku->file_buku))) {
        unlink(storage_path('app/public/' . $buku->file_buku));
    }

    $path = $request->file('file_buku')->store('upload/file_buku', 'public');
    $validated['file_buku'] = $path;
}

    // Simpan ulang kategori_ids dalam bentuk string
    $validated['kategori_ids'] = implode(',', $request->kategori_id);

    $dataBuku = collect($validated)->except('kategori_id')->toArray();
    $buku->update($dataBuku);

    // Update pivot
    $buku->kategoris()->sync($request->kategori_id);

    return redirect()->route('admin.data_buku.index')->with('success', 'Data buku berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = DataBuku::findOrFail($id);
       
        $buku->delete();
        return redirect()->route('admin.data_buku.index')
            ->with('success', 'Data buku berhasil dihapus!');
    }

       public function bulkDelete(Request $request)
{
    $selectedIds = $request->selected_ids ?? [];

    // Jika dikirim sebagai string "1,2,3"
    if (!is_array($selectedIds)) {
        $selectedIds = array_filter(array_map('trim', explode(',', $selectedIds)));
    }

    // Hapus semua yang bukan angka (termasuk "on")
    $selectedIds = array_filter($selectedIds, function ($id) {
        return is_numeric($id);
    });

    // Ubah ke integer
    $selectedIds = array_map('intval', $selectedIds);

    if (empty($selectedIds)) {
        return redirect()->back()->with('error', 'Tidak ada kategori yang dipilih.');
    }

    DataBuku::whereIn('id', $selectedIds)->delete();

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
        $buku = DataBuku::findOrFail($id);
        $buku->status = 'arsip';
        $buku->save();

        return redirect()->route('admin.data_arsip.index')
            ->with('success', 'Buku "' . $buku->judul_buku . '" berhasil diarsipkan!');
    }

    return back()->with('error', 'Tidak ada buku yang dipilih untuk diarsipkan.');
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


    //pulihkan buku dari arsip 
    public function restore ($id)
    {
        $buku = DataBuku::findOrFail($id);
        $buku->status = 'aktif';
        $buku->save();

        return redirect()->route('admin.data_buku.index')->with('success', 'Buku berhasil dipulihkan!');
    }
}