<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Daftar Ulang - STARS</title>
    @vite('resources/css/siswa/daftarulang.css')
</head>
<body>
    <x-payment-alert />
    {{-- Header dengan background merah --}}
    <div class="top-header">
        <a href="{{ route('siswa.dashboard') }}" class="btn-back">←Kembali</a>
        <div>
            <div class="breadcrumb">
                <span class="breadcrumb-separator">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="red">
                        <path
                            d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                    </svg>
                </span>
                <p>Pembayaran Daftar Ulang</p>
            </div>
        </div>
    </div>

    <div class="container">
        {{-- Card Info Pembayaran --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                        fill="red">
                        <path
                            d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                    </svg>
                </div>
                <div class="card-title">Pembayaran Daftar Ulang</div>
            </div>
            <p class="card-description">
                Pembayaran daftar ulang untuk melanjutkan pendidikan ke tingkat yang lebih tinggi. Siswa wajib melakukan
                daftar ulang sebelum tahun ajaran baru dimulai.
            </p>

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
                        <span class="info-label">Kelas Saat Ini</span>
                        <span class="info-value">{{ $siswa->kelas_siswa }} {{ $siswa->jurusan }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kelas Tujuan</span>
                        @php
                            $kelasTujuan = ((int) $siswa->kelas_siswa) + 1;
                        @endphp
                        <span class="info-value">{{ $kelasTujuan }} {{ $siswa->jurusan }}</span>
                    </div>
                </div>

                {{-- Detail Pembayaran --}}
                <div class="info-section">
                    <div class="info-section-title">Detail Pembayaran</div>
                    @if ($biaya)
                        <div class="info-row">
                            <span class="info-label">Biaya Daftar ulang</span>
                            <span class="info-value">Rp {{ number_format($biaya->biaya * 0.25, 0, ',', '.') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Dana pembangunan</span>
                            <span class="info-value">Rp {{ number_format($biaya->biaya * 0.45, 0, ',', '.') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Biaya Kegiatan</span>
                            <span class="info-value">Rp {{ number_format($biaya->biaya * 0.3, 0, ',', '.') }}</span>
                        </div>
                        <div class="info-row total">
                            <span class="info-label">Detail Pembayaran</span>
                            <span class="info-value">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Form Pembayaran --}}
        <form action="{{ route('siswa.daftar-ulang.store') }}" method="POST" enctype="multipart/form-data"
            id="formPembayaran">
            @csrf
            <input type="hidden" name="id_biaya" value="{{ $biaya->id_biaya }}">
            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
            <input type="hidden" name="nominal_dibayar" id="nominalDibayar" value="">

            {{-- Card Opsi Pembayaran --}}
            <div class="card">
                <div class="payment-options-title">
                    <span>
                        <svg width="40" height="40" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            fill="none" stroke="red" stroke-width="3" stroke-linecap="round">
                            <line x1="4" y1="6" x2="20" y2="6" />
                            <line x1="4" y1="12" x2="20" y2="12" />
                            <line x1="4" y1="18" x2="20" y2="18" />
                        </svg>
                    </span>
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
                        <div class="upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                viewBox="0 0 24 24" fill="red">
                                <path
                                    d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                            </svg>
                        </div>
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
                        <div class="dropzone-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3l5 5h-3v6h-4V8H7l5-5z" />
                                <rect x="4" y="18" width="16" height="3" rx="1" />
                            </svg>
                        </div>
                        <div class="dropzone-text">Pilih File Gambar (PNG, JPG) atau PDF</div>
                        <div class="dropzone-hint">Maksimal 10MB</div>
                    </div>

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept=".jpg,.jpeg,.png,.pdf"
                        required onchange="handleFileSelect(this)">

                    <div class="file-preview" id="filePreview">
                        <span class="file-name" id="fileName"></span>
                        <button type="button" class="btn-remove" onclick="removeFile()">Hapus</button>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn-submit" id="btnSubmit" disabled>
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="black">
                                <path
                                    d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                            </svg></span>
                        <span>Bayar</span>
                    </button>
                    <button type="button" class="btn-reset" onclick="resetForm()">Reset</button>
                </div>
            </div>
        </form>
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

        document.getElementById('formPembayaran').addEventListener('submit', function(e) {
        e.preventDefault();

        // Tampilkan alert sukses
        showPaymentAlert({
            title: 'Pembayaran Dikirim',
            message: 'Bukti pembayaran sedang diverifikasi admin',
            type: 'success',
            duration: 2000
        });

        // Submit form setelah alert ditampilkan
        setTimeout(() => {
            this.submit();
        }, 500);
    });
    </script>
</body>
</html>
