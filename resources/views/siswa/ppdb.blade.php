<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran PPDB - STARS</title>
    @vite('resources/css/siswa/ppdb.css')
</head>
<body>
    <x-payment-alert />
    {{-- Header dengan background merah --}}
    <div class="top-header">
        <a href="{{ route('siswa.dashboard') }}" class="btn-back">
            <span><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="30" height="30">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="#FFFFFF"/>
                </svg></span>Kembali
            </a>
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
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="red">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                </div>
                <div class="card-title">Pembayaran PPDB</div>
            </div>
            <p class="card-description">
                Pembayaran untuk calon siswa yang sedang tahap PPDB 2024/2025. Pastikan semua tahap telah selesai
                melakukan pembayaran.
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
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="red">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="red">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
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
                        <div class="dropzone-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40"
                                            height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 3l5 5h-3v6h-4V8H7l5-5z" />
                                            <rect x="4" y="18" width="16" height="3" rx="1" /></svg></div>
                        <div class="dropzone-text">Pilih File Gambar (PNG, JPG) atau PDF</div>
                        <div class="dropzone-hint">Maksimal 10MB</div>
                    </div>

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" required
                        onchange="handleFileSelect(this)">

                    <div class="file-preview" id="filePreview">
                        <span class="file-name" id="fileName"></span>
                        <button type="button" class="btn-remove" onclick="removeFile()">Hapus</button>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn-submit" id="btnSubmit" disabled>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="black">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                    </svg>
                        </span>
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

        // Override form submit untuk menampilkan alert
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
