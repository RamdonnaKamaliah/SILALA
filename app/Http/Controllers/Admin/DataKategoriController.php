<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataKategori;

class DataKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_kategori = DataKategori::all();
        return view('admin.data_kategori.index', compact('data_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_kategori.create', ['title' => 'Tambah Kategori']);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_kategori' => 'required|string|max:255|unique:data_kategoris,nama_kategori',
    ], [
        'nama_kategori.unique' => 'Kategori sudah ada.',
        'nama_kategori.required' => 'Nama kategori harus diisi.',
    ]);

    DataKategori::create($validated);

    return redirect()->route('admin.data_kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = DataKategori::findOrFail($id);
        return view('admin.data_kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = DataKategori::findOrFail($id);
        return view('admin.data_kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi data
    $validated = $request->validate([
        'nama_kategori' => 'required|string|max:255|unique:data_kategoris,nama_kategori,' . $id,
    ]);

    // Cari data kategori
    $kategori = DataKategori::findOrFail($id);

    // Update data
    $kategori->update($validated);

    // Notifikasi berhasil
    return redirect()
        ->route('admin.data_kategori.index')
        ->with('success', 'Kategori berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = DataKategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.data_kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

     /**
     * Bulk delete categories
     */
    public function bulkDelete(Request $request)
    {
        $selectedIds = $request->selected_ids;

        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Tidak ada kategori yang dipilih.');
        }

        DataKategori::whereIn('id', $selectedIds)->delete();

        return redirect()->route('admin.data_kategori.index')
            ->with('success', count($selectedIds) . ' kategori berhasil dihapus.');
    }
}