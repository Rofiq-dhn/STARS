@extends('layouts.admin')

@section('title', 'Data Biaya')

@section('content')
    <h1>Data Biaya</h1>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('biaya.create') }}"
            style="background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
            + Tambah Biaya
        </a>
    </div>

    <div
        style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow-x: auto;">
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #34495e; color: white;">
                    <th style="padding: 12px; text-align: left;">No</th>
                    <th style="padding: 12px; text-align: left;">Biaya</th>
                    <th style="padding: 12px; text-align: left;">Kategori</th>
                    <th style="padding: 12px; text-align: left;">Tahun</th>
                    <th style="padding: 12px; text-align: left;">Kelas</th>
                    <th style="padding: 12px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($biaya as $s)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 12px;">{{ $loop->iteration }}</td>
                        <td style="padding: 12px;">Rp {{ number_format($s->biaya, 0, ',', '.') }}</td>
                        <td style="padding: 12px;">{{ $s->kategori }}</td>
                        <td style="padding: 12px;">{{ $s->tahun }}</td>
                        <td style="padding: 12px;">{{ $s->kelas ?? '-' }}</td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="{{ route('biaya.edit', $s->id_biaya) }}"
                                style="background-color: #f39c12; color: white; padding: 6px 12px; text-decoration: none; border-radius: 3px; margin-right: 5px;">
                                Edit
                            </a>
                            <form action="{{ route('biaya.destroy', $s->id_biaya) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin mau hapus data ini?')"
                                    style="background-color: #e74c3c; color: white; padding: 6px 12px; border: none; border-radius: 3px; cursor: pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
