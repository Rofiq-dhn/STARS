<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title halaman dinamis, default "Dashboard Siswa" --}}
    {{-- @yield() = placeholder yang akan diisi dari view lain --}}
    <title>@yield('title', 'Dashboard Siswa') - STARS</title>

    {{-- CSS untuk styling halaman --}}
    <style>
        /* Reset CSS default browser */
        * {
            margin: 0;
            /* Hapus margin default */
            padding: 0;
            /* Hapus padding default */
            box-sizing: border-box;
            /* Ukuran termasuk padding & border */
        }

        /* Styling untuk body */
        body {
            font-family: Arial, sans-serif;
            /* Font default */
            display: flex;
            /* Layout flexbox */
            min-height: 100vh;
            /* Minimal tinggi 100% viewport */
        }

        /* Styling sidebar */
        .sidebar {
            width: 250px;
            /* Lebar sidebar 250px */
            background-color: #2196F3;
            /* Background biru */
            color: white;
            /* Teks putih */
            padding: 20px;
            /* Padding dalam sidebar */
            position: fixed;
            /* Posisi fixed (tidak scroll) */
            height: 100vh;
            /* Tinggi 100% viewport */
        }

        /* Styling heading di sidebar */
        .sidebar h2 {
            margin-bottom: 30px;
            /* Jarak bawah 30px */
            border-bottom: 2px solid #1976D2;
            /* Garis bawah biru tua */
            padding-bottom: 15px;
            /* Padding bawah 15px */
        }

        /* Styling list menu di sidebar */
        .sidebar ul {
            list-style: none;
            /* Hilangkan bullet point */
        }

        /* Styling item menu */
        .sidebar ul li {
            margin-bottom: 15px;
            /* Jarak antar menu 15px */
        }

        /* Styling link menu */
        .sidebar ul li a {
            color: white;
            /* Teks putih */
            text-decoration: none;
            /* Hilangkan underline */
            display: block;
            /* Display block (full width) */
            padding: 12px;
            /* Padding dalam link */
            border-radius: 5px;
            /* Sudut rounded 5px */
        }

        /* Styling link saat hover (mouse di atas) */
        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #1976D2;
            /* Background biru tua saat hover */
        }

        /* Styling konten utama */
        .content {
            margin-left: 250px;
            /* Geser 250px dari kiri (ukuran sidebar) */
            padding: 30px;
            /* Padding dalam konten */
            flex: 1;
            /* Flex grow 1 (ambil sisa space) */
            background-color: #f5f5f5;
            /* Background abu-abu muda */
        }

        /* Styling alert sukses */
        .alert-success {
            background-color: #4caf50;
            /* Background hijau */
            color: white;
            /* Teks putih */
            padding: 15px;
            /* Padding 15px */
            margin-bottom: 20px;
            /* Margin bawah 20px */
            border-radius: 5px;
            /* Sudut rounded 5px */
        }

        /* Styling table */
        table {
            background-color: white;
            /* Background putih */
        }
    </style>
</head>

<body>
    {{-- Sidebar untuk navigasi --}}
    <div class="sidebar">
        {{-- Logo/Judul aplikasi --}}
        <h2>STARS Siswa</h2>

        {{-- Info siswa yang login --}}
        {{-- auth()->user() = data user yang sedang login --}}
        {{-- ->siswa->nama = ambil nama dari relasi siswa --}}
        <p><strong>Budi Santoso</strong></p>
        <p style="font-size: 12px; margin-bottom: 20px;">Siswa</p>
        {{-- Menu navigasi --}}
        <ul>
            <li>
                {{-- Link ke dashboard siswa --}}
                {{-- route('siswa.dashboard') = generate URL dari nama route --}}
                {{-- request()->routeIs('siswa.dashboard') = cek apakah route aktif --}}
                {{-- Kalau iya, tambah class 'active' --}}
                <a href="{{ route('siswa.dashboard') }}"
                    class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                {{-- Menu lainnya bisa ditambah di sini --}}
                <a href="#">Tagihan Saya</a>
            </li>
            <li>
                <a href="#">Riwayat Pembayaran</a>
            </li>
        </ul>

        {{-- Form logout (nanti diaktifkan kalau sudah ada auth) --}}
        {{--
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 10px; background-color: transparent; border: 2px solid white; color: white; cursor: pointer; border-radius: 5px;">
                Logout
            </button>
        </form>
        --}}
    </div>

    {{-- Konten utama halaman --}}
    <div class="content">
        {{-- Alert sukses (tampil kalau ada pesan di session) --}}
        {{-- session('success') = cek apakah ada data 'success' di session --}}
        @if (session('success'))
            <div class="alert-success">
                {{-- Tampilkan pesan sukses --}}
                {{ session('success') }}
            </div>
        @endif

        {{-- Placeholder untuk konten dari view lain --}}
        {{-- Content dari dashboard.blade.php akan masuk di sini --}}
        @yield('content')
    </div>
</body>

</html>
