@extends('layouts.admin')

@section('title', 'Data Biaya')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section class="tagihan-section">
        <div class="section-header">
            <h2>Data Biaya</h2>
            <a href="{{ route('biaya.create') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Tambah Biaya
            </a>
        </div>

        <div class="data-table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Biaya</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($biaya as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>Rp {{ number_format($s->biaya, 0, ',', '.') }}</td>
                            <td>{{ $s->kategori }}</td>
                            <td>{{ $s->tahun }}</td>
                            <td>{{ $s->kelas ?? '-' }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('biaya.edit', $s->id_biaya) }}" class="btn-edit">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>
                                <form action="{{ route('biaya.destroy', $s->id_biaya) }}" method="POST"
                                    style="display:inline;">  
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="showCustomAlert('Yakin Ingin Hapus Data?', function() {
                                    // Aksi yang dijalankan saat klik 'Hapus'
                                    document.getElementById('delete-form-1').submit();
                                    })" class="btn-delete">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
</body>
</html>
