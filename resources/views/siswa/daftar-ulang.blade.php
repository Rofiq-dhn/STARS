<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Daftar Ulang - STARS</title>
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .card-description {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .info-section h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item label {
            font-size: 14px;
            color: #666;
        }

        .info-item strong {
            font-size: 14px;
            color: #333;
        }

        .info-item.total strong {
            color: #D32F2F;
            font-size: 16px;
        }

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

        .upload-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            display: block;
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
                📝 Pembayaran Daftar Ulang
            </div>
        </div>

        {{-- Card Info --}}
        <div class="card">
            <div class="card-title">
                📝 Pembayaran Daftar Ulang
            </div>
            <p class="card-description">
                Pembayaran daftar ulang untuk melanjutkan pendidikan ke tingkat yang lebih tinggi. Siswa wajib melakukan
                daftar ulang sebelum tahun ajaran baru dimulai.
            </p>

            <div class="info-grid">
                {{-- Data Siswa --}}
                <div class="info-section">
                    <h3>Data Siswa</h3>
                    <div class="info-item">
                        <label>Nama Siswa</label>
                        <strong>{{ $siswa->nama }}</strong>
                    </div>
                    <div class="info-item">
                        <label>NISN</label>
                        <strong>{{ $siswa->nis }}</strong>
                    </div>
                    <div class="info-item">
                        <label>Kelas Saat Ini</label>
                        <strong>{{ $siswa->kelas_siswa }} {{ $siswa->jurusan }}</strong>
                    </div>
                    <div class="info-item">
                        <label>Kelas Tujuan</label>
                        @php
                            $kelasTujuan = ((int) $siswa->kelas_siswa) + 1;
                        @endphp
                        <strong>{{ $kelasTujuan }} {{ $siswa->jurusan }}</strong>
                    </div>
                </div>

                {{-- Detail Pembayaran --}}
                <div class="info-section">
                    <h3>Detail Pembayaran</h3>
                    @if ($biaya)
                        <div class="info-item">
                            <label>Biaya Daftar ulang</label>
                            <strong>Rp {{ number_format($biaya->biaya * 0.25, 0, ',', '.') }}</strong>
                        </div>
                        <div class="info-item">
                            <label>Dana pembangunan</label>
                            <strong>Rp {{ number_format($biaya->biaya * 0.45, 0, ',', '.') }}</strong>
                        </div>
                        <div class="info-item">
                            <label>Biaya Kegiatan</label>
                            <strong>Rp {{ number_format($biaya->biaya * 0.3, 0, ',', '.') }}</strong>
                        </div>
                        <div class="info-item total">
                            <label><strong>Detail Pembayaran</strong></label>
                            <strong>Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('siswa.daftar-ulang.store') }}" method="POST" enctype="multipart/form-data"
            id="formPembayaran">
            @csrf
            <input type="hidden" name="id_biaya" value="{{ $biaya->id_biaya }}">
            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">

            {{-- Opsi --}}
            <div class="card">
                <div class="card-title">
                    💳 Opsi Pembayaran
                </div>

                <div class="opsi-grid">
                    <div class="opsi-card" onclick="pilihOpsi('lunas')" id="cardLunas">
                        <input type="radio" name="tipe_bayar" value="lunas" id="opsiLunas" required>
                        <h4>Lunas</h4>
                        <p>Bayar sekaligus</p>
                        <div class="price">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</div>
                    </div>

                    <div class="opsi-card" onclick="pilihOpsi('cicilan')" id="cardCicilan">
                        <input type="radio" name="tipe_bayar" value="cicilan" id="opsiCicilan" required>
                        <h4>Cicil</h4>
                        <p>Cicil dua Kali bayar</p>
                        <div class="price">Rp {{ number_format($biaya->biaya / 2, 0, ',', '.') }}/bulan</div>
                    </div>
                </div>

                <input type="hidden" name="nominal_dibayar" id="nominalDibayar" value="">
            </div>

            {{-- Upload --}}
            <div class="card">
                <div class="upload-section">
                    <div class="upload-header">
                        <span style="font-size: 24px;">💳</span>
                        <h4>Kirim Bukti Transfer</h4>
                    </div>

                    <p style="font-size: 13px; color: #666; margin-bottom: 15px;">
                        Transfer ke rekening sekolah dan upload bukti
                    </p>

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

                    <label class="upload-label">Upload Bukti Pembayaran</label>

                    <div class="dropzone" id="dropzone" onclick="document.getElementById('fileInput').click()">
                        <div class="dropzone-icon">⬇️</div>
                        <div class="dropzone-text">Pilih File Gambar (PNG, JPG) atau PDF</div>
                        <div class="dropzone-hint">Maksimal 10MB</div>
                    </div>

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" required
                        onchange="handleFileSelect(this)">

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

        {{-- History Pembayaran --}}
        @if ($pembayaran->count() > 0)
            <div class="card" style="margin-top: 20px;">
                <h3 style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #ddd;">
                    📋 History Pembayaran Daftar Ulang
                </h3>

                <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #7B1FA2; color: white;">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Sisa</th>
                            <th>Cicilan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $item)
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>Rp {{ number_format($item->nominal_dibayar, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>
                                <td style="text-align: center;">{{ $item->cicilan_ke }} / {{ $item->total_cicilan }}
                                </td>
                                <td style="text-align: center;">
                                    <span
                                        style="
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
                                    @if ($item->status == 'lunas' && $item->kwitansi)
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

        function checkFormValidity() {
            const opsiDipilih = document.querySelector('input[name="tipe_bayar"]:checked');
            const fileDipilih = document.getElementById('fileInput').files.length > 0;

            if (opsiDipilih && fileDipilih) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
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
