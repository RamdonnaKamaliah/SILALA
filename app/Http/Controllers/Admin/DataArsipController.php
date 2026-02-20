<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBuku;

class DataArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // hanya tampilkan buku yang statusnya arsip
    $buku_arsip = DataBuku::where('status', 'arsip')->latest()->get();

    return view('admin.data_arsip.index', compact('buku_arsip'));
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
        return view('admin.data_arsip.show', ['buku' => DataBuku::findOrFail($id)]);
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
        $buku = DataBuku::findOrFail($id);
        // Hapus foto buku jika ada
        if ($buku->foto_buku && file_exists(public_path($buku->foto_buku))) {
            unlink(public_path($buku->foto_buku));
        }
        $buku->delete();
        return redirect()->route('admin.data_arsip.index')
            ->with('success', 'Data buku berhasil dihapus!');
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