@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')
    <h1>Detail Pembayaran</h1>

    {{-- Tombol Kembali --}}
    <a
        href="{{ route('pembayaran.index') }}"
        style="display: inline-block; padding: 10px 20px; background-color: #9e9e9e; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px;"
    >
        ← Kembali
    </a>

    {{-- Grid 2 kolom: Info Pembayaran & Bukti Transfer --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

        {{-- Kolom Kiri: Info Pembayaran --}}
        <div style="background: white; padding: 20px; border-radius: 8px;">
            <h2 style="margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                Informasi Pembayaran
            </h2>

            {{-- Tabel info --}}
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 10px 0; width: 150px;"><strong>Tanggal Upload</strong></td>
                    <td style="padding: 10px 0;">
                        : {{ $pembayaran->created_at->format('d F Y, H:i') }} WIB
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Nama Siswa</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->siswa->nama }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>NIS</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->siswa->nis }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Kelas</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->siswa->kelas_siswa }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Jurusan</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->siswa->jurusan }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 20px 0;">
                        <hr style="border: none; border-top: 1px solid #ddd;">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Kategori Biaya</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->biaya->kategori }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Bulan</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->bulan }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Tahun</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->tahun }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Total Biaya</strong></td>
                    <td style="padding: 10px 0;">
                        : Rp {{ number_format($pembayaran->biaya->biaya, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Nominal Dibayar</strong></td>
                    <td style="padding: 10px 0; color: #4caf50; font-weight: bold;">
                        : Rp {{ number_format($pembayaran->nominal_dibayar, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Sisa Pembayaran</strong></td>
                    <td style="padding: 10px 0; color: #f44336; font-weight: bold;">
                        : Rp {{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Status</strong></td>
                    <td style="padding: 10px 0;">
                        {{-- Badge status --}}
                        <span style="
                            padding: 5px 15px;
                            border-radius: 5px;
                            color: white;
                            background-color: {{ $pembayaran->status == 'lunas' ? '#4caf50' : '#ff9800' }};
                            display: inline-block;
                        ">
                            {{ ucfirst($pembayaran->status) }}
                        </span>
                    </td>
                </tr>
            </table>

            {{-- Tombol Aksi (hanya tampil kalau belum lunas) --}}
            @if($pembayaran->status == 'belum lunas')
                <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #ddd;">
                    {{-- Form Verifikasi --}}
                    <form action="{{ route('pembayaran.verifikasi', $pembayaran->id_pembayaran) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')

                        <button
                            type="submit"
                            onclick="return confirm('Verifikasi pembayaran ini sebagai LUNAS?')"
                            style="padding: 12px 30px; background-color: #4caf50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-right: 10px;"
                        >
                            ✅ Verifikasi Lunas
                        </button>
                    </form>

                    {{-- Form Tolak --}}
                    <form action="{{ route('pembayaran.tolak', $pembayaran->id_pembayaran) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Tolak pembayaran ini? Data akan dihapus!')"
                            style="padding: 12px 30px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;"
                        >
                            ❌ Tolak
                        </button>
                    </form>
                </div>
            @endif
        </div>

        {{-- Kolom Kanan: Preview Bukti Transfer --}}
        <div style="background: white; padding: 20px; border-radius: 8px;">
            <h2 style="margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                Bukti Transfer
            </h2>

            {{-- Cek ekstensi file untuk tampilkan preview yang sesuai --}}
            {{-- pathinfo() = ambil info file --}}
            {{-- PATHINFO_EXTENSION = ambil ekstensi file (jpg, png, pdf) --}}
            @php
                $extension = pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION);
            @endphp

            {{-- Kalau file gambar (jpg, jpeg, png) --}}
            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                {{-- Tampilkan gambar --}}
                {{-- asset() = generate URL ke folder public --}}
                {{-- storage/bukti_pembayaran/ = path file (symbolic link) --}}
                <img
                    src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                    alt="Bukti Transfer"
                    style="width: 100%; border-radius: 5px; border: 2px solid #ddd;"
                >

            {{-- Kalau file PDF --}}
            @elseif(strtolower($extension) == 'pdf')
                {{-- Tampilkan embed PDF --}}
                <embed
                    src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                    type="application/pdf"
                    style="width: 100%; height: 600px; border: 2px solid #ddd; border-radius: 5px;"
                >

            {{-- Kalau format tidak dikenali --}}
            @else
                <p style="text-align: center; color: #999; padding: 40px;">
                    Format file tidak dapat ditampilkan
                </p>
            @endif

            {{-- Tombol Download --}}
            <a
                href="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                download
                style="display: block; margin-top: 20px; padding: 12px; background-color: #2196F3; color: white; text-align: center; text-decoration: none; border-radius: 5px;"
            >
                📥 Download Bukti
            </a>
        </div>
    </div>
@endsection
