<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBuku;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataBukuImport; 
use App\Models\DataKategori;
use App\Helpers\ImageHelper;


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
    return view('admin.data_buku.create', compact('kategoris'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        'file_buku' => 'nullable|mimes:pdf|max:255',
    ]);

    // Upload file foto
    if ($request->hasFile('foto_buku')) {
        $imageName = time() . '.' . $request->foto_buku->extension();
        $request->foto_buku->move(public_path('uploads/buku'), $imageName);
        $validated['foto_buku'] = 'uploads/buku/' . $imageName;
    }

    // Upload file PDF
    if ($request->hasFile('file_buku')) {
        $fileName = time() . '.' . $request->file_buku->extension();
        $request->file_buku->move(public_path('uploads/file_buku'), $fileName);
        $validated['file_buku'] = 'uploads/file_buku/' . $fileName;
    }

    // Simpan id kategori dalam bentuk string (contoh: "1,2,3")
    $validated['kategori_ids'] = implode(',', $request->kategori_id);

    // Simpan buku
    $dataBuku = collect($validated)->except('kategori_id')->toArray();
    $buku = DataBuku::create($dataBuku);

    // Simpan relasi di pivot
    $buku->kategoris()->attach($request->kategori_id);

    return redirect()->route('admin.data_buku.index')->with('success', 'Data buku berhasil ditambahkan!');
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
        'file_buku' => 'nullable|mimes:pdf|max:255',
    ]);

    $buku = DataBuku::findOrFail($id);

    if ($request->hasFile('foto_buku')) {
        if ($buku->foto_buku && file_exists(public_path($buku->foto_buku))) {
            unlink(public_path($buku->foto_buku));
        }
        $imageName = time() . '.' . $request->foto_buku->extension();
        $request->foto_buku->move(public_path('uploads/buku'), $imageName);
        $validated['foto_buku'] = 'uploads/buku/' . $imageName;
    }

    if ($request->hasFile('file_buku')) {
        if ($buku->file_buku && file_exists(public_path($buku->file_buku))) {
            unlink(public_path($buku->file_buku));
        }
        $fileName = time() . '.' . $request->file_buku->extension();
        $request->file_buku->move(public_path('uploads/file_buku'), $fileName);
        $validated['file_buku'] = 'uploads/file_buku/' . $fileName;
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
        // Hapus foto buku jika ada
        if ($buku->foto_buku && file_exists(public_path($buku->foto_buku))) {
            unlink(public_path($buku->foto_buku));
        }
        $buku->delete();
        return redirect()->route('admin.data_buku.index')
            ->with('success', 'Data buku berhasil dihapus!');
    }

       public function bulkDelete(Request $request)
    {
        $selectedIds = $request->selected_ids;

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

public function bulkArchive(Request $request) {

    $selectedIds = explode(',', $request->input('selected_ids', ''));

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