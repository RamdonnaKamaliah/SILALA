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
      $media = GambarBuku::with('buku')->get();
      return view('admin.media.index', compact('media'));
    }

 public function destroy($id)
{
    $gambar = GambarBuku::findOrFail($id);

    $gambar->delete();

    return back()->with('success', 'Gambar & Data berhasil dihapus');
}

}