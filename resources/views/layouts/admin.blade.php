<!DOCTYPE html>
<html lang="en">
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
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
        }

        .sidebar {
            width: 250px; /* DIPERBAIKI: Titik koma, bukan koma */
            background-color: #ff4343;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2); /* DIPERBAIKI: Warna border lebih soft */
            padding-bottom: 15px;
            color: #fff;
            font-weight: bold;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.15); /* DIPERBAIKI: Transparansi lebih baik */
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #c93636; /* DIPERBAIKI: Warna lebih kontras */
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0; /* DIPERBAIKI: Ditambahkan */
            left: 250px; /* DIPERBAIKI: Sesuai lebar sidebar */
            right: 0; /* DIPERBAIKI: Supaya full width */
            height: 60px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 99;
        }

        .navbar-brand {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            display: block; /* DIPERBAIKI: Ditambahkan */
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .user-role {
            display: block; /* DIPERBAIKI: Ditambahkan */
            font-size: 12px;
            color: #7f8c8d;
            background-color: #B71C1C;
/* >>>>>>> origin/backend */
        }

        .content {
            margin-left: 250px; /* DIPERBAIKI: Sesuai lebar sidebar, bukan 300px */
            margin-top: 60px; /* DIPERBAIKI: Sesuai tinggi navbar */
            padding: 30px;
            min-height: calc(100vh - 60px);
            background-color: #ecf0f1;
        }

        /* Alert Success */
        .alert-success {
            background-color: #4caf50;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        table {
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>STARS Admin</h2>

        {{-- Tampilkan nama admin yang login --}}
        {{-- auth()->user()->admin->nama = ambil nama dari relasi admin --}}
        <p><strong>{{ auth()->user()->admin->nama }}</strong></p>
        <p style="font-size: 12px; margin-bottom: 20px;">Administrator</p>

        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    🏠 Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('biaya.index') }}" class="{{ request()->routeIs('biaya.*') ? 'active' : '' }}">
                    💰 Tambah Tagihan
                </a>
            </li>
            <li>
                <a href="{{ route('pembayaran.index') }}" class="{{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                    Data Pembayaran
                </a>
            </li>
        </ul>

        {{-- Form Logout --}}
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 10px; background-color: transparent; border: 2px solid white; color: white; cursor: pointer; border-radius: 5px;">
                Logout
            </button>
        </form>
    </div>

    <!-- Navbar - DIPERBAIKI: Dipindahkan keluar dari sidebar -->
    <div class="navbar">
        <div class="navbar-brand">
            <strong>STARS</strong><br>
            <small style="font-size: 12px; font-weight: normal;">Sistem Tagihan Dan Pembayaran Sekolah</small>
        </div>
        <div class="navbar-user">
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
                <span class="user-role">Administrator</span>
            </div>
        </div>
    </div>

    <!-- Content Area - DIPERBAIKI: Struktur lebih sederhana -->
    <div class="content">
        @if(session('success'))
            <div class="alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
