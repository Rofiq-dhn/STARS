@extends('layouts.admin')

@section('title', 'Data Biaya')

@section('content')
@vite(['resources/css/admin/tagihan-list.css'])
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
                                        <form id="delete-form-{{ $item->id_biaya }}" action="{{ route('biaya.destroy', $item->id_biaya) }}" method="POST" style="display: inline; margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="handleDelete({{ $item->id_biaya }})" class="btn-delete" title="Hapus">
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

    <script>
        // Fungsi untuk handle delete dengan custom alert
        function handleDelete(id) {
            showConfirmAlert('Yakin Ingin Hapus Data?', function() {
                document.getElementById('delete-form-' + id).submit();
            });
        }

        // Tampilkan alert jika ada session success
        @if(session('success'))
            showSuccessAlert('{{ session('success') }}');
        @endif

        // Tampilkan alert jika ada session error
        @if(session('error'))
            showErrorAlert('{{ session('error') }}');
        @endif
    </script>
@endsection
