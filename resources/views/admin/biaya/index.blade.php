@extends('layouts.admin')

@section('title', 'Data Biaya')

@section('content')
    <style>
        .tagihan-container {
            min-height: 100vh;
            background-color: #f3f4f6;
            padding: 2rem;
        }

        .tagihan-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .tagihan-header a {
            text-decoration: none;
            text-align: center;
            margin-top: 1rem;
        }

        .tagihan-title h1 {
            font-size: 2.25rem;
            font-weight: bold;
            color: #111827;
            margin: 0;
        }

        .tagihan-title p {
            color: #6b7280;
            font-size: 1rem;
            margin-top: 0.25rem;
        }

        .btn-tambah {
            background-color: #ef4444;
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: background-color 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            border: none;
            cursor: pointer;
        }

        .btn-tambah:hover {
            background-color: #dc2626;
        }

        .btn-tambah span:first-child {
            font-size: 1.125rem;
            font-weight: 600;
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
            padding: 1.25rem 2rem;
            text-align: center;
            font-weight: bold;
            font-size: 1rem;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody td {
            padding: 1.5rem 2rem;
            text-align: center;
            color: #1f2937;
            font-size: 1rem;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-edit, .btn-delete {
            padding: 0.625rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-edit {
            background-color: #ef4444;
            color: white;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #dc2626;
        }

        .btn-delete {
            background-color: #9ca3af;
            color: white;
        }

        .btn-delete:hover {
            background-color: #6b7280;
        }

        .btn-edit svg, .btn-delete svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: #6b7280;
        }

        .empty-state-icon {
            width: 4rem;
            height: 4rem;
            color: #d1d5db;
            margin: 0 auto 1rem;
        }

        .empty-state p {
            font-weight: 600;
            font-size: 1.125rem;
            margin: 0;
        }
    </style>

    <div class="tagihan-container">
        <!-- Header Section -->
        <div class="tagihan-header">
            <div class="tagihan-title">
                <h1>Tagihan</h1>
                <p>Tambah Data Tagihan</p>
            </div>
            <a href="{{ route('biaya.create') }}" class="btn-tambah">
                <span>+</span>
                <span>Tambah Tagihan</span>
            </a>
        </div>

        <!-- Card Container -->
        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <h2>Data Tagihan</h2>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Biaya</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($biaya as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- Edit Button -->
                                        <a href="{{ route('biaya.edit', $item->id_biaya) }}"
                                           class="btn-edit"
                                           title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('biaya.destroy', $item->id_biaya) }}" method="POST" style="display: inline; margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Yakin hapus data ini?')"
                                                    class="btn-delete"
                                                    title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p>Belum ada data tagihan.</p>
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
