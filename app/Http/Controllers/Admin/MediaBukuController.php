<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use App\Models\GambarBuku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class MediaBukuController extends Controller
{
   private $apiUrl = 'http://127.0.0.1:8000/api';

public function index()
{
    try {
        // Request ke API
        $response = Http::get($this->apiUrl . '/media');
        
        if ($response->successful()) {
            $media = collect($response->json()['data'])->map(function($item) {
                $obj = (object) $item;
                
                // Convert relasi buku jadi object jika ada
                if (isset($item['buku'])) {
                    $obj->buku = (object) $item['buku'];
                } else {
                    $obj->buku = null;
                }
                
                return $obj;
            });
            
            return view('admin.media.index', compact('media'));
        } else {
            return back()->with('error', 'Gagal mengambil data media');
        }
        
    } catch (\Exception $e) {
        Log::error('Error fetching media: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

 public function destroy($id)
{
    try {
        $response = Http::delete($this->apiUrl . '/media/' . $id);
        
        if ($response->successful()) {
            return back()->with('success', 'Gambar & Data berhasil dihapus');
        } else {
            $error = $response->json()['message'] ?? 'Gagal menghapus data';
            return back()->with('error', $error);
        }
        
    } catch (\Exception $e) {
        Log::error('Error deleting media: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

}