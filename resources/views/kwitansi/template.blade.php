<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{-- Title untuk PDF --}}
    <title>Kwitansi Pembayaran</title>

    {{-- CSS untuk styling kwitansi --}}
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling body */
        body {
            font-family: Arial, sans-serif;  /* Font default */
            padding: 40px;                   /* Padding luar */
            font-size: 14px;                 /* Ukuran font default */
        }

        /* Header kwitansi */
        .header {
            text-align: center;              /* Teks center */
            border-bottom: 3px solid #333;   /* Garis bawah tebal */
            padding-bottom: 20px;            /* Padding bawah */
            margin-bottom: 30px;             /* Margin bawah */
        }

        .header h1 {
            font-size: 24px;                 /* Font besar untuk judul */
            margin-bottom: 5px;              /* Jarak bawah */
            color: #D32F2F;                  /* Warna merah STARS */
        }

        .header p {
            font-size: 12px;                 /* Font kecil untuk subtitle */
            color: #666;                     /* Warna abu-abu */
        }

        /* Info kwitansi (no & tanggal) */
        .info {
            margin-bottom: 30px;             /* Jarak bawah */
        }

        .info table {
            width: 100%;                     /* Lebar full */
        }

        .info table td {
            padding: 5px 0;                  /* Padding atas-bawah */
        }

        /* Content utama */
        .content {
            margin-bottom: 30px;             /* Jarak bawah */
        }

        .content h3 {
            margin-bottom: 10px;             /* Jarak bawah heading */
            color: #333;                     /* Warna gelap */
        }

        .content table {
            width: 100%;                     /* Lebar full */
            border-collapse: collapse;       /* Hilangkan jarak antar cell */
        }

        .content table td {
            padding: 8px 0;                  /* Padding atas-bawah */
            border-bottom: 1px dashed #ddd;  /* Garis putus-putus */
        }

        .content table td:first-child {
            width: 200px;                    /* Lebar kolom pertama */
            font-weight: bold;               /* Teks bold */
        }

        /* Total pembayaran (highlight) */
        .total {
            background-color: #f5f5f5;       /* Background abu-abu muda */
            padding: 15px;                   /* Padding dalam */
            border-radius: 5px;              /* Sudut rounded */
            margin: 20px 0;                  /* Margin atas-bawah */
        }

        .total table td {
            padding: 5px 0;                  /* Padding atas-bawah */
        }

        .total .amount {
            font-size: 20px;                 /* Font besar */
            font-weight: bold;               /* Bold */
            color: #D32F2F;                  /* Warna merah */
        }

        /* Tanda tangan */
        .signature {
            margin-top: 50px;                /* Jarak atas besar */
            text-align: right;               /* Align kanan */
        }

        .signature p {
            margin-bottom: 80px;             /* Jarak untuk tempat TTD */
        }

        /* Footer kwitansi */
        .footer {
            margin-top: 50px;                /* Jarak atas */
            text-align: center;              /* Teks center */
            font-size: 11px;                 /* Font kecil */
            color: #999;                     /* Warna abu-abu muda */
            border-top: 1px solid #ddd;      /* Garis atas */
            padding-top: 20px;               /* Padding atas */
        }
    </style>
</head>
<body>
    {{-- Header Kwitansi --}}
    <div class="header">
        <h1>KWITANSI PEMBAYARAN</h1>
        <p>STARS - Sistem Tagihan Dan Pembayaran Sekolah</p>
    </div>

    {{-- Info Kwitansi (No & Tanggal) --}}
    <div class="info">
        <table>
            <tr>
                <td style="width: 150px;"><strong>No. Kwitansi</strong></td>
                {{-- Generate nomor kwitansi otomatis --}}
                {{-- 'KWT' = prefix --}}
                {{-- date('Ymd', strtotime($pembayaran->created_at)) = tanggal format YYYYMMDD --}}
                {{-- str_pad() = padding angka dengan leading zero (misal: 001, 002) --}}
                <td>: KWT-{{ date('Ymd', strtotime($pembayaran->created_at)) }}-{{ str_pad($pembayaran->id_pembayaran, 3, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal</strong></td>
                {{-- Tampilkan tanggal pembayaran --}}
                {{-- Carbon::parse() = parse string tanggal jadi object Carbon --}}
                {{-- ->locale('id') = set locale Indonesia --}}
                {{-- ->isoFormat() = format tanggal dengan format custom --}}
                <td>: {{ \Carbon\Carbon::parse($pembayaran->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
        </table>
    </div>

    {{-- Content: Data Siswa & Pembayaran --}}
    <div class="content">
        <h3>Sudah Terima Dari:</h3>
        <table>
            <tr>
                <td>Nama</td>
                {{-- Tampilkan nama siswa dari relasi --}}
                <td>: {{ $pembayaran->siswa->nama }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                {{-- Tampilkan NIS siswa --}}
                <td>: {{ $pembayaran->siswa->nis }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                {{-- Tampilkan kelas siswa --}}
                <td>: {{ $pembayaran->siswa->kelas_siswa }}</td>
            </tr>
            <tr>
                <td>Jurusan</td>
                {{-- Tampilkan jurusan siswa --}}
                <td>: {{ $pembayaran->siswa->jurusan }}</td>
            </tr>
        </table>
    </div>

    <div class="content">
        <h3>Untuk Pembayaran:</h3>
        <table>
            <tr>
                <td>Kategori</td>
                {{-- Tampilkan kategori biaya (SPP, PPDB, dll) --}}
                <td>: {{ $pembayaran->biaya->kategori }}</td>
            </tr>
            <tr>
                <td>Periode</td>
                {{-- Tampilkan bulan & tahun pembayaran --}}
                <td>: {{ $pembayaran->bulan }} {{ $pembayaran->tahun }}</td>
            </tr>
        </table>
    </div>

    {{-- Total Pembayaran (Highlight) --}}
    <div class="total">
        <table style="width: 100%;">
            <tr>
                <td style="width: 200px; font-weight: bold;">Uang Sejumlah</td>
                {{-- Tampilkan nominal dengan format Rupiah --}}
                <td class="amount">: Rp {{ number_format($pembayaran->nominal_dibayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Terbilang</td>
                {{-- Tampilkan nominal dalam huruf --}}
                {{-- Helper function terbilang() nanti kita buat --}}
                <td>: {{ terbilang($pembayaran->nominal_dibayar) }} Rupiah</td>
            </tr>
        </table>
    </div>

    {{-- Status Pembayaran --}}
    <div class="content">
        <table>
            <tr>
                <td>Status</td>
                <td>: <strong style="color: #4caf50;">{{ strtoupper($pembayaran->status) }}</strong></td>
            </tr>
            @if($pembayaran->sisa_pembayaran > 0)
                <tr>
                    <td>Sisa Pembayaran</td>
                    <td>: Rp {{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}</td>
                </tr>
            @endif
        </table>
    </div>

    {{-- Tanda Tangan --}}
    <div class="signature">
        {{-- Tampilkan kota & tanggal saat kwitansi dibuat --}}
        <p>Yogyakarta, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
        <p><strong>Petugas Administrasi</strong></p>
        <br><br>
        <p style="margin-top: 0;">_______________________</p>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Kwitansi ini sah dan diproses oleh sistem STARS</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }} WIB</p>
    </div>
</body>
</html>
