@extends('layouts.admin')

@section('title', 'Edit Biaya')

@section('content')
    <h1>Edit Biaya</h1>

    <form action="{{ route('biaya.update', $biaya->id_biaya) }}" method="POST" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Kategori *</label><br>
            <select name="kategori" required style="width: 100%; padding: 8px;">
                <option value="">-- Pilih Kategori --</option>
                <option value="PPDB" {{ $biaya->kategori == 'PPDB' ? 'selected' : '' }}>PPDB</option>
                <option value="SPP" {{ $biaya->kategori == 'SPP' ? 'selected' : '' }}>SPP</option>
                <option value="DAFTAR ULANG" {{ $biaya->kategori == 'DAFTAR ULANG' ? 'selected' : '' }}>DAFTAR ULANG</option>
            </select>
            @error('kategori')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Tahun Ajaran *</label><br>
            <input type="text" name="tahun" value="{{ $biaya->tahun }}" required style="width: 100%; padding: 8px;">
            @error('tahun')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Kelas (Opsional, untuk SPP)</label><br>
            <input type="text" name="kelas" value="{{ $biaya->kelas }}" placeholder="Contoh: 10, 11, 12" style="width: 100%; padding: 8px;">
            @error('kelas')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label>Biaya (Rp) *</label><br>
            <input type="number" name="biaya" value="{{ $biaya->biaya }}" required style="width: 100%; padding: 8px;">
            @error('biaya')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: blue; color: white; border: none; cursor: pointer;">Update</button>
        <a href="{{ route('biaya.index') }}" style="padding: 10px 20px; background-color: gray; color: white; text-decoration: none; display: inline-block;">Kembali</a>
    </form>
@endsection
