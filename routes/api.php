<?php

use Illuminate\Support\Facades\Route;

// USER API
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DaftarBukuController;
use App\Http\Controllers\Api\DetailBukuController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\RiwayatBukuController;
use App\Http\Controllers\Api\BukuFavoritController;

// ADMIN API
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\DataBukuController;
use App\Http\Controllers\Api\MediaBukuController;
use App\Http\Controllers\Api\DataArsipController;
use App\Http\Controllers\Api\DataPenggunaController;

Route::post('/login', [AuthController::class, 'login']);
Route::prefix('user')->group(function () {
    
    // AUTH
    Route::post('/register', [AuthController::class, 'register']);
    
    // BUKU & KATEGORI
    Route::get('/daftar-buku', [DaftarBukuController::class, 'index']);
    Route::get('/detail-buku/{id}', [DetailBukuController::class, 'index']);
    Route::get('/kategori', [KategoriController::class, 'index']);
});

Route::prefix('user')
->middleware('auth:sanctum')
->group(function () {
    
    Route::get('/dataBuku', [DataBukuController::class, 'index']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // RIWAYAT & PEMINJAMAN
        Route::get('/riwayat-buku', [RiwayatBukuController::class, 'index']);
        Route::get('/check-active-borrow', [RiwayatBukuController::class, 'checkActiveBorrow']);
        Route::get('/check-book-borrow/{bookId}', [RiwayatBukuController::class, 'checkBookBorrowStatus']);

        Route::post('/pinjam-buku', [RiwayatBukuController::class, 'store']);
        Route::post('/kembalikan-buku/{id}', [RiwayatBukuController::class, 'kembalikanBuku']);
        Route::post('/kembalikan-buku-foto', [RiwayatBukuController::class, 'kembalikanBukuWithPhoto']);
        Route::get('/peminjaman-terlambat', [RiwayatBukuController::class, 'getPeminjamanTerlambat']);

        // FAVORIT
        Route::get('/favorit', [BukuFavoritController::class, 'index']);
        Route::post('/favorit/toggle', [BukuFavoritController::class, 'toggle']);
        Route::delete('/favorit/remove', [BukuFavoritController::class, 'destroy']);
    });