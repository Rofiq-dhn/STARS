<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;

// ============================================
// PUBLIC ROUTES (Tidak Perlu Login)
// ============================================

/**
 * Route untuk menampilkan halaman login
 * Method: GET
 * URL: /login
 */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

/**
 * Route untuk memproses login (submit form)
 * Method: POST
 * URL: /login
 */
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// ============================================
// PROTECTED ROUTES (Harus Login Dulu)
// ============================================

// middleware(['auth']) = semua route di dalam harus sudah login
// Kalau belum login, otomatis redirect ke /login
Route::middleware(['auth'])->group(function () {

    /**
     * Route untuk logout
     * Method: POST (untuk keamanan CSRF)
     * URL: /logout
     */
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /**
     * Route root (/)
     * Redirect otomatis berdasarkan role user yang login
     * - Admin → admin/dashboard
     * - Siswa → siswa/dashboard
     */
    Route::get('/', function () {
        // Auth::user() = ambil data user yang sedang login
        // isAdmin() = method helper di Model User untuk cek role
        if (Auth::user()->isAdmin()) {
            // redirect()->route() = redirect ke route berdasarkan nama route
            return redirect()->route('admin.dashboard');
        }

        // Kalau bukan admin, pasti siswa
        return redirect()->route('siswa.dashboard');
    });

    // ============================================
    // ADMIN ROUTES
    // ============================================

    /**
     * Dashboard Admin
     * Method: GET
     * URL: /admin/dashboard
     */
    Route::get('/admin/dashboard', function () {
        // view() = load file blade dari resources/views/
        // 'admin.dashboard' = load file resources/views/admin/dashboard.blade.php
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // prefix('admin') = semua route di dalam group ini punya prefix /admin
    // Jadi /biaya jadi /admin/biaya
    Route::prefix('admin')->group(function () {

        // ============================================
        // CRUD BIAYA
        // ============================================

        /**
         * Route::resource() = generate 7 route CRUD sekaligus
         * - GET    /admin/biaya           → index()   (list semua data)
         * - GET    /admin/biaya/create    → create()  (form tambah)
         * - POST   /admin/biaya           → store()   (simpan data baru)
         * - GET    /admin/biaya/{id}      → show()    (detail 1 data)
         * - GET    /admin/biaya/{id}/edit → edit()    (form edit)
         * - PUT    /admin/biaya/{id}      → update()  (update data)
         * - DELETE /admin/biaya/{id}      → destroy() (hapus data)
         */
        Route::resource('biaya', BiayaController::class);

        // ============================================
        // MANAGEMENT PEMBAYARAN
        // ============================================

        /**
         * List semua pembayaran yang masuk
         * Method: GET
         * URL: /admin/pembayaran
         */
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

        /**
         * Detail satu pembayaran (untuk verifikasi)
         * Method: GET
         * URL: /admin/pembayaran/{id}
         * Parameter: {id} = id_pembayaran
         */
        Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');

        /**
         * Verifikasi pembayaran (ubah status jadi lunas + generate kwitansi PDF)
         * Method: PUT
         * URL: /admin/pembayaran/{id}/verifikasi
         * Parameter: {id} = id_pembayaran
         */
        Route::put('/pembayaran/{id}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');

        /**
         * Tolak pembayaran (hapus data + file bukti)
         * Method: DELETE
         * URL: /admin/pembayaran/{id}/tolak
         * Parameter: {id} = id_pembayaran
         */
        Route::delete('/pembayaran/{id}/tolak', [PembayaranController::class, 'tolak'])->name('pembayaran.tolak');
    });

    // ============================================
    // SISWA ROUTES
    // ============================================

    /**
     * Dashboard Siswa (Landing page setelah login)
     * Menampilkan 3 pilihan pembayaran: PPDB, SPP, Daftar Ulang
     * Method: GET
     * URL: /siswa/dashboard
     */
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');

    // ============================================
    // PEMBAYARAN PPDB
    // ============================================

    /**
     * Halaman pembayaran PPDB
     * Menampilkan form bayar + history pembayaran PPDB
     * Method: GET
     * URL: /siswa/ppdb
     */
    Route::get('/siswa/ppdb', [SiswaController::class, 'ppdb'])->name('siswa.ppdb');

    /**
     * Proses submit pembayaran PPDB
     * Method: POST
     * URL: /siswa/ppdb/store
     */
    Route::post('/siswa/ppdb/store', [SiswaController::class, 'storePPDBDaftarUlang'])->name('siswa.ppdb.store');

    // ============================================
    // PEMBAYARAN SPP
    // ============================================

    /**
     * Halaman pembayaran SPP
     * Menampilkan status per bulan + form bayar
     * Method: GET
     * URL: /siswa/spp
     */
    Route::get('/siswa/spp', [SiswaController::class, 'spp'])->name('siswa.spp');

    /**
     * Proses submit pembayaran SPP
     * Method: POST
     * URL: /siswa/spp/store
     */
    Route::post('/siswa/spp/store', [SiswaController::class, 'storeSPP'])->name('siswa.spp.store');

    // ============================================
    // PEMBAYARAN DAFTAR ULANG
    // ============================================

    /**
     * Halaman pembayaran Daftar Ulang
     * Menampilkan form bayar + history pembayaran Daftar Ulang
     * Method: GET
     * URL: /siswa/daftar-ulang
     */
    Route::get('/siswa/daftar-ulang', [SiswaController::class, 'daftarUlang'])->name('siswa.daftar-ulang');

    /**
     * Proses submit pembayaran Daftar Ulang
     * Method: POST
     * URL: /siswa/daftar-ulang/store
     */
    Route::post('/siswa/daftar-ulang/store', [SiswaController::class, 'storePPDBDaftarUlang'])->name('siswa.daftar-ulang.store');

    // ============================================
    // DOWNLOAD KWITANSI
    // ============================================

    /**
     * Download kwitansi PDF
     * Bisa diakses oleh siswa setelah pembayaran diverifikasi admin
     * Method: GET
     * URL: /siswa/kwitansi/{id}
     * Parameter: {id} = id_pembayaran
     */
    Route::get('/siswa/kwitansi/{id}', [PembayaranController::class, 'downloadKwitansi'])->name('pembayaran.download-kwitansi');

});

Route::get('/test-upload', function() {
    try {
        // Buat file dummy
        $content = 'Test upload file';
        $filename = 'test_' . time() . '.txt';

        // Simpan dengan Storage facade
        Storage::disk('public')->put('bukti_pembayaran/' . $filename, $content);

        // Cek hasil
        $path = storage_path('app/public/bukti_pembayaran/' . $filename);

        return [
            'status' => 'success',
            'filename' => $filename,
            'path' => $path,
            'file_exists' => file_exists($path),
            'file_size' => file_exists($path) ? filesize($path) : 0,
            'folder_writable' => is_writable(storage_path('app/public/bukti_pembayaran')),
            'folder_path' => storage_path('app/public/bukti_pembayaran'),
        ];
    } catch (\Exception $e) {
        return [
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ];
    }
});
