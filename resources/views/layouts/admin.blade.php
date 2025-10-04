<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
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
            overflow-y: auto;
        }

        .sidebar h2 {
            margin-bottom: 10px;
            text-align: center;
            font-size: 24px;
        }

        .sidebar .user-info {
            text-align: center;
            padding: 15px 0;
            border-bottom: 2px solid #B71C1C;
            margin-bottom: 30px;
            font-size: 14px;
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
            padding: 12px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #B71C1C;
        }

        .sidebar ul li a.active {
            background-color: #B71C1C;
        }

        .logout-btn {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #B71C1C;
        }

        .logout-btn form button {
            width: 100%;
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn form button:hover {
            background-color: white;
            color: #D32F2F;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            flex: 1;
            background-color: #ecf0f1;
            min-height: 100vh;
        }

        .content h1 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .alert-success {
            background-color: #2ecc71;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>STARS</h2>
        <div class="user-info">
            <strong>{{ Auth::user()->getNama() }}</strong><br>
            <small>{{ Auth::user()->level === 'admin' ? 'Administrator' : 'Siswa' }}</small>
        </div>

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
        </ul>

        <div class="logout-btn">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
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
