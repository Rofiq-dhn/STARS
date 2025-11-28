<!-- resources/views/components/login-alert.blade.php -->
<div id="loginAlert" class="login-alert-overlay" style="display: none;">
    <div class="login-alert-container">
        <div class="login-alert-content">
            <div class="login-alert-icon-check">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path d="M15 30L25 40L45 20" stroke="#00ff00" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 class="login-alert-title" id="loginAlertTitle">Login Berhasil</h3>
        </div>
    </div>
</div>

<style>
.login-alert-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 80px;
}

.login-alert-container {
    background: white;
    border-radius: 12px;
    padding: 0;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    max-width: 600px;
    width: 90%;
    animation: slideDown 0.3s ease;
    overflow: hidden;
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

.login-alert-content {
    display: flex;
    align-items: center;
    padding: 30px 40px;
    gap: 25px;
    border-left: 8px solid #00ff00;
}

.login-alert-icon-check {
    flex-shrink: 0;
}

.login-alert-title {
    font-size: 28px;
    font-weight: 500;
    color: #333;
    margin: 0;
    text-align: left;
}
</style>

<script>
// Fungsi untuk menampilkan login alert dan redirect
function showLoginAlert(title = 'Login Berhasil', redirectUrl, duration = 1500) {
    const alert = document.getElementById('loginAlert');
    const alertTitle = document.getElementById('loginAlertTitle');
    
    // Set title
    alertTitle.textContent = title;
    
    // Show alert
    alert.style.display = 'flex';
    
    // Auto redirect setelah duration
    setTimeout(() => {
        alert.style.display = 'none';
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    }, duration);
}
</script>