<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Admin\DataBukuController;
use App\Http\Controllers\Admin\DataKategoriController;
use App\Http\Controllers\Admin\DataArsipController;
use App\Http\Controllers\Admin\DataPenggunaController;
use App\Http\Controllers\Admin\DataPeminjamController;
use App\Http\Controllers\Admin\DataDendaController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\user\DaftarBukuController;
use App\Http\Controllers\Auth\SetupPasswordController;
use App\Http\Controllers\user\DetailBukuController;
use App\Http\Controllers\user\RiwayatBukuController;
use App\Http\Controllers\user\RiwayatBacaController;
use App\Http\Controllers\user\FavoritController;
use App\Http\Controllers\user\ProfilController;





// Public Routes
Route::get('/', function () {
    return view('landingpage');
});

// Authentication Routes
require __DIR__.'/auth.php';

// Google OAuth Routes
Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('google.callback');

    

Route::middleware('auth:web')->group(function () {
    Route::get('/setup-password', [SetupPasswordController::class, 'index'])->name('setup.password');
    Route::post('/setup-password', [SetupPasswordController::class, 'store'])->name('setup.password.store');
});


// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Routes
Route::middleware(['auth:web', UserMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/daftarbuku', [DaftarBukuController::class, 'index'])->name('user.daftarbuku');
    Route::get('/detailbuku/{id}', [DetailBukuController::class, 'index'])->name('user.detailbuku');
     Route::get('/riwayatbuku', [RiwayatBukuController::class, 'index'])->name('user.riwayatbuku');
    Route::post('/riwayatbuku/store', [RiwayatBukuController::class, 'store'])->name('user.riwayatbuku.store');
    Route::get('/riwayatbaca', [RiwayatBacaController::class, 'index'])->name('user.riwayatbaca');
    Route::get('/favorit', [FavoritController::class, 'index'])->name('user.favorit');
    Route::get('/profil', [ProfilController::class, 'index'])->name('user.profil');
    
    // User - Riwayat Buku
Route::put('/riwayat/kembalikan/{id}', [RiwayatBukuController::class, 'kembalikanBuku'])
    ->name('user.riwayat.kembalikan');
Route::get('/check-borrow-status/{bookId}', [RiwayatBukuController::class, 'checkBookBorrowStatus'])->name('user.check.borrow.status');
Route::get('/check-active-borrow', [RiwayatBukuController::class, 'checkActiveBorrow'])->name('user.check.active.borrow');
// routes/web.php
Route::post('/pinjam', [App\Http\Controllers\Admin\DataPeminjamController::class, 'store'])
    ->name('pinjam.store')
    ->middleware('auth'); // Hanya auth, tanpa admin middleware
});



// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
  // 🗂️ Arsipkan buku
Route::put('/data_buku/{id}/archive', [DataBukuController::class, 'archive'])
    ->name('data_buku.archive');
    
// 🔁 Pulihkan buku dari arsip
Route::put('/data_buku/{id}/restore', [DataBukuController::class, 'restore'])
    ->name('data_buku.restore');

    Route::resource('/data_buku', DataBukuController::class)->names('data_buku');
    Route::delete('/data-buku/bulk-delete', [DataBukuController::class, 'bulkDelete'])->name('data_buku.bulk-delete');
    Route::get('/data_buku/template', [DataBukuController::class, 'downloadTemplate'])->name('data_buku.template');
    Route::post('/data_buku/import', [DataBukuController::class, 'import'])->name('data_buku.import');

    Route::resource('/data_kategori', DataKategoriController::class)->names('data_kategori');
    Route::delete('/data-kategori/bulk-delete', [DataKategoriController::class, 'bulkDelete'])->name('data_kategori.bulk-delete');

    Route::resource('/data_arsip', DataArsipController::class)->names('data_arsip');
    Route::resource('/data_pengguna', DataPenggunaController::class)->names('data_pengguna');
    Route::resource('/data_peminjam', DataPeminjamController::class)->names('data_peminjam');

    Route::put('/data_peminjam/{id}/kembalikan', [DataPeminjamController::class, 'kembalikan'])
        ->name('data_peminjam.kembalikan');
    Route::put('/data_peminjam/{id}/masalah', [DataPeminjamController::class, 'masalah'])
        ->name('data_peminjam.masalah');

    Route::resource('/data_denda', DataDendaController::class)->names('data_denda');
});


//route landingpage data buku
    Route::get('/', [LandingpageController::class, 'index'])->name('landing.index');

// Home Redirect Route
Route::get('/home', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } 
    
    if (Auth::guard('web')->check()) {
        return redirect()->route('dashboard');
    }
    
    return redirect()->route('login');
})->name('home');