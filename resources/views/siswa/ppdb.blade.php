<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran PPDB - STARS</title>
    <style>
        /* Reset CSS */
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
            position: relative;
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
            padding-bottom: 4px;
            height: 35px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 600;
        }

        .breadcrumb {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            display: flex;
        }

        .breadcrumb-separator {
            margin: 0 8px;
        }

        /* Container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 25px 20px;
        }

        /* Card dengan shadow lebih soft */
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
            margin-bottom: 10px;
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

        .card-description {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Info Grid - 2 kolom */
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

        .info-row {
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding: 10px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .info-row:last-child {
            border-bottom: none;
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

        .info-row.total .info-label {
            font-weight: 600;
            color: #333;
        }

        .info-row.total .info-value {
            color: #D32F2F;
            font-size: 16px;
            font-weight: 700;
        }

        /* Payment Options */
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

        .option-card:hover {
            border-color: #D32F2F;
            background: #FFFBFB;
        }

        .option-card.active {
            border-color: #D32F2F;
            background: #FFF5F5;
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

        /* Upload Section dengan pink background */
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
            background: linear-gradient(135deg, #D32F2F 0%, #B71C1C 100%);
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

        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            color: white;
            display: inline-block;
        }

        .status-lunas {
            background: #4caf50;
        }

        .status-pending {
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 24" fill="red">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                </span> <p>Pembayaran PPDB</p>
            </div>
        </div>
    </div>

    <div class="container">
        {{-- Card Info Pembayaran --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">🎓</div>
                <div class="card-title">Pembayaran PPDB</div>
            </div>
            <p class="card-description">
                Pembayaran untuk pendaftaran siswa baru tahun ajaran 2024/2025. Pastikan semua data sudah benar sebelum melakukan pembayaran.
            </p>

            <div class="info-grid">
                {{-- Detail Pembayaran --}}
                <div class="info-section">
                    <div class="info-section-title">Detail Pembayaran</div>
                    @if($biaya)
                    <div class="info-row">
                        <span class="info-label">Detail Pembayaran</span>
                        <span class="info-value">Rp {{ number_format($biaya->biaya * 0.25, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Biaya Seragam</span>
                        <span class="info-value">Rp {{ number_format($biaya->biaya * 0.45, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Biaya Buku</span>
                        <span class="info-value">Rp {{ number_format($biaya->biaya * 0.30, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-row total">
                        <span class="info-label">Detail Pembayaran</span>
                        <span class="info-value">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</span>
                    </div>
                    @endif
                </div>

                {{-- Data Calon Siswa --}}
                <div class="info-section">
                    <div class="info-section-title">Data Calon Siswa</div>
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $siswa->nama }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NISN</span>
                        <span class="info-value">{{ $siswa->nis }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kelas Tujuan</span>
                        <span class="info-value">{{ $siswa->kelas_siswa }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tahun Ajaran</span>
                        <span class="info-value">{{ $tahunAjaran }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Pembayaran --}}
        <form action="{{ route('siswa.ppdb.store') }}" method="POST" enctype="multipart/form-data" id="formPembayaran">
            @csrf
            <input type="hidden" name="id_biaya" value="{{ $biaya->id_biaya }}">
            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
            <input type="hidden" name="nominal_dibayar" id="nominalDibayar" value="">

            {{-- Card Opsi Pembayaran --}}
            <div class="card">
                <div class="payment-options-title">
                    <span>💳</span>
                    <span>Opsi Pembayaran</span>
                </div>

                <div class="options-grid">
                    {{-- Lunas --}}
                    <div class="option-card" onclick="pilihOpsi('lunas')" id="cardLunas">
                        <input type="radio" name="tipe_bayar" value="lunas" id="opsiLunas" required>
                        <div class="option-title">Lunas</div>
                        <div class="option-desc">Bayar Sekaligus</div>
                        <div class="option-price">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</div>
                    </div>

                    {{-- Cicil --}}
                    <div class="option-card" onclick="pilihOpsi('cicilan')" id="cardCicilan">
                        <input type="radio" name="tipe_bayar" value="cicilan" id="opsiCicilan" required>
                        <div class="option-title">Cicil</div>
                        <div class="option-desc">Cicil dua Kali bayar</div>
                        <div class="option-price">Rp {{ number_format($biaya->biaya / 2, 0, ',', '.') }}/bulan</div>
                    </div>
                </div>
            </div>

            {{-- Card Upload Bukti --}}
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

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept="image/*,application/pdf" required onchange="handleFileSelect(this)">

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

        {{-- History Pembayaran --}}
        @if($pembayaran->count() > 0)
            <div class="card" style="margin-top: 20px;">
                <div class="history-title">
                    <span>📋</span>
                    <span>History Pembayaran PPDB</span>
                </div>

                <table class="history-table">
                    <thead>
                        <tr>
                            <th style="width: 40px; text-align: center;">No</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Sisa</th>
                            <th style="text-align: center;">Cicilan</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $item)
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>
                                <td style="text-align: center;">{{ $item->cicilan_ke }} / {{ $item->total_cicilan }}</td>
                                <td style="text-align: center;">
                                    <span class="status-badge {{ $item->status == 'lunas' ? 'status-lunas' : 'status-pending' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if($item->status == 'lunas' && $item->kwitansi)
                                        <a href="{{ route('pembayaran.download-kwitansi', $item->id_pembayaran) }}" class="btn-download">
                                            📄 Download
                                        </a>
                                    @else
                                        <span class="waiting-text">Menunggu verifikasi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        const totalBiaya = {{ $biaya->biaya }};
        const nominalInput = document.getElementById('nominalDibayar');
        const btnSubmit = document.getElementById('btnSubmit');

        function pilihOpsi(opsi) {
            const cardLunas = document.getElementById('cardLunas');
            const cardCicilan = document.getElementById('cardCicilan');
            const radioLunas = document.getElementById('opsiLunas');
            const radioCicilan = document.getElementById('opsiCicilan');

            cardLunas.classList.remove('active');
            cardCicilan.classList.remove('active');

            if (opsi === 'lunas') {
                radioLunas.checked = true;
                cardLunas.classList.add('active');
                nominalInput.value = totalBiaya;
            } else {
                radioCicilan.checked = true;
                cardCicilan.classList.add('active');
                nominalInput.value = totalBiaya / 2;
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
            document.getElementById('formPembayaran').reset();
            document.getElementById('cardLunas').classList.remove('active');
            document.getElementById('cardCicilan').classList.remove('active');
            removeFile();
            nominalInput.value = '';
            btnSubmit.disabled = true;
        }

        function checkFormValidity() {
            const opsiDipilih = document.querySelector('input[name="tipe_bayar"]:checked');
            const fileDipilih = document.getElementById('fileInput').files.length > 0;

            btnSubmit.disabled = !(opsiDipilih && fileDipilih);
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
