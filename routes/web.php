<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\KayitController;

Route::get('/', function () {
    return view('anasayfa');
});



Route::middleware('auth')->get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});



Route::post('/kayit-gonder', [KayitController::class, 'gonder'])->name('kayit.gonder');

