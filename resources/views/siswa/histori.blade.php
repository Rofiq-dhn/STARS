<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pembayaran - STARS</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        /* Navbar - sama seperti dashboard */
        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand img {
            width: 35px;
            height: 35px;
        }

        .navbar-brand-text h1 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #DC2626;
            line-height: 1.2;
            margin: 0;
        }

        .navbar-brand-text p {
            font-size: 0.65rem;
            color: #6B7280;
            margin: 0;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 2.5rem;
            align-items: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .navbar-menu li a {
            color: #6B7280;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding-bottom: 5px;
        }

        .navbar-menu li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #DC2626;
            transition: width 0.3s ease;
        }

        .navbar-menu li a:hover {
            color: #DC2626;
        }

        .navbar-menu li a:hover::after {
            width: 100%;
        }

        .navbar-menu li a.active {
            color: #DC2626;
        }

        .navbar-menu li a.active::after {
            width: 100%;
        }

        .navbar-user {
            width: 40px;
            height: 40px;
            background: #DC2626;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.25rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Header */
        .page-header {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-back {
            width: 45px;
            height: 45px;
            background: #f5f5f5;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #e0e0e0;
        }

        .page-title {
            flex: 1;
        }

        .page-title h1 {
            font-size: 1.75rem;
            color: #1F2937;
            margin-bottom: 0.25rem;
        }

        .page-title p {
            font-size: 0.9rem;
            color: #6B7280;
        }

        /* Card */
        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #DC2626;
            color: white;
        }

        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.875rem;
        }

        th:first-child {
            border-top-left-radius: 8px;
        }

        th:last-child {
            border-top-right-radius: 8px;
        }

        tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        td {
            padding: 1rem;
            font-size: 0.875rem;
            color: #4B5563;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.lunas {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-badge.belum-lunas {
            background: #FEF3C7;
            color: #92400E;
        }

        /* Action Button */
        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #10B981;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-download:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
        }

        .btn-disabled {
            background: #D1D5DB;
            color: #6B7280;
            cursor: not-allowed;
        }

        .btn-disabled:hover {
            background: #D1D5DB;
            transform: none;
            box-shadow: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            color: #6B7280;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #9CA3AF;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .navbar-menu {
                position: static;
                transform: none;
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .container {
                padding: 0 1rem;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-title h1 {
                font-size: 1.25rem;
            }

            .table-container {
                overflow-x: scroll;
            }

            table {
                min-width: 800px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <div style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('img/telkom.png') }}" alt="STARS Logo">
            </div>
            <div class="navbar-brand-text">
                <h1>STARS</h1>
                <p>Sistem Tagihan Dan Pembayaran Sekolah</p>
            </div>
        </div>

        <ul class="navbar-menu">
            <li><a href="{{ route('siswa.dashboard') }}">Beranda</a></li>
            <li><a href="{{ route('siswa.histori') }}" class="active">Histori</a></li>
            <li><a href="#tutorial">Tutorial</a></li>
            <li><a href="#">Kontak</a></li>
        </ul>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="navbar-user" id="userMenuBtn" title="{{ auth()->user()->siswa->nama }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="200" height="39">
                    <circle cx="50" cy="35" r="15" fill="white"/>
                    <path d="M 25 70 Q 25 55 50 55 Q 75 55 75 70 L 75 80 Q 75 85 50 85 Q 25 85 25 80 Z" fill="white"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Container -->
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <a href="{{ route('siswa.dashboard') }}" class="btn-back">←</a>
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
</body>
</html>
