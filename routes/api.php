<?php

use App\Http\Controllers\Api\DataBukuController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\MediaBukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('dataBuku', [DataBukuController::class, 'index']);
Route::post('dataBuku', [DataBukuController::class, 'store']);
Route::get('dataBuku/{id}', [DataBukuController::class, 'show']);
Route::put('dataBuku/{id}', [DataBukuController::class, 'update']);
Route::delete('dataBuku/{id}', [DataBukuController::class, 'destroy']);
Route::post('dataBuku/bulk-delete', [DataBukuController::class, 'bulkDelete']);
Route::post('dataBuku/bulk-archive', [DataBukuController::class, 'bulkArchive']);
Route::post('dataBuku/{id}/restore', [DataBukuController::class, 'restore']);
Route::post('dataBuku/import', [DataBukuController::class, 'import']);
Route::get('/media', [MediaBukuController::class, 'index']);
Route::post('/media', [MediaBukuController::class, 'store']);
Route::delete('/media/{id}', [MediaBukuController::class, 'destroy']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
Route::put('/kategori', [KategoriController::class, 'index']);
Route::put('/kategori', [KategoriController::class, 'store']);
Route::put('/kategori/{id}', [KategoriController::class, 'show']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);