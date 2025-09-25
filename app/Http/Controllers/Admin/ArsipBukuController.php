<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArsipBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.arsip_buku.index', ['title' => 'Data Arsip Buku']);
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
        return "Detail Favorit ID: $id (Percobaan)";
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
        return "Proses Hapus Favorit ID: $id (Percobaan)";
    }
}