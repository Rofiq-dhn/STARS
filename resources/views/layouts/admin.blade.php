<!-- Layout -->
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - STARS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        /* Sidebar Styles */
        .sidebar {
            top: 0;
            width: 280px;
            background: linear-gradient(180deg, #3d3d3d 0%, #2b2b2b 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-280px);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 58px;
            height: 58px;
            border-radius: 8px;
            padding-top: 15px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-size: 24px;
        }

        .logo-text h2 {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 2px;
        }

        .logo-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,0.7);
            line-height: 1.3;
        }

        /* Navigation Menu */
        .sidebar-nav {
            padding: 20px 16px;
            padding-bottom: 100px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 8px;
        }

        .sidebar ul li a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 18px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 16px;
            font-weight: 500;
        }

        .sidebar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .sidebar ul li a.active {
            background-color: #dc2626;
            color: white;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);
        }

        .nav-icon {
            font-size: 20px;
            width: 24px;
            text-align: center;
        }

        /* Logout Button */
        .logout-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 280px;
            padding: 20px 16px;
            background: linear-gradient(to top, #2b2b2b 80%, transparent 100%);
            transition: width 0.3s ease;
        }

        .sidebar.collapsed .logout-container {
            width: 0;
            opacity: 0;
        }

        .logout-container form {
            margin: 0;
        }

        .logout-container button {
            width: 100%;
            padding: 12px;
            background-color: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            color: white;
            cursor: pointer;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-container button:hover {
            background-color: #dc2626;
            border-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 70px;
            background-color: #B30000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            z-index: 99;
            transition: left 0.3s ease;
        }

        .navbar.expanded {
            left: 0;
        }

        /* Toggle Button */
        .toggle-sidebar-btn {
            background-color: transparent;
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 20px;
        }

        .toggle-sidebar-btn:hover {
            background-color: rgba(255,255,255,0.3);
            transform: scale(1.05);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 700;
        }

        .navbar-brand-text strong {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            display: block;
            line-height: 1.2;
        }

        .navbar-brand-text small {
            font-size: 11px;
            font-weight: 400;
            color: #ffffff;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .user-role {
            display: block;
            font-size: 12px;
            color: #7f8c8d;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        /* Content Area */
        .content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 32px;
            min-height: calc(100vh - 70px);
            background-color: #f5f5f5;
            transition: margin-left 0.3s ease;
        }

        .content.expanded {
            margin-left: 0;
        }

        /* Alert Success */
        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 16px 20px;
            margin-bottom: 24px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            font-weight: 500;
        }

        .alert-success::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 50%;
            font-weight: 700;
        }

        table {
            background-color: white;
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .navbar {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .logout-container {
                position: relative;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4L2 9L12 14L22 9L12 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M2 9V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M19 10.5V16C19 16 17 18 12 18C7 18 5 16 5 16V10.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="logo-text">
                    <h2>Admin Sekolah</h2>
                    <p class="logo-subtitle">Sistem Tagihan Sekolah</p>
                </div>
            </div>
        </div>
        <div class="sidebar-nav">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="white">
                                <path d="M12 3l9 8h-3v9H6v-9H3l9-8z"/>
                            </svg>
                        </span>
                        <span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('biaya.index') }}" class="{{ request()->routeIs('biaya.*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="white">
                            <!-- Kepala -->
                            <circle cx="12" cy="8" r="4"/>
                            <!-- Badan -->
                            <path d="M4 20c0-4 4-6 8-6s8 2 8 6v1H4v-1z"/>
                            <!-- Tanda plus -->
                            <path d="M19 7h-2V5h-2V3h2V1h2v2h2v2h-2v2z"/>
                            </svg>
                        </span>
                        <span>Data Tagihan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pembayaran.index') }}" class="{{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="white">
                                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                            </svg>
                        </span>
                        <span>Data Pembayaran</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="logout-container">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" onclick="handleLogout()">
                    <span>
                    <svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    </span>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Navbar -->
    <div class="navbar" id="navbar">
        <div style="display: flex; align-items: center; gap: 16px;">
            <button class="toggle-sidebar-btn" onclick="toggleSidebar()" id="toggleBtn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="40" height="40">
                    <rect width="256" height="256" fill="none"/>
                    <rect x="35" y="35" width="186" height="186" rx="20" ry="20" fill="#ffffff"/>
                    <rect x="50" y="50" width="46" height="156" fill="#B30000"/>
                    <rect x="110" y="50" width="96" height="156" fill="#B30000"/>
                    <polyline points="165,100 145,128 165,156" fill="none" stroke="#ffffff" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="navbar-brand">

                <div class="navbar-brand-text">
                    <strong>STARS</strong>
                    <small>Sistem Tagihan Dan Pembayaran Sekolah</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content" id="content">
        <x-custom-alert/>
        <x-logout-alert/>
        @yield('content')
    </div>
</body>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const navbar = document.getElementById('navbar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggleBtn');

        sidebar.classList.toggle('collapsed');
        navbar.classList.toggle('expanded');
        content.classList.toggle('expanded');

        // Ubah icon toggle button
        if (sidebar.classList.contains('collapsed')) {
            toggleBtn.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="40" height="40"><rect width="256" height="256" fill="none"/><rect x="35" y="35" width="186" height="186" rx="20" ry="20" fill="#ffffff"/><rect x="110" y="50" width="96" height="156" fill="#B30000"/><rect x="50" y="50" width="46" height="156" fill="#B30000"/><polyline points="91,100 111,128 91,156" fill="none" stroke="#ffffff" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        } else {
            toggleBtn.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="40" height="40"><rect width="256" height="256" fill="none"/><rect x="35" y="35" width="186" height="186" rx="20" ry="20" fill="#ffffff"/><rect x="50" y="50" width="46" height="156" fill="#B30000"/><rect x="110" y="50" width="96" height="156" fill="#B30000"/><polyline points="165,100 145,128 165,156" fill="none" stroke="#ffffff" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        }
    }

    function handleLogout() {
        showLogoutAlert();
    }
</script>
</html>
