<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\password;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\DataPenggunaController;
use App\Http\Controllers\Admin\DataBukuController;
use App\Http\Controllers\Admin\DataArsipController;
use App\Http\Controllers\Admin\DataPeminjamController;
use App\Http\Controllers\Admin\DataDendaController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('landingpage');
});

// User routes - gunakan class langsung
Route::middleware(['auth', UserMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin routes - gunakan class langsung
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
     // Route resource favorit yang disederhanakan
     Route::resource('/admin/data_buku', DataBukuController::class)->names('admin.data_buku');
     Route::get('/admin/data_buku/template', [DataBukuController::class, 'downloadTemplate'])->name('admin.data_buku.template');
     Route::post('/admin/data_buku/import', [DataBukuController::class, 'import'])->name('admin.data_buku.import');
    Route::resource('/admin/data_arsip', DataArsipController::class)->names('admin.data_arsip');
    Route::resource('/admin/data_pengguna', DataPenggunaController::class)->names('admin.data_pengguna');
    Route::resource('/admin/data_peminjam', DataPeminjamController::class)->names('admin.data_peminjam');
    Route::resource('/admin/data_denda', DataDendaController::class)->names('admin.data_denda');
});

// Fallback untuk redirect berdasarkan user type
Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->user_type === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
    return redirect()->route('login');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

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

    // Update/google_id dan token (baik user baru maupun existing)
    $user->update([
        'google_id' => $googleUser->id,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);
    return redirect('/dashboard');
});



// Auth routes (dari breeze) - letakkan di atas
require __DIR__.'/auth.php';