@extends('layouts.admin')

@section('title', 'Edit Biaya')

@section('content')
    <h1>Edit Biaya</h1>

    <div>
        <a href="{{ route('biaya.index') }}"> Kembali </a>
    </div>
    <div>
        <form action="{{ route('biaya.update', $biaya->id_biaya) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="biaya">Biaya:</label>
                <input type="number" id="biaya" name="biaya" value="{{ $biaya->biaya }}" required>
            </div>
            <h1>hello world</h1>
            <div>
                <label for="kategori">Kategori:</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="PPDB" {{ $biaya->kategori == 'PPDB' ? 'selected' : '' }}>PPDB</option>
                    <option value="SPP" {{ $biaya->kategori == 'SPP' ? 'selected' : '' }}>SPP</option>
                    <option value="DAFTAR ULANG" {{ $biaya->kategori == 'DAFTAR ULANG' ? 'selected' : '' }}>DAFTAR ULANG
                    </option>
                </select>
            </div>

            <div>
                <label for="tahun">Tahun:</label>
                <input type="text" id="tahun" name="tahun" value="{{ $biaya->tahun }}" required>
            </div>

            <div>
                <label for="kelas">Kelas:</label>
                <input type="text" id="kelas" name="kelas" value="{{ $biaya->kelas }}"
                    placeholder="Kosongkan jika PPDB/Daftar Ulang">
            </div>

            <div>
                <button type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
