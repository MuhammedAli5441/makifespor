<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TakimController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\KayitController;

Route::get('/', function () {
    return view('anasayfa');
})->name('anasayfa');



Route::middleware('auth')->get('/adminanasayfa', [TakimController::class, 'index'])->name('admin.anasayfa');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});



Route::post('/kayit-gonder', [KayitController::class, 'gonder'])->name('kayit.gonder');

 Route::resource('takimlar',TakimController::class);
