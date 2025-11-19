<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - STARS</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* ========================================= */
        /* NAVBAR STYLING */
        /* ========================================= */
        .navbar {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
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
            gap: 0.75rem;
        }

        .navbar-brand-text h1 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #DC2626;
            line-height: 1;
            margin: 0;
        }

        .navbar-brand-text p {
            font-size: 0.7rem;
            color: #6B7280;
            margin: 0;
            margin-top: 2px;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
            padding-right: 250px;
        }

        .navbar-menu li a {
            color: #4B5563;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-menu li a:hover {
            color: #DC2626;
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

        /* Remove the old dropdown styles and add these new ones */

.user-menu-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.user-menu-content {
    position: absolute;
    top: 80px;
    right: 20px;
    background: rgb(255, 255, 255);
    border-radius: 0.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    min-width: 250px;
    overflow: hidden;
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

        .user-menu-content a,
        .user-menu-content button {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
            transition: background 0.2s;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
        }

        .user-menu-content a:hover,
        .user-menu-content button:hover {
            background: #ffffff;
        }

        /* ========================================= */
        /* HERO SECTION */
        /* ========================================= */
        .hero {
            background-image: url('{{ asset("img/SMKTELKOM.png") }}');
            padding: 4rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            opacity: 0.1;
        }

        .welcome-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1.5rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin: 1rem 0;
            position: relative;
            z-index: 1;
        }

        .hero p {
            font-size: 1rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.95;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* ========================================= */
        /* FITUR SECTION */
        /* ========================================= */
        .fitur-section {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }

        .section-title p {
            color: #6B7280;
            font-size: 1rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-top: 4px solid #DC2626;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #FEE2E2, #FECACA);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
        }

        .card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 1rem;
        }

        .card p {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .btn-bayar {
            display: inline-block;
            background: linear-gradient(135deg, #DC2626, #B91C1C);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(220, 38, 38, 0.2);
        }

        .btn-bayar:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(220, 38, 38, 0.3);
        }

        /* ========================================= */
        /* LANGKAH PEMBAYARAN */
        /* ========================================= */
        .langkah-section {
            background: linear-gradient(135deg, #FEE2E2, #FECACA);
            padding: 4rem 2rem;
            margin: 4rem 0;
        }

        .langkah-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .langkah-container h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 3rem;
        }

        .langkah-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }

        .langkah-item {
            text-align: center;
        }

        .langkah-number {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #DC2626, #B91C1C);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 16px rgba(220, 38, 38, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 8px 16px rgba(220, 38, 38, 0.3);
            }
            50% {
                box-shadow: 0 8px 24px rgba(220, 38, 38, 0.5);
            }
        }

        .langkah-item h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }

        .langkah-item p {
            color: #4B5563;
            line-height: 1.6;
        }

        /* ========================================= */
        /* FOOTER */
        /* ========================================= */
        .footer {
            background: #1F2937;
            color: white;
            padding: 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .footer-brand h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .footer-brand p {
            font-size: 0.875rem;
            color: #9CA3AF;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .footer-links a {
            color: #D1D5DB;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #DC2626;
        }

        /* ========================================= */
        /* RESPONSIVE */
        /* ========================================= */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-menu {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .section-title h2,
            .langkah-container h2 {
                font-size: 2rem;
            }

            .card-grid,
            .langkah-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    {{-- ========================================= --}}
    {{-- NAVBAR TOP --}}
    {{-- ========================================= --}}
    <nav class="navbar">
    <!-- Logo & Brand -->
    <div class="navbar-brand">
        <div style="width: 40px; height: 40px; background: #D32F2F; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">S</div>
        <div class="navbar-brand-text">
            <h1>STARS</h1>
            <p>Sistem Tagihan Dan Pembayaran Sekolah</p>
        </div>
    </div>

    <!-- Menu Navigation -->
    <ul class="navbar-menu">
        <li><a href="{{ route('siswa.dashboard') }}">Beranda</a></li>
        <li><a href="#">Layanan</a></li>
        <li><a href="#">Tutorial</a></li>
        <li><a href="#">Kontak</a></li>
    </ul>

    <!-- User Profile Button -->
    <div style="display: flex; align-items: center; gap: 1rem;">
        <button class="navbar-user" id="userMenuBtn" title="{{ auth()->user()->siswa->nama }}">
            {{ substr(auth()->user()->siswa->nama, 0, 1) }}
        </button>

        <!-- User Menu Modal -->
        <div id="userMenu" class="user-menu-modal" style="display: none;">
            <div class="user-menu-content">
                <div style="padding: 1rem; border-bottom: 1px solid #e5e7eb;">
                    <p style="margin: 0; font-weight: 600; color: #1f2937;">{{ auth()->user()->siswa->nama }}</p>
                    <p style="margin: 0.25rem 0 0 0; font-size: 0.875rem; color: #6b7280;">NIS: {{ auth()->user()->siswa->nis }}</p>
                </div>

                <a href="#" style="display: block; padding: 0.75rem 1rem; color: #374151; text-decoration: none; font-size: 0.875rem; transition: background 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'">
                    ⚙️ Pengaturan
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="display: block; width: 100%; padding: 0.75rem 1rem; color: #374151; background: none; border: none; text-align: left; font-size: 0.875rem; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'">
                        🚪 Logout
                    </button>
                </form>
            </div>
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
        <span class="welcome-badge">❤️ Halo, {{ auth()->user()->siswa->nama }} Selamat Datang ❤️</span>
        <h1>Selamat Datang<br>{{ auth()->user()->siswa->nama }}</h1>
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
                    <h4>Pilih Pembayaran</h4>
                    <p>Pilih jenis pembayaran yang ingin dibayar</p>
                </div>

                {{-- Step 2 --}}
                <div class="langkah-item">
                    <div class="langkah-number">2</div>
                    <h4>Transfer & Upload</h4>
                    <p>Transfer ke rekening sekolah dan upload bukti</p>
                </div>

                {{-- Step 3 --}}
                <div class="langkah-item">
                    <div class="langkah-number">3</div>
                    <h4>Verifikasi</h4>
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
    <script>
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userMenu = document.getElementById('userMenu');

    // Toggle menu
    userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target) && e.target !== userMenuBtn) {
            userMenu.style.display = 'none';
        }
    });

    // Close menu when clicking inside (on links/buttons)
    userMenu.addEventListener('click', (e) => {
        if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON') {
            userMenu.style.display = 'none';
        }
    });
    </script>
</body>
</html>
