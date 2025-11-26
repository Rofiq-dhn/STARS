<!-- resources/views/components/custom-alert.blade.php -->
<div id="customAlert" class="custom-alert-overlay" style="display: none;">
    <div class="custom-alert-container">
        <div class="custom-alert-content">
            <div class="custom-alert-icon-check" id="alertIcon">
                <!-- Icon Success (Centang) -->
                <svg class="icon-success" width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path d="M15 30L25 40L45 20" stroke="#00ff00" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <!-- Icon Warning (Tanda Seru) -->
                <svg class="icon-warning" width="60" height="60" viewBox="0 0 60 60" fill="none" style="display: none;">
                    <circle cx="30" cy="30" r="25" stroke="#ff0000" stroke-width="3" fill="none"/>
                    <path d="M30 20V32" stroke="#ff0000" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="30" cy="40" r="2" fill="#ff0000"/>
                </svg>

                <!-- Icon Error (Silang) -->
                <svg class="icon-error" width="60" height="60" viewBox="0 0 60 60" fill="none" style="display: none;">
                    <circle cx="30" cy="30" r="25" stroke="#ff0000" stroke-width="3" fill="none"/>
                    <path d="M20 20L40 40M40 20L20 40" stroke="#ff0000" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
            <h3 class="custom-alert-title" id="alertTitle">Data Berhasil Ditambah</h3>
        </div>
    </div>
</div>

<style>
.custom-alert-overlay {
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

.custom-alert-container {
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

.custom-alert-content {
    display: flex;
    align-items: center;
    padding: 30px 40px;
    gap: 25px;
}

.custom-alert-icon-check {
    flex-shrink: 0;
}

.custom-alert-title {
    font-size: 28px;
    font-weight: 500;
    color: #333;
    margin: 0;
    text-align: center;
}

/* Variasi untuk alert error/delete */
.custom-alert-container.alert-error {
    border-left-color: #ff0000;
}

/* Variasi untuk alert warning */
.custom-alert-container.alert-warning {
    border-left-color: #ff0000;
}

/* Untuk alert dengan tombol konfirmasi */
.custom-alert-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    padding: 0 40px 30px 40px;
}

.btn-cancel,
.btn-confirm {
    padding: 12px 35px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 500;
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
    background-color: #ff0000;
    color: white;
}

.btn-confirm:hover {
    background-color: #cc0000;
}
</style>

<script>
// Variable untuk menyimpan callback confirm
let currentConfirmCallback = null;

// Fungsi helper untuk menampilkan icon yang sesuai
function setAlertIcon(type) {
    const iconSuccess = document.querySelector('.icon-success');
    const iconWarning = document.querySelector('.icon-warning');
    const iconError = document.querySelector('.icon-error');
    const container = document.querySelector('.custom-alert-container');

    // Sembunyikan semua icon dulu
    if (iconSuccess) iconSuccess.style.display = 'none';
    if (iconWarning) iconWarning.style.display = 'none';
    if (iconError) iconError.style.display = 'none';

    // Tampilkan icon sesuai type
    if (type === 'success') {
        if (iconSuccess) iconSuccess.style.display = 'block';
        if (container) container.style.borderLeftColor = '#00ff00';
    } else if (type === 'warning') {
        if (iconWarning) iconWarning.style.display = 'block';
        if (container) container.style.borderLeftColor = '#ff0000';
    } else if (type === 'error') {
        if (iconError) iconError.style.display = 'block';
        if (container) container.style.borderLeftColor = '#ff0000';
    }
}

// Fungsi untuk menampilkan alert sukses (auto close)
function showSuccessAlert(title = 'Data Berhasil Ditambah', duration = 2000) {
    const alert = document.getElementById('customAlert');
    const container = alert.querySelector('.custom-alert-container');
    const alertTitle = document.getElementById('alertTitle');

    // Reset callback
    currentConfirmCallback = null;

    // Reset classes
    container.className = 'custom-alert-container';

    // Set icon SUCCESS (centang hijau)
    setAlertIcon('success');

    // Set title
    alertTitle.textContent = title;

    // Remove buttons if exists
    const existingButtons = alert.querySelector('.custom-alert-buttons');
    if (existingButtons) {
        existingButtons.remove();
    }

    // Show alert
    alert.style.display = 'flex';

    // Auto close
    setTimeout(() => {
        closeCustomAlert();
    }, duration);
}

// Fungsi untuk menampilkan alert error (auto close)
function showErrorAlert(title = 'Data Gagal Ditambah', duration = 2000) {
    const alert = document.getElementById('customAlert');
    const container = alert.querySelector('.custom-alert-container');
    const alertTitle = document.getElementById('alertTitle');

    // Reset callback
    currentConfirmCallback = null;

    // Set error class
    container.className = 'custom-alert-container alert-error';

    // Set icon ERROR (silang merah)
    setAlertIcon('error');

    // Set title
    alertTitle.textContent = title;

    // Remove buttons if exists
    const existingButtons = alert.querySelector('.custom-alert-buttons');
    if (existingButtons) {
        existingButtons.remove();
    }

    // Show alert
    alert.style.display = 'flex';

    // Auto close
    setTimeout(() => {
        closeCustomAlert();
    }, duration);
}

// Fungsi untuk menampilkan alert konfirmasi (dengan tombol)
function showConfirmAlert(title = 'Yakin Ingin Hapus Data?', onConfirm, confirmText = 'Hapus') {
    const alert = document.getElementById('customAlert');
    const container = alert.querySelector('.custom-alert-container');
    const alertTitle = document.getElementById('alertTitle');

    // Simpan callback ke variable global
    currentConfirmCallback = onConfirm;

    // Set warning class
    container.className = 'custom-alert-container alert-warning';

    // Set icon WARNING (tanda seru merah)
    setAlertIcon('warning');

    // Set title
    alertTitle.textContent = title;

    // Remove existing buttons
    const existingButtons = alert.querySelector('.custom-alert-buttons');
    if (existingButtons) {
        existingButtons.remove();
    }

    // Add buttons
    const buttonsDiv = document.createElement('div');
    buttonsDiv.className = 'custom-alert-buttons';
    buttonsDiv.innerHTML = `
        <button type="button" class="btn-cancel" onclick="closeCustomAlert()">Tidak</button>
        <button type="button" class="btn-confirm" id="confirmBtn">${confirmText}</button>
    `;
    container.appendChild(buttonsDiv);

    // Show alert
    alert.style.display = 'flex';

    // Add confirm handler - gunakan onclick langsung
    const confirmBtn = document.getElementById('confirmBtn');
    confirmBtn.onclick = function() {
        closeCustomAlert();
        if (currentConfirmCallback && typeof currentConfirmCallback === 'function') {
            currentConfirmCallback();
        }
        currentConfirmCallback = null;
    };
}

// Fungsi untuk menutup alert
function closeCustomAlert() {
    const alert = document.getElementById('customAlert');
    alert.style.display = 'none';

    // Reset callback saat ditutup
    currentConfirmCallback = null;
}

// Close alert when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const alertOverlay = document.getElementById('customAlert');
    if (alertOverlay) {
        alertOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCustomAlert();
            }
        });
    }
});
</script>
