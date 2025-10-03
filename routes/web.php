<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiayaController;

// Redirect root ke dashboard admin
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// CRUD Biaya dengan prefix admin
Route::prefix('admin')->group(function () {
    Route::resource('biaya', BiayaController::class);
});
