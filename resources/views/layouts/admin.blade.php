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
            top : 0;
            width: 280px;
            background: linear-gradient(180deg, #3d3d3d 0%, #2b2b2b 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background-color: #dc2626;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .logo-text h2 {
            font-size: 16px;
            font-weight: 700;
            color: white;
            margin-bottom: 2px;
        }

        .logo-subtitle {
            font-size: 11px;
            color: rgba(255,255,255,0.7);
            line-height: 1.3;
        }

        /* Navigation Menu */
        .sidebar-nav {
            padding: 20px 16px;
            padding-bottom: 100px; /* Beri ruang untuk logout button */
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 4px;
        }

        .sidebar ul li a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
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
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            z-index: 99;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
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
            color: #2c3e50;
            display: block;
            line-height: 1.2;
        }

        .navbar-brand-text small {
            font-size: 11px;
            font-weight: 400;
            color: #7f8c8d;
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
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">🎓</div>
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
                        <span class="nav-icon">🏠</span>
                        <span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('biaya.index') }}" class="{{ request()->routeIs('biaya.*') ? 'active' : '' }}">
                        <span class="nav-icon">📋</span>
                        <span>Data Tagihan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pembayaran.index') }}" class="{{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                        <span class="nav-icon">💳</span>
                        <span>Data Pembayaran</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <span>🚪</span>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-brand">
            <div class="navbar-brand-icon">F</div>
            <div class="navbar-brand-text">
                <strong>STARS</strong>
                <small>Sistem Tagihan Dan Pembayaran Sekolah</small>
            </div>
        </div>
        <div class="navbar-user">
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
                <span class="user-role">Administrator</span>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>