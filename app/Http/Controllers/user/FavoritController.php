<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Models\Favorit;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FavoritController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:data_bukus,id'
        ]);

        $user = Auth::user();
        $bukuId = $request->buku_id;

        $favorite = Favorit::where('user_id', $user->id)
                            ->where('buku_id', $bukuId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json([
                'success' => true,
                'message' => 'Buku dihapus dari favorit',
                'favorited' => false
            ]);
        } else {
            Favorit::create([
                'user_id' => $user->id,
                'buku_id' => $bukuId
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Buku ditambahkan ke favorit',
                'favorited' => true
            ]);
        }
    }

    public function index()
    {
        $favorites = Favorit::where('user_id', Auth::id())
            ->with('buku')
            ->get();

        return view('user.favorit', compact('favorites'));
    }
    
    // Optional: Method khusus untuk menghapus favorit
    public function destroy(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:data_bukus,id'
        ]);

        $favorite = Favorit::where('user_id', Auth::id())
                            ->where('buku_id', $request->buku_id)
                            ->firstOrFail();

        $favorite->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus dari favorit'
        ]);
    }
}