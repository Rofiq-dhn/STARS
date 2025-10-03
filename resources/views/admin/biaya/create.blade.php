@extends('layouts.admin')

@section('title', 'Tambah Biaya')

@section('content')
    <h1>Tambah Biaya</h1>

    <div>
        <form action="{{ route('biaya.store') }}" method="POST">
            @csrf

            <div>
                <label for="biaya">Biaya:</label>
                <input type="number" id="biaya" name="biaya" required>
            </div>

            <div>
                <label for="kategori">Kategori:</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="PPDB">PPDB</option>
                    <option value="SPP">SPP</option>
                    <option value="DAFTAR ULANG">DAFTAR ULANG</option>
                </select>
            </div>

            <div>
                <label for="tahun">Tahun:</label>
                <input type="text" id="tahun" name="tahun" required>
            </div>

            <div>
                <label for="kelas">Kelas:</label>
                <input type="text" id="kelas" name="kelas">
            </div>

            <div >
                <button type="submit"> Simpan</button>
                <a href="{{ route('biaya.index') }}" > Kembali </a>
            </div>
        </form>
    </div>
@endsection
