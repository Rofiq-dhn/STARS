@extends('layouts.admin')

@section('title', 'Data Biaya')

@section('content')
    <h1>Data Biaya</h1>

    <a href="{{ route('biaya.create') }}">+ Tambah Biaya</a>

    <table border="1" cellpadding="10" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #333; color: white;">
                <th>No</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Kelas</th>
                <th>Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($biaya as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->kelas ?? '-' }}</td>
                    <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('biaya.edit', $item->id_biaya) }}">Edit</a>
                        |
                        <form action="{{ route('biaya.destroy', $item->id_biaya) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data biaya.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
