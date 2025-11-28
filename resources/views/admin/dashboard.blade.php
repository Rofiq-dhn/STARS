@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
@vite('resources/css/admin/dashboard.css')

<!-- dashboard -->
<x-login-alert />
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
