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
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #D32F2F;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            border-bottom: 2px solid #B71C1C;
            padding-bottom: 15px;
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
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #B71C1C;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            flex: 1;
            background-color: #f5f5f5;
        }

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
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('biaya.index') }}" class="{{ request()->routeIs('biaya.*') ? 'active' : '' }}">
                    Data Biaya
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
