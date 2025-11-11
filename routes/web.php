<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
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

// -----------------------------------------------------------------------------
// Public Routes
// -----------------------------------------------------------------------------
Route::get('/', function () {
    return view('landingpage');
});

// -----------------------------------------------------------------------------
// Authentication Routes (Laravel Breeze)
// -----------------------------------------------------------------------------
require __DIR__ . '/auth.php';

// -----------------------------------------------------------------------------
// Google OAuth Routes
// -----------------------------------------------------------------------------
Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('email', $googleUser->email)->first();

    if (!$user) {
        // Jika user belum ada, buat baru
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => Hash::make(Str::random(24)),
        ]);
    }

    // Update google_id dan token
    $user->update([
        'google_id' => $googleUser->id,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);
    return redirect('/dashboard');
})->name('google.callback');

// -----------------------------------------------------------------------------
// Authenticated Routes
// -----------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout Dashboard User
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// -----------------------------------------------------------------------------
// User Routes
// -----------------------------------------------------------------------------
Route::middleware(['auth:web', UserMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// -----------------------------------------------------------------------------
// Admin Routes
// -----------------------------------------------------------------------------
Route::middleware(['auth:admin', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // --- Data Buku ---
        Route::resource('data_buku', DataBukuController::class);
        Route::post('/data_buku/bulk-delete', [DataBukuController::class, 'bulkDelete'])
            ->name('data_buku.bulk-delete');

        // --- Data Kategori ---
        Route::resource('data_kategori', DataKategoriController::class);
        Route::post('/data_kategori/bulk-delete', [DataKategoriController::class, 'bulkDelete'])
            ->name('data_kategori.bulk-delete');

        // --- Data Arsip ---
        Route::resource('data_arsip', DataArsipController::class);
        Route::post('/data_arsip/bulk-delete', [DataArsipController::class, 'bulkDelete'])
            ->name('data_arsip.bulk-delete');

        // --- Data Pengguna ---
        Route::resource('data_pengguna', DataPenggunaController::class);
        Route::post('/data_pengguna/bulk-delete', [DataPenggunaController::class, 'bulkDelete'])
            ->name('data_pengguna.bulk-delete');

        // --- Data Peminjam ---
        Route::resource('data_peminjam', DataPeminjamController::class);
        Route::post('/data_peminjam/bulk-delete', [DataPeminjamController::class, 'bulkDelete'])
            ->name('data_peminjam.bulk-delete');

        // --- Data Denda ---
        Route::resource('data_denda', DataDendaController::class);
        Route::post('/data_denda/bulk-delete', [DataDendaController::class, 'bulkDelete'])
            ->name('data_denda.bulk-delete');
    });

// -----------------------------------------------------------------------------
// Admin Authentication Routes
// -----------------------------------------------------------------------------
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Reset password admin
Route::get('/admin/password/reset', [AdminController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('/admin/password/email', [AdminController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/admin/password/reset/{token}', [AdminController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('/admin/password/reset', [AdminController::class, 'reset'])->name('admin.password.update');

// -----------------------------------------------------------------------------
// End of File
// -----------------------------------------------------------------------------
