@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')
    <h1 style="margin-bottom: 10px;">Detail Pembayaran</h1>
    <p style="color: #666; margin-bottom: 20px;">
        Verifikasi pembayaran dari siswa. Pastikan bukti transfer valid sebelum melakukan verifikasi.
    </p>


    <a href="{{ route('pembayaran.index') }}"
        style="display: inline-block; padding: 10px 20px; background-color: #9e9e9e; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">
        ← Kembali ke Daftar Pembayaran
    </a>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

        {{-- KOLOM KIRI: INFO PEMBAYARAN --}}
        <div style="background: white; padding: 20px; border-radius: 8px;">
            <h2 style="margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                📋 Informasi Pembayaran
            </h2>

            <table style="width: 100%;">
                <tr>
                    <td style="padding: 10px 0; width: 180px;"><strong>Tanggal Upload</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->created_at->format('d F Y, H:i') }} WIB</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px 0;">
                        <hr style="border: none; border-top: 1px solid #eee;">
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
                    <td colspan="2" style="padding: 10px 0;">
                        <hr style="border: none; border-top: 1px solid #eee;">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Kategori Biaya</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->biaya->kategori }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Bulan</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->bulan ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Tahun Ajaran</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->tahun_ajaran }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Total Biaya</strong></td>
                    <td style="padding: 10px 0;">: Rp {{ number_format($pembayaran->biaya->biaya, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Nominal Dibayar</strong></td>
                    <td style="padding: 10px 0; color: #4caf50; font-weight: bold;">
                        : Rp {{ number_format($pembayaran->nominal_dibayar, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Sisa Pembayaran</strong></td>
                    <td
                        style="padding: 10px 0; color: {{ $pembayaran->sisa_pembayaran > 0 ? '#f44336' : '#4caf50' }}; font-weight: bold;">
                        : Rp {{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Cicilan</strong></td>
                    <td style="padding: 10px 0;">: {{ $pembayaran->cicilan_ke }} / {{ $pembayaran->total_cicilan }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Status</strong></td>
                    <td style="padding: 10px 0;">
                        <span
                            style="
                            padding: 5px 15px;
                            border-radius: 5px;
                            color: white;
                            background-color: {{ $pembayaran->status == 'lunas' ? '#4caf50' : '#ff9800' }};
                            display: inline-block;
                        ">
                            {{ strtoupper($pembayaran->status) }}
                        </span>
                    </td>
                </tr>
            </table>

            @if ($pembayaran->status == 'belum lunas')
                <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #ddd;">
                    <h3 style="margin-bottom: 15px;">Aksi Verifikasi</h3>

                    <form action="{{ route('pembayaran.verifikasi', $pembayaran->id_pembayaran) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            onclick="return confirm('Verifikasi pembayaran ini sebagai LUNAS? Kwitansi akan otomatis digenerate.')"
                            style="padding: 12px 30px; background-color: #4caf50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-right: 10px; font-weight: bold;">
                            ✅ Verifikasi Lunas
                        </button>
                    </form>

                    <form action="{{ route('pembayaran.tolak', $pembayaran->id_pembayaran) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Tolak pembayaran ini? Data dan file akan DIHAPUS PERMANEN!')"
                            style="padding: 12px 30px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;">
                            ❌ Tolak Pembayaran
                        </button>
                    </form>
                </div>
            @endif
        </div>

        {{-- KOLOM KANAN: BUKTI TRANSFER --}}
        <div style="background: white; padding: 20px; border-radius: 8px;">
            <h2 style="margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                📎 Bukti Transfer
            </h2>

            @php
                // Ambil ekstensi file
                $extension = strtolower(pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION));
            @endphp

            @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                {{-- Preview Gambar --}}
                <img src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Transfer"
                    style="width: 100%; height: auto; border-radius: 5px; border: 2px solid #ddd; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

                <div style="margin-top: 15px; padding: 10px; background: #f5f5f5; border-radius: 5px;">
                    <small style="color: #666;">
                        <strong>Nama File:</strong> {{ $pembayaran->bukti_pembayaran }}
                    </small>
                </div>
            @elseif($extension == 'pdf')
                {{-- Preview PDF --}}
                <embed src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                    type="application/pdf" style="width: 100%; height: 700px; border: 2px solid #ddd; border-radius: 5px;">

                <div style="margin-top: 15px; padding: 10px; background: #f5f5f5; border-radius: 5px;">
                    <small style="color: #666;">
                        <strong>Nama File:</strong> {{ $pembayaran->bukti_pembayaran }}
                    </small>
                </div>
            @else
                {{-- Format tidak dikenali --}}
                <div style="padding: 40px; text-align: center; color: #999; border: 2px dashed #ddd; border-radius: 5px;">
                    <div style="font-size: 48px; margin-bottom: 10px;">❌</div>
                    <p style="font-size: 16px;">Format file tidak dapat ditampilkan</p>
                    <p style="font-size: 14px; margin-top: 10px;">
                        Ekstensi file: <strong>.{{ $extension }}</strong>
                    </p>
                </div>
            @endif

            {{-- Tombol Download --}}

            <a href="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}" download
                style="display: block; margin-top: 20px; padding: 12px; background-color: #2196F3; color: white; text-align: center; text-decoration: none; border-radius: 5px; font-weight: bold;">
                📥 Download Bukti Transfer
            </a>

            {{-- Tombol Buka di Tab Baru --}}

            <a href="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}" target="_blank"
                rel="noopener noreferrer"
                style="display: block; margin-top: 10px; padding: 12px; background-color: #ff9800; color: white; text-align: center; text-decoration: none; border-radius: 5px; font-weight: bold;">
                🔗 Buka di Tab Baru
            </a>
        </div>
    </div>
@endsection
