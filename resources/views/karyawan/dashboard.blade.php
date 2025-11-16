@extends('layout.appkaryawan')

@section('title', 'Dashboard Karyawan - Sistem Absensi')

@section('page-title', 'Dashboard Karyawan')

@section('content')
<!-- Welcome Banner dengan Gradient Animasi -->
<div class="welcome-banner">
    <div class="welcome-content">
        <div class="welcome-text">
            <div class="greeting">
                <span class="greeting-icon">👋</span>
                <span class="greeting-text">Selamat Pagi</span>
            </div>
            <h1>{{ Auth::user()->name}}!</h1>
            <p>Semoga hari Anda produktif dan menyenangkan. Status absensi hari ini: <span class="attendance-status checked-in">Telah Check-in</span></p>
        </div>
        <div class="datetime-card">
            <div class="date-info">
                <i class="fas fa-calendar-alt"></i>
                <div class="current-date" id="currentDate"></div>
            </div>
            <div class="time-info">
                <i class="fas fa-clock"></i>
                <div class="current-time" id="currentTime"></div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h3 class="section-title">
        <i class="fas fa-bolt"></i>
        Aksi Cepat
    </h3>
    <div class="action-grid">
        <div class="action-card checkin-card">
            <div class="action-icon">
                <i class="fas fa-fingerprint"></i>
            </div>
            <div class="action-content">
                <h4>Check-in</h4>
                <p>Absen masuk hari ini</p>
                <button class="action-btn primary">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Check-in Sekarang
                </button>
            </div>
        </div>
        <div class="action-card checkout-card">
            <div class="action-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="action-content">
                <h4>Check-out</h4>
                <p>Absen pulang</p>
                <button class="action-btn secondary" disabled>
                    <i class="fas fa-door-open me-2"></i>
                    Check-out (17:00)
                </button>
            </div>
        </div>
        <div class="action-card request-card">
            <div class="action-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="action-content">
                <h4>Ajukan Izin</h4>
                <p>Pengajuan cuti/izin</p>
                <button class="action-btn outline">
                    <i class="fas fa-paper-plane me-2"></i>
                    Ajukan Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Overview -->
<div class="stats-overview">
    <h3 class="section-title">
        <i class="fas fa-chart-bar"></i>
        Ringkasan Bulan Ini
    </h3>
    <div class="stats-grid">
        <div class="stat-card attendance-stat">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>5%</span>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">18</div>
                <div class="stat-label">Hari Hadir</div>
                <div class="stat-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 85%"></div>
                    </div>
                    <span class="progress-text">85% Kehadiran</span>
                </div>
            </div>
        </div>

        <div class="stat-card late-stat">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-trend negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>2%</span>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">2</div>
                <div class="stat-label">Keterlambatan</div>
                <div class="late-detail">
                    <span class="late-time">Rata-rata 15 menit</span>
                </div>
            </div>
        </div>

        <div class="stat-card leave-stat">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-umbrella-beach"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-badge">Tersisa</span>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">10</div>
                <div class="stat-label">Hari Cuti</div>
                <div class="leave-progress">
                    <div class="progress-circle">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e0e0e0" stroke-width="4" fill="none"></circle>
                            <circle cx="30" cy="30" r="25" stroke="#1abc9c" stroke-width="4" fill="none" 
                                    stroke-dasharray="157" stroke-dashoffset="47.1" stroke-linecap="round"></circle>
                        </svg>
                        <span class="circle-text">70%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card productivity-stat">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>8%</span>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">85%</div>
                <div class="stat-label">Produktivitas</div>
                <div class="productivity-chart">
                    <div class="chart-bars">
                        <div class="chart-bar" style="height: 60%"></div>
                        <div class="chart-bar" style="height: 80%"></div>
                        <div class="chart-bar" style="height: 85%"></div>
                        <div class="chart-bar" style="height: 70%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Announcements -->
<div class="dashboard-grid">
    <!-- Recent Activity -->
    <div class="dashboard-card activity-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-history"></i>
                Aktivitas Terkini
            </h3>
            <div class="card-actions">
                <button class="action-btn">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <button class="action-btn">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Check-in berhasil</div>
                    <div class="activity-desc">Anda telah check-in hari ini pukul 08:00</div>
                    <div class="activity-time">2 jam yang lalu</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Pengajuan cuti disetujui</div>
                    <div class="activity-desc">Pengajuan cuti tanggal 20 April telah disetujui</div>
                    <div class="activity-time">1 hari yang lalu</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon info">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Meeting tim</div>
                    <div class="activity-desc">Meeting rutin tim pukul 14:00 di Ruang Rapat A</div>
                    <div class="activity-time">Besok, 14:00</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements -->
    <div class="dashboard-card announcements-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Pengumuman
            </h3>
            <div class="card-badge">3 Baru</div>
        </div>
        <div class="announcements-list">
            <div class="announcement-item urgent">
                <div class="announcement-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="announcement-content">
                    <div class="announcement-title">Gathering Perusahaan</div>
                    <div class="announcement-desc">Perusahaan akan mengadakan acara gathering karyawan pada tanggal 25 April 2024. Diharapkan seluruh karyawan dapat hadir.</div>
                    <div class="announcement-meta">
                        <span class="announcement-date">15 Apr 2024</span>
                        <span class="announcement-tag">Penting</span>
                    </div>
                </div>
            </div>
            <div class="announcement-item">
                <div class="announcement-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="announcement-content">
                    <div class="announcement-title">Update Sistem Absensi</div>
                    <div class="announcement-desc">Akan dilakukan maintenance sistem absensi pada Minggu, 21 April pukul 00:00 - 06:00.</div>
                    <div class="announcement-meta">
                        <span class="announcement-date">14 Apr 2024</span>
                        <span class="announcement-tag">Info</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Events -->
<div class="dashboard-card events-card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-calendar-day"></i>
            Acara Mendatang
        </h3>
        <button class="view-all-btn">
            <i class="fas fa-list me-1"></i>
            Lihat Semua
        </button>
    </div>
    <div class="events-list">
        <div class="event-item">
            <div class="event-date">
                <div class="event-day">20</div>
                <div class="event-month">Apr</div>
            </div>
            <div class="event-content">
                <div class="event-title">Cuti Tahunan</div>
                <div class="event-desc">Cuti yang telah diajukan</div>
                <div class="event-time">All day</div>
            </div>
            <div class="event-status approved">
                <i class="fas fa-check me-1"></i>
                Disetujui
            </div>
        </div>
        <div class="event-item">
            <div class="event-date">
                <div class="event-day">25</div>
                <div class="event-month">Apr</div>
            </div>
            <div class="event-content">
                <div class="event-title">Gathering Perusahaan</div>
                <div class="event-desc">Acara tahunan perusahaan</div>
                <div class="event-time">09:00 - 17:00</div>
            </div>
            <div class="event-status mandatory">
                <i class="fas fa-exclamation me-1"></i>
                Wajib
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS Variables - Konsisten dengan layout.appkaryawan */
    :root {
        --primary: #3498db;
        --primary-dark: #2980b9;
        --secondary: #2c3e50;
        --accent: #1abc9c;
        --light: #ecf0f1;
        --danger: #e74c3c;
        --warning: #f39c12;
        --success: #2ecc71;
        --gray: #95a5a6;
        --text: #333;
        --border-radius: 8px;
        --shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    /* Header Icon Fix */
    .header-menu-icon {
        font-size: 1.5rem;
        cursor: pointer;
        padding: 8px;
        border-radius: 4px;
        transition: var(--transition);
    }

    .header-menu-icon:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Welcome Banner Styles */
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 15px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .welcome-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .welcome-text h1 {
        font-size: 2.2rem;
        margin: 10px 0;
        font-weight: 700;
    }

    .greeting {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 5px;
    }

    .greeting-text {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .greeting-icon {
        font-size: 1.3rem;
    }

    .attendance-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .attendance-status.checked-in {
        background: rgba(46, 204, 113, 0.2);
        color: var(--success);
    }

    .datetime-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .date-info, .time-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 10px 0;
        justify-content: center;
    }

    .date-info i, .time-info i {
        font-size: 1.2rem;
        opacity: 0.8;
    }

    .current-time {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .banner-illustration {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
    }

    .floating-elements {
        position: relative;
    }

    .floating-element {
        position: absolute;
        font-size: 2rem;
        animation: float 3s ease-in-out infinite;
    }

    .floating-element.el-1 {
        top: -20px;
        right: 0;
        animation-delay: 0s;
    }

    .floating-element.el-2 {
        top: 30px;
        right: 40px;
        animation-delay: 1s;
    }

    .floating-element.el-3 {
        top: -10px;
        right: 80px;
        animation-delay: 2s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Quick Actions */
    .quick-actions {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--primary);
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .action-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: var(--transition);
        border: 1px solid #f0f0f0;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .checkin-card .action-icon { 
        background: linear-gradient(135deg, var(--success), #27ae60); 
    }
    .checkout-card .action-icon { 
        background: linear-gradient(135deg, var(--danger), #c0392b); 
    }
    .request-card .action-icon { 
        background: linear-gradient(135deg, var(--primary), var(--primary-dark)); 
    }

    .action-content h4 {
        margin: 0 0 5px 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--secondary);
    }

    .action-content p {
        margin: 0 0 15px 0;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .action-btn {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            position: relative;
            transition: color 0.2s;
            padding: 8px;
            flex-shrink: 0;
        }

    .action-btn.primary {
        background: var(--primary);
        color: white;
    }

    .action-btn.primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .action-btn.secondary {
        background: var(--gray);
        color: white;
        cursor: not-allowed;
    }

    .action-btn.outline {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
    }

    .action-btn.outline:hover {
        background: var(--primary);
        color: white;
    }

    /* Stats Overview */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: white;
    }

    .attendance-stat .stat-icon { 
        background: linear-gradient(135deg, var(--primary), var(--primary-dark)); 
    }
    .late-stat .stat-icon { 
        background: linear-gradient(135deg, var(--danger), #c0392b); 
    }
    .leave-stat .stat-icon { 
        background: linear-gradient(135deg, var(--accent), #16a085); 
    }
    .productivity-stat .stat-icon { 
        background: linear-gradient(135deg, #9b59b6, #8e44ad); 
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .stat-trend.positive {
        background: rgba(46, 204, 113, 0.1);
        color: var(--success);
    }

    .stat-trend.negative {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--secondary);
    }

    .stat-label {
        font-size: 1rem;
        color: var(--gray);
        margin-bottom: 15px;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: #f0f0f0;
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .progress-text {
        font-size: 0.8rem;
        color: var(--gray);
        margin-top: 5px;
    }

    .progress-circle {
        position: relative;
        display: inline-block;
    }

    .circle-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--secondary);
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .dashboard-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--shadow);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title i {
        color: var(--primary);
    }

    .card-badge {
        background: var(--danger);
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Activity List */
    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f5f5f5;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: white;
        flex-shrink: 0;
    }

    .activity-icon.success { background: var(--success); }
    .activity-icon.warning { background: var(--warning); }
    .activity-icon.info { background: var(--primary); }

    .activity-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--secondary);
    }

    .activity-desc {
        font-size: 0.9rem;
        color: var(--gray);
        margin-bottom: 5px;
    }

    .activity-time {
        font-size: 0.8rem;
        color: var(--gray);
    }

    /* Announcements */
    .announcement-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        background: #f8f9fa;
        border-left: 4px solid var(--primary);
    }

    .announcement-item.urgent {
        background: #fff5f5;
        border-left-color: var(--danger);
    }

    .announcement-icon {
        color: var(--primary);
        font-size: 1.2rem;
        margin-top: 2px;
    }

    .announcement-item.urgent .announcement-icon {
        color: var(--danger);
    }

    .announcement-title {
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--secondary);
    }

    .announcement-desc {
        font-size: 0.9rem;
        color: var(--gray);
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .announcement-meta {
        display: flex;
        gap: 15px;
        font-size: 0.8rem;
    }

    .announcement-tag {
        background: #e3f2fd;
        color: var(--primary-dark);
        padding: 2px 8px;
        border-radius: 10px;
        font-weight: 600;
    }

    /* Events */
    .events-card {
        margin-bottom: 30px;
    }

    .view-all-btn {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .view-all-btn:hover {
        background: var(--primary);
        color: white;
    }

    .event-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        background: #f8f9fa;
        transition: var(--transition);
    }

    .event-item:hover {
        background: #e9ecef;
    }

    .event-date {
        text-align: center;
        background: white;
        padding: 10px;
        border-radius: 6px;
        min-width: 60px;
        border: 1px solid #e0e0e0;
    }

    .event-day {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .event-month {
        font-size: 0.8rem;
        color: var(--gray);
        text-transform: uppercase;
    }

    .event-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--secondary);
    }

    .event-desc {
        font-size: 0.9rem;
        color: var(--gray);
        margin-bottom: 5px;
    }

    .event-time {
        font-size: 0.8rem;
        color: var(--gray);
    }

    .event-status {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .event-status.approved {
        background: rgba(46, 204, 113, 0.1);
        color: var(--success);
    }

    .event-status.mandatory {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .welcome-content {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .datetime-card {
            width: 100%;
        }

        .action-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .banner-illustration {
            display: none;
        }

        .date-info, .time-info {
            justify-content: center;
        }
    }
</style>

<script>
    // Update date and time
    function updateDateTime() {
        const now = new Date();
        
        // Format date
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);
        
        // Format time
        const time = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit' 
        });
        document.getElementById('currentTime').textContent = time;
    }
    
    // Update time immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Add hover effects and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading animation to stats cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('fade-in-up');
        });

        // Add click handlers for action buttons
        const actionButtons = document.querySelectorAll('.action-btn');
        actionButtons.forEach(button => {
            if (!button.disabled) {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            }
        });
    });
</script>
@endsection