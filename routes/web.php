<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaketLayananController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\IsAdmin;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('paket', PaketLayananController::class);
    Route::resource('portofolio', PortofolioController::class);
    Route::resource('pemesanan', PemesananController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('booking', BookingController::class)->only(['index', 'create', 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
