{{-- Alert Modal Component --}}
<div id="alertModal" class="custom-alert-overlay" style="display: none;">
    <div class="custom-alert-container" id="alertContainer">
        <div class="custom-alert-content">
            <div class="custom-alert-icon-check" id="modalIcon">
                <!-- Icon akan diisi dengan JavaScript -->
            </div>
            <h2 class="custom-alert-title" id="modalMessage">Apakah Anda yakin?</h2>
        </div>
        <div class="custom-alert-buttons">
            <button type="button" class="btn-cancel" onclick="closeAlertModal()">Batal</button>
            <button type="button" class="btn-confirm" id="confirmButton">Konfirmasi</button>
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

.custom-alert-icon-check svg {
    width: 50px;
    height: 50px;
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
.custom-alert-container.alert-warning {
    border-left-color: #ffa500;
}

.custom-alert-container.alert-warning .custom-alert-icon-check svg path {
    stroke: #ffa500;
}

.custom-alert-container.alert-warning .btn-confirm {
    background-color: #ffa500;
}

.custom-alert-container.alert-warning .btn-confirm:hover {
    background-color: #ff8c00;
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
let currentForm = null;

function showAlertModal(type, message, form) {
    const modal = document.getElementById('alertModal');
    const container = document.getElementById('alertContainer');
    const modalIcon = document.getElementById('modalIcon');
    const modalMessage = document.getElementById('modalMessage');
    
    // Reset classes
    container.className = 'custom-alert-container';
    
    // Set icon dan class berdasarkan type
    if (type === 'delete' || type === 'tolak') {
        container.classList.add('alert-error');
        modalIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        `;
    } else if (type === 'verifikasi') {
        container.classList.add('alert-warning');
        modalIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        `;
    }
    
    // Set message
    modalMessage.textContent = message;
    
    // Simpan form yang akan disubmit
    currentForm = form;
    
    // Tampilkan modal
    modal.style.display = 'flex';
}

function closeAlertModal() {
    const modal = document.getElementById('alertModal');
    modal.style.display = 'none';
    currentForm = null;
}

function confirmAction() {
    if (currentForm) {
        currentForm.submit();
    }
    closeAlertModal();
}

// Event listener untuk tombol confirm
document.getElementById('confirmButton').addEventListener('click', confirmAction);

// Close modal ketika klik di luar modal content
document.getElementById('alertModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAlertModal();
    }
});

// Close modal dengan tombol ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAlertModal();
    }
});
</script>