<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DataPenggunaController extends Controller
{
    public function index()
    {
        // Hanya 3 statistik yang dibutuhkan
        $userCount = User::count();
        $karyawanCount = User::karyawan()->count();
        $magangCount = User::magang()->count();

        return view('admin.data_pengguna.index', compact(
            'userCount',
            'karyawanCount',
            'magangCount'
        ));
    }
}