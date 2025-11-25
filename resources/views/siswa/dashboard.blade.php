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

        /* ========================================= */
        /* HERO SECTION */
        /* ========================================= */
        .hero {
            background-image: url('{{ asset("img/SMKTELKOM.png") }}');
            background-size: cover;
            background-position: center;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            min-height: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        .welcome-badge {
            display: inline-block;
            background: rgba(220, 38, 38, 0.9);
            padding: 0.5rem 1.5rem;
            border-radius: 2rem;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin: 0.5rem 0;
            position: relative;
            z-index: 1;
            line-height: 1.2;
        }

        .hero p {
            font-size: 0.95rem;
            max-width: 650px;
            margin: 1rem auto 0;
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
            margin: 3rem auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }

        .section-title p {
            color: #6B7280;
            font-size: 0.95rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .card {
            background: white;
            border-radius: 0.75rem;
            padding: 2rem 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f3f4f6;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            background: #DC2626;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
        }

        .card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 1rem;
        }

        .card p {
            color: #6B7280;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            min-height: 60px;
        }

        .btn-bayar {
            display: inline-block;
            background: #DC2626;
            color: white;
            padding: 0.7rem 2.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.2);
        }

        .btn-bayar:hover {
            background: #B91C1C;
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }

        /* ========================================= */
        /* LANGKAH PEMBAYARAN */
        /* ========================================= */
        .langkah-section {
            background: #FFE5E5;
            padding: 3rem 2rem;
            margin: 3rem 0 0;
        }

        .langkah-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .langkah-container h2 {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 2.5rem;
        }

        .langkah-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
        }

        .langkah-item {
            text-align: center;
        }

        .langkah-number {
            width: 70px;
            height: 70px;
            background: #DC2626;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 auto 1.25rem;
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }

        .langkah-item h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }

        .langkah-item p {
            color: #4B5563;
            line-height: 1.6;
            font-size: 0.9rem;
        }

        /* ========================================= */
        /* FOOTER */
        /* ========================================= */
        .footer {
            background: #333333;
            color: white;
            padding: 1rem;
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
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .footer-brand p {
            font-size: 0.8rem;
            color: #CBD5E0;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .footer-links a {
            color: #E2E8F0;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #DC2626;
        }

        /* ========================================= */
        /* RESPONSIVE */
        /* ========================================= */

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Fade in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        .card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .langkah-item {
            animation: fadeInUp 0.6s ease-out;
        }

        .langkah-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .langkah-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .langkah-item:nth-child(3) {
            animation-delay: 0.3s;
        }

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

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 0.85rem;
            }

            .section-title h2,
            .langkah-container h2 {
                font-size: 1.5rem;
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
            <div style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('img/telkom.png') }}" alt="STARS Logo">
            </div>
            <div class="navbar-brand-text">
                <h1>STARS</h1>
                <p>Sistem Tagihan Dan Pembayaran Sekolah</p>
            </div>
        </div>

        <!-- Menu Navigation -->
        <ul class="navbar-menu">
            <li><a href="{{ route('siswa.dashboard') }}">Beranda</a></li>
            <li><a href="#">Layanan</a></li>
            <li><a href="#tutorial">Tutorial</a></li>
            <li><a href="#">Kontak</a></li>
        </ul>

        <!-- User Profile Button -->
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="navbar-user" id="userMenuBtn" title="{{ auth()->user()->siswa->nama }}">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="200" height="39">
                    <!-- Kepala (lingkaran) -->
                    <circle cx="50" cy="35" r="15" fill="white"/>
                    <!-- Badan (setengah lingkaran) -->
                    <path d="M 25 70 Q 25 55 50 55 Q 75 55 75 70 L 75 80 Q 75 85 50 85 Q 25 85 25 80 Z" fill="white"/>
                </svg>
            </button>

            <!-- User Menu Modal - TIDAK DIUBAH -->
            <div id="userMenu" class="user-menu-modal" style="display: none;">
                <div class="user-menu-content" style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); overflow: hidden; min-width: 320px;">
                    <!-- Header dengan info user dan tombol close -->
                    <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: flex-start; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                            <!-- Avatar Icon -->
                            <div style="width: 48px; height: 48px; background: #000; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>

                            <!-- User Info -->
                            <div style="flex: 1;">
                                <p style="margin: 0; font-weight: 600; color: #1f2937; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ auth()->user()->siswa->nama }}
                                </p>
                                <p style="margin: 0.25rem 0 0 0; font-size: 0.875rem; color: #6b7280;">
                                    {{ auth()->user()->siswa->nis }}
                                </p>
                            </div>
                        </div>

                        <!-- Close Button (Arrow) -->
                        <button id="closeMenuBtn" style="background: #e5e7eb; border: none; border-radius: 6px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; cursor: pointer; padding: 0; flex-shrink: 0; transition: background 0.2s;" onmouseover="this.style.background='#d1d5db'" onmouseout="this.style.background='#e5e7eb'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="display: flex; align-items: center; justify-content: center; width: calc(100% - 2rem); margin: 1rem; padding: 0.875rem 1rem; color: white; background: #ef4444; border: none; border-radius: 8px; font-size: 0.9375rem; font-weight: 600; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                            Logout
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
        <span class="welcome-badge">Halo, {{ auth()->user()->siswa->nama }} Selamat Datang ❤️</span>
        <h1>Selamat Datang<br>{{ auth()->user()->siswa->nama }}</h1>
        <p>
            Platform pembayaran digital untuk PPDB, SPP, dan Daftar Ulang siswa.
            Proses cepat, aman, dan terintegrasi dengan sistem sekolah.
        </p>
    </section>

    {{-- ========================================= --}}
    {{-- FITUR UTAMA (3 CARD MENU) --}}
    {{-- ========================================= --}}
    <section id="fitur" class="fitur-section">
        <div class="section-title">
            <h2>Fitur Utama</h2>
            <p>Silahkan Memilih Pilihan Tagihan</p>
        </div>

        <div class="card-grid">
            {{-- Card PPDB --}}
            <div class="card ppdb">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                </div>
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
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                    </svg>
                </div>
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
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                    </svg>
                </div>
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
    <section class="langkah-section" id="tutorial">
        <div class="langkah-container">
            <h2>Langkah Membayar?</h2>

            <div class="langkah-grid">
                {{-- Step 1 --}}
                <div class="langkah-item">
                    <div class="langkah-number">1</div>
                    <h4>Pilih jenis pembayaran yang ingin dibayarkan</h4>
                </div>

                {{-- Step 2 --}}
                <div class="langkah-item">
                    <div class="langkah-number">2</div>
                    <h4>Transfer ke rekening sekolah dan upload bukti</h4>
                </div>

                {{-- Step 3 --}}
                <div class="langkah-item">
                    <div class="langkah-number">3</div>
                    <h4>Tunggu verifikasi admin dan download kwitansi</h4>
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
        const closeMenuBtn = document.getElementById('closeMenuBtn');

        // Toggle menu
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
        });

        // Close with button
        closeMenuBtn.addEventListener('click', () => {
            userMenu.style.display = 'none';
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

        // ========================================
        // SMOOTH SCROLL & ACTIVE MENU
        // ========================================
        const navLinks = document.querySelectorAll('.nav-link');

        // Smooth scroll untuk link navbar
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Jika link adalah "#" (Beranda), scroll ke top
                if (href === '#') {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });

                    // Update active state
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
                // Jika link adalah anchor (#fitur, #langkah, dll)
                else if (href.startsWith('#')) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        const navbarHeight = document.querySelector('.navbar').offsetHeight;
                        const targetPosition = targetElement.offsetTop - navbarHeight - 20;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });

                        // Update active state
                        navLinks.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    }
                }
            });
        });

        // Auto update active menu saat scroll
        window.addEventListener('scroll', () => {
            const scrollPosition = window.scrollY + 150;

            // Cek apakah di posisi paling atas
            if (window.scrollY < 200) {
                navLinks.forEach(link => link.classList.remove('active'));
                navLinks[0].classList.add('active'); // Beranda active
                return;
            }

            // Cek section mana yang sedang dilihat
            const sections = ['fitur', 'langkah', 'footer'];

            sections.forEach((sectionId, index) => {
                const section = document.getElementById(sectionId);
                if (section) {
                    const sectionTop = section.offsetTop;
                    const sectionBottom = sectionTop + section.offsetHeight;

                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        navLinks.forEach(link => link.classList.remove('active'));
                        navLinks[index + 1].classList.add('active'); // +1 karena index 0 adalah Beranda
                    }
                }
            });
        });

        // ========================================
        // INTERSECTION OBSERVER UNTUK ANIMASI
        // ========================================
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe semua cards dan langkah items
        document.querySelectorAll('.card, .langkah-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>
