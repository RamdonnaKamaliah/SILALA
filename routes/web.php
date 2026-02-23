<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CmsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Admin\DataBukuController;
use App\Http\Controllers\Admin\DataKategoriController;
use App\Http\Controllers\Admin\DataArsipController;
use App\Http\Controllers\Admin\DataPenggunaController;
use App\Http\Controllers\Admin\DataPeminjamController;
use App\Http\Controllers\Admin\AdminAkunController;
use App\Http\Controllers\user\DaftarBukuController;
use App\Http\Controllers\Auth\SetupPasswordController;
use App\Http\Controllers\user\DetailBukuController;
use App\Http\Controllers\user\RiwayatBukuController;
use App\Http\Controllers\user\RiwayatBacaController;
use App\Http\Controllers\user\FavoritController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\EditProfilController;
use App\Http\Controllers\user\RatingController;
use App\Http\Controllers\Admin\MediaBukuController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\superAdmin\DashboardSuperAdminController;
use App\Http\Controllers\superAdmin\SuperAdminAkunAdminController;
use App\Http\Controllers\superAdmin\SuperAdminDataBukuController;
use App\Http\Controllers\superAdmin\SuperAdminMediaBukuController;
use App\Http\Controllers\superAdmin\SuperAdminPeminjamController;
use App\Http\Controllers\User\DaftarBukuController as UserDaftarBukuController;

// Public Routes
Route::get('/', [LandingpageController::class, 'index']);

// Authentication Routes
require __DIR__.'/auth.php';

// Google OAuth Routes
Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('google.callback');
    
// Setup Password Route (untuk user yang register via Google)
Route::middleware('auth:web')->group(function () {
    Route::get('/setup-password', [SetupPasswordController::class, 'index'])
        ->name('setup.password');
    Route::post('/setup-password', [SetupPasswordController::class, 'store'])
        ->name('setup.password.store');
});

// User Routes
Route::middleware([UserMiddleware::class])->group(function () {
    // USER
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');

    //DAFTAR BUKU
    Route::get('/daftarbuku', [DaftarBukuController::class, 'index'])->name('user.daftarbuku');

    // DETAIL BUKU
    Route::get('/detailbuku/{id}', [DetailBukuController::class, 'index'])
    ->middleware('auth')
    ->name('user.detailbuku');


    // RIWAYAT BUKU & RIWAYAT BACA
    Route::get('/riwayatbuku', [RiwayatBukuController::class, 'index'])->name('user.riwayatbuku');
    Route::post('/riwayatbuku/store', [RiwayatBukuController::class, 'store'])->name('user.riwayatbuku.store');
    Route::get('/riwayatbaca', [RiwayatBacaController::class, 'index'])->name('user.riwayatbaca');

    // PROFIL USER
    Route::get('/profil', [ProfilController::class, 'index'])->name('user.profil');
    Route::get('/editprofil', [EditProfilController::class, 'index'])->name('user.editprofil');
    Route::put('/editprofil', [EditProfilController::class, 'update'])->name('user.updateprofil');

    // BACA
    Route::get('/baca/{id}', [DetailBukuController::class, 'baca'])->name('user.baca');

     // PENGEMBALIAN BUKU
    Route::put('/riwayat/kembalikan/{id}', [RiwayatBukuController::class, 'kembalikanBuku'])
        ->name('user.riwayat.kembalikan');
    Route::post('/kembalikan-buku-foto', [RiwayatBukuController::class, 'kembalikanBukuWithPhoto'])
        ->name('user.kembalikan.buku.foto');
    Route::get('/check-borrow-status/{bookId}', [RiwayatBukuController::class, 'checkBookBorrowStatus'])
        ->name('user.check.borrow.status');
    Route::get('/check-active-borrow', [RiwayatBukuController::class, 'checkActiveBorrow'])
        ->name('user.check.active.borrow');
    Route::get('/peminjaman-teguran/{id}', [RiwayatBukuController::class, 'getPeminjamanTeguran'])
        ->name('user.peminjaman.teguran');

    // PINJAM BUKU
    Route::post('/pinjam', [App\Http\Controllers\Admin\DataPeminjamController::class, 'store'])
        ->name('pinjam.store')
        ->middleware('auth');
    
        Route::get('/peminjaman-terlambat', [RiwayatBukuController::class, 'getPeminjamanTerlambat'])
    ->name('user.peminjaman.terlambat');
    
    // FAVORIT
    Route::get('/favorit', [FavoritController::class, 'index'])->name('user.favorit');
    Route::post('/favorit/toggle', [FavoritController::class, 'toggle'])->name('user.favorit.toggle');
    Route::delete('/favorit/remove', [FavoritController::class, 'destroy'])->name('user.favorit.destroy');
    // RATING
    Route::post('/rating', [RatingController::class, 'store'])->name('user.rating.store');
    Route::get('/rating/{bukuId}', [RatingController::class, 'getUserRating'])->name('user.rating.get');
    Route::delete('/rating/{bukuId}', [RatingController::class, 'destroy'])->name('user.rating.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['admin.auth', 'admin.only'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/akun', AdminAkunController::class)->names('akun_admin');

    // Data Buku Routes
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
     Route::post('/admin/profile/update', [AdminProfileController::class, 'update'])
    ->name('profile.update');
    Route::post('/profile/update-password', [AdminProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    
    Route::delete('/data_buku/bulk-delete', [DataBukuController::class, 'bulkDelete'])->name('data_buku.bulkDelete');
    Route::get('/data_buku/template', [DataBukuController::class, 'downloadTemplate'])->name('data_buku.template');
    Route::post('/data_buku/import', [DataBukuController::class, 'import'])->name('data_buku.import');
    Route::post('/data_buku/bulk-archive', [DataBukuController::class, 'bulkArchive'])
    ->name('data_buku.bulkArchive'); // 🗂️ Arsipkan banyak buku
    Route::put('/data_buku/{id}/archive', [DataBukuController::class, 'archive'])
    ->name('data_buku.archive'); // 🗂️ Arsipkan buku
    Route::put('/data_buku/{id}/restore', [DataBukuController::class, 'restore'])
    ->name('data_buku.restore');

     Route::resource('/data_buku', DataBukuController::class)->names('data_buku');

    // Data Kategori Routes
    Route::delete('/data_kategori/bulk-delete', [DataKategoriController::class, 'bulkDelete'])->name('data_kategori.bulk-delete');
    Route::resource('/data_kategori', DataKategoriController::class)->names('data_kategori');

    // Data Arsip Routes
    Route::resource('/data_arsip', DataArsipController::class)->names('data_arsip');
    Route::post('/data_arsip/bulk-restore', [DataArsipController::class, 'bulkRestore'])
        ->name('data_arsip.bulkRestore');   //Pulihkan banyak buku dari arsip
    Route::post('/data_arsip/bulk-delete', [DataArsipController::class, 'bulkDeleteArchive'])
        ->name('data_arsip.bulkDeleteArchive');  // Hapus banyak buku dari arsip

    // Data Pengguna Routes
    Route::resource('/data_pengguna', DataPenggunaController::class)->names('data_pengguna');
    Route::delete('/data_pengguna/{id}', [DataPenggunaController::class, 'destroy'])
    ->name('data_pengguna.destroy');

    // Data Peminjam Routes
    Route::resource('/data_peminjam', DataPeminjamController::class)->names('data_peminjam');
    Route::put('/data_peminjam/{id}/kembalikan', [DataPeminjamController::class, 'kembalikanBuku'])
        ->name('data_peminjam.kembalikan');  
    Route::put('/data_peminjam/{id}/konfirmasi', [DataPeminjamController::class, 'konfirmasiPengembalian'])
        ->name('data_peminjam.konfirmasi');  
    Route::put('/data_peminjam/{id}/masalah', [DataPeminjamController::class, 'laporkanMasalah'])
        ->name('data_peminjam.masalah');

    //  Teguran dan Batalkan Teguran
    Route::post('/data_peminjam/{id}/teguran', [DataPeminjamController::class, 'kirimTeguran'])
    ->name('admin.data_peminjam.teguran');
    Route::delete('/data_peminjam/{id}/batalkan-teguran', [DataPeminjamController::class, 'batalkanTeguran'])
    ->name('admin.data_peminjam.batalkan-teguran');
        
    // Media Buku Routes
    Route::get('/media-buku', [MediaBukuController::class, 'index'])->name('media.index');
    Route::delete('/media-buku/{id}', [MediaBukuController::class, 'destroy'])
    ->name('media.destroy');

     
    Route::get('/cms', [CmsController::class, 'index'])->name('cms.index');
    Route::post('/cms/upload', [CmsController::class, 'upload'])->name('cms.upload');;
    Route::delete('/cms/delete', [CmsController::class, 'deleteLogo'])->name('cms.delete');
    
        //statistik peminjaman pengembalian
        Route::get('/statistik-peminjaman', [DashboardController::class, 'Statistik'])
            ->name('statistik.peminjaman');
});


// Super Admin
Route::prefix('superadmin')->name('superadmin.')->middleware(['admin.auth', 'super.admin'])->group(function () {
    Route::get('/dashboard', [DashboardSuperAdminController::class, 'index'])->name('dashboard');
    
    Route::resource('/data_peminjam', SuperAdminPeminjamController::class)->names('data_peminjam');
    Route::resource('/akun_admin', SuperAdminAkunAdminController::class)->names('akun_admin');
    Route::resource('/data_buku', SuperAdminDataBukuController::class)->names('data_buku');
    Route::resource('/media_buku', SuperAdminMediaBukuController::class)->names('media_buku');
    
});



Route::middleware([App\Http\Middleware\UserMiddleware::class])->group(function () {
    Route::get('/test-auth-2', function() {
        return [
            'logged_in_web' => Auth::guard('web')->check(),
            'user_web' => Auth::guard('web')->user(),
            'session_id' => session()->getId(),
        ];
    });
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