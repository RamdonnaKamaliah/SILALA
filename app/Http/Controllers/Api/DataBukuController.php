<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\DataBukuImport;
use App\Models\databuku; 
use App\Models\GambarBuku;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class DataBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = databuku::with('kategoris')->latest()->where('status', 'aktif')->get(); 
        
        return response()->json([
            'status' => true,
            'message' => 'Data Ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'foto_buku' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'foto_id'   => 'nullable|exists:gambar_bukus,id',
            'judul_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'bahasa' => 'required',
            'kategori_id' => 'required|array|min:1',
            'kategori_id.*' => 'exists:data_kategoris,id',
            'jumlah_halaman' => 'required',
            'edisi' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
            'file_buku' => 'required|mimes:pdf|max:10240',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal membuat data',
                'data' => $validator->errors()
            ], 422);
        }

        $foto_buku_path = null;

        //  Upload manual
    if ($request->hasFile('foto_buku')) {

        $file = $request->file('foto_buku');

        $path = $file->store('uploads/buku', 'public');  
        $foto_buku_path = $path;

        // Simpan ke tabel media
        GambarBuku::create([
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => $path,
            'judul_buku' => $request->judul_buku,
        ]);
    }

    // Pilih dari galeri
    if ($request->foto_id) {
        $media = GambarBuku::find($request->foto_id);
        if ($media) {
            $foto_buku_path = $media->path_file;
        }
    }


        // Simpan kategori_ids sebagai string
        $kategori_ids = implode(',', $request->kategori_id);

        $buku = databuku::create([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'bahasa' => $request->bahasa,
            'jumlah_halaman' => $request->jumlah_halaman,
            'edisi' => $request->edisi,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'file_buku' => $request->file('file_buku')
                ? $request->file('file_buku')->store('uploads/file_buku', 'public')
                : null,
            'foto_buku' => $foto_buku_path,
        ]);

        // Attach ke tabel pivot
        $buku->kategoris()->attach($request->kategori_id);

        $buku->load('kategoris');

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil dibuat',
            'data' => $buku 
        ], 201);
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
        $validated = $request->validate([
            'foto_buku' => 'nullable|image|mimes:png,jpg|max:2048',
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . (date('Y') + 1),
            'bahasa' => 'required|string|max:100',
            'kategori_id' => 'required|array|min:1',
            'kategori_id.*' => 'exists:data_kategoris,id',
            'jumlah_halaman' => 'required|integer|min:1',
            'edisi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'file_buku' => 'nullable|mimes:pdf|max:10240',
        ]);

        
        $buku = databuku::findOrFail($id);

        // Handle foto_buku
        if ($request->hasFile('foto_buku')) {
            if ($buku->foto_buku && file_exists(storage_path('app/public/' . $buku->foto_buku))) {
                unlink(storage_path('app/public/' . $buku->foto_buku));
            }

            $path = $request->file('foto_buku')->store('upload/foto_buku', 'public');
            $validated['foto_buku'] = $path;
        }

        // Handle file_buku
        if ($request->hasFile('file_buku')) {
            if ($buku->file_buku && file_exists(storage_path('app/public/' . $buku->file_buku))) {
                unlink(storage_path('app/public/' . $buku->file_buku));
            }

            $path = $request->file('file_buku')->store('upload/file_buku', 'public');
            $validated['file_buku'] = $path;
        }

        // Simpan kategori_ids sebagai string
        $validated['kategori_ids'] = implode(',', $request->kategori_id);

        // Update data buku
        $dataBuku = collect($validated)->except('kategori_id')->toArray();
        $buku->update($dataBuku);

        // Update pivot table
        $buku->kategoris()->sync($request->kategori_id);

        // Load relasi sebelum return
        $buku->load('kategoris');

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah',
            'data' => $buku
        ], 200);
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

        // Hapus file buku jika ada
        if ($buku->file_buku && file_exists(storage_path('app/public/' . $buku->file_buku))) {
            unlink(storage_path('app/public/' . $buku->file_buku));
        }

        $buku->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }

    /**
     * Import data from Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new DataBukuImport, $request->file('file'));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diimport'
        ], 200);
    }

    public function archive($id = null)
    {
    if ($id) {
        $buku = DataBuku::findOrFail($id);
        $buku->status = 'arsip';
        $buku->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil di arsip'
        ], 200);
    }else{
        return response()->json([
            'status' => false,
            'message' => 'data gagal di arsipkan'
        ]);
    }
}

    public function restore ($id)
    {
        $buku = databuku::findOrFail($id);
        $buku->status = 'aktif';
        $buku->save();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil diarsipkan'
        ], 200);
    }

    public function bulkArchive(Request $request)
{
    $selectedIds = $request->input('selected_ids', []);

    if (!is_array($selectedIds)) {
        $selectedIds = array_filter(array_map('trim', explode(',', $selectedIds)));
    }

    $selectedIds = array_filter($selectedIds, function ($id) {
        return is_numeric($id);
    });

    $selectedIds = array_map('intval', $selectedIds);

    if (empty($selectedIds)) {
        return back()->with('error', 'Tidak ada buku yang dipilih untuk diarsipkan.');
    }

    databuku::whereIn('id', $selectedIds)->update(['status' => 'arsip']);

    return response()->json([
        'status' => true,
        'message' => 'data yang terpilih sukses di arsipkan'
    ]);


}

 public function bulkDelete(Request $request)
{
    $selectedIds = $request->input('selected_ids', []);

    if (!is_array($selectedIds)) {
        $selectedIds = array_filter(array_map('trim', explode(',', $selectedIds)));
    }

    $selectedIds = array_filter($selectedIds, function ($id) {
        return is_numeric($id);
    });

    $selectedIds = array_map('intval', $selectedIds);

    if (empty($selectedIds)) {
        return back()->with('error', 'Tidak ada buku yang dipilih untuk diarsipkan.');
    }

    databuku::whereIn('id', $selectedIds)->delete();

    return response()->json([
        'status' => true,
        'message' => 'data yang terpilih sukses di hapus'
    ]);


}
}