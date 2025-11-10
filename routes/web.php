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

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Routes
Route::middleware(['auth:web', UserMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
       
   // 🗂️ Arsipkan buku
Route::put('/data_buku/{id}/archive', [DataBukuController::class, 'archive'])
    ->name('data_buku.archive');
// Route untuk arsipkan banyak buku
Route::post('/data-buku/bulk-archive', [DataBukuController::class, 'bulkArchive'])
    ->name('data_buku.bulkArchive');


    
// 🔁 Pulihkan buku dari arsip
Route::put('/data_buku/{id}/restore', [DataBukuController::class, 'restore'])
    ->name('data_buku.restore');
// Route untuk pulihkan banyak buku
Route::post('/data_buku/bulk-restore', [DataBukuController::class, 'bulkRestore'])
    ->name('data_buku.bulkRestore');

// Route untuk halaman arsip
Route::post('/data-arsip/bulk-restore', [DataArsipController::class, 'bulkRestore'])
    ->name('admin.data_arsip.bulkRestore');

Route::post('/data-arsip/bulk-delete', [DataArsipController::class, 'bulkDeleteArchive'])
    ->name('admin.data_arsip.bulkDeleteArchive');



    Route::resource('/data_buku', DataBukuController::class)->names('data_buku');
    Route::delete('/data-buku/bulk-delete', [DataBukuController::class, 'bulkDelete'])->name('data_buku.bulk-delete');
    Route::get('/data_buku/template', [DataBukuController::class, 'downloadTemplate'])->name('data_buku.template');
    Route::post('/data_buku/import', [DataBukuController::class, 'import'])->name('data_buku.import');
    Route::resource('/data_kategori', DataKategoriController::class)->names('data_kategori');
    Route::delete('/data-kategori/bulk-delete', [DataKategoriController::class, 'bulkDelete'])->name('data_kategori.bulk-delete');
    Route::resource('/data_arsip', DataArsipController::class)->names('data_arsip');
    Route::resource('/data_pengguna', DataPenggunaController::class)->names('data_pengguna');
    Route::resource('/data_peminjam', DataPeminjamController::class)->names('data_peminjam');
    Route::resource('/data_denda', DataDendaController::class)->names('data_denda');
 
});



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