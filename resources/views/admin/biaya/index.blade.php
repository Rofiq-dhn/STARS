@extends('layouts.admin')

@section('title', 'Data Biaya')

@section('content')
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Tagihan - Sistem Keuangan</title>
    </head>

    <body>
        <div class="container">
            <!-- Main Content -->
            <main class="main-content">
                <!-- Tagihan Section -->
                <section class="tagihan-section">
                    <div class="section-header">
                        <h2>Data Biaya</h2>
                        <a href="{{ route('biaya.create') }}" class="btn-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Tambah Biaya
                        </a>
                    </div>

                    <div class="data-table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Biaya</th>
                                    <th>Kategori</th>
                                    <th>Tahun</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biaya as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>Rp {{ number_format($s->biaya, 0, ',', '.') }}</td>
                                        <td>{{ $s->kategori }}</td>
                                        <td>{{ $s->tahun }}</td>
                                        <td>{{ $s->kelas ?? '-' }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('biaya.edit', $s->id_biaya) }}" class="btn-edit">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('biaya.destroy', $s->id_biaya) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin mau hapus data ini?')"
                                                    class="btn-delete">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6" />
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>

        <style>
            * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    color: #333;
}

.container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar Styles */
.sidebar {
    width: 280px;
    background: linear-gradient(180deg, #dc2626 0%, #b91c1c 100%);
    color: white;
    padding: 24px;
    display: flex;
    flex-direction: column;
}

.logo {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 40px;
}

.logo-icon {
    width: 48px;
    height: 48px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-text h1 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 2px;
}

.logo-text p {
    font-size: 12px;
    opacity: 0.9;
}

.nav-menu {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s;
    font-size: 14px;
}

.nav-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.nav-item.active {
    background-color: rgba(255, 255, 255, 0.2);
    font-weight: 500;
}

/* Main Content Styles */
.main-content {
    flex: 1;
    background-color: #f5f5f5;
}

.header {
    background-color: white;
    padding: 20px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 14px;
}

.breadcrumb strong {
    color: #111827;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-info span {
    font-size: 14px;
    font-weight: 500;
}

.user-avatar {
    width: 36px;
    height: 36px;
    background-color: #dc2626;
    border-radius: 50%;
}

/* Tagihan Section */
.tagihan-section {
    padding: 32px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.section-header h2 {
    font-size: 24px;
    font-weight: 600;
    color: #111827;
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: #dc2626;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #b91c1c;
}

/* Data Table Container */
.data-table-container {
    background-color: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.table-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #111827;
}

/* Table Styles */
.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table thead {
    background-color: #f9fafb;
}

.data-table th {
    padding: 12px 16px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e5e7eb;
}

.data-table tbody tr {
    border-bottom: 1px solid #f3f4f6;
    transition: background-color 0.2s;
}

.data-table tbody tr:hover {
    background-color: #f9fafb;
}

.data-table td {
    padding: 16px;
    font-size: 14px;
    color: #374151;
}

.data-table tbody tr td:first-child {
    font-weight: 500;
    color: #6b7280;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-edit,
.btn-delete {
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.btn-edit {
    background-color: #fef3c7;
    color: #d97706;
}

.btn-edit:hover {
    background-color: #fde68a;
}

.btn-delete {
    background-color: #fee2e2;
    color: #dc2626;
}

.btn-delete:hover {
    background-color: #fecaca;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        padding: 16px;
    }

    .header {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }

    .tagihan-section {
        padding: 16px;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .data-table-container {
        overflow-x: auto;
    }

    .data-table {
        min-width: 600px;
    }
}
        </style>
    </body>

    </html>
@endsection
