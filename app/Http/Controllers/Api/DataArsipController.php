<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\databuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku_arsip = databuku::where('status', 'arsip')->with('kategoris')->get();

    return response()->json([
        'status' => true,
        'message' => 'data arsip di temukan',
        'data' => $buku_arsip
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          
        $data = databuku::with('kategoris')->find($id);
        
        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $buku = databuku::find($id);
        
        if(empty($buku)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

       // Hapus foto buku jika ada
    if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)) {
        Storage::disk('public')->delete($buku->foto_buku);
    }

    // Hapus file buku jika ada
    if ($buku->file_buku && Storage::disk('public')->exists($buku->file_buku)) {
        Storage::disk('public')->delete($buku->file_buku);
    }

        $buku->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}