{{-- Extend dari layout admin --}}
@extends('layouts.admin')

{{-- Set title halaman --}}
@section('title', 'Data Pembayaran')

{{-- Mulai section content --}}
@section('content')
    @vite('resources/css/admin/data-pembayaran.css')

    {{-- Include Alert Modal Component --}}
    @include('components.modal-alert')

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
                            <th>Bulan(Hanya Untuk SPP)</th>
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
                               <td>{{ $item->bulan ?? '-' }}</td>

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
                                           title="Lihat Detail" alt="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                                @if ( $item->status != 'lunas' )
                                                {{-- Tombol Tolak --}}
                                                <form id="form-tolak-{{ $item->id_pembayaran }}"
                                                    action="{{ route('pembayaran.tolak', $item->id_pembayaran) }}"
                                                    method="POST"
                                                    style="display: inline; margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            onclick="showAlertModal('tolak', 'Tolak Pembayaran Ini?', document.getElementById('form-tolak-{{ $item->id_pembayaran }}'))"
                                                            class="btn-icon btn-tolak"
                                                            title="Tolak">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                @else
                                                {{-- Tombol Hapus untuk status lunas --}}
                                                <form id="form-delete-{{ $item->id_pembayaran }}"
                                                    action="{{ route('pembayaran.destroy', $item->id_pembayaran) }}"
                                                    method="POST"
                                                    style="display: inline; margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            onclick="showAlertModal('delete', 'Hapus Histori Pembayaran?',  document.getElementById('form-delete-{{ $item->id_pembayaran }}'))"
                                                            class="btn-icon btn-delete"
                                                            title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
