@extends('layouts.admin')

@section('title', 'Tambah Biaya')

@section('content')
<style>
    .container-tagihan {
        padding: 20px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        max-width: 630px;
        margin: 0 auto;
    }

    .header-tagihan {
        margin-bottom: 30px;
    }

    .header-tagihan h1 {
        font-size: 32px;
        font-weight: bold;
        margin: 0;
        text-align: left;
        color: #333;
    }

    .header-tagihan p {
        color: #666;
        margin: 5px 0 0 0;
        font-size: 14px;
    }

    .card-form {
        background: white;
        border-radius: 8px;
        padding: 30px;
        max-width: 600px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
        margin: 0 0 25px 0;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group:last-of-type {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box;
        font-family: inherit;
        transition: border-color 0.2s;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: #dc3545;
    }

    .form-select {
        background: white;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 35px;
    }

    .form-input::placeholder {
        color: #999;
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }

    .button-group {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn {
        padding: 10px 24px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        border: none;
        transition: all 0.2s;
    }

    .btn-back {
        background: white;
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    .btn-back:hover {
        background: #fff5f5;
    }

    .btn-submit {
        background: #dc3545;
        color: white;
        border: 1px solid #dc3545;
    }

    .btn-submit:hover {
        background: #c82333;
        border-color: #c82333;
    }
</style>

<div class="container-tagihan">
    <div class="header-tagihan">
        <h1>Tagihan</h1>
        <p>Tambah Data Tagihan</p>
    </div>

    <div class="card-form">
        <h2 class="card-title">Tambah Biaya</h2>

        <form action="{{ route('biaya.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Biaya:</label>
                <input
                    type="number"
                    name="biaya"
                    class="form-input"
                    value="{{ old('biaya') }}"
                    placeholder="Biaya..."
                    required
                >
                @error('biaya')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Kategori:</label>
                <select name="kategori" class="form-select" required>
                    <option value="">☰ Pilih Kategori...</option>
                    <option value="PPDB" {{ old('kategori') == 'PPDB' ? 'selected' : '' }}>PPDB</option>
                    <option value="SPP" {{ old('kategori') == 'SPP' ? 'selected' : '' }}>SPP</option>
                    <option value="DAFTAR ULANG" {{ old('kategori') == 'DAFTAR ULANG' ? 'selected' : '' }}>DAFTAR ULANG</option>
                </select>
                @error('kategori')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Tahun:</label>
                <input
                    type="text"
                    name="tahun"
                    class="form-input"
                    value="{{ old('tahun') }}"
                    placeholder="Tahun..."
                    required
                >
                @error('tahun')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Kelas:</label>
                <input
                    type="text"
                    name="kelas"
                    class="form-input"
                    value="{{ old('kelas') }}"
                    placeholder="Kelas(Opsional jika PPDB)..."
                >
                @error('kelas')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="button-group">
                <a href="{{ route('biaya.index') }}" class="btn btn-back">
                    Kembali
                </a>
                <button type="submit" class="btn btn-submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
