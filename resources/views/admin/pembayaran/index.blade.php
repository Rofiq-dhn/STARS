{{-- Extend dari layout admin --}}
@extends('layouts.admin')

{{-- Set title halaman --}}
@section('title', 'Data Pembayaran')

{{-- Mulai section content --}}
@section('content')
    <style>
        .pembayaran-container {
            min-height: 100vh;
            background-color: #f3f4f6;
            padding: 2rem;
        }

        .pembayaran-header {
            margin-bottom: 1.5rem;
        }

        .pembayaran-header h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #111827;
            margin: 0 0 0.25rem 0;
        }

        .pembayaran-header p {
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
        }

        .card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #111827;
            margin: 0;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #808080;
            color: white;
        }

        thead th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody td {
            padding: 1.25rem 1.5rem;
            color: #1f2937;
            font-size: 0.95rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.375rem 0.875rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-align: center;
            min-width: 80px;
        }

        .status-lunas {
            background-color: #10b981;
            color: white;
        }

        .status-belum {
            background-color: #f59e0b;
            color: white;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-icon {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-detail {
            background-color: #3b82f6;
            color: white;
        }

        .btn-detail:hover {
            background-color: #2563eb;
        }

        .btn-verifikasi {
            background-color: #ef4444;
            color: white;
        }

        .btn-verifikasi:hover {
            background-color: #dc2626;
        }

        .btn-tolak {
            background-color: #e5e7eb;
            color: #6b7280;
        }

        .btn-tolak:hover {
            background-color: #d1d5db;
        }

        .btn-icon svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: #6b7280;
        }

        .empty-state p {
            font-size: 1rem;
            margin: 0;
        }
    </style>

    <div class="pembayaran-container">
        {{-- Header Section --}}
        <div class="pembayaran-header">
            <h1>Data Pembayaran</h1>
            <p>Verifikasi pembayaran yang diupload oleh siswa</p>
        </div>

        {{-- Card Container --}}
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header">
                <h2>Data Tagihan</h2>
            </div>

            {{-- Table --}}
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
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
                        @forelse ($pembayaran as $item)
                            <tr>
                                {{-- Nomor urut --}}
                                <td>{{ $loop->iteration }}</td>

                                {{-- Tanggal pembayaran --}}
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>

                                {{-- Nama siswa --}}
                                <td>{{ $item->siswa->nama }}</td>

                                {{-- NIS siswa --}}
                                <td>{{ $item->siswa->nis }}</td>

                                {{-- Kategori biaya --}}
                                <td>{{ $item->biaya->kategori }}</td>

                                {{-- Bulan pembayaran --}}
                                <td>{{ $item->bulan }}</td>

                        {{-- Tahun pembayaran --}}
                        <td>{{ $item->tahun_ajaran }}</td>

                                {{-- Nominal --}}
                                <td>Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}</td>

                                {{-- Status --}}
                                <td>
                                    <span class="status-badge {{ $item->status == 'lunas' ? 'status-lunas' : 'status-belum' }}">
                                        {{ $item->status == 'lunas' ? 'Lunas' : 'Belum lunas' }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <div class="action-buttons">
                                        {{-- Tombol Detail --}}
                                        <a href="{{ route('pembayaran.show', $item->id_pembayaran) }}"
                                           class="btn-icon btn-detail"
                                           title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Tombol Verifikasi --}}
                                        @if ($item->status == 'belum lunas')
                                            <form action="{{ route('pembayaran.verifikasi', $item->id_pembayaran) }}"
                                                  method="POST"
                                                  style="display: inline; margin: 0;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                        onclick="return confirm('Verifikasi pembayaran ini sebagai LUNAS?')"
                                                        class="btn-icon btn-verifikasi"
                                                        title="Verifikasi">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                            </form>

                                            {{-- Tombol Tolak --}}
                                            <form action="{{ route('pembayaran.tolak', $item->id_pembayaran) }}"
                                                  method="POST"
                                                  style="display: inline; margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Tolak pembayaran ini? Data akan dihapus!')"
                                                        class="btn-icon btn-tolak"
                                                        title="Tolak">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Tampil kalau data kosong --}}
                            <tr>
                                <td colspan="10">
                                    <div class="empty-state">
                                        <p>Belum ada pembayaran yang masuk.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
