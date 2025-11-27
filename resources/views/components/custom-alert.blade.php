<!-- resources/views/components/custom-alert.blade.php -->
<div id="customAlert" class="custom-alert-overlay" style="display: none;">
    <div class="custom-alert-container">
        <div class="custom-alert-content">
            <div class="custom-alert-icon-check">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path d="M15 30L25 40L45 20" stroke="#00ff00" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 class="custom-alert-title" id="alertTitle">Biaya Berhasil Ditambah</h3>
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
    text-align: left;
}

/* Variasi untuk alert error/delete */
.custom-alert-container.alert-error {
    border-left-color: #ff0000;
}

.custom-alert-container.alert-error .custom-alert-icon-check svg path {
    stroke: #ff0000;
}

/* Variasi untuk alert warning */
.custom-alert-container.alert-warning  {
    border-left-color: #ff0000;
}

.custom-alert-container.alert-warning .custom-alert-icon-check svg path {
    stroke: #ff0000;
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
// Fungsi untuk menampilkan alert sukses (auto close)
function showSuccessAlert(title = 'Data Berhasil Ditambah', duration = 2000) {
    const alert = document.getElementById('customAlert');
    const container = alert.querySelector('.custom-alert-container');
    const alertTitle = document.getElementById('alertTitle');

    // Reset classes
    container.className = 'custom-alert-container';

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

    // Set error class
    container.className = 'custom-alert-container alert-error';

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
function showConfirmAlert(title = 'Yakin Ingin Hapus Data?', onConfirm) {
    const alert = document.getElementById('customAlert');
    const container = alert.querySelector('.custom-alert-container');
    const alertTitle = document.getElementById('alertTitle');

    // Set warning class
    container.className = 'custom-alert-container alert-warning';

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
        <button type="button" class="btn-confirm" id="confirmBtn">Hapus</button>
    `;
    container.appendChild(buttonsDiv);

    // Show alert
    alert.style.display = 'flex';

    // Add confirm handler
    document.getElementById('confirmBtn').addEventListener('click', function handler() {
        closeCustomAlert();
        if (onConfirm && typeof onConfirm === 'function') {
            onConfirm();
        }
        this.removeEventListener('click', handler);
    });
}

// Fungsi untuk menutup alert
function closeCustomAlert() {
    document.getElementById('customAlert').style.display = 'none';
}

// Close alert when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('customAlert')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCustomAlert();
        }
    });
});
</script>
