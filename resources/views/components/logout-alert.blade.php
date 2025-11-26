<!-- resources/views/components/logout-alert.blade.php -->
<div id="logoutAlert" class="logout-alert-overlay" style="display: none;">
    <div class="logout-alert-container">
        <div class="logout-alert-content">
            <div class="logout-alert-icon">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <circle cx="30" cy="30" r="25" stroke="#ff6b6b" stroke-width="3" fill="none"/>
                    <path d="M30 20V32" stroke="#ff6b6b" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="30" cy="40" r="2" fill="#ff6b6b"/>
                </svg>
            </div>
            <h3 class="logout-alert-title">Apakah Anda yakin ingin keluar?</h3>
        </div>
        <div class="logout-alert-buttons">
            <button type="button" class="btn-logout-cancel" onclick="closeLogoutAlert()">Tidak</button>
            <button type="button" class="btn-logout-confirm" onclick="confirmLogout()">Keluar</button>
        </div>
    </div>
</div>

<style>
    .logout-alert-overlay {
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

    .logout-alert-container {
        background: white;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        max-width: 500px;
        width: 90%;
        animation: slideDown 0.3s ease;
        overflow: hidden;
        border-left: 8px solid #ff0000;
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

    .logout-alert-content {
        display: flex;
        align-items: center;
        padding: 30px 40px;
        gap: 25px;
    }

    .logout-alert-icon {
        flex-shrink: 0;
    }

    .logout-alert-title {
        font-size: 22px;
        font-weight: 500;
        color: #333;
        margin: 0;
        text-align: left;
    }

    .logout-alert-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        padding: 0 40px 30px 40px;
    }

    .btn-logout-cancel,
    .btn-logout-confirm {
        padding: 12px 35px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-logout-cancel {
        background-color: white;
        color: #333;
        border: 2px solid #ddd;
    }

    .btn-logout-cancel:hover {
        background-color: #f5f5f5;
        border-color: #bbb;
    }

    .btn-logout-confirm {
        background-color: #dc2626;
        color: white;
    }

    .btn-logout-confirm:hover {
        background-color: #b91c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
</style>

<script>
// Fungsi untuk menampilkan logout alert
function showLogoutAlert() {
    const alert = document.getElementById('logoutAlert');
    if (alert) {
        alert.style.display = 'flex';
    }
}

// Fungsi untuk menutup logout alert
function closeLogoutAlert() {
    const alert = document.getElementById('logoutAlert');
    if (alert) {
        alert.style.display = 'none';
    }
}

// Fungsi untuk konfirmasi logout
function confirmLogout() {
    const form = document.getElementById('logout-form');
    if (form) {
        form.submit();
    } else {
        console.error('Form logout-form tidak ditemukan!');
    }
}

// Close alert ketika klik di luar modal
document.addEventListener('DOMContentLoaded', function() {
    const alertOverlay = document.getElementById('logoutAlert');
    if (alertOverlay) {
        alertOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeLogoutAlert();
            }
        });
    }
});
</script>
