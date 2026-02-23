<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SuperAdminAkunAdminController extends Controller
{
     public function index()
{
    $loginAdminId = Auth::guard('admin')->id();

    $admins = Admin::where('id', '!=', $loginAdminId)
        ->latest()
        ->get();

    return view('super_admin.akun_admin.index', [
        'admins' => $admins,
        'totalUsers' => $admins->count(),
    ]);
}



 public function store()
{
    $number = 1;

    //  Loop sampai ketemu admin & email yang BENAR-BENAR belum ada
    while (true) {
        $adminName = 'admin' . $number;
        $email     = $adminName . '@silala.com';

        $exists = Admin::where('name', $adminName)
            ->orWhere('email', $email)
            ->exists();

        if (!$exists) {
            break; 
        }

        $number++;
    }

    // password random huruf kecil + angka
    $password = substr(
        str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),
        0,
        8
    );

    Admin::create([
        'name'           => $adminName,
        'email'          => $email,
        'password'       => Hash::make($password),
        'plain_password' => $password,
    ]);

    return redirect()
        ->route('superadmin.akun_admin.index')
        ->with('success', "Akun {$adminName} berhasil dibuat");
}


public function destroy(Admin $akun)
{
    $loginAdminId = Auth::guard('admin')->id();

    if ($akun->id == $loginAdminId) {
        return redirect()
            ->route('superadmin.akun_admin.index')
            ->with('swal', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Tidak bisa menghapus akun yang sedang login'
            ]);
    }

    $akun->delete();

    return redirect()
        ->route('superadmin.akun_admin.index')
        ->with('swal', [
            'icon' => 'success',
            'title' => 'Berhasil',
            'text' => 'Akun admin berhasil dihapus'
        ]);
}
}