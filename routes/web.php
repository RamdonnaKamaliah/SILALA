<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Middleware
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;

// Controllers - Admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DataBukuController;
use App\Http\Controllers\Admin\DataKategoriController;
use App\Http\Controllers\Admin\DataArsipController;
use App\Http\Controllers\Admin\DataPenggunaController;
use App\Http\Controllers\Admin\DataPeminjamController;
use App\Http\Controllers\Admin\MediaBukuController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\AdminProfileController;

// Controllers - Auth
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\SetupPasswordController;

// Controllers - User & Public
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\user\DaftarBukuController;
use App\Http\Controllers\user\DetailBukuController;
use App\Http\Controllers\user\RiwayatBukuController;
use App\Http\Controllers\user\RiwayatBacaController;
use App\Http\Controllers\user\FavoritController;
use App\Http\Controllers\user\ProfilController;
use App\Http\Controllers\user\EditProfilController;
use App\Http\Controllers\user\RatingController;

// 🌟 ADMIN Profile
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin', AdminMiddleware::class])
    ->group(function () {

        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/update-password', [AdminProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    });

// ==============================
// 🌟 ADMIN CMS
// ==============================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin', AdminMiddleware::class])
    ->group(function () {

        Route::get('/cms', [CmsController::class, 'editHero'])
            ->name('cms_admin.index');

        Route::post('/cms/update-hero', [CmsController::class, 'updateHero'])
            ->name('cms_admin.updateHero');

        Route::post('/cms/update-footer-logo', [CmsController::class, 'updateFooterLogo'])
            ->name('cms_admin.updateFooterLogo');

        Route::post('/cms/update-sidebar-logo', [CmsController::class, 'updateSidebarLogo'])
            ->name('cms_admin.updateSidebarLogo');   

         Route::post('/cms/update-hero-bg', [CmsController::class, 'updateHeroBg'])
            ->name('cms_admin.updateHeroBg');
    });


// ==============================
// 🌟 PUBLIC ROUTES
// ==============================
Route::get('/', function () {
    return view('landingpage');
});

// Google OAuth
Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('google.callback');


// ==============================
// 🌟 PROFILE (UMUM LOGIN)
// ==============================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


// ==============================
// 🌟 USER ROUTES
// ==============================
Route::middleware(['auth:web', UserMiddleware::class])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/daftarbuku', [DaftarBukuController::class, 'index'])
        ->name('user.daftarbuku');

    Route::get('/detailbuku/{id}', [DetailBukuController::class, 'index'])
        ->name('user.detailbuku');

    // Baca Buku
    Route::get('/baca/{id}', [DetailBukuController::class, 'baca'])
        ->name('user.baca');

    // Riwayat Buku
    Route::get('/riwayatbuku', [RiwayatBukuController::class, 'index'])
        ->name('user.riwayatbuku');

    Route::post('/riwayatbuku/store', [RiwayatBukuController::class, 'store'])
        ->name('user.riwayatbuku.store');

    Route::put('/riwayat/kembalikan/{id}', [RiwayatBukuController::class, 'kembalikanBuku'])
        ->name('user.riwayat.kembalikan');

    Route::get('/check-borrow-status/{bookId}', [RiwayatBukuController::class, 'checkBookBorrowStatus'])
        ->name('user.check.borrow.status');

    Route::get('/check-active-borrow', [RiwayatBukuController::class, 'checkActiveBorrow'])
        ->name('user.check.active.borrow');

    // Riwayat Baca
    Route::get('/riwayatbaca', [RiwayatBacaController::class, 'index'])
        ->name('user.riwayatbaca');

    // Peminjaman Buku
    Route::post('/pinjam', [DataPeminjamController::class, 'store'])
        ->name('pinjam.store');

    // Favorit Buku
    Route::get('/favorit', [FavoritController::class, 'index'])
        ->name('user.favorit');

    Route::post('/favorit/toggle', [FavoritController::class, 'toggle'])
        ->name('user.favorit.toggle');

    // Rating Buku
    Route::post('/rating', [RatingController::class, 'store'])
        ->name('user.rating.store');

    Route::get('/rating/{bukuId}', [RatingController::class, 'getUserRating'])
        ->name('user.rating.get');

    Route::delete('/rating/{bukuId}', [RatingController::class, 'destroy'])
        ->name('user.rating.destroy');

    // Profil User
    Route::get('/profil', [ProfilController::class, 'index'])
        ->name('user.profil');

    Route::get('/editprofil', [EditProfilController::class, 'index'])
        ->name('user.editprofil');

});


// ==============================
// 🌟 ADMIN ROUTES
// ==============================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin', AdminMiddleware::class])
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('dashboard');

        // Data Buku
        Route::resource('/data_buku', DataBukuController::class);
        Route::delete('/data-buku/bulk-delete', [DataBukuController::class, 'bulkDelete'])
            ->name('data_buku.bulk-delete');
        Route::get('/data_buku/template', [DataBukuController::class, 'downloadTemplate'])
            ->name('data_buku.template');
        Route::post('/data_buku/import', [DataBukuController::class, 'import'])
            ->name('data_buku.import');
        Route::put('/data_buku/{id}/archive', [DataBukuController::class, 'archive'])
            ->name('data_buku.archive');
        Route::post('/data-buku/bulk-archive', [DataBukuController::class, 'bulkArchive'])
            ->name('data_buku.bulkArchive');
        Route::put('/data_buku/{id}/restore', [DataBukuController::class, 'restore'])
            ->name('data_buku.restore');

        // Data Kategori
        Route::resource('/data_kategori', DataKategoriController::class);
        Route::delete('/data-kategori/bulk-delete', [DataKategoriController::class, 'bulkDelete'])
            ->name('data_kategori.bulk-delete');

        // Arsip
        Route::resource('/data_arsip', DataArsipController::class);
        Route::post('/data_arsip/bulk-restore', [DataArsipController::class, 'bulkRestore'])
            ->name('data_arsip.bulkRestore');
        Route::post('/data_arsip/bulk-delete', [DataArsipController::class, 'bulkDeleteArchive'])
            ->name('data_arsip.bulkDeleteArchive');

        // Pengguna
        Route::resource('/data_pengguna', DataPenggunaController::class);

        // Peminjam
        Route::resource('/data_peminjam', DataPeminjamController::class);
        Route::put('/data_peminjam/{id}/kembalikan', [DataPeminjamController::class, 'kembalikan'])
            ->name('data_peminjam.kembalikan');
        Route::put('/data_peminjam/{id}/masalah', [DataPeminjamController::class, 'masalah'])
            ->name('data_peminjam.masalah');

        // Media Buku
        Route::get('/media-buku', [MediaBukuController::class, 'index'])
            ->name('media.index');

        Route::delete('/media-buku/{id}', [MediaBukuController::class, 'destroy'])
            ->name('media.destroy');

    });


// ==============================
// 🌟 Redirect HOME
// ==============================
Route::get('/home', function () {

    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    if (Auth::guard('web')->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');

})->name('home');

// Laravel Default Auth
require __DIR__.'/auth.php';