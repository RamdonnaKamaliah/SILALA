<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BukuFavoritController;
use App\Http\Controllers\Api\DaftarBukuController;
use App\Http\Controllers\Api\DataArsipController;
use App\Http\Controllers\Api\DataBukuController;
use App\Http\Controllers\Api\DataPenggunaController;
use App\Http\Controllers\Api\DetailBukuController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\MediaBukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//data  buku
Route::get('dataBuku', [DataBukuController::class, 'index']);
Route::post('dataBuku', [DataBukuController::class, 'store']);
Route::get('dataBuku/{id}', [DataBukuController::class, 'show']);
Route::put('dataBuku/{id}', [DataBukuController::class, 'update']);
Route::delete('dataBuku/{id}', [DataBukuController::class, 'destroy']);
Route::post('dataBuku/bulk-delete', [DataBukuController::class, 'bulkDelete']);
Route::post('dataBuku/bulk-archive', [DataBukuController::class, 'bulkArchive']);
Route::post('dataBuku/{id}/restore', [DataBukuController::class, 'restore']);
Route::post('dataBuku/import', [DataBukuController::class, 'import']);

//media
Route::get('/media', [MediaBukuController::class, 'index']);
Route::delete('/media/{id}', [MediaBukuController::class, 'destroy']);

//kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

//arsip
Route::get('arsip', [DataArsipController::class, 'index']);
Route::get('arsip/{id}', [DataArsipController::class, 'show']);
Route::delete('arsip/{id}', [DataArsipController::class, 'destroy']);
Route::get('dataPengguna', [DataPenggunaController::class, 'index']);



// USER ROUTING

//Register
Route::post('register', [AuthController::class, 'register']);
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

//Login
Route::post('login', [AuthController::class,'login']); 
Route::post('/google/login', [AuthController::class,'googleLogin']); 

Route::middleware(['auth:sanctum,web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('daftarBuku', [DaftarBukuController::class, 'index']);
    Route::get('detailBuku/{id}', [DetailBukuController::class, 'index']);
});