@extends('layouts.admin')

@section('title', 'Tambah Biaya')

@section('content')
@vite(['resources/css/admin/tagihan-form.css'])

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
                <label class="form-label">Kelas(Hanya Untuk SPP):</label>
                <input
                    type="text"
                    name="kelas"
                    class="form-input"
                    value="{{ old('kelas') }}"
                    placeholder="Kelas..."
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

<script>
    // Tampilkan alert jika ada session success
    @if(session('success'))
        showSuccessAlert('{{ session('success') }}');
    @endif

    // Tampilkan alert jika ada session error
    @if(session('error'))
        showErrorAlert('{{ session('error') }}');
    @endif
</script>
@endsection
