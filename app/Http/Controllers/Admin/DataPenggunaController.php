<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrashedAccount;
use App\Models\User;

class DataPenggunaController extends Controller
{
    public function index()
    {
    
        $totalUsers = User::count();
        $karyawanCount = User::karyawan()->count();
        $magangCount = User::magang()->count();
        
        $users = User::all();

        return view('admin.data_pengguna.index', compact(
            'totalUsers',
            'karyawanCount',
            'magangCount',
            'users' // Jangan lupa tambahin ini
        ));
    }


public function destroy($id)
{
    try {
        $user = User::findOrFail($id);

        TrashedAccount::create([
            'name' => $user->name,
            'email'=> $user->email,
        ]);

        $user->delete();

        return response()->json([
            'message' => 'Akun berhasil dihapus'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal menghapus akun'
        ], 500);
    }
}


}