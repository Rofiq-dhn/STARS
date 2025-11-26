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
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .btn-back {
            width: 40px;
            height: 40px;
            background: #f5f5f5;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            text-decoration: none;
            color: #333;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            color: #D32F2F;
            font-weight: bold;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Status Grid */
        .status-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .status-section h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        /* Container untuk status dengan scroll */
        .status-scroll {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }

        /* Custom scrollbar */
        .status-scroll::-webkit-scrollbar {
            width: 6px;
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
            display: flex;
            justify-content: space-between;
            padding: 12px 15px;
            background: #ffebee;
            border-radius: 5px;
            margin-bottom: 8px;
        }

        .status-item.lunas {
            background: #e8f5e9;
        }

        .status-item label {
            font-size: 14px;
            color: #333;
        }

        .status-badge {
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 12px;
            font-weight: bold;
        }

        .status-badge.lunas {
            background: #4caf50;
            color: white;
        }

        .status-badge.belum {
            background: #f44336;
            color: white;
        }

        /* Pilih Bulan - Radio Button Style */
        .bulan-section {
            margin-bottom: 25px;
        }

        .bulan-section h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .bulan-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .bulan-card {
            border: 2px solid #e0e0e0;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .bulan-card:hover:not(.disabled) {
            border-color: #D32F2F;
        }

        .bulan-card.active {
            border-color: #D32F2F;
            background: #ffebee;
        }

        .bulan-card.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f5f5f5;
        }

        /* Hilangkan radio button */

        .bulan-card h4 {
            font-size: 15px;
            margin-bottom: 5px;
            padding-right: 30px;
        }

        .bulan-card p {
            font-size: 13px;
            color: #666;
        }

        .bulan-card .price {
            font-size: 16px;
            font-weight: bold;
            color: #D32F2F;
            margin-top: 5px;
        }

        /* Opsi Pembayaran */
        .opsi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .opsi-card {
            border: 2px solid #e0e0e0;
            padding: 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .opsi-card:hover {
            border-color: #D32F2F;
        }

        .opsi-card.active {
            border-color: #D32F2F;
            background: #ffebee;
        }

        .opsi-card h4 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .opsi-card p {
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        .opsi-card .price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        /* Upload Section */
        .upload-section {
            background: #fff5f5;
            border: 2px solid #ffcdd2;
            border-radius: 8px;
            padding: 25px;
        }

        .upload-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .upload-header h4 {
            font-size: 16px;
            color: #D32F2F;
        }

        .bank-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ffcdd2;
        }

        .bank-item {
            font-size: 13px;
        }

        .bank-item label {
            color: #999;
            display: block;
            margin-bottom: 3px;
        }

        .bank-item strong {
            color: #333;
        }

        .dropzone {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .dropzone:hover {
            border-color: #D32F2F;
            background: #fff5f5;
        }

        .dropzone-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .dropzone-text {
            font-size: 14px;
            color: #666;
        }

        .dropzone-hint {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .file-preview {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .file-preview.show {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-remove {
            background: #f44336;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: #D32F2F;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background: #B71C1C;
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="header">
            <a href="{{ route('siswa.dashboard') }}" class="btn-back">←</a>
            <div class="header-title">
                💳 Pembayaran SPP
            </div>
        </div>

        {{-- Card Status & Data Siswa --}}
        <div class="card">
            <div class="card-title">
                💳 Pembayaran SPP
            </div>

            <div class="status-grid">
                {{-- Data Siswa --}}
                <div class="status-section">
                    <h3>Data Siswa</h3>
                    <div style="font-size: 14px; line-height: 2;">
                        <div><strong>Nama Siswa:</strong> {{ $siswa->nama }}</div>
                        <div><strong>NIS:</strong> {{ $siswa->nis }}</div>
                        <div><strong>Kelas:</strong> {{ $siswa->kelas_siswa }} {{ $siswa->jurusan }}</div>
                        <div><strong>Tahun Ajaran:</strong> {{ $tahunAjaran }}</div>
                    </div>
                </div>

                {{-- Status Pembayaran --}}
                <div class="status-section">
                    <h3>Status Pembayaran</h3>
                    <div class="status-scroll">
                        @foreach($bulanList as $index => $bulan)
                            @php
                                $tahunBulan = $index < 6 ? '2025' : '2026';
                                $pembayaranBulan = $pembayaran->where('bulan', $bulan)->first();
                            @endphp
                            <div class="status-item {{ $statusBulan[$bulan] == 'lunas' ? 'lunas' : '' }}">
                                <div>
                                    <label style="font-weight: bold;">{{ $bulan }} {{ $tahunBulan }}</label>
                                </div>
                                <span class="status-badge {{ $statusBulan[$bulan] == 'lunas' ? 'lunas' : 'belum' }}">
                                    {{ $statusBulan[$bulan] == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
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
            <input type="hidden" name="bulan" id="bulanTerpilih">

            {{-- Card Pilih Bulan --}}
            <div class="card">
                <div class="card-title">
                    📅 Pilih Bulan Pembayaran
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
                            $batasTanggal = "10 " . $bulanBatas . " " . $tahunBatas;
                        @endphp
                        <div class="bulan-card {{ $isLunas ? 'disabled' : '' }}"
                             id="bulan_{{ $bulan }}"
                             onclick="{{ $isLunas ? '' : 'pilihBulan(\'' . $bulan . '\')' }}">
                            <h4>{{ $bulan }} {{ $tahunBulan }}</h4>
                            <p>{{ $isLunas ? '✓ Sudah Lunas' : 'Batas tanggal ' . $batasTanggal }}</p>
                            @if(!$isLunas)
                            <div class="price">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Card Opsi Pembayaran --}}
            <div class="card" id="opsiCard" style="display: none;">
                <div class="card-title">
                    💳 Opsi Pembayaran
                </div>

                <div class="opsi-grid">
                    <div class="opsi-card" onclick="pilihOpsi('lunas')" id="cardLunas">
                        <h4>Lunas</h4>
                        <p>Bayar sekaligus</p>
                        <div class="price">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</div>
                    </div>

                    <div class="opsi-card" onclick="pilihOpsi('cicilan')" id="cardCicilan">
                        <h4>Cicil</h4>
                        <p>Cicil dua kali bayar</p>
                        <div class="price">Rp {{ number_format($biaya->biaya / 2, 0, ',', '.') }}/bayar</div>
                    </div>
                </div>

                <input type="hidden" name="nominal_dibayar" id="nominalDibayar">
                <input type="hidden" name="tipe_bayar" id="tipeBayar">
            </div>

            {{-- Card Upload --}}
            <div class="card" id="uploadCard" style="display: none;">
                <div class="upload-section">
                    <div class="upload-header">
                        <span style="font-size: 24px;">💳</span>
                        <h4>Kirim Bukti Transfer</h4>
                    </div>

                    <div class="bank-info">
                        <div class="bank-item">
                            <label>Bank BNI</label>
                            <strong>1234567890</strong>
                        </div>
                        <div class="bank-item">
                            <label>Atas Nama</label>
                            <strong>SMK Telkom Banjarbaru</strong>
                        </div>
                    </div>

                    <div class="dropzone" id="dropzone" onclick="document.getElementById('fileInput').click()">
                        <div class="dropzone-icon">⬇️</div>
                        <div class="dropzone-text">Pilih File Gambar (PNG, JPG) atau PDF</div>
                        <div class="dropzone-hint">Maksimal 10MB</div>
                    </div>

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" onchange="handleFileSelect(this)">

                    <div class="file-preview" id="filePreview">
                        <span id="fileName"></span>
                        <button type="button" class="btn-remove" onclick="removeFile()">Hapus</button>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="btnSubmit" disabled>
                    Kirim Pembayaran
                </button>
            </div>
        </form>
    </div>

    <script>
        const biayaPerBulan = {{ $biaya->biaya }};
        let bulanDipilih = null;

        function pilihBulan(bulan) {
            // Reset semua card
            document.querySelectorAll('.bulan-card:not(.disabled)').forEach(card => {
                card.classList.remove('active');
            });

            // Aktifkan yang dipilih
            const card = document.getElementById('bulan_' + bulan);
            card.classList.add('active');
            bulanDipilih = bulan;

            // Set hidden input
            document.getElementById('bulanTerpilih').value = bulan;

            // Tampilkan card opsi & upload
            document.getElementById('opsiCard').style.display = 'block';
            document.getElementById('uploadCard').style.display = 'block';

            checkFormValidity();
        }

        function pilihOpsi(opsi) {
            const cardLunas = document.getElementById('cardLunas');
            const cardCicilan = document.getElementById('cardCicilan');

            cardLunas.classList.remove('active');
            cardCicilan.classList.remove('active');

            if (opsi === 'lunas') {
                cardLunas.classList.add('active');
                document.getElementById('tipeBayar').value = 'lunas';
                document.getElementById('nominalDibayar').value = biayaPerBulan;
            } else {
                cardCicilan.classList.add('active');
                document.getElementById('tipeBayar').value = 'cicilan';
                document.getElementById('nominalDibayar').value = biayaPerBulan / 2;
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

        function checkFormValidity() {
            const bulanTerpilih = document.getElementById('bulanTerpilih').value;
            const tipeBayar = document.getElementById('tipeBayar').value;
            const fileDipilih = document.getElementById('fileInput').files.length > 0;

            document.getElementById('btnSubmit').disabled = !(bulanTerpilih && tipeBayar && fileDipilih);
        }

        // Drag and drop
        const dropzone = document.getElementById('dropzone');

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#D32F2F';
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.style.borderColor = '#ddd';
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.style.borderColor = '#ddd';
            const file = e.dataTransfer.files[0];
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('fileInput').files = dataTransfer.files;
            handleFileSelect(document.getElementById('fileInput'));
        });
    </script>
</body>
</html>
