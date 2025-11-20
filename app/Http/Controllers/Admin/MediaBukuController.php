<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use App\Models\GambarBuku;
use Illuminate\Support\Facades\Storage;

class MediaBukuController extends Controller
{
    public function index()
    {
        $gambar = GambarBuku::latest()->paginate(20);
        return view('admin.media.index', compact('gambar'));
    }

    public function destroy(GambarBuku $gambar)
    {
        Storage::delete($gambar->path_file);
        $gambar->delete();

        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Gambar buku berhasil dihapus');
    }
}
