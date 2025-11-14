<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - STARS</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* ========================================= */
        /* NAVBAR TOP */
        /* ========================================= */

        .navbar {
            background: white;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Logo & Brand */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
        }

        .navbar-brand-text h1 {
            font-size: 18px;
            color: #D32F2F;
            font-weight: bold;
        }

        .navbar-brand-text p {
            font-size: 11px;
            color: #666;
        }

        /* Menu Navigation */
        .navbar-menu {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .navbar-menu a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-menu a:hover {
            color: #D32F2F;
        }

        /* User Profile Icon */
        .navbar-user {
            width: 40px;
            height: 40px;
            background: #D32F2F;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            cursor: pointer;
            position: relative;
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            min-width: 200px;
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f5f5f5;
        }

        /* ========================================= */
        /* HERO SECTION (Background Image) */
        /* ========================================= */

        .hero {
            background: linear-gradient(rgba(211, 47, 47, 0.8), rgba(211, 47, 47, 0.8)),
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200') center/cover;
            height: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 16px;
            max-width: 600px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .hero .welcome-badge {
            background: rgba(255,255,255,0.2);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            backdrop-filter: blur(10px);
        }

        /* ========================================= */
        /* FITUR UTAMA SECTION */
        /* ========================================= */

        .fitur-section {
            max-width: 1200px;
            margin: -80px auto 50px;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            padding-top: 20px;
        }

        .section-title h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #666;
            font-size: 14px;
        }

        /* Grid 3 kolom untuk card */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        /* Card Menu Pembayaran */
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        /* Icon */
        .card-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background: #ffebee;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .card.ppdb .card-icon {
            background: #ffebee;
            color: #D32F2F;
        }

        .card.spp .card-icon {
            background: #ffebee;
            color: #D32F2F;
        }

        .card.daftar-ulang .card-icon {
            background: #ffebee;
            color: #D32F2F;
        }

        .card h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 20px;
            min-height: 60px;
        }

        /* Tombol Bayar */
        .btn-bayar {
            display: block;
            width: 100%;
            padding: 12px;
            background: #D32F2F;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-bayar:hover {
            background: #B71C1C;
        }

        /* ========================================= */
        /* LANGKAH PEMBAYARAN SECTION */
        /* ========================================= */

        .langkah-section {
            background: white;
            padding: 50px 20px;
        }

        .langkah-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .langkah-section h2 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 50px;
        }

        .langkah-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .langkah-item {
            text-align: center;
        }

        .langkah-number {
            width: 80px;
            height: 80px;
            background: #D32F2F;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
            margin: 0 auto 20px;
        }

        .langkah-item h4 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .langkah-item p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* ========================================= */
        /* FOOTER */
        /* ========================================= */

        .footer {
            background: #333;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-brand h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .footer-brand p {
            font-size: 12px;
            color: #999;
        }

        .footer-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: #D32F2F;
        }

        /* ========================================= */
        /* ALERT SUCCESS */
        /* ========================================= */

        .alert-success {
            max-width: 1200px;
            margin: 20px auto;
            padding: 15px 20px;
            background: #4caf50;
            color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* ========================================= */
        /* RESPONSIVE */
        /* ========================================= */

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .navbar-menu {
                display: none;
            }

            .card-grid,
            .langkah-grid {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 32px;
            }

            .footer-content {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    {{-- ========================================= --}}
    {{-- NAVBAR TOP --}}
    {{-- ========================================= --}}

    <nav class="navbar">
        {{-- Logo & Brand --}}
        <div class="navbar-brand">
            {{-- Icon bisa diganti dengan logo sekolah --}}
            <div style="width: 40px; height: 40px; background: #D32F2F; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">S</div>
            <div class="navbar-brand-text">
                <h1>STARS</h1>
                <p>Sistem Tagihan Dan Pembayaran Sekolah</p>
            </div>
        </div>

        {{-- Menu Navigation --}}
        <ul class="navbar-menu">
            <li><a href="{{ route('siswa.dashboard') }}">Beranda</a></li>
            <li><a href="#">Layanan</a></li>
            <li><a href="#">Tutorial</a></li>
            <li><a href="#">Kontak</a></li>
        </ul>

        {{-- User Profile Dropdown --}}
        <div class="dropdown">
            <div class="navbar-user">
                {{-- Icon user (initial nama) --}}
                {{ substr(auth()->user()->siswa->nama, 0, 1) }}
            </div>

            {{-- Dropdown Menu --}}
            <div class="dropdown-menu">
                <a href="#"><strong>{{ auth()->user()->siswa->nama }}</strong></a>
                <a href="#">NIS: {{ auth()->user()->siswa->nis }}</a>
                <hr style="margin: 0; border: none; border-top: 1px solid #eee;">
                <a href="#">⚙️ Pengaturan</a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit">🚪 Logout</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- ========================================= --}}
    {{-- ALERT SUCCESS --}}
    {{-- ========================================= --}}

    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- ========================================= --}}
    {{-- HERO SECTION --}}
    {{-- ========================================= --}}

    <section class="hero">
        <span class="welcome-badge">❤️ Halo User, Selamat Datang ❤️</span>
        <h1>Selamat Datang User</h1>
        <p>
            Platform pembayaran digital untuk PPDB, SPP, dan Daftar Ulang siswa.
            Proses cepat, aman, dan terintegrasi dengan sistem sekolah.
        </p>
    </section>

    {{-- ========================================= --}}
    {{-- FITUR UTAMA (3 CARD MENU) --}}
    {{-- ========================================= --}}

    <section class="fitur-section">
        <div class="section-title">
            <h2>Fitur Utama</h2>
            <p>Silahkan Memilih Pilihan Tagihan</p>
        </div>

        <div class="card-grid">
            {{-- Card PPDB --}}
            <div class="card ppdb">
                <div class="card-icon">🎓</div>
                <h3>PPDB</h3>
                <p>Pembayaran Penerimaan Peserta Didik Baru untuk calon siswa yang mendaftar ke sekolah.</p>

                @if($biayaPPDB)
                    <a href="{{ route('siswa.ppdb') }}" class="btn-bayar">Bayar</a>
                @else
                    <span style="color: #999; font-size: 14px;">Tidak ada tagihan</span>
                @endif
            </div>

            {{-- Card SPP --}}
            <div class="card spp">
                <div class="card-icon">💳</div>
                <h3>SPP</h3>
                <p>Sumbangan Pembinaan Pendidikan bulanan untuk keberlangsungan proses belajar mengajar.</p>

                @if($biayaSPP)
                    <a href="{{ route('siswa.spp') }}" class="btn-bayar">Bayar</a>
                @else
                    <span style="color: #999; font-size: 14px;">Tidak ada tagihan</span>
                @endif
            </div>

            {{-- Card Daftar Ulang --}}
            <div class="card daftar-ulang">
                <div class="card-icon">📝</div>
                <h3>Daftar Ulang</h3>
                <p>Pembayaran daftar ulang untuk melanjutkan pendidikan ke tingkat yang lebih tinggi.</p>

                @if($biayaDaftarUlang)
                    <a href="{{ route('siswa.daftar-ulang') }}" class="btn-bayar">Bayar</a>
                @else
                    <span style="color: #999; font-size: 14px;">Tidak ada tagihan</span>
                @endif
            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- LANGKAH PEMBAYARAN --}}
    {{-- ========================================= --}}

    <section class="langkah-section">
        <div class="langkah-container">
            <h2>Langkah Membayar</h2>

            <div class="langkah-grid">
                {{-- Step 1 --}}
                <div class="langkah-item">
                    <div class="langkah-number">1</div>
                    <h4>Step</h4>
                    <p>Pilih jenis pembayaran yang ingin dibayar</p>
                </div>

                {{-- Step 2 --}}
                <div class="langkah-item">
                    <div class="langkah-number">2</div>
                    <h4>Step</h4>
                    <p>Transfer ke rekening sekolah dan upload bukti</p>
                </div>

                {{-- Step 3 --}}
                <div class="langkah-item">
                    <div class="langkah-number">3</div>
                    <h4>Step</h4>
                    <p>Tunggu verifikasi admin dan download kwitansi</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================= --}}

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>STARS</h3>
                <p>Sistem Tagihan Dan Pembayaran Sekolah</p>
            </div>

            <ul class="footer-links">
                <li><a href="#">Privasi</a></li>
                <li><a href="#">Kontak</a></li>
                <li><a href="#">Bantuan</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
