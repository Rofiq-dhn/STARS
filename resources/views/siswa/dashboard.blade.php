@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - STARS')

@vite('resources/css/siswa/dashboard.css')
    <style>
        .hero {
            background-image: url('{{ asset("img/SMKTELKOM.png") }}');
            background-size: cover;
            background-position: center;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            min-height: 650px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 768px) {
            .hero {
                min-height: 500px;
                padding: 2rem 1rem;
            }
        }
    </style>
@section('content')
    <x-login-alert />
    {{-- HERO SECTION --}}
    <section class="hero">
        <span class="welcome-badge">Halo, {{ auth()->user()->siswa->nama }} Selamat Datang !</span>
        <h1>Selamat Datang<br>{{ auth()->user()->siswa->nama }}</h1>
        <p>
            Platform pembayaran digital untuk PPDB, SPP, dan Daftar Ulang siswa.
            Proses cepat, aman, dan terintegrasi dengan sistem sekolah.
        </p>
    </section>

    {{-- FITUR UTAMA (3 CARD MENU) --}}
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

    {{-- LANGKAH PEMBAYARAN --}}
    <section class="langkah-section" id="tutorial">
        <div class="langkah-container">
            <h2>Langkah Membayar?</h2>

            <div class="langkah-grid">
                <div class="langkah-item">
                    <div class="langkah-number">1</div>
                    <h4>Pilih jenis pembayaran yang ingin dibayarkan</h4>
                </div>

                <div class="langkah-item">
                    <div class="langkah-number">2</div>
                    <h4>Transfer ke rekening sekolah dan upload bukti</h4>
                </div>

                <div class="langkah-item">
                    <div class="langkah-number">3</div>
                    <h4>Tunggu verifikasi admin dan download kwitansi di <a class="histori" href="{{route('siswa.histori') }}">Histori</a></h4>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
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

        document.querySelectorAll('.card, .langkah-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });
    </script>
@endsection
