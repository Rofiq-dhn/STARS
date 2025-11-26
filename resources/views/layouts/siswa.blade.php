<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'STARS')</title>
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

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
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

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-links {
                justify-content: center;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <x-logout-alert />

    {{-- NAVBAR --}}
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
            <li><a href="">Histori</a></li>
            <li><a href="#tutorial">Tutorial</a></li>
            <li><a href="#footer">Kontak</a></li>
        </ul>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="navbar-user" id="userMenuBtn" title="{{ auth()->user()->siswa->nama }}">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="200" height="39">
                    <circle cx="50" cy="35" r="15" fill="white"/>
                    <path d="M 25 70 Q 25 55 50 55 Q 75 55 75 70 L 75 80 Q 75 85 50 85 Q 25 85 25 80 Z" fill="white"/>
                </svg>
            </button>

            <div id="userMenu" class="user-menu-modal" style="display: none;">
                <div class="user-menu-content" style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); overflow: hidden; min-width: 320px;">
                    <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: flex-start; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                            <div style="width: 48px; height: 48px; background: #000; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>

                            <div style="flex: 1;">
                                <p style="margin: 0; font-weight: 600; color: #1f2937; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ auth()->user()->siswa->nama }}
                                </p>
                                <p style="margin: 0.25rem 0 0 0; font-size: 0.875rem; color: #6b7280;">
                                    {{ auth()->user()->siswa->nis }}
                                </p>
                            </div>
                        </div>

                        <button id="closeMenuBtn" style="background: #e5e7eb; border: none; border-radius: 6px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; cursor: pointer; padding: 0; flex-shrink: 0; transition: background 0.2s;" onmouseover="this.style.background='#d1d5db'" onmouseout="this.style.background='#e5e7eb'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="button" onclick="handleLogout()" style="display: flex; align-items: center; justify-content: center; width: calc(100% - 2rem); margin: 1rem; padding: 0.875rem 1rem; color: white; background: #ef4444; border: none; border-radius: 8px; font-size: 0.9375rem; font-weight: 600; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>STARS</h3>
                <p>Sistem Tagihan Dan Pembayaran Sekolah</p>
            </div>

            <ul id="footer" class="footer-links">
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

        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.style.display = userMenu.style.display === 'none' ? 'block' : 'none';
        });

        closeMenuBtn.addEventListener('click', () => {
            userMenu.style.display = 'none';
        });

        document.addEventListener('click', (e) => {
            if (!userMenu.contains(e.target) && e.target !== userMenuBtn) {
                userMenu.style.display = 'none';
            }
        });

        userMenu.addEventListener('click', (e) => {
            if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON') {
                userMenu.style.display = 'none';
            }
        });

        function handleLogout() {
            showLogoutAlert();
        }
    </script>

    @yield('scripts')
</body>
</html>
