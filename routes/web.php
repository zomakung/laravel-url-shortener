<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!auth()->check()) {
        return view('welcome');
    }
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/shorten', [App\Http\Controllers\ShortUrlController::class, 'store'])->name('shorten');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/overview', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.overview');
    Route::get('/urls', [App\Http\Controllers\AdminController::class, 'urls'])->name('admin.urls');
    Route::delete('/urls/{shortUrl}', [App\Http\Controllers\AdminController::class, 'destroy_urls'])->name('admin.urls.destroy');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
});

require __DIR__.'/auth.php';

Route::get('/{shortCode}', [App\Http\Controllers\ShortUrlController::class, 'redirect'])->where('shortCode', '[A-Za-z0-9]+');