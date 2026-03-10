<!-- filepath: d:\Laravel\STARS\resources\views\components\payment-alert.blade.php -->
<div id="paymentAlert" class="payment-alert-overlay" style="display: none;">
    <div class="payment-alert-container">
        <div class="payment-alert-content">
            <div class="payment-alert-icon" id="alertIcon">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path d="M15 30L25 40L45 20" stroke="#00ff00" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 class="payment-alert-title" id="alertTitle">Pembayaran Berhasil</h3>
            <p class="payment-alert-message" id="alertMessage">Bukti pembayaran sedang diverifikasi</p>
        </div>
    </div>
</div>

<style>
.payment-alert-overlay {
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

.payment-alert-container {
    background: white;
    border-radius: 12px;
    padding: 0;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    max-width: 500px;
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

.payment-alert-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 30px 40px;
    gap: 15px;
    border-left: 8px solid #00ff00;
}

.payment-alert-icon {
    flex-shrink: 0;
}

.payment-alert-title {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin: 0;
    text-align: center;
}

.payment-alert-message {
    font-size: 14px;
    color: #666;
    margin: 0;
    text-align: center;
}

/* Variant untuk error */
.payment-alert-content.error {
    border-left-color: #ff4444;
}

.payment-alert-content.error .payment-alert-icon svg {
    stroke: #ff4444;
}

.payment-alert-content.error .payment-alert-title {
    color: #ff4444;
}
</style>

<script>
function showPaymentAlert(options = {}) {
    const {
        title = 'Pembayaran Berhasil',
        message = 'Bukti pembayaran sedang diverifikasi',
        type = 'success',
        duration = 2000,
        redirectUrl = null
    } = options;

    const alert = document.getElementById('paymentAlert');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');
    const alertContent = alert.querySelector('.payment-alert-content');
    const alertIcon = document.getElementById('alertIcon');

    // Set title dan message
    alertTitle.textContent = title;
    alertMessage.textContent = message;

    // Ubah style berdasarkan type
    alertContent.classList.remove('error');
    if (type === 'error') {
        alertContent.classList.add('error');
        alertIcon.innerHTML = `
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                <circle cx="30" cy="30" r="28" stroke="#ff4444" stroke-width="2" fill="none"/>
                <line x1="20" y1="20" x2="40" y2="40" stroke="#ff4444" stroke-width="3" stroke-linecap="round"/>
                <line x1="40" y1="20" x2="20" y2="40" stroke="#ff4444" stroke-width="3" stroke-linecap="round"/>
            </svg>
        `;
    } else {
        alertIcon.innerHTML = `
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                <path d="M15 30L25 40L45 20" stroke="#00ff00" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        `;
    }

    // Tampilkan alert
    alert.style.display = 'flex';

    // Auto hide dan redirect
    setTimeout(() => {
        alert.style.display = 'none';
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    }, duration);
}
</script>