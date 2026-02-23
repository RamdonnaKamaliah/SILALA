<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataPenggunaController extends Controller
{
    public function index()
    {
    
        $totalUsers = User::count();
        $pengunjungCount = User::pengunjung()->count();
        $anggotaCount = User::anggota()->count();
        
        $users = User::all();

        return view('admin.data_pengguna.index', compact(
            'totalUsers',
            'pengunjungCount',
            'anggotaCount',
            'users' // Jangan lupa tambahin ini
        ));
    }


public function destroy($id)
{
    $user = User::findOrFail($id);

    if (Auth::id() == $user->id) {
        return response()->json([
            'success' => false,
            'message' => 'Anda tidak bisa menghapus akun sendiri.'
        ], 403);
    }

    $user->delete();

    return response()->json([
        'success' => true,
        'message' => 'Pengguna berhasil dihapus.'
    ]);
}

}