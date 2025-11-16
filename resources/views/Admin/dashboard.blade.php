@extends('layout.app')

@section('content')
<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #1d4ed8;
        --success: #10b981;
        --success-dark: #047857;
        --warning: #f59e0b;
        --warning-dark: #b45309;
        --info: #8b5cf6;
        --info-dark: #7c3aed;
        --danger: #ef4444;
        --danger-dark: #dc2626;
    }

    .dashboard-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 250px;
        height: 250px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 180px;
        height: 180px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
    }

    .card {
        border-radius: 18px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .feature-card {
        text-align: center;
        padding: 35px 25px;
        height: 100%;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s;
    }

    .feature-card:hover::before {
        left: 100%;
    }

    .feature-icon {
        width: 90px;
        height: 90px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2.2rem;
        color: white;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .stats-card {
        color: white;
        border: none;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .stats-card:hover .stat-value {
        transform: scale(1.05);
    }

    .stat-value {
        font-size: 2.4rem;
        font-weight: 800;
        margin-bottom: 5px;
        transition: transform 0.3s ease;
    }

    .quick-action {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 16px;
        padding: 25px 20px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .quick-action:hover {
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        transform: translateY(-5px) scale(1.03);
        border-color: var(--primary);
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.8rem;
        color: white;
        transition: all 0.3s ease;
    }

    .quick-action:hover .action-icon {
        transform: scale(1.1) rotate(10deg);
    }

    .notification-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--danger);
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }


    .activity-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .activity-item:hover {
        background: #f8fafc;
        transform: translateX(5px);
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.2rem;
        color: white;
    }

    .progress-ring {
        width: 80px;
        height: 80px;
        position: relative;
    }

    .ring-circle {
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }

    .ring-bg {
        fill: none;
        stroke: #e2e8f0;
        stroke-width: 8;
    }

    .ring-progress {
        fill: none;
        stroke-width: 8;
        stroke-linecap: round;
        stroke-dasharray: 226.08;
        transition: stroke-dashoffset 1s ease;
    }

    .dark-mode-toggle {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        border: none;
        box-shadow: 0 5px 20px rgba(59, 130, 246, 0.4);
        cursor: pointer;
        z-index: 1000;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .dark-mode-toggle:hover {
        transform: scale(1.1) rotate(15deg);
    }

    .floating-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 12px;
        padding: 15px 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        border-left: 4px solid var(--success);
        transform: translateX(400px);
        transition: transform 0.5s ease;
        z-index: 1001;
    }

    .floating-notification.show {
        transform: translateX(0);
    }

    .stat-trend {
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .trend-up {
        color: var(--success);
    }

    .trend-down {
        color: var(--danger);
    }
</style>

<!-- Floating Notification -->
<div class="floating-notification" id="welcomeNotification">
    <div class="d-flex align-items-center">
        <div class="activity-icon bg-success me-3">
            <i class="fas fa-bell"></i>
        </div>
        <div>
            <h6 class="mb-1">Selamat Datang Kembali!</h6>
            <p class="text-muted small mb-0">3 tugas menunggu perhatian Anda</p>
        </div>
    </div>
</div>

<!-- Dark Mode Toggle -->
<button class="dark-mode-toggle" id="darkModeToggle">
    <i class="fas fa-moon"></i>
</button>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-8 welcome-content">
                <h3 class="mb-2">👋 Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}</h3>
                <p class="mb-3">Kelola jadwal shift, absensi, dan data karyawan dari satu tempat.</p>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-light text-primary px-3 py-2">
                        <i class="fas fa-calendar me-2"></i>
                        <span id="current-date">{{ now()->format('l, d F Y') }}</span>
                    </span>
                    <span class="badge bg-light text-success px-3 py-2">
                        <i class="fas fa-clock me-2"></i>
                        <span id="current-time">{{ now()->format('H:i') }}</span>
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="position-relative d-inline-block">
                    <div class="progress-ring">
                        <svg viewBox="0 0 100 100">
                            <circle class="ring-bg" cx="50" cy="50" r="36"></circle>
                            <circle class="ring-progress" cx="50" cy="50" r="36"
                                    stroke="#10b981" stroke-dashoffset="67.824"></circle>
                        </svg>
                        <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
                            <small>Hari Ini</small>
                            <div class="fw-bold">85%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Statistik Cepat -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stats-card shadow-sm p-3" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark));">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase small mb-2 opacity-90">Total Karyawan</h6>
                            <div class="stat-value">124</div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8% dari bulan lalu</span>
                            </div>
                        </div>
                        <div class="notification-badge">3</div>
                    </div>
                    <i class="fas fa-users position-absolute bottom-0 end-0 me-3 mb-3 opacity-25" style="font-size: 3.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card shadow-sm p-3" style="background: linear-gradient(135deg, var(--success), var(--success-dark));">
                <div class="card-body position-relative">
                    <h6 class="text-uppercase small mb-2 opacity-90">Kehadiran Hari Ini</h6>
                    <div class="stat-value">96%</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+2% dari kemarin</span>
                    </div>
                    <i class="fas fa-user-check position-absolute bottom-0 end-0 me-3 mb-3 opacity-25" style="font-size: 3.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card shadow-sm p-3" style="background: linear-gradient(135deg, var(--warning), var(--warning-dark));">
                <div class="card-body position-relative">
                    <h6 class="text-uppercase small mb-2 opacity-90">Shift Aktif</h6>
                    <div class="stat-value">5</div>
                    <div class="stat-trend trend-down">
                        <i class="fas fa-arrow-down"></i>
                        <span>-1 dari minggu lalu</span>
                    </div>
                    <i class="fas fa-business-time position-absolute bottom-0 end-0 me-3 mb-3 opacity-25" style="font-size: 3.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card shadow-sm p-3" style="background: linear-gradient(135deg, var(--info), var(--info-dark));">
                <div class="card-body position-relative">
                    <h6 class="text-uppercase small mb-2 opacity-90">Laporan Bulan Ini</h6>
                    <div class="stat-value">42</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+12% dari target</span>
                    </div>
                    <i class="fas fa-chart-bar position-absolute bottom-0 end-0 me-3 mb-3 opacity-25" style="font-size: 3.5rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Utama dengan Fitur Interaktif -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm feature-card" onclick="showFeature('shift')">
                <div class="feature-icon" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark));">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h5 class="mb-3">Laporan Shift Bulanan</h5>
                <p class="text-muted small mb-4">Pantau jadwal dan rotasi shift karyawan tiap bulan dengan analisis mendalam.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-primary">Updated Today</span>
                    <button class="btn btn-primary btn-sm rounded-pill px-3">
                        Explore <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm feature-card" onclick="showFeature('absensi')">
                <div class="feature-icon" style="background: linear-gradient(135deg, var(--success), var(--success-dark));">
                    <i class="fas fa-clock"></i>
                </div>
                <h5 class="mb-3">Laporan Absensi</h5>
                <p class="text-muted small mb-4">Analisis data absensi real-time dengan deteksi pola dan notifikasi.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-success">Live Data</span>
                    <button class="btn btn-success btn-sm rounded-pill px-3">
                        Monitor <i class="fas fa-chart-line ms-1"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm feature-card" onclick="showFeature('manajemen')">
                <div class="feature-icon" style="background: linear-gradient(135deg, var(--info), var(--info-dark));">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h5 class="mb-3">Manajemen Data</h5>
                <p class="text-muted small mb-4">Kelola data karyawan dan HRD dengan tools yang powerful dan intuitif.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-info">Smart Tools</span>
                    <button class="btn btn-info btn-sm rounded-pill px-3 text-white">
                        Manage <i class="fas fa-users-cog ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">⚡ Akses Cepat</h5>
                    <a href="#" class="text-primary small">Lihat Semua</a>
                </div>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="quick-action" onclick="quickAction('addEmployee')">
                            <div class="action-icon bg-primary">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h6 class="mb-2">Tambah Karyawan</h6>
                            <small class="text-muted">Input data baru</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="quick-action" onclick="quickAction('exportReport')">
                            <div class="action-icon bg-success">
                                <i class="fas fa-file-export"></i>
                            </div>
                            <h6 class="mb-2">Ekspor Laporan</h6>
                            <small class="text-muted">PDF, Excel, CSV</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="quick-action" onclick="quickAction('settings')">
                            <div class="action-icon bg-warning">
                                <i class="fas fa-cog"></i>
                            </div>
                            <h6 class="mb-2">Pengaturan</h6>
                            <small class="text-muted">Customize system</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="quick-action" onclick="quickAction('help')">
                            <div class="action-icon bg-info">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <h6 class="mb-2">Bantuan</h6>
                            <small class="text-muted">Support & docs</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">📝 Aktivitas Terbaru</h5>
                    <span class="badge bg-primary">5 baru</span>
                </div>
                <div style="max-height: 300px; overflow-y: auto;">
                    <div class="activity-item">
                        <div class="activity-icon bg-success">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Absensi Masuk</h6>
                            <p class="text-muted small mb-0">98 karyawan telah absen masuk</p>
                            <small class="text-muted">8:30 AM</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Keterlambatan</h6>
                            <p class="text-muted small mb-0">5 karyawan terlambat hari ini</p>
                            <small class="text-muted">9:15 AM</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-info">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Laporan Dibuat</h6>
                            <p class="text-muted small mb-0">Laporan shift mingguan selesai</p>
                            <small class="text-muted">10:00 AM</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update waktu real-time
    function updateDateTime() {
        const now = new Date();
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const timeOptions = { hour: '2-digit', minute: '2-digit' };

        document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', dateOptions);
        document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', timeOptions);
    }

    // Show welcome notification
    setTimeout(() => {
        document.getElementById('welcomeNotification').classList.add('show');
    }, 1000);

    // Hide notification after 5 seconds
    setTimeout(() => {
        document.getElementById('welcomeNotification').classList.remove('show');
    }, 6000);

    // Feature click handlers
    function showFeature(feature) {
        const features = {
            'shift': 'Membuka modul Laporan Shift...',
            'absensi': 'Mengakses dashboard Absensi...',
            'manajemen': 'Membuka Manajemen Data...'
        };

        showToast(`🚀 ${features[feature]}`);
    }

    function quickAction(action) {
        const actions = {
            'addEmployee': 'Membuka form tambah karyawan...',
            'exportReport': 'Menyiapkan opsi ekspor...',
            'settings': 'Membuka pengaturan sistem...',
            'help': 'Membuka pusat bantuan...'
        };

        showToast(`⚡ ${actions[action]}`);
    }

    function showToast(message) {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = 'floating-notification show';
        toast.style.bottom = '20px';
        toast.style.top = 'auto';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <div class="activity-icon bg-primary me-3">
                    <i class="fas fa-info"></i>
                </div>
                <div>
                    <p class="mb-0 small">${message}</p>
                </div>
            </div>
        `;

        document.body.appendChild(toast);

        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    // Dark mode toggle
    document.getElementById('darkModeToggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const icon = this.querySelector('i');
        if (document.body.classList.contains('dark-mode')) {
            icon.className = 'fas fa-sun';
            this.style.background = 'var(--warning)';
        } else {
            icon.className = 'fas fa-moon';
            this.style.background = 'var(--primary)';
        }
    });

    // Initialize
    setInterval(updateDateTime, 1000);
    updateDateTime();

    // Add some interactive animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress ring
        const progressRing = document.querySelector('.ring-progress');
        setTimeout(() => {
            progressRing.style.strokeDashoffset = '67.824'; // 85% progress
        }, 500);
    });
</script>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
