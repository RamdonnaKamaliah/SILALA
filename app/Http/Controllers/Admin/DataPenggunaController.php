<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
}