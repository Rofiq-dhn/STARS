@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<!-- dashboard -->
<style>
    .dashboard-container {
        max-width: 1200px;
    }

    .dashboard-header {
        background: white;
        padding: 24px;
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .dashboard-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .dashboard-header p {
        color: #7f8c8d;
        font-size: 14px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, transparent 100%);
        border-radius: 0 0 0 100%;
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .stat-title {
        font-size: 13px;
        color: #7f8c8d;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(220, 38, 38, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .stat-value.red {
        color: #dc2626;
    }

    .stat-change {
        font-size: 12px;
        color: #27ae60;
        font-weight: 500;
    }

    .stat-change.down {
        color: #7f8c8d;
    }

    .notification-section {
        background: white;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }

    .notification-header {
        font-size: 18px;
        font-weight: 700;
        color: #dc2626;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #fee2e2;
    }

    .notification-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .notification-item {
        background: #f9fafb;
        padding: 16px;
        border-radius: 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s;
    }

    .notification-item:hover {
        background: #f3f4f6;
    }

    .notification-content {
        flex: 1;
    }

    .notification-name {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 4px;
    }

    .notification-desc {
        font-size: 13px;
        color: #7f8c8d;
        margin-bottom: 4px;
    }

    .notification-time {
        font-size: 12px;
        color: #95a5a6;
    }

    .notification-amount {
        font-size: 15px;
        font-weight: 700;
        color: #2c3e50;
        margin-right: 12px;
    }

    .btn-lunas {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-lunas:hover {
        background-color: #059669;
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h2>Beranda Admin</h2>
        <p>Selamat Datang Admin</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Siswa</div>
                </div>
                <div class="stat-icon">👥</div>
            </div>
            <div class="stat-value">1,472</div>
            <div class="stat-change">+12 siswa baru bulan ini</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Pembayaran SPP</div>
                </div>
                <div class="stat-icon">💰</div>
            </div>
            <div class="stat-value red">Rp 45.2M</div>
            <div class="stat-change">92% sudah terbayar</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Daftar Ulang</div>
                </div>
                <div class="stat-icon">📋</div>
            </div>
            <div class="stat-value">892</div>
            <div class="stat-change down">Dari 1,243 siswa</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Pendapatan Bulanan</div>
                </div>
                <div class="stat-icon">📊</div>
            </div>
            <div class="stat-value red">Rp 58.2M</div>
            <div class="stat-change">+8.2% dari bulan lalu</div>
        </div>
    </div>

    <!-- Notifications Section -->
    <div class="notification-section">
        <div class="notification-header">
            Notifikasi
        </div>
        <div class="notification-list">
            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-name">Ahmadi</div>
                    <div class="notification-desc">Pembayaran SPP</div>
                    <div class="notification-time">2 jam lalu</div>
                </div>
                <div class="notification-amount">Rp 500.000</div>
                <button class="btn-lunas">Lunas</button>
            </div>

            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-name">Ahmadi</div>
                    <div class="notification-desc">Pembayaran SPP</div>
                    <div class="notification-time">2 jam lalu</div>
                </div>
                <div class="notification-amount">Rp 500.000</div>
                <button class="btn-lunas">Lunas</button>
            </div>

            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-name">Ahmadi</div>
                    <div class="notification-desc">Pembayaran SPP</div>
                    <div class="notification-time">2 jam lalu</div>
                </div>
                <div class="notification-amount">Rp 500.000</div>
                <button class="btn-lunas">Lunas</button>
            </div>

            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-name">Ahmadi</div>
                    <div class="notification-desc">Pembayaran SPP</div>
                    <div class="notification-time">2 jam lalu</div>
                </div>
                <div class="notification-amount">Rp 500.000</div>
                <button class="btn-lunas">Lunas</button>
            </div>
        </div>
    </div>
</div>
@endsection