<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP - STARS</title>
    @vite('resources/css/siswa/spp.css')
</head>
<body>
    <x-payment-alert />
    {{-- Header dengan background merah --}}
    <div class="top-header">
        <a href="{{ route('siswa.dashboard') }}" class="btn-back"><span><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="30" height="30">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="#FFFFFF"/>
                </svg></span>Kembali
            </a>
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
                            $batasTanggal = "10 " . $bulanBatas . " " . $tahunBatas;
                        @endphp
                        <div class="bulan-card {{ $isLunas ? 'disabled' : '' }}"
                             id="bulan_{{ $bulan }}"
                             onclick="{{ $isLunas ? '' : 'pilihBulan(\'' . $bulan . '\')' }}">
                            <h4>{{ $bulan }} {{ $tahunBulan }}</h4>
                            <p>{{ $isLunas ? '✓ Sudah Lunas' : 'Batas tanggal ' . $batasTanggal }}</p>
                            @if(!$isLunas)
                            <div class="bulan-price">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Card Opsi Pembayaran - Selalu Tampil --}}
            <div class="card">
    <div class="card-header">
        <div class="card-icon">💳</div>
        <div class="card-title">Opsi Pembayaran</div>
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
                        <div class="dropzone-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40"
                                            height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 3l5 5h-3v6h-4V8H7l5-5z" />
                                            <rect x="4" y="18" width="16" height="3" rx="1" /></svg></div>
                        <div class="dropzone-text">Pilih File Gambar (PNG, JPG) atau PDF</div>
                        <div class="dropzone-hint">Maksimal 10MB</div>
                    </div>

                    <input type="file" name="bukti_pembayaran" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" onchange="handleFileSelect(this)">

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

            // Cek apakah cicilan disabled
            if (opsi === 'cicilan' && cardCicilan.classList.contains('disabled')) {
                return;
            }

            // Reset semua card
            cardLunas.classList.remove('active');
            cardCicilan.classList.remove('active');

            // Aktifkan yang dipilih
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
            const bulanTerpilih = document.getElementById('bulanTerpilih').value;
            const tipeBayar = document.getElementById('tipeBayar').value;
            const fileDipilih = document.getElementById('fileInput').files.length > 0;
            const bulanDipilih = document.querySelectorAll('input[name="bulan[]"]:checked').length > 0;

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

        // Override form submit untuk menampilkan alert
        document.getElementById('formSPP').addEventListener('submit', function(e) {
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
