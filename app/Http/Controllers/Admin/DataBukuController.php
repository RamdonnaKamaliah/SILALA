<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBuku;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataBukuImport; 

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
        return view('admin.data_buku.create', ['title' => 'Tambah Buku']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'foto_buku' => 'nullable|image|max:2048', // Maksimal 2MB
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . (date('Y') + 1),
            'bahasa' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'jumlah_halaman' => 'required|integer|min:1',
            'edisi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'file_buku' => 'nullable|mimes:pdf|max:255',
        ]);

      
        if ($request->hasFile('foto_buku')) {
            $imageName = time() . '.' . $request->foto_buku->extension();
            $request->foto_buku->move(public_path('uploads/buku'), $imageName);
            $validated['foto_buku'] = 'uploads/buku/' . $imageName;
        }

        if ($request->hasfile('file_buku')){
            $fileName = time() . '.' . $request->file_buku->extension();
            $request->file_buku->move(public_path('uploads/file_buku'), $fileName);
            $validated['file_buku'] = 'uploads/file_buku/' . $fileName;
        }
        // Simpan data ke database
        
        DataBuku::create($validated);
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
        return view('admin.data_buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $validated = $request->validate([
            'foto_buku' => 'nullable|image|max:2048', // Maksimal 2MB
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . (date('Y') + 1),
            'bahasa' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'jumlah_halaman' => 'required|integer|min:1',
            'edisi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'file_buku' => 'nullable|mimes:pdf|max:255',
        ]);

       $buku = DataBuku::findOrFail($id);

         // Update foto jika ada
    if ($request->hasFile('foto_buku')) {
        if (!empty($buku->foto_buku) && file_exists(public_path($buku->foto_buku))) {
            unlink(public_path($buku->foto_buku));
        }

        $imageName = time() . '.' . $request->foto_buku->extension();
        $request->foto_buku->move(public_path('uploads/buku'), $imageName);
        $validated['foto_buku'] = 'uploads/buku/' . $imageName;
    }

    // Update file buku jika ada
    if ($request->hasFile('file_buku')) {
        if (!empty($buku->file_buku) && file_exists(public_path($buku->file_buku))) {
            unlink(public_path($buku->file_buku));
        }

        $fileName = time() . '.' . $request->file_buku->extension();
        $request->file_buku->move(public_path('uploads/file_buku'), $fileName);
        $validated['file_buku'] = 'uploads/file_buku/' . $fileName;
    }

    // Update data buku
    $buku->update($validated);
       return redirect()->route('admin.data_buku.index')
                 ->with('success', 'Data buku berhasil diperbarui!');
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

    public function downloadTemplate()
    {
        return response()->download(public_path('uploads/template/TEMPLATE_INPUT_DATA_BUKU_SILALA.xlsx'));

    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new DataBukuImport, $request->file('file'));
        return redirect()->route('admin.data_buku.index')->with('success', 'Data buku berhasil diimpor!');
    }
}