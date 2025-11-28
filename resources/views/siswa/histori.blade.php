@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - STARS')

@vite('resources/css/siswa/histori.css')
@section('content')
    <!-- Container -->
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <a href="{{ route('siswa.dashboard') }}" class="btn-back">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="200" height="200">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="#000000"/>
                </svg>
            </a>
            <div class="page-title">
                <h1>Histori Pembayaran</h1>
                <p>Riwayat semua pembayaran yang telah dilakukan</p>
            </div>
        </div>

        <!-- Card Table -->
        <div class="card">
            <h2 class="card-title">📋 Histori Pembayaran</h2>

            @if($pembayaran->count() > 0)
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Sisa</th>
                                <th>Status</th>
                                <th>Kwitansi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $item)
                                <tr>
                                    <td style="text-align: center; font-weight: 600;">{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $item->biaya->kategori }}</strong>
                                        @if($item->bulan)
                                            <br><span style="font-size: 0.75rem; color: #6B7280;">{{ $item->bulan }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td style="font-weight: 600; color: #DC2626;">
                                        Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($item->sisa_pembayaran, 0, ',', '.') }}
                                    </td>
                                    <td style="text-align: center;">
                                        <span class="status-badge {{ $item->status == 'lunas' ? 'lunas' : 'belum-lunas' }}">
                                            {{ $item->status == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                                        </span>
                                    </td>
                                    <td style="text-align: center;">
                                        @if($item->status == 'lunas' && $item->kwitansi)
                                            <a href="{{ route('pembayaran.download-kwitansi', $item->id_pembayaran) }}"
                                               class="btn-download">
                                                📄 Download Kwitansi
                                            </a>
                                        @else
                                            <span class="btn-download btn-disabled">
                                                Menunggu Verifikasi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>Belum Ada Pembayaran</h3>
                    <p>Anda belum melakukan pembayaran apapun</p>
                </div>
            @endif
        </div>
    </div>
@endsection
