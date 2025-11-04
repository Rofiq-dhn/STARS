<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\SiswaController;  // Import SiswaController

// Route homepage - redirect ke dashboard admin (sementara)
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Route dashboard admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// CRUD Biaya (untuk admin)
Route::prefix('admin')->group(function () {
    Route::resource('biaya', BiayaController::class);
});

// Route untuk siswa
// Route::get() = route dengan method GET
// '/siswa/dashboard' = URL yang diakses
// [SiswaController::class, 'dashboard'] = panggil method dashboard dari SiswaController
// ->name('siswa.dashboard') = kasih nama route untuk dipanggil dengan route()
Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
