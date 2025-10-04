@extends('layouts.admin')

@section('title', 'Tambah Biaya')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Tagihan - Admin Sekolah</title>
        @vite(['resources/js/app.js'])
    </head>

    <body>
        <div class="container">
            <!-- Main Content -->
            <main class="main-content">
                <!-- Alert Banner -->
                <div class="alert-banner">
                    <div class="alert-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </div>
                    <div class="alert-content">
                        <strong>STARS</strong>
                        <p>Sistem Tagihan Dan Pembayaran Sekolah</p>
                    </div>
                </div>

                <!-- Content Section -->
                <section class="content-section">
                    <div class="page-header">
                        <h2>Tagihan</h2>
                        <p class="breadcrumb">Tambah Data Tagihan</p>
                    </div>

                    <!-- Form Container -->
                    <div class="form-container">
                        <div class="form-header">
                            <h3>Tambah Biaya</h3>
                            <a href="{{ route('biaya.index') }}" class="btn-back">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <line x1="19" y1="12" x2="5" y2="12" />
                                    <polyline points="12 19 5 12 12 5" />
                                </svg>
                                Kembali
                            </a>
                        </div>

                        <form action="{{ route('biaya.store') }}" method="POST" class="form-biaya">
                            @csrf
                            <!-- Biaya Field -->
                            <div class="form-group">
                                <label for="biaya">Biaya:</label>
                                <input type="number" id="biaya" name="biaya" placeholder="Masukkan nominal biaya..."
                                    class="form-input" required>
                            </div>

                            <!-- Kategori Field -->
                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <div class="select-wrapper">
                                    <select id="kategori" name="kategori" class="form-select" required>
                                        <option value="">Pilih Kategori..</option>
                                        <option value="PPDB">PPDB</option>
                                        <option value="SPP">SPP</option>
                                        <option value="DAFTAR ULANG">Daftar Ulang</option>
                                    </select>
                                    <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Tahun Field -->
                            <div class="form-group">
                                <label for="tahun">Tahun:</label>
                                <input type="text" id="tahun" name="tahun" placeholder="Masukkan tahun..."
                                    class="form-input" required>
                            </div>

                            <!-- Kelas Field -->
                            <div class="form-group">
                                <label for="kelas">Kelas:</label>
                                <input type="text" id="kelas" name="kelas"
                                    placeholder="Masukkan kelas (opsional)..." class="form-input">
                            </div>

                            <!-- Submit Button -->
                            <div class="form-actions">
                                <button type="submit" class="btn-submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </body>

    </html>
@endsection
