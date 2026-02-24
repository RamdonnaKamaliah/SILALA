<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminAkunUserController extends Controller
{
    public function index()
    {
    
        $totalUsers = User::count();
        $pengunjungCount = User::pengunjung()->count();
        $anggotaCount = User::anggota()->count();
        
        $users = User::all();

        return view('super_admin.akun_pengguna.index', compact(
            'totalUsers',
            'pengunjungCount',
            'anggotaCount',
            'users' 
        ));
    }
}