@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <h1>Dashboard Siswa</h1>

    {{-- Card Info Siswa --}}
    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h2>Selamat Datang, {{ $siswa->nama }}! 👋</h2>
        <p>NIS: {{ $siswa->nis }}</p>
        <p>Kelas: {{ $siswa->kelas_siswa }}</p>
        <p>Jurusan: {{ $siswa->jurusan }}</p>
        <p>Angkatan: {{ $siswa->angkatan }}</p>
    </div>

    {{-- Card Ringkasan --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        <div style="background: #ffebee; padding: 20px; border-radius: 8px; border-left: 4px solid #f44336;">
            <h3 style="margin-bottom: 10px; color: #c62828;">Total Tagihan Belum Lunas</h3>
            <p style="font-size: 24px; font-weight: bold; color: #c62828;">
                Rp {{ number_format($totalTagihan, 0, ',', '.') }}
            </p>
        </div>

        <div style="background: #e8f5e9; padding: 20px; border-radius: 8px; border-left: 4px solid #4caf50;">
            <h3 style="margin-bottom: 10px; color: #2e7d32;">Total Sudah Dibayar</h3>
            <p style="font-size: 24px; font-weight: bold; color: #2e7d32;">
                Rp {{ number_format($totalBayar, 0, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Daftar Tagihan --}}
    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h2>Daftar Tagihan</h2>

        <table border="1" cellpadding="10" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #333; color: white;">
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Kelas</th>
                    <th>Biaya</th>
                    <th>Aksi</th> {{-- TAMBAH KOLOM AKSI --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($tagihan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->kelas ?? '-' }}</td>
                        <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>

                        {{-- TAMBAH TOMBOL BAYAR --}}
                        <td style="text-align: center;">
                            {{-- Link ke form bayar --}}
                            {{-- route('siswa.bayar.form', $item->id_biaya) = generate URL dengan parameter ID biaya --}}
                            <a
                                href="{{ route('siswa.bayar.form', $item->id_biaya) }}"
                                style="padding: 8px 16px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 5px; display: inline-block;"
                            >
                                💳 Bayar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada tagihan.</td> {{-- UBAH COLSPAN JADI 6 --}}
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Riwayat Pembayaran --}}
<div style="background: white; padding: 20px; border-radius: 8px;">
    <h2>Riwayat Pembayaran</h2>

    <table border="1" cellpadding="10" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #333; color: white;">
                <th>No</th>
                <th>Kategori</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Nominal Dibayar</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Tanggal Bayar</th>
                <th>Aksi</th> {{-- TAMBAH KOLOM AKSI --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->biaya->kategori }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>
                    <td>
                        <span style="
                            padding: 5px 10px;
                            border-radius: 5px;
                            color: white;
                            background-color: {{ $item->status == 'lunas' ? '#4caf50' : '#f44336' }};
                        ">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>

                    {{-- TAMBAH TOMBOL DOWNLOAD KWITANSI --}}
                    <td style="text-align: center;">
                        {{-- Cek apakah kwitansi sudah ada (sudah diverifikasi admin) --}}
                        @if($item->kwitansi)
                            {{-- Tampilkan tombol download --}}
                            <a
                                href="{{ route('pembayaran.download-kwitansi', $item->id_pembayaran) }}"
                                style="padding: 6px 12px; background-color: #4caf50; color: white; text-decoration: none; border-radius: 3px; display: inline-block;"
                            >
                                📥 Download
                            </a>
                        @else
                            {{-- Kalau belum ada kwitansi, tampilkan status menunggu --}}
                            <span style="color: #ff9800; font-size: 12px;">
                                ⏳ Menunggu Verifikasi
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Belum ada riwayat pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
