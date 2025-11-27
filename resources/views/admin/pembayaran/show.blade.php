@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')
    @vite('resources/css/admin/detail.css')
    <x-verification-alert />
    <div class="container-detail">
        <div class="header-section">
            <h1>Data Pembayaran</h1>
            <p>Verifikasi pembayaran yang diupload oleh siswa</p>
            <a href="{{ route('pembayaran.index') }}" class="btn-back">
                ← Kembali Ke Daftar Pembayaran
            </a>
        </div>

        <div class="grid-container">
            {{-- KOLOM KIRI: DATA TAGIHAN --}}
            <div class="card">
                <div class="card-header">
                    <span class="card-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            fill="red">
                            <path
                                d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                        </svg></span>
                    <h2>Data Tagihan</h2>
                </div>

                <table class="info-table">
                    <tr>
                        <td style="font-weight:600;">Tanggal Upload</td>
                        <td style="font-weight: 600;">: {{ $pembayaran->created_at->format('d F Y, H:i') }} WIB</td>
                    </tr>

                    <tr>
                        <td>Nama Siswa</td>
                        <td>: {{ $pembayaran->siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>: {{ $pembayaran->siswa->nis }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>: {{ $pembayaran->siswa->kelas_siswa }}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>: {{ $pembayaran->siswa->jurusan }}</td>
                    </tr>
                    <br>
                    <tr>
                        <td>Kategori</td>
                        <td>: {{ $pembayaran->biaya->kategori }}</td>
                    </tr>
                    <tr>
                        <td>Bulan</td>
                        <td>: {{ $pembayaran->bulan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tahun Ajaran</td>
                        <td>: {{ $pembayaran->tahun_ajaran }}</td>
                    </tr>
                    <tr>
                        <td>Total Biaya</td>
                        <td>: RP. {{ number_format($pembayaran->biaya->biaya, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Nominal Dibayar</td>
                        <td class="text-green">: RP. {{ number_format($pembayaran->nominal_dibayar, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Sisa Pembayaran</td>
                        <td class="text-red">
                            : RP. {{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Cicilan</td>
                        <td>: {{ $pembayaran->cicilan_ke }}/{{ $pembayaran->total_cicilan }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <span
                                class="status-badge {{ $pembayaran->status == 'lunas' ? 'status-lunas' : 'status-belum' }}">
                                {{ $pembayaran->status == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            {{-- KOLOM KANAN: DATA TAGIHAN & KIRIM KWITANSI --}}
            <div>
                {{-- Data Tagihan (Preview) --}}
                <div class="card">
                    <div class="card-header">
                        <span class="card-header-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                fill="red">
                                <path
                                    d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                            </svg>
                        </span>
                        <h2>Bukti Transfer</h2>
                    </div>

                    @php
                        $extension = strtolower(pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION));
                    @endphp

                    <div class="preview-container">
                        @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                                alt="Bukti Transfer" class="preview-img">
                        @elseif($extension == 'pdf')
                            <embed src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}"
                                type="application/pdf" style="width: 100%; height: 400px; border-radius: 5px;">
                        @else
                            <div class="preview-placeholder">
                                Image.png/jpg/jpeg/pdf
                            </div>
                        @endif
                    </div>

                    <div class="file-info">
                        <small><strong>Nama File :</strong> {{ $pembayaran->bukti_pembayaran }}</small>
                    </div>

                    <a href="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}" download
                        class="btn-download">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30"
                                fill="currentColor">
                                <!-- Arah panah turun -->
                                <path d="M12 3v12m0 0l-5-5m5 5l5-5" stroke="currentColor" stroke-width="2" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />

                                <!-- Garis bawah tempat file “mendarat” -->
                                <path d="M4 19h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <p>Download Bukti</p>
                    </a>

                    <a href="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}" target="_blank"
                        rel="noopener noreferrer" class="btn-open">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="currentColor">
                                <!-- Kotak -->
                                <path d="M5 4h7v2H6v11h11v-6h2v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z" />

                                <!-- Panah keluar -->
                                <path d="M14 4h6v6h-2V7.41l-6.29 6.3-1.42-1.42L16.59 6H14V4z" />
                            </svg>
                        </span>
                        <p>Buka Di Tab Baru</p>
                    </a>
                </div>

                {{-- Kirim Kwitansi --}}
                @if ($pembayaran->status == 'belum lunas')
                    <div class="card" style="margin-top: 30px;">
                        <div class="card-header">
                            <span class="card-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    fill="red">
                                    <path
                                        d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                                </svg>
                            </span>
                            <h2>Kirim Kwitansi</h2>
                        </div>

                        <div class="upload-box">
                            <div class="upload-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 3l5 5h-3v6h-4V8H7l5-5z" />
                                    <rect x="4" y="18" width="16" height="3" rx="1" />
                                </svg>
                            </div>
                            <p class="upload-text">Pilih File Gambar (PNG, JPG) atau PDF</p>
                            <p class="upload-hint">Maksimal 10MB</p>
                            <div class="upload-wrapper">
                                <button class="btn-upload">
                                    <p>Upload</p> <span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 3l5 5h-3v6h-4V8H7l5-5z" />
                                            <rect x="4" y="18" width="16" height="3" rx="1" /></svg></span>
                                </button>
                            </div>
                        </div>

                        <div class="action-buttons">
                            {{-- Form Verifikasi (Hidden) --}}
                            <form action="{{ route('pembayaran.verifikasi', $pembayaran->id_pembayaran) }}"
                                method="POST" id="formVerifikasi" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>

                            {{-- Form Tolak (Hidden) --}}
                            <form action="{{ route('pembayaran.tolak', $pembayaran->id_pembayaran) }}" method="POST"
                                id="formTolak" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            {{-- Button Verifikasi --}}
                            <button type="button" onclick="showVerificationAlert('formVerifikasi', 'verify')"
                                class="btn-verifikasi">
                                <svg width="40" height="40" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12l4 4 10-10" />
                                </svg>
                                <p>Verifikasi</p>
                            </button>

                            {{-- Button Tolak --}}
                            <button type="button" onclick="showVerificationAlert('formTolak', 'reject')"
                                class="btn-tolak">
                                <svg width="40" height="40" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                    <line x1="6" y1="18" x2="18" y2="6" />
                                </svg>
                                <p>Tolak Pembayaran</p>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
