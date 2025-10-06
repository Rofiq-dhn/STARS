@extends('layouts.admin')

@section('title', 'Edit Biaya')

@section('content')
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <!-- Content Section -->
            <section class="content-section">
                <div class="page-header">
                    <h2>Tagihan</h2>
                    <p class="breadcrumb">Edit Data Tagihan</p>
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h3>Edit Biaya</h3>
                        <a href="{{ route('biaya.index') }}" class="btn-back">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="19" y1="12" x2="5" y2="12" />
                                <polyline points="12 19 5 12 12 5" />
                            </svg>
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('biaya.update', $biaya->id_biaya) }}" method="POST" class="form-biaya">
                        @csrf
                        @method('PUT')

                        <!-- Biaya Field -->
                        <div class="form-group">
                            <label for="biaya">Biaya:</label>
                            <input type="number" id="biaya" name="biaya" value="{{ $biaya->biaya }}"
                                class="form-input" required>
                        </div>

                        <!-- Kategori Field -->
                        <div class="form-group">
                            <label for="kategori">Kategori:</label>
                            <div class="select-wrapper">
                                <select id="kategori" name="kategori" class="form-select" required>
                                    <option value="">Pilih Kategori..</option>
                                    <option value="PPDB" {{ $biaya->kategori == 'PPDB' ? 'selected' : '' }}>PPDB</option>
                                    <option value="SPP" {{ $biaya->kategori == 'SPP' ? 'selected' : '' }}>SPP</option>
                                    <option value="DAFTAR ULANG" {{ $biaya->kategori == 'DAFTAR ULANG' ? 'selected' : '' }}>
                                        Daftar Ulang</option>
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </div>
                        </div>

                        <!-- Tahun Field -->
                        <div class="form-group">
                            <label for="tahun">Tahun:</label>
                            <input type="text" id="tahun" name="tahun" value="{{ $biaya->tahun }}"
                                class="form-input" required>
                        </div>

                        <!-- Kelas Field -->
                        <div class="form-group">
                            <label for="kelas">Kelas:</label>
                            <input type="text" id="kelas" name="kelas" value="{{ $biaya->kelas }}"
                                placeholder="Kelas.." class="form-input">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Update</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
@endsection
