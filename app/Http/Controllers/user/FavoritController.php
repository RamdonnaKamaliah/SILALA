<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FavoritController extends Controller
{
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $bukuId = $request->buku_id;

        $favorite = Favorit::where('user_id', $user->id)
                            ->where('buku_id', $bukuId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['favorited' => false]);
        } else {
            Favorit::create([
                'user_id' => $user->id,
                'buku_id' => $bukuId
            ]);
            return response()->json(['favorited' => true]);
        }
    }
    public function index()
{
    $favorites = Favorit::where('user_id', Auth::id())
        ->with('buku')
        ->get();

    return view('user.favorit', compact('favorites'));
}

}