<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon">           
                <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 4L2 9L12 14L22 9L12 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M2 9V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>   
                    <path d="M19 10.5V16C19 16 17 18 12 18C7 18 5 16 5 16V10.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>  
                </div>
                <div class="logo-text">
                    <h1>Admin Sekolah</h1>
                    <p>Sistem Tagihan dan Pembayaran Sekolah</p>
                </div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>
                    Beranda
                </a>
                <a href="{{ route('biaya.index') }}"
                    class="nav-item {{ request()->routeIs('biaya.*') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                    Tambah Tagihan
                </a>
                <a href="#" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                                              <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                    </svg>
                    Pengaturan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header-dashboard">
                <div class="logo-nav">
                <div class="logo-icon">
                <img src="{{ asset('img/sidebar.png') }}" alt="Sidebar close">
               
            </div> 
            <div class="logo-text-nav">
                    <h1>STARS</h1>
                    <p>Sistem Tagihan dan Pembayaran Sekolah</p>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>

</html>
