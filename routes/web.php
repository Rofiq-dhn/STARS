<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;  // IMPORT CONTROLLER BARU

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Route Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::prefix('admin')->group(function () {
    // CRUD Biaya
    Route::resource('biaya', BiayaController::class);

    // Data Pembayaran - ROUTE BARU
    // Route::get() untuk list pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // Route::get() untuk detail pembayaran
    // {id} = parameter dinamis (id_pembayaran)
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');

    // Route::put() untuk verifikasi pembayaran
    // Method PUT untuk update data
    Route::put('/pembayaran/{id}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');

    // Route::delete() untuk tolak pembayaran
    // Method DELETE untuk hapus data
    Route::delete('/pembayaran/{id}/tolak', [PembayaranController::class, 'tolak'])->name('pembayaran.tolak');
});

// Route Siswa
Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
Route::get('/siswa/bayar/{id_biaya}', [SiswaController::class, 'formBayar'])->name('siswa.bayar.form');
Route::post('/siswa/bayar', [SiswaController::class, 'storeBayar'])->name('siswa.bayar.store');

// ROUTE BARU: Download Kwitansi
// Route::get() dengan method GET
// Parameter {id} = id_pembayaran
Route::get('/siswa/kwitansi/{id}', [PembayaranController::class, 'downloadKwitansi'])->name('pembayaran.download-kwitansi');
