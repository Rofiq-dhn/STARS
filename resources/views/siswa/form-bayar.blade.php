{{-- Extend dari layout siswa --}}
@extends('layouts.siswa')

{{-- Set title halaman --}}
@section('title', 'Bayar Tagihan')

{{-- Mulai section content --}}
@section('content')
    {{-- Heading halaman --}}
    <h1>Form Pembayaran</h1>

    {{-- Card Info Tagihan yang Dibayar --}}
    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h2>Detail Tagihan</h2>

        {{-- Tampilkan info tagihan --}}
        <table style="margin-top: 15px;">
            <tr>
                <td style="padding: 5px; width: 150px;"><strong>Kategori</strong></td>
                <td style="padding: 5px;">: {{ $biaya->kategori }}</td>
            </tr>
            <tr>
                <td style="padding: 5px;"><strong>Tahun Ajaran</strong></td>
                <td style="padding: 5px;">: {{ $biaya->tahun }}</td>
            </tr>
            <tr>
                <td style="padding: 5px;"><strong>Kelas</strong></td>
                <td style="padding: 5px;">: {{ $biaya->kelas ?? 'Semua Kelas' }}</td>
            </tr>
            <tr>
                <td style="padding: 5px;"><strong>Total Biaya</strong></td>
                <td style="padding: 5px; color: #f44336; font-weight: bold;">
                    : Rp {{ number_format($biaya->biaya, 0, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>

    {{-- Form Pembayaran --}}
    <div style="background: white; padding: 20px; border-radius: 8px;">
        <h2>Input Pembayaran</h2>

        {{-- Form dengan enctype untuk upload file --}}
        {{-- enctype="multipart/form-data" WAJIB ada untuk upload file --}}
        <form action="{{ route('siswa.bayar.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin-top: 20px;">
            {{-- Token CSRF untuk keamanan --}}
            @csrf

            {{-- Hidden input untuk ID biaya --}}
            {{-- type="hidden" = input tidak terlihat di halaman --}}
            {{-- value="{{ $biaya->id_biaya }}" = nilai otomatis dari variabel --}}
            <input type="hidden" name="id_biaya" value="{{ $biaya->id_biaya }}">

            {{-- Input Bulan --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Bulan Pembayaran <span style="color: red;">*</span>
                </label>

                {{-- Dropdown bulan --}}
                <select name="bulan" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    {{-- Option default (kosong) --}}
                    <option value="">-- Pilih Bulan --</option>

                    {{-- Loop untuk bikin option bulan Januari - Desember --}}
                    {{-- range(1, 12) = array [1, 2, 3, ..., 12] --}}
                    @foreach(range(1, 12) as $m)
                        {{-- date('F', mktime(0,0,0,$m)) = convert angka bulan jadi nama bulan --}}
                        {{-- mktime(0,0,0,$m) = create timestamp dengan bulan ke-$m --}}
                        {{-- date('F', ...) = format jadi nama bulan (January, February, ...) --}}
                        <option value="{{ date('F', mktime(0,0,0,$m)) }}">
                            {{ date('F', mktime(0,0,0,$m)) }}
                        </option>
                    @endforeach
                </select>

                {{-- Tampilkan error validasi kalau ada --}}
                {{-- @error() = directive Laravel untuk tampilkan error validasi --}}
                @error('bulan')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Tahun --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Tahun <span style="color: red;">*</span>
                </label>

                {{-- Input text untuk tahun --}}
                {{-- value="{{ date('Y') }}" = default tahun sekarang --}}
                {{-- old('tahun', date('Y')) = ambil old input (kalau ada error), kalau tidak ada pakai tahun sekarang --}}
                <input
                    type="text"
                    name="tahun"
                    value="{{ old('tahun', date('Y')) }}"
                    placeholder="Contoh: 2025"
                    required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                >

                @error('tahun')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Nominal Dibayar --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Nominal Dibayar (Rp) <span style="color: red;">*</span>
                </label>

                {{-- Input number untuk nominal --}}
                {{-- type="number" = hanya bisa input angka --}}
                {{-- min="1" = minimal 1 --}}
                {{-- step="1000" = increment 1000 (untuk tombol +/-) --}}
                <input
                    type="number"
                    name="nominal_dibayar"
                    value="{{ old('nominal_dibayar') }}"
                    placeholder="Masukkan nominal yang dibayar"
                    required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                >

                @error('nominal_dibayar')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror

                {{-- Info helper --}}
                <small style="color: #666; display: block; margin-top: 5px;">
                    💡 Bisa bayar sebagian (cicilan) atau full
                </small>
            </div>

            {{-- Input Upload Bukti Transfer --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Bukti Transfer <span style="color: red;">*</span>
                </label>

                {{-- Input file untuk upload --}}
                {{-- type="file" = input file --}}
                {{-- accept="image/*,application/pdf" = hanya terima gambar & PDF --}}
                <input
                    type="file"
                    name="bukti_pembayaran"
                    accept="image/*,application/pdf"
                    required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                >

                @error('bukti_pembayaran')
                    <div style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror

                {{-- Info helper --}}
                <small style="color: #666; display: block; margin-top: 5px;">
                    📎 Format: JPG, PNG, atau PDF. Maksimal 2MB.
                </small>
            </div>

            {{-- Tombol Submit & Kembali --}}
            <div style="display: flex; gap: 10px;">
                {{-- Tombol Submit --}}
                <button
                    type="submit"
                    style="padding: 12px 30px; background-color: #4caf50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;"
                >
                    Upload & Bayar
                </button>

                {{-- Tombol Kembali --}}
                <a
                    href="{{ route('siswa.dashboard') }}"
                    style="padding: 12px 30px; background-color: #9e9e9e; color: white; text-decoration: none; border-radius: 5px; display: inline-block; font-size: 16px;"
                >
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
