<!-- resources/views/components/custom-alert.blade.php -->
<div id="customAlert" class="custom-alert-overlay" style="display: none;">
    <div class="custom-alert-container">
        <div class="custom-alert-icon">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L2 20h20L12 2z" fill="#ff0000" stroke="#cc0000" stroke-width="1"/>
                <text x="12" y="17" text-anchor="middle" fill="white" font-size="12" font-weight="bold">!</text>
            </svg>
        </div>
        <h3 class="custom-alert-title" id="alertTitle">Yakin Ingin Hapus Data?</h3>
        <div class="custom-alert-buttons">
            <button type="button" class="btn-cancel" onclick="closeCustomAlert()">Tidak</button>
            <button type="button" class="btn-confirm" id="confirmBtn">Hapus</button>
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
    padding: 30px 40px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    animation: slideDown 0.3s ease;
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

.custom-alert-icon {
    margin-bottom: 20px;
}

.custom-alert-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 30px;
}

.custom-alert-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-cancel,
.btn-confirm {
    padding: 10px 30px;
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
function showCustomAlert(title, onConfirm) {
    const alert = document.getElementById('customAlert');
    const alertTitle = document.getElementById('alertTitle');
    const confirmBtn = document.getElementById('confirmBtn');

    alertTitle.textContent = title || 'Yakin Ingin Hapus Data?';
    alert.style.display = 'flex';

    // Remove previous event listeners
    const newConfirmBtn = confirmBtn.cloneNode(true);
    confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);

    // Add new event listener
    document.getElementById('confirmBtn').addEventListener('click', function() {
        closeCustomAlert();
        if (onConfirm && typeof onConfirm === 'function') {
            onConfirm();
        }
    });
}

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
