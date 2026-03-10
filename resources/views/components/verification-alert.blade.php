<!-- filepath: d:\Laravel\STARS\resources\views\components\verification-alert.blade.php -->
<div id="verificationAlert" class="verification-alert-overlay" style="display: none;">
    <div class="verification-alert-container">
        <div class="verification-alert-content">
            <div class="verification-alert-icon" id="verificationIcon">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path d="M15 30L25 40L45 20" stroke="#00ff00" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="verification-alert-text">
                <h3 class="verification-alert-title" id="verificationTitle">Verifikasi Pembayaran</h3>
                <p class="verification-alert-message" id="verificationMessage">Yakin ingin memverifikasi pembayaran ini?
                </p>
            </div>
        </div>
        <div class="verification-alert-buttons">
            <button type="button" class="btn-cancel" onclick="closeVerificationAlert()">Batal</button>
            <button type="button" class="btn-confirm" id="confirmVerifyBtn">Verifikasi</button>
        </div>
    </div>
</div>

<style>
    .verification-alert-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .verification-alert-container {
        background: white;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        max-width: 600px;
        width: 90%;
        animation: slideDown 0.3s ease;
        overflow: hidden;
        border-left: 8px solid #00ff00;
    }

    .verification-alert-container.alert-danger {
        border-left-color: #ff0000;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .verification-alert-content {
        display: flex;
        align-items: center;
        padding: 30px 40px;
        gap: 25px;
    }

    .verification-alert-icon {
        flex-shrink: 0;
    }

    .verification-alert-text {
        flex: 1;
    }

    .verification-alert-title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0 0 8px 0;
    }

    .verification-alert-message {
        font-size: 14px;
        color: #666;
        margin: 0;
        line-height: 1.5;
    }

    .verification-alert-buttons {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        padding: 20px 40px;
        background-color: #f9f9f9;
        border-top: 1px solid #eee;
    }

    .btn-cancel,
    .btn-confirm {
        padding: 10px 30px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-cancel {
        background-color: white;
        color: #333;
        border: 2px solid #ddd;
    }

    .btn-cancel:hover {
        background-color: #f5f5f5;
        border-color: #bbb;
    }

    .btn-confirm {
        background-color: #00ff00;
        color: #ffffff;
    }

    .btn-confirm:hover {
        background-color: #00cc00;
    }

    /* Variasi untuk reject/tolak */
    .verification-alert-container.alert-danger .btn-confirm {
        background-color: #ff0000;
        color: white;
    }

    .verification-alert-container.alert-danger .btn-confirm:hover {
        background-color: #cc0000;
    }

    .verification-alert-container.alert-danger .verification-alert-icon svg {
        stroke: #ff0000;
    }
</style>

<script>
    let currentVerificationForm = null;
    let verificationMode = 'verify';

    // Fungsi untuk menampilkan alert verifikasi
    function showVerificationAlert(formId, mode = 'verify') {
        const alert = document.getElementById('verificationAlert');
        const container = alert.querySelector('.verification-alert-container');
        const title = document.getElementById('verificationTitle');
        const message = document.getElementById('verificationMessage');
        const icon = document.getElementById('verificationIcon');
        const confirmBtn = document.getElementById('confirmVerifyBtn');

        // Cari form
        currentVerificationForm = document.getElementById(formId);

        // Debug: pastikan form ditemukan
        if (!currentVerificationForm) {
            console.error('Form tidak ditemukan dengan ID:', formId);
            alert('Error: Form tidak ditemukan! Silakan refresh halaman.');
            return;
        }

        verificationMode = mode;

        if (mode === 'verify') {
            container.classList.remove('alert-danger');
            title.textContent = 'Verifikasi Pembayaran';
            message.textContent = 'Yakin ingin memverifikasi pembayaran ini sebagai LUNAS? Kwitansi akan otomatis digenerate.';
            confirmBtn.textContent = 'Ya, Verifikasi';
            confirmBtn.className = 'btn-confirm';

            icon.innerHTML = `
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path d="M15 30L25 40L45 20" stroke="#00ff00" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            `;
        } else if (mode === 'reject') {
            container.classList.add('alert-danger');
            title.textContent = 'Tolak Pembayaran';
            message.textContent = 'Tolak pembayaran ini? Data dan file bukti transfer akan DIHAPUS PERMANEN dan tidak bisa dikembalikan!';
            confirmBtn.textContent = 'Ya, Tolak & Hapus';
            confirmBtn.className = 'btn-confirm';

            icon.innerHTML = `
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <circle cx="30" cy="30" r="28" stroke="#ff0000" stroke-width="2" fill="none"/>
                    <line x1="20" y1="20" x2="40" y2="40" stroke="#ff0000" stroke-width="3" stroke-linecap="round"/>
                    <line x1="40" y1="20" x2="20" y2="40" stroke="#ff0000" stroke-width="3" stroke-linecap="round"/>
                </svg>
            `;
        }

        alert.style.display = 'flex';
    }

    // Fungsi untuk menutup alert
    function closeVerificationAlert() {
        const alert = document.getElementById('verificationAlert');
        alert.style.display = 'none';
        currentVerificationForm = null;
    }

    // Fungsi untuk submit form verifikasi
    function submitVerificationForm() {
        if (!currentVerificationForm) {
            console.error('Form tidak tersedia!');
            alert('Error: Form tidak ditemukan! Silakan refresh halaman dan coba lagi.');
            return;
        }

        // PERBAIKAN: SIMPAN REFERENSI FORM SEBELUM CLOSE ALERT
        const formToSubmit = currentVerificationForm; // ← INI KUNCINYA!
        const formId = formToSubmit.id;
        const isVerify = formId === 'formVerifikasi';

        // Dapatkan elemen alert
        const alert = document.getElementById('verificationAlert');
        const container = alert.querySelector('.verification-alert-container');
        const title = document.getElementById('verificationTitle');
        const messageEl = document.getElementById('verificationMessage');
        const icon = document.getElementById('verificationIcon');
        const buttons = document.querySelector('.verification-alert-buttons');

        // Ubah ke success alert
        container.classList.remove('alert-danger');
        container.style.borderLeftColor = '#00ff00';

        title.textContent = 'Memproses...';
        messageEl.textContent = isVerify ? 'Sedang memverifikasi pembayaran...' : 'Sedang menolak pembayaran...';

        icon.innerHTML = `
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                <circle cx="30" cy="30" r="25" stroke="#00ff00" stroke-width="4" fill="none" stroke-dasharray="157" stroke-dashoffset="0">
                    <animateTransform attributeName="transform" type="rotate" from="0 30 30" to="360 30 30" dur="1s" repeatCount="indefinite"/>
                </circle>
            </svg>
        `;

        buttons.style.display = 'none';

        // Submit form setelah delay singkat
        setTimeout(() => {
            formToSubmit.submit(); // ← GUNAKAN VARIABEL YANG DISIMPAN
        }, 800);
    }

    // Event listener untuk tombol confirm
    document.addEventListener('DOMContentLoaded', function() {
        const confirmBtn = document.getElementById('confirmVerifyBtn');
        const overlay = document.getElementById('verificationAlert');

        if (confirmBtn) {
            confirmBtn.addEventListener('click', submitVerificationForm);
        }

        // Close alert when clicking outside
        if (overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    closeVerificationAlert();
                }
            });
        }
    });
</script>

