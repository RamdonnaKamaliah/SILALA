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
        $media = GambarBuku::with('buku')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Data media ditemukan',
            'data' => $media
        ], 200);
    }

    public function store(Request $request)
    {
       //
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

    // Hapus dari database
    $media->delete();

    return response()->json([
        'status' => true,
        'message' => 'Media berhasil dihapus'
    ], 200);
}
}