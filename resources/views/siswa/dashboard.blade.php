{{-- Extend dari layout siswa (nanti kita buat) --}}
@extends('layouts.siswa')

{{-- Set title halaman --}}
@section('title', 'Dashboard Siswa')

{{-- Mulai section content --}}
@section('content')
    {{-- Heading halaman --}}
    <h1>Dashboard Siswa</h1>

    {{-- Card Info Siswa --}}
    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        {{-- Tampilkan nama siswa --}}
        {{-- $siswa->nama = ambil field nama dari variabel $siswa yang dikirim controller --}}
        <h2>Selamat Datang, {{ $siswa->nama }}! 👋</h2>

        {{-- Tampilkan info siswa --}}
        <p>NIS: {{ $siswa->nis }}</p>              {{-- Tampilkan NIS siswa --}}
        <p>Kelas: {{ $siswa->kelas_siswa }}</p>    {{-- Tampilkan kelas siswa --}}
        <p>Jurusan: {{ $siswa->jurusan }}</p>      {{-- Tampilkan jurusan siswa --}}
        <p>Angkatan: {{ $siswa->angkatan }}</p>    {{-- Tampilkan angkatan siswa --}}
    </div>

    {{-- Card Ringkasan Pembayaran --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        {{-- Card Total Tagihan Belum Lunas --}}
        <div style="background: #ffebee; padding: 20px; border-radius: 8px; border-left: 4px solid #f44336;">
            {{-- Judul card --}}
            <h3 style="margin-bottom: 10px; color: #c62828;">Total Tagihan Belum Lunas</h3>

            {{-- Tampilkan total tagihan dengan format Rupiah --}}
            {{-- number_format() untuk format angka jadi format Rupiah --}}
            {{-- Parameter: (angka, jumlah desimal, pemisah desimal, pemisah ribuan) --}}
            <p style="font-size: 24px; font-weight: bold; color: #c62828;">
                Rp {{ number_format($totalTagihan, 0, ',', '.') }}
            </p>
        </div>

        {{-- Card Total Sudah Dibayar --}}
        <div style="background: #e8f5e9; padding: 20px; border-radius: 8px; border-left: 4px solid #4caf50;">
            <h3 style="margin-bottom: 10px; color: #2e7d32;">Total Sudah Dibayar</h3>
            <p style="font-size: 24px; font-weight: bold; color: #2e7d32;">
                Rp {{ number_format($totalBayar, 0, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Section Daftar Tagihan --}}
    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h2>Daftar Tagihan</h2>

        {{-- Table tagihan --}}
        <table border="1" cellpadding="10" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
            <thead>
                {{-- Header tabel --}}
                <tr style="background-color: #333; color: white;">
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Kelas</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop semua data tagihan --}}
                {{-- @forelse = foreach dengan fallback kalau data kosong --}}
                @forelse ($tagihan as $item)
                    <tr>
                        {{-- Nomor urut otomatis --}}
                        {{-- $loop->iteration = counter otomatis dari Laravel (1, 2, 3, ...) --}}
                        <td>{{ $loop->iteration }}</td>

                        {{-- Tampilkan kategori tagihan --}}
                        <td>{{ $item->kategori }}</td>

                        {{-- Tampilkan tahun ajaran --}}
                        <td>{{ $item->tahun }}</td>

                        {{-- Tampilkan kelas, kalau NULL tampilkan "-" --}}
                        {{-- ?? = null coalescing operator, kalau kiri NULL pakai kanan --}}
                        <td>{{ $item->kelas ?? '-' }}</td>

                        {{-- Tampilkan biaya dengan format Rupiah --}}
                        <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    {{-- Tampil kalau data tagihan kosong --}}
                    <tr>
                        {{-- colspan="5" = cell ini span 5 kolom --}}
                        <td colspan="5" style="text-align: center;">Tidak ada tagihan.</td>
                    </tr>
                @endforelse
                {{-- Akhir loop --}}
            </tbody>
        </table>
    </div>

    {{-- Section Riwayat Pembayaran --}}
    <div style="background: white; padding: 20px; border-radius: 8px;">
        <h2>Riwayat Pembayaran</h2>

        {{-- Table riwayat pembayaran --}}
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
                </tr>
            </thead>
            <tbody>
                {{-- Loop semua riwayat pembayaran --}}
                @forelse ($riwayat as $item)
                    <tr>
                        {{-- Nomor urut --}}
                        <td>{{ $loop->iteration }}</td>

                        {{-- Tampilkan kategori dari relasi biaya --}}
                        {{-- $item->biaya = relasi ke tabel biayas (dari ->with('biaya') di controller) --}}
                        {{-- ->kategori = ambil field kategori dari tabel biayas --}}
                        <td>{{ $item->biaya->kategori }}</td>

                        {{-- Tampilkan bulan pembayaran --}}
                        <td>{{ $item->bulan }}</td>

                        {{-- Tampilkan tahun pembayaran --}}
                        <td>{{ $item->tahun }}</td>

                        {{-- Tampilkan nominal yang dibayar --}}
                        <td>Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}</td>

                        {{-- Tampilkan sisa pembayaran --}}
                        <td>Rp {{ number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>

                        {{-- Tampilkan status dengan warna berbeda --}}
                        <td>
                            {{-- Kondisional styling berdasarkan status --}}
                            {{-- Kalau lunas = hijau, kalau belum lunas = merah --}}
                            <span style="
                                padding: 5px 10px;
                                border-radius: 5px;
                                color: white;
                                background-color: {{ $item->status == 'lunas' ? '#4caf50' : '#f44336' }};
                            ">
                                {{-- Tampilkan teks status --}}
                                {{ $item->status }}
                            </span>
                        </td>

                        {{-- Tampilkan tanggal pembayaran --}}
                        {{-- $item->created_at = timestamp Laravel (Carbon) --}}
                        {{-- ->format('d/m/Y') = format jadi DD/MM/YYYY --}}
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    {{-- Tampil kalau belum ada riwayat pembayaran --}}
                    <tr>
                        <td colspan="8" style="text-align: center;">Belum ada riwayat pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
{{-- Akhir section content --}}
