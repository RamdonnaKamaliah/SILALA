<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GambarBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MediaBukuController extends Controller
{
    public function index()
    {
        $media = GambarBuku::all();
        
        return response()->json([
            'status' => true,
            'message' => 'Data media ditemukan',
            'data' => $media
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_buku' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'judul_buku' => 'nullable|string|max:255',
        ]);

        $file = $request->file('foto_buku');
        $path = $file->store('uploads/buku', 'public');

        $media = GambarBuku::create([
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => $path,
            'judul_buku' => $request->judul_buku,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Media berhasil diupload',
            'data' => $media
        ], 201);
    }

    public function destroy($id)
    {
        $media = GambarBuku::find($id);
        
        if (!$media) {
            return response()->json([
                'status' => false,
                'message' => 'Media tidak ditemukan'
            ], 404);
        }

        // Hapus file dari storage
        if (Storage::disk('public')->exists($media->path_file)) {
            Storage::disk('public')->delete($media->path_file);
        }

        $media->delete();

        return response()->json([
            'status' => true,
            'message' => 'Media berhasil dihapus'
        ], 200);
    }
}