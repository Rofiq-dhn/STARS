{{-- Extend dari layout admin --}}
@extends('layouts.admin')

{{-- Set title halaman --}}
@section('title', 'Data Pembayaran')

{{-- Mulai section content --}}
@section('content')
    {{-- Heading halaman --}}
    <h1>Data Pembayaran</h1>
    <p style="color: #666; margin-bottom: 20px;">Verifikasi pembayaran yang diupload oleh siswa</p>

    {{-- Card Table Pembayaran --}}
    <div style="background: white; padding: 20px; border-radius: 8px;">
        {{-- Table daftar pembayaran --}}
        <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
            <thead>
                {{-- Header tabel --}}
                <tr style="background-color: #333; color: white;">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kategori</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop semua data pembayaran --}}
                {{-- @forelse = foreach dengan fallback kalau kosong --}}
                @forelse ($pembayaran as $item)
                    <tr>
                        {{-- Nomor urut otomatis --}}
                        {{-- $loop->iteration = counter otomatis Laravel --}}
                        <td>{{ $loop->iteration }}</td>

                        {{-- Tanggal pembayaran --}}
                        {{-- $item->created_at = timestamp Laravel (Carbon) --}}
                        {{-- ->format('d/m/Y H:i') = format jadi DD/MM/YYYY HH:MM --}}
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>

                        {{-- Nama siswa dari relasi --}}
                        {{-- $item->siswa = relasi ke tabel siswas (dari ->with('siswa')) --}}
                        {{-- ->nama = ambil field nama dari tabel siswas --}}
                        <td>{{ $item->siswa->nama }}</td>

                        {{-- NIS siswa --}}
                        <td>{{ $item->siswa->nis }}</td>

                        {{-- Kategori biaya dari relasi --}}
                        {{-- $item->biaya->kategori = ambil kategori dari relasi biaya --}}
                        <td>{{ $item->biaya->kategori }}</td>

                        {{-- Bulan pembayaran --}}
                        <td>{{ $item->bulan }}</td>

                        {{-- Tahun pembayaran --}}
                        <td>{{ $item->tahun }}</td>

                        {{-- Nominal yang dibayar dengan format Rupiah --}}
                        <td>Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}</td>

                        {{-- Status dengan warna berbeda --}}
                        <td>
                            {{-- Conditional styling berdasarkan status --}}
                            {{-- Ternary operator: kondisi ? nilai_jika_true : nilai_jika_false --}}
                            <span
                                style="
                                padding: 5px 10px;
                                border-radius: 5px;
                                color: white;
                                background-color: {{ $item->status == 'lunas' ? '#4caf50' : '#ff9800' }};
                            ">
                                {{-- Tampilkan status --}}
                                {{-- ucfirst() = uppercase karakter pertama --}}
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        {{-- Kolom aksi --}}
                        <td style="text-align: center;">
                            {{-- Tombol Lihat Detail --}}
                            {{-- route('pembayaran.show', $item->id_pembayaran) = generate URL dengan parameter ID --}}
                            <a href="{{ route('pembayaran.show', $item->id_pembayaran) }}"
                                style="padding: 6px 12px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 3px; display: inline-block; margin-bottom: 5px;">
                                👁️ Detail
                            </a>

                            {{-- Tombol Verifikasi (hanya tampil kalau status belum lunas) --}}
                            {{-- @if = conditional directive Laravel --}}
                            @if ($item->status == 'belum lunas')
                                <br>

                                {{-- Form verifikasi --}}
                                <form action="{{ route('pembayaran.verifikasi', $item->id_pembayaran) }}" method="POST"
                                    style="display: inline;">
                                    {{-- Token CSRF untuk keamanan --}}
                                    @csrf

                                    {{-- Spoofing method jadi PUT --}}
                                    @method('PUT')

                                    {{-- Tombol submit verifikasi --}}
                                    <button type="submit"
                                        onclick="return confirm('Verifikasi pembayaran ini sebagai LUNAS?')"
                                        style="padding: 6px 12px; background-color: #4caf50; color: white; border: none; border-radius: 3px; cursor: pointer;">
                                        ✅ Verifikasi
                                    </button>
                                </form>

                                {{-- Form tolak --}}
                                <form action="{{ route('pembayaran.tolak', $item->id_pembayaran) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Tolak pembayaran ini? Data akan dihapus!')"
                                        style="padding: 6px 12px; background-color: #f44336; color: white; border: none; border-radius: 3px; cursor: pointer;">
                                        ❌ Tolak
                                    </button>
                                </form>
                            @endif
                            {{-- Akhir conditional --}}
                        </td>
                    </tr>
                @empty
                    {{-- Tampil kalau data kosong --}}
                    <tr>
                        {{-- colspan="10" = cell ini span 10 kolom --}}
                        <td colspan="10" style="text-align: center; padding: 40px; color: #999;">
                            Belum ada pembayaran yang masuk.
                        </td>
                    </tr>
                @endforelse
                {{-- Akhir loop --}}
            </tbody>
        </table>
    </div>
@endsection
{{-- Akhir section content --}}
