<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP - STARS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 0;
            min-height: 100vh;
        }

        /* Header dengan background merah */
        .top-header {
            background-color:#333333;
            padding: 15px 270px;
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .btn-back {
            border: none;
            color: white;
            width: 80px;
            height: 35px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            text-decoration: none;
            transition: background 0.3s;
            padding-bottom: 4px;
        }

        .breadcrumb {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            display: flex;
        }

        .breadcrumb-separator {
            margin: 0 10px;
        }

        /* Container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 25px 20px;
        }

        /* Card */
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .card-icon {
            width: 28px;
            height: 28px;
            background: #FEE;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        /* Status Grid - 2 kolom */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .info-section-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f5f5f5;
        }

        /* Data Siswa */
        .info-row {
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding: 10px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .info-label {
            font-size: 12px;
            color: #999;
        }

        .info-value {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        /* Status Pembayaran dengan scroll */
        .status-scroll {
            max-height: 280px;
            overflow-y: auto;
            padding-right: 8px;
        }

        .status-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .status-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .status-scroll::-webkit-scrollbar-thumb {
            background: #D32F2F;
            border-radius: 10px;
        }

        .status-item {
            padding: 12px 15px;
            background: #FFEBEE;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-item.lunas {
            background: #E8F5E9;
        }

        .status-month {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }

        .status-link {
            display: block;
            font-size: 11px;
            color: #2196F3;
            text-decoration: none;
            margin-top: 3px;
        }

        .status-badge {
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
        }

        .status-badge.lunas {
            background: #4caf50;
        }

        .status-badge.belum {
            background: #f44336;
        }

        /* Pilih Bulan Section */
        .bulan-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .bulan-card {
            border: 2px solid #e5e5e5;
            padding: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .bulan-card:hover:not(.disabled) {
            border-color: #D32F2F;
            background: #FFFBFB;
        }

        .bulan-card.active {
            border-color: #D32F2F;
            background: #FFF5F5;
        }

        .bulan-card.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f5f5f5;
        }

        .bulan-card input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
            pointer-events: none;
        }
        
        .bulan-title {
            font-size: 15px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .bulan-desc {
            font-size: 12px;
            color: #999;
            margin-bottom: 8px;
        }

        .bulan-price {
            font-size: 16px;
            font-weight: 700;
            color: #333;
        }

        /* Total Pembayaran */
        .total-section {
            background: #FFF5F5;
            border: 2px solid #FFCDD2;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .total-section-title {
            font-size: 15px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 13px;
            color: #666;
        }

        .total-row.final {
            font-size: 18px;
            font-weight: 700;
            color: #D32F2F;
            padding-top: 15px;
            margin-top: 15px;
            border-top: 2px solid #FFCDD2;
        }

        /* Alert Warning */
        .alert-warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            color: #856404;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Opsi Pembayaran - Selalu tampil */
        .payment-options-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .option-card {
            border: 2px solid #e5e5e5;
            padding: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .option-card:hover:not(.disabled) {
            border-color: #D32F2F;
            background: #FFFBFB;
        }

        .option-card.active {
            border-color: #D32F2F;
            background: #FFF5F5;
        }

        .option-card.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f9f9f9;
        }

        .option-card input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .option-title {
            font-size: 15px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .option-desc {
            font-size: 12px;
            color: #999;
            margin-bottom: 10px;
        }

        .option-price {
            font-size: 17px;
            font-weight: 700;
            color: #333;
        }

        /* Upload Section */
        .upload-section {
            background: #FFF5F5;
            border: 2px solid #FFCDD2;
            border-radius: 12px;
            padding: 20px;
        }

        .upload-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .upload-icon {
            width: 32px;
            height: 32px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .upload-title {
            font-size: 15px;
            font-weight: 600;
            color: #D32F2F;
        }

        .upload-subtitle {
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }

        .bank-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 18px;
            padding-bottom: 15px;
            border-bottom: 1px solid #FFCDD2;
        }

        .bank-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .bank-label {
            font-size: 11px;
            color: #999;
        }

        .bank-value {
            font-size: 13px;
            color: #333;
            font-weight: 600;
        }

        .upload-label-text {
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
            display: block;
        }

        .dropzone {
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 35px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .dropzone:hover {
            border-color: #D32F2F;
            background: #FFFBFB;
        }

        .dropzone-icon {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .dropzone-text {
            font-size: 13px;
            color: #666;
            margin-bottom: 4px;
        }

        .dropzone-hint {
            font-size: 11px;
            color: #999;
        }

        .file-preview {
            display: none;
            margin-top: 12px;
            padding: 12px 15px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            align-items: center;
            justify-content: space-between;
        }

        .file-preview.show {
            display: flex;
        }

        .file-name {
            font-size: 13px;
            color: #333;
            flex: 1;
        }

        .btn-remove {
            background: #f44336;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 500;
        }

        .btn-remove:hover {
            background: #d32f2f;
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 150px;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-submit {
            padding: 14px;
            background: linear-gradient(135deg, #D32F2F 0%, #B71C1C 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .btn-reset {
            padding: 14px;
            background: white;
            color: #666;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-reset:hover {
            border-color: #D32F2F;
            color: #D32F2F;
        }

        input[type="file"] {
            display: none;
        }

        /* History Table */
        .history-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f5f5f5;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .history-table thead {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
        }

        .history-table th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
        }

        .history-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #f5f5f5;
        }

        .history-table tbody tr:hover {
            background: #FFFBFB;
        }

        .history-status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            color: white;
            display: inline-block;
        }

        .history-status-lunas {
            background: #4caf50;
        }

        .history-status-pending {
            background: #ff9800;
        }

        .btn-download {
            padding: 6px 12px;
            background: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-download:hover {
            background: #45a049;
        }

        .waiting-text {
            color: #999;
            font-size: 11px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .bulan-grid,
            .options-grid {
                grid-template-columns: 1fr;
            }

            .bank-info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .history-table {
                font-size: 11px;
            }

            .history-table th,
            .history-table td {
                padding: 8px 6px;
            }
        }
    </style>
</head>
<body>
    {{-- Header dengan background merah --}}
    <div class="top-header">
        <a href="{{ route('siswa.dashboard') }}" class="btn-back">←Kembali</a>
        <div>
            <div class="breadcrumb">
                <span class="breadcrumb-separator">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="red">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                    </svg>
                </span> <p>Pembayaran SPP</p>
            </div>
        </div>
    </div>

    <div class="container">
        {{-- Card Info & Status --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">💳</div>
                <div class="card-title">Pembayaran SPP</div>
            </div>

            <div class="info-grid">
                {{-- Data Siswa --}}
                <div class="info-section">
                    <div class="info-section-title">Data Siswa</div>
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $siswa->nama }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NISN</span>
                        <span class="info-value">{{ $siswa->nis }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kelas</span>
                        <span class="info-value">{{ $siswa->kelas_siswa }} {{ $siswa->jurusan }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tahun Ajaran</span>
                        <span class="info-value">{{ $tahunAjaran }}</span>
                    </div>
                </div>

                {{-- Status Pembayaran dengan Scroll --}}
                <div class="info-section">
                    <div class="info-section-title">Status Pembayaran</div>
                    <div class="status-scroll">
                        @foreach($bulanList as $index => $bulan)
                            @php
                                $tahunBulan = $index < 6 ? '2025' : '2026';
                                $pembayaranBulan = $pembayaran->where('bulan', $bulan)->first();
                                $isLunas = $statusBulan[$bulan] == 'lunas';
                            @endphp
                            <div class="status-item {{ $isLunas ? 'lunas' : '' }}">
                                <div>
                                    <div class="status-month">{{ $bulan }} {{ $tahunBulan }}</div>
                                    @if($isLunas && $pembayaranBulan && $pembayaranBulan->kwitansi)
                                        <a href="{{ route('pembayaran.download-kwitansi', $pembayaranBulan->id_pembayaran) }}" class="status-link">
                                            📄 Download Kwitansi
                                        </a>
                                    @endif
                                </div>
                                <span class="status-badge {{ $isLunas ? 'lunas' : 'belum' }}">
                                    {{ $isLunas ? 'Lunas' : 'Belum Lunas' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Pembayaran --}}
        <form action="{{ route('siswa.spp.store') }}" method="POST" enctype="multipart/form-data" id="formSPP">
            @csrf
            <input type="hidden" name="id_biaya" value="{{ $biaya->id_biaya }}">
            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
            <input type="hidden" name="nominal_dibayar" id="nominalDibayar">

            {{-- Card Pilih Bulan --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📅</div>
                    <div class="card-title">Pilih Bulan Pembayaran</div>
                </div>

                <div class="bulan-grid">
                    @foreach($bulanList as $index => $bulan)
                        @php
                            $isLunas = $statusBulan[$bulan] == 'lunas';
                            $tahunBulan = $index < 6 ? '2025' : '2026';

                            $indexBatas = $index + 2;
                            if ($indexBatas >= 12) {
                                $indexBatas = $indexBatas - 12;
                                $tahunBatas = $index < 6 ? '2026' : '2027';
                            } else {
                                $tahunBatas = $indexBatas < 6 ? '2025' : '2026';
                            }
                            $bulanBatas = $bulanList[$indexBatas];
                            $batasTanggal = "Jatuh tempo: 10 " . $bulanBatas . " " . $tahunBatas;
                        @endphp
                        <div class="bulan-card {{ $isLunas ? 'disabled' : '' }}"
                             id="bulan_{{ $bulan }}"
                             onclick="{{ $isLunas ? '' : 'toggleBulan(this, \'' . $bulan . '\')' }}">
                            <input type="checkbox" name="bulan[]" value="{{ $bulan }}" id="check_{{ $bulan }}" {{ $isLunas ? 'disabled' : '' }}>
                            <div class="bulan-title">{{ $bulan }} {{ $tahunBulan }}</div>
                            <div class="bulan-desc">{{ $isLunas ? '✓ Sudah Lunas' : $batasTanggal }}</div>
                            @if(!$isLunas)
                            <div class="bulan-price">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Total Section - Hidden sampai pilih bulan --}}
                <div class="total-section" id="totalSection" style="display: none;">
                    <div class="total-section-title">Total pembayaran</div>
                    <div id="totalList"></div>
                    <div class="total-row final">
                        <span>Total</span>
                        <span id="totalFinal">Rp 0</span>
                    </div>
                </div>
            </div>

            {{-- Warning Multiple Bulan --}}
            <div class="alert-warning" id="warningMultiple" style="display: none;">
                <span style="font-size: 18px;">⚠️</span>
                <div>
                    <strong>Perhatian:</strong> Anda memilih lebih dari 1 bulan. Pembayaran hanya bisa Lunas (tidak bisa cicil).
                </div>
            </div>

            {{-- Card Opsi Pembayaran - Selalu Tampil --}}
            <div class="card">
                <div class="payment-options-title">
                    <span>💳</span>
                    <span>Opsi Pembayaran</span>
                </div>

                <div class="options-grid">
                    <div class="option-card" onclick="pilihOpsi('lunas')" id="cardLunas">
                        <input type="radio" name="tipe_bayar" value="lunas" id="opsiLunas">
                        <div class="option-title">Lunas</div>
                        <div class="option-desc">Bayar Sekaligus</div>
                        <div class="option-price" id="hargaLunas">Rp 0</div>
                    </div>

                    <div class="option-card" onclick="pilihOpsi('cicilan')" id="cardCicilan">
                        <input type="radio" name="tipe_bayar" value="cicilan" id="opsiCicilan">
                        <div class="option-title">Cicil</div>
                        <div class="option-desc">Cicil dua Kali bayar</div>
                        <div class="option-price" id="hargaCicilan">Rp 0/bulan</div>
                    </div>
                </div>
            </div>

            {{-- Card Upload - Selalu Tampil --}}
            <div class="card">
                <div class="upload-section">
                    <div class="upload-header">
                        <div class="upload-icon">💳</div>
                        <div class="upload-title">Kirim Bukti Transfer</div>
                    </div>

                    <p class="upload-subtitle">
                        Transfer ke rekening sekolah dan upload bukti
                    </p>

                    <div class="bank-info-grid">
                        <div class="bank-item">
                            <span class="bank-label">Bank BNI</span>
                            <span class="bank-value">1234567890</span>
                        </div>
                        <div class="bank-item">
                            <span class="bank-label">Atas Nama</span>
                            <span class="bank-value">SMK Telkom Banjarbaru</span>
                        </div>
                    </div>

                    <label class="upload-label-text">Upload Bukti Pembayaran</label>

                    <div class="dropzone" id="dropzone" onclick="document.getElementById('fileInput').click()">
                        <div class="dropzone-icon">⬇️</div>
                        <div class="dropzone-text">Pilih File Gambar (PNG, JPG) atau PDF</div>
                        <div class="dropzone-hint">Maksimal 10MB</div>
                    </div>

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept="image/*,application/pdf" onchange="handleFileSelect(this)">

                    <div class="file-preview" id="filePreview">
                        <span class="file-name" id="fileName"></span>
                        <button type="button" class="btn-remove" onclick="removeFile()">Hapus</button>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn-submit" id="btnSubmit" disabled>
                        <span>💳</span>
                        <span>Bayar</span>
                    </button>
                    <button type="button" class="btn-reset" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </form>
    <script>
        const biayaPerBulan = {{ $biaya->biaya }};
        let bulanDipilih = [];

        function toggleBulan(element, bulan) {
            const checkbox = document.getElementById('check_' + bulan);
            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                element.classList.add('active');
                bulanDipilih.push(bulan);
            } else {
                element.classList.remove('active');
                bulanDipilih = bulanDipilih.filter(b => b !== bulan);
            }

            updateTotal();
        }

        function updateTotal() {
            const jumlah = bulanDipilih.length;
            const total = jumlah * biayaPerBulan;

            if (jumlah > 0) {
                document.getElementById('totalSection').style.display = 'block';

                let listHTML = '';
                bulanDipilih.forEach(b => {
                    listHTML += `<div class="total-row"><span>Spp ${b}</span><span>Rp ${formatRupiah(biayaPerBulan)}</span></div>`;
                });
                document.getElementById('totalList').innerHTML = listHTML;
                document.getElementById('totalFinal').textContent = 'Rp ' + formatRupiah(total);

                document.getElementById('hargaLunas').textContent = 'Rp ' + formatRupiah(total);
                document.getElementById('hargaCicilan').textContent = 'Rp ' + formatRupiah(total / 2) + '/bulan';

                // Logic cicilan - disable jika lebih dari 1 bulan
                const cardCicilan = document.getElementById('cardCicilan');
                const opsiCicilan = document.getElementById('opsiCicilan');

                if (jumlah > 1) {
                    document.getElementById('warningMultiple').style.display = 'block';
                    cardCicilan.classList.add('disabled');
                    opsiCicilan.disabled = true;

                    // Auto select lunas jika cicilan sedang aktif
                    if (opsiCicilan.checked) {
                        document.getElementById('opsiLunas').checked = true;
                        pilihOpsi('lunas');
                    }
                } else {
                    document.getElementById('warningMultiple').style.display = 'none';
                    cardCicilan.classList.remove('disabled');
                    opsiCicilan.disabled = false;
                }
            } else {
                document.getElementById('totalSection').style.display = 'none';
                document.getElementById('warningMultiple').style.display = 'none';

                // Reset harga ke 0
                document.getElementById('hargaLunas').textContent = 'Rp 0';
                document.getElementById('hargaCicilan').textContent = 'Rp 0/bulan';

                // Enable cicilan kembali
                const cardCicilan = document.getElementById('cardCicilan');
                const opsiCicilan = document.getElementById('opsiCicilan');
                cardCicilan.classList.remove('disabled');
                opsiCicilan.disabled = false;
            }

            checkFormValidity();
        }

        function pilihOpsi(opsi) {
            const cardLunas = document.getElementById('cardLunas');
            const cardCicilan = document.getElementById('cardCicilan');
            const opsiCicilan = document.getElementById('opsiCicilan');
            const total = bulanDipilih.length * biayaPerBulan;

            // Jangan lakukan apapun jika cicilan disabled
            if (opsi === 'cicilan' && opsiCicilan.disabled) {
                return;
            }

            cardLunas.classList.remove('active');
            cardCicilan.classList.remove('active');

            if (opsi === 'lunas') {
                document.getElementById('opsiLunas').checked = true;
                cardLunas.classList.add('active');
                document.getElementById('nominalDibayar').value = total;
            } else {
                document.getElementById('opsiCicilan').checked = true;
                cardCicilan.classList.add('active');
                document.getElementById('nominalDibayar').value = total / 2;
            }

            checkFormValidity();
        }

        function handleFileSelect(input) {
            const file = input.files[0];
            if (file) {
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('filePreview').classList.add('show');
                document.getElementById('dropzone').style.display = 'none';
            }
            checkFormValidity();
        }

        function removeFile() {
            document.getElementById('fileInput').value = '';
            document.getElementById('filePreview').classList.remove('show');
            document.getElementById('dropzone').style.display = 'block';
            checkFormValidity();
        }

        function resetForm() {
            document.getElementById('formSPP').reset();

            // Reset semua bulan card
            document.querySelectorAll('.bulan-card').forEach(card => {
                card.classList.remove('active');
            });

            // Reset opsi card
            document.getElementById('cardLunas').classList.remove('active');
            document.getElementById('cardCicilan').classList.remove('active');

            // Reset array bulan
            bulanDipilih = [];

            // Reset file
            removeFile();

            // Reset nominal
            document.getElementById('nominalDibayar').value = '';

            // Update tampilan
            updateTotal();
        }

        function checkFormValidity() {
            const opsiDipilih = document.querySelector('input[name="tipe_bayar"]:checked');
            const fileDipilih = document.getElementById('fileInput').files.length > 0;
            const bulanDipilih = document.querySelectorAll('input[name="bulan[]"]:checked').length > 0;

            document.getElementById('btnSubmit').disabled = !(opsiDipilih && fileDipilih && bulanDipilih);
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        // Drag and drop
        const dropzone = document.getElementById('dropzone');

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#D32F2F';
            dropzone.style.background = '#FFFBFB';
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.style.borderColor = '#ddd';
            dropzone.style.background = 'white';
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#ddd';
            dropzone.style.background = 'white';
            const file = e.dataTransfer.files[0];
            if (file) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                document.getElementById('fileInput').files = dataTransfer.files;
                handleFileSelect(document.getElementById('fileInput'));
            }
        });
    </script>
</body>
</html>
