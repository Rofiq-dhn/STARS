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

        /* Pilih Bulan */
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

        .bulan-card h4 {
            font-size: 15px;
            margin-bottom: 5px;
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

        .bulan-card input[type="checkbox"] {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Total Pembayaran */
        .total-section {
            background: #fff5f5;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #D32F2F;
            margin-bottom: 25px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
        }

        .total-row.final {
            font-size: 18px;
            font-weight: bold;
            color: #D32F2F;
            padding-top: 15px;
            margin-top: 15px;
            border-top: 2px solid #ffcdd2;
        }

        /* Opsi & Upload sama seperti PPDB */
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

        .opsi-card.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .opsi-card input[type="radio"] {
            margin-bottom: 10px;
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

        input[type="file"],
        input[type="checkbox"] {
            display: none;
        }

        .alert-warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            color: #856404;
            font-size: 14px;
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
                    {{-- Scroll container untuk semua bulan --}}
                    <div class="status-scroll">
                        @foreach($bulanList as $index => $bulan)
                            {{-- Tentukan tahun untuk tiap bulan --}}
                            @php
                                // Juli-Desember = tahun pertama (2025)
                                // Januari-Juni = tahun kedua (2026)
                                $tahunBulan = $index < 6 ? '2025' : '2026';

                                // Cari data pembayaran untuk bulan ini
                                $pembayaranBulan = $pembayaran->where('bulan', $bulan)->first();
                            @endphp
                            <div class="status-item {{ $statusBulan[$bulan] == 'lunas' ? 'lunas' : '' }}">
                                <div>
                                    <label style="font-weight: bold;">{{ $bulan }} {{ $tahunBulan }}</label>

                                    {{-- Kalau lunas, tampilkan tombol download --}}
                                    @if($statusBulan[$bulan] == 'lunas' && $pembayaranBulan && $pembayaranBulan->kwitansi)
                                        <a href="{{ route('pembayaran.download-kwitansi', $pembayaranBulan->id_pembayaran) }}"
                                           style="display: block; font-size: 11px; color: #2196F3; margin-top: 3px; text-decoration: none;">
                                            📄 Download Kwitansi
                                        </a>
                                    @endif
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

            {{-- Card Pilih Bulan --}}
            <div class="card">
                <div class="card-title">
                    📅 Pilih Bulan Pembayaran
                </div>

                <div class="bulan-grid">
                    @foreach($bulanList as $index => $bulan)
                        @php
                            $isLunas = $statusBulan[$bulan] == 'lunas';

                            // Tentukan tahun untuk tiap bulan
                            // Juli-Desember = tahun pertama (2025)
                            // Januari-Juni = tahun kedua (2026)
                            $tahunBulan = $index < 6 ? '2025' : '2026';

                            // Hitung batas pembayaran (2 bulan setelahnya)
                            $indexBatas = $index + 2; // +2 bulan

                            // Kalau index batas >= 12, wrap ke tahun berikutnya
                            if ($indexBatas >= 12) {
                                $indexBatas = $indexBatas - 12;
                                $tahunBatas = $index < 6 ? '2026' : '2027';
                            } else {
                                // Tentukan tahun batas berdasarkan index batas
                                $tahunBatas = $indexBatas < 6 ? '2025' : '2026';
                            }

                            // Ambil nama bulan batas
                            $bulanBatas = $bulanList[$indexBatas];

                            // Format batas tanggal
                            $batasTanggal = "10 " . $bulanBatas . " " . $tahunBatas;
                        @endphp
                        <div class="bulan-card {{ $isLunas ? 'disabled' : '' }}"
                             id="bulan_{{ $bulan }}"
                             onclick="{{ $isLunas ? '' : 'toggleBulan(this, \'' . $bulan . '\')' }}">
                            <input type="checkbox" name="bulan[]" value="{{ $bulan }}" id="check_{{ $bulan }}" {{ $isLunas ? 'disabled' : '' }}>
                            <h4>{{ $bulan }} {{ $tahunBulan }}</h4>
                            <p>{{ $isLunas ? '✓ Sudah Lunas' : 'Batas tanggal ' . $batasTanggal }}</p>
                            @if(!$isLunas)
                            <div class="price">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Total Section --}}
                <div class="total-section" id="totalSection" style="display: none;">
                    <h4 style="margin-bottom: 15px;">Total pembayaran</h4>
                    <div id="totalList"></div>
                    <div class="total-row final">
                        <span>Total</span>
                        <span id="totalFinal">Rp 0</span>
                    </div>
                </div>
            </div>

            {{-- Warning untuk multiple bulan --}}
            <div class="alert-warning" id="warningMultiple" style="display: none;">
                ⚠️ <strong>Perhatian:</strong> Anda memilih lebih dari 1 bulan. Pembayaran hanya bisa Lunas (tidak bisa cicil).
            </div>

            {{-- Card Opsi Pembayaran --}}
            <div class="card" id="opsiCard" style="display: none;">
                <div class="card-title">
                    💳 Opsi Pembayaran
                </div>

                <div class="opsi-grid">
                    <div class="opsi-card" onclick="pilihOpsi('lunas')" id="cardLunas">
                        <input type="radio" name="tipe_bayar" value="lunas" id="opsiLunas">
                        <h4>Lunas</h4>
                        <p>Bayar sekaligus</p>
                        <div class="price" id="hargaLunas">Rp 0</div>
                    </div>

                    <div class="opsi-card" onclick="pilihOpsi('cicilan')" id="cardCicilan">
                        <input type="radio" name="tipe_bayar" value="cicilan" id="opsiCicilan">
                        <h4>Cicil</h4>
                        <p>Cicil dua Kali bayar</p>
                        <div class="price" id="hargaCicilan">Rp 0/bulan</div>
                    </div>
                </div>

                <input type="hidden" name="nominal_dibayar" id="nominalDibayar">
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

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept="image/*,application/pdf" onchange="handleFileSelect(this)">

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

        {{-- History Pembayaran SPP --}}
        @if($pembayaran->count() > 0)
            <div class="card" style="margin-top: 20px;">
                <h3 style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #ddd;">
                    📋 History Pembayaran SPP
                </h3>

                <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #2196F3; color: white;">
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Sisa</th>
                            <th>Cicilan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran->sortBy('created_at') as $item)
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>
                                <td style="text-align: center;">{{ $item->cicilan_ke }} / {{ $item->total_cicilan }}</td>
                                <td style="text-align: center;">
                                    <span style="
                                        padding: 5px 10px;
                                        border-radius: 12px;
                                        font-size: 12px;
                                        color: white;
                                        background-color: {{ $item->status == 'lunas' ? '#4caf50' : '#ff9800' }};
                                    ">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if($item->status == 'lunas' && $item->kwitansi)
                                        <a href="{{ route('pembayaran.download-kwitansi', $item->id_pembayaran) }}"
                                           style="padding: 6px 12px; background-color: #4caf50; color: white; text-decoration: none; border-radius: 5px; display: inline-block; font-size: 12px;">
                                            📄 Download
                                        </a>
                                    @else
                                        <span style="color: #999; font-size: 12px;">Menunggu verifikasi</span>
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
                document.getElementById('opsiCard').style.display = 'block';
                document.getElementById('uploadCard').style.display = 'block';

                let listHTML = '';
                bulanDipilih.forEach(b => {
                    listHTML += `<div class="total-row"><span>Spp ${b}</span><span>Rp ${formatRupiah(biayaPerBulan)}</span></div>`;
                });
                document.getElementById('totalList').innerHTML = listHTML;
                document.getElementById('totalFinal').textContent = 'Rp ' + formatRupiah(total);

                document.getElementById('hargaLunas').textContent = 'Rp ' + formatRupiah(total);
                document.getElementById('hargaCicilan').textContent = 'Rp ' + formatRupiah(total / 2) + '/bayar';

                // Logic cicilan
                const cardCicilan = document.getElementById('cardCicilan');
                const opsiCicilan = document.getElementById('opsiCicilan');
                if (jumlah > 1) {
                    document.getElementById('warningMultiple').style.display = 'block';
                    cardCicilan.classList.add('disabled');
                    opsiCicilan.disabled = true;
                    document.getElementById('opsiLunas').checked = true;
                    pilihOpsi('lunas');
                } else {
                    document.getElementById('warningMultiple').style.display = 'none';
                    cardCicilan.classList.remove('disabled');
                    opsiCicilan.disabled = false;
                }
            } else {
                document.getElementById('totalSection').style.display = 'none';
                document.getElementById('opsiCard').style.display = 'none';
                document.getElementById('uploadCard').style.display = 'none';
                document.getElementById('warningMultiple').style.display = 'none';
            }
        }

        function pilihOpsi(opsi) {
            const cardLunas = document.getElementById('cardLunas');
            const cardCicilan = document.getElementById('cardCicilan');
            const total = bulanDipilih.length * biayaPerBulan;

            cardLunas.classList.remove('active');
            cardCicilan.classList.remove('active');

            if (opsi === 'lunas') {
                document.getElementById('opsiLunas').checked = true;
                cardLunas.classList.add('active');
                document.getElementById('nominalDibayar').value = total;
            } else {
                if (bulanDipilih.length > 1) return;
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

        function checkFormValidity() {
            const opsiDipilih = document.querySelector('input[name="tipe_bayar"]:checked');
            const fileDipilih = document.getElementById('fileInput').files.length > 0;

            document.getElementById('btnSubmit').disabled = !(opsiDipilih && fileDipilih && bulanDipilih.length > 0);
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }
    </script>
</body>
</html>
