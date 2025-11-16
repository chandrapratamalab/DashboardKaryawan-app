@extends('layout.appkaryawan')

@section('title', 'Pengajuan Izin & Cuti')
@section('page-title', 'Pengajuan Izin & Cuti')

@section('content')
<div class="pengajuan-container">
    <!-- Header Section -->
    <div class="pengajuan-header">
        <h1 class="pengajuan-title">Pengajuan Izin & Cuti</h1>
        <p class="pengajuan-subtitle">Kelola permohonan izin atau cuti Anda dengan mudah</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">12</h3>
                <p class="stat-label">Hari Cuti Tersedia</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">2</h3>
                <p class="stat-label">Menunggu Persetujuan</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">8</h3>
                <p class="stat-label">Disetujui Bulan Ini</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">15</h3>
                <p class="stat-label">Total Pengajuan</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="pengajuan-content">
        <!-- Form Section -->
        <div class="form-section">
            <div class="form-card">
                <h2 class="form-title">Ajukan Permohonan Baru</h2>
                
                <!-- Tab Navigation -->
                <div class="tab-navigation">
                    <button class="tab-btn active" data-tab="izin">Izin</button>
                    <button class="tab-btn" data-tab="cuti">Cuti</button>
                </div>

                <!-- Izin Form -->
                <form id="izin-form" class="pengajuan-form active">
                    @csrf
                    <div class="form-group">
                        <label for="jenis_izin" class="form-label">Jenis Izin</label>
                        <select id="jenis_izin" name="jenis_izin" class="form-select" required>
                            <option value="">Pilih Jenis Izin</option>
                            <option value="sakit">Izin Sakit</option>
                            <option value="keluarga">Izin Keluarga</option>
                            <option value="pribadi">Izin Pribadi</option>
                            <option value="lainnya">Izin Lainnya</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="tanggal_mulai_izin" class="form-label">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai_izin" name="tanggal_mulai" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai_izin" class="form-label">Tanggal Selesai</label>
                            <input type="date" id="tanggal_selesai_izin" name="tanggal_selesai" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alasan_izin" class="form-label">Alasan Izin</label>
                        <textarea id="alasan_izin" name="alasan" class="form-textarea" rows="4" placeholder="Jelaskan alasan pengajuan izin..." required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <span class="btn-text">Ajukan Izin</span>
                        <div class="btn-loader" style="display: none;">
                            <div class="spinner"></div>
                        </div>
                    </button>
                </form>

                <!-- Cuti Form -->
                <form id="cuti-form" class="pengajuan-form">
                    @csrf
                    <div class="form-group">
                        <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                        <select id="jenis_cuti" name="jenis_cuti" class="form-select" required>
                            <option value="">Pilih Jenis Cuti</option>
                            <option value="tahunan">Cuti Tahunan</option>
                            <option value="hamil">Cuti Hamil</option>
                            <option value="besar">Cuti Besar</option>
                            <option value="penting">Cuti Penting</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="tanggal_mulai_cuti" class="form-label">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai_cuti" name="tanggal_mulai" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai_cuti" class="form-label">Tanggal Selesai</label>
                            <input type="date" id="tanggal_selesai_cuti" name="tanggal_selesai" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_hari" class="form-label">Jumlah Hari</label>
                        <input type="number" id="jumlah_hari" name="jumlah_hari" class="form-input" min="1" readonly>
                    </div>

                    <div class="form-group">
                        <label for="alasan_cuti" class="form-label">Alasan Cuti</label>
                        <textarea id="alasan_cuti" name="alasan" class="form-textarea" rows="4" placeholder="Jelaskan alasan pengajuan cuti..." required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <span class="btn-text">Ajukan Cuti</span>
                        <div class="btn-loader" style="display: none;">
                            <div class="spinner"></div>
                        </div>
                    </button>
                </form>
            </div>
        </div>

        <!-- History Section dengan Scroll -->
        <div class="history-section">
            <div class="history-card">
                <div class="history-header">
                    <h2 class="history-title">Statistik & Riwayat Pengajuan</h2>
                </div>

                <!-- Statistik Ringkas -->
                <div class="quick-stats">
                    <div class="quick-stat">
                        <div class="quick-stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="quick-stat-info">
                            <span class="quick-stat-value">2</span>
                            <span class="quick-stat-label">Pending</span>
                        </div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-icon approved">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="quick-stat-info">
                            <span class="quick-stat-value">10</span>
                            <span class="quick-stat-label">Disetujui</span>
                        </div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-icon rejected">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="quick-stat-info">
                            <span class="quick-stat-value">3</span>
                            <span class="quick-stat-label">Ditolak</span>
                        </div>
                    </div>
                </div>

                <!-- Chart Visual -->
                <div class="chart-container-scroll">
                    <div class="chart-header">
                        <h3>Distribusi Pengajuan Bulan Ini</h3>
                    </div>
                    <div class="chart-bars">
                        <div class="chart-bar-item">
                            <div class="bar-info">
                                <span class="bar-label">Izin Sakit</span>
                                <span class="bar-percentage">40%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill sakit" style="width: 40%"></div>
                            </div>
                            <span class="bar-count">4</span>
                        </div>
                        <div class="chart-bar-item">
                            <div class="bar-info">
                                <span class="bar-label">Izin Pribadi</span>
                                <span class="bar-percentage">30%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill pribadi" style="width: 30%"></div>
                            </div>
                            <span class="bar-count">3</span>
                        </div>
                        <div class="chart-bar-item">
                            <div class="bar-info">
                                <span class="bar-label">Cuti Tahunan</span>
                                <span class="bar-percentage">20%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill tahunan" style="width: 20%"></div>
                            </div>
                            <span class="bar-count">2</span>
                        </div>
                        <div class="chart-bar-item">
                            <div class="bar-info">
                                <span class="bar-label">Cuti Lainnya</span>
                                <span class="bar-percentage">10%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill lainnya" style="width: 10%"></div>
                            </div>
                            <span class="bar-count">1</span>
                        </div>
                    </div>
                </div>

                <!-- Filter Options -->
                <div class="filter-section">
                    <div class="filter-group">
                        <label class="filter-label">Status:</label>
                        <select id="status-filter" class="filter-select">
                            <option value="all">Semua Status</option>
                            <option value="pending">Menunggu</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Jenis:</label>
                        <select id="type-filter" class="filter-select">
                            <option value="all">Semua Jenis</option>
                            <option value="izin">Izin</option>
                            <option value="cuti">Cuti</option>
                        </select>
                    </div>
                    <button class="filter-reset" id="reset-filter">
                        <i class="fas fa-redo"></i>
                        Reset
                    </button>
                </div>

                <!-- History List dengan Scroll -->
                <div class="history-list-scroll">
                    <div class="history-list-container">
                        <!-- Item 1 -->
                        <div class="history-item" data-status="pending" data-type="izin">
                            <div class="item-header">
                                <div class="item-type">
                                    <i class="fas fa-file-medical"></i>
                                    <span>Izin Sakit</span>
                                </div>
                                <div class="item-status pending">
                                    <i class="fas fa-clock"></i>
                                    Menunggu
                                </div>
                            </div>
                            <div class="item-dates">
                                <i class="fas fa-calendar"></i>
                                20 Des 2023 - 21 Des 2023
                            </div>
                            <div class="item-reason">
                                Periksa kesehatan rutin dan konsultasi dokter
                            </div>
                            <div class="item-meta">
                                <span class="meta-days">
                                    <i class="fas fa-calendar-day"></i>
                                    2 Hari
                                </span>
                                <span class="meta-date">
                                    <i class="fas fa-paper-plane"></i>
                                    Diajukan: 18 Des 2023
                                </span>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="history-item" data-status="approved" data-type="cuti">
                            <div class="item-header">
                                <div class="item-type">
                                    <i class="fas fa-umbrella-beach"></i>
                                    <span>Cuti Tahunan</span>
                                </div>
                                <div class="item-status approved">
                                    <i class="fas fa-check-circle"></i>
                                    Disetujui
                                </div>
                            </div>
                            <div class="item-dates">
                                <i class="fas fa-calendar"></i>
                                15 Des 2023 - 20 Des 2023
                            </div>
                            <div class="item-reason">
                                Liburan akhir tahun bersama keluarga di kampung halaman
                            </div>
                            <div class="item-meta">
                                <span class="meta-days">
                                    <i class="fas fa-calendar-day"></i>
                                    6 Hari
                                </span>
                                <span class="meta-date">
                                    <i class="fas fa-paper-plane"></i>
                                    Diajukan: 10 Des 2023
                                </span>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="history-item" data-status="rejected" data-type="izin">
                            <div class="item-header">
                                <div class="item-type">
                                    <i class="fas fa-home"></i>
                                    <span>Izin Keluarga</span>
                                </div>
                                <div class="item-status rejected">
                                    <i class="fas fa-times-circle"></i>
                                    Ditolak
                                </div>
                            </div>
                            <div class="item-dates">
                                <i class="fas fa-calendar"></i>
                                12 Des 2023 - 13 Des 2023
                            </div>
                            <div class="item-reason">
                                Menemani anak yang sedang sakit dan perlu perawatan
                            </div>
                            <div class="item-meta">
                                <span class="meta-days">
                                    <i class="fas fa-calendar-day"></i>
                                    2 Hari
                                </span>
                                <span class="meta-date">
                                    <i class="fas fa-paper-plane"></i>
                                    Diajukan: 10 Des 2023
                                </span>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="history-item" data-status="approved" data-type="cuti">
                            <div class="item-header">
                                <div class="item-type">
                                    <i class="fas fa-baby"></i>
                                    <span>Cuti Hamil</span>
                                </div>
                                <div class="item-status approved">
                                    <i class="fas fa-check-circle"></i>
                                    Disetujui
                                </div>
                            </div>
                            <div class="item-dates">
                                <i class="fas fa-calendar"></i>
                                1 Nov 2023 - 30 Nov 2023
                            </div>
                            <div class="item-reason">
                                Persiapan melahirkan dan masa nifas setelah persalinan
                            </div>
                            <div class="item-meta">
                                <span class="meta-days">
                                    <i class="fas fa-calendar-day"></i>
                                    30 Hari
                                </span>
                                <span class="meta-date">
                                    <i class="fas fa-paper-plane"></i>
                                    Diajukan: 15 Okt 2023
                                </span>
                            </div>
                        </div>

                        <!-- Item 5 -->
                        <div class="history-item" data-status="approved" data-type="izin">
                            <div class="item-header">
                                <div class="item-type">
                                    <i class="fas fa-user-md"></i>
                                    <span>Izin Sakit</span>
                                </div>
                                <div class="item-status approved">
                                    <i class="fas fa-check-circle"></i>
                                    Disetujui
                                </div>
                            </div>
                            <div class="item-dates">
                                <i class="fas fa-calendar"></i>
                                5 Des 2023 - 6 Des 2023
                            </div>
                            <div class="item-reason">
                                Istirahat karena demam dan flu berat, dengan surat dokter
                            </div>
                            <div class="item-meta">
                                <span class="meta-days">
                                    <i class="fas fa-calendar-day"></i>
                                    2 Hari
                                </span>
                                <span class="meta-date">
                                    <i class="fas fa-paper-plane"></i>
                                    Diajukan: 4 Des 2023
                                </span>
                            </div>
                        </div>

                        <!-- Item 6 -->
                        <div class="history-item" data-status="pending" data-type="cuti">
                            <div class="item-header">
                                <div class="item-type">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Cuti Pendidikan</span>
                                </div>
                                <div class="item-status pending">
                                    <i class="fas fa-clock"></i>
                                    Menunggu
                                </div>
                            </div>
                            <div class="item-dates">
                                <i class="fas fa-calendar"></i>
                                8 Jan 2024 - 12 Jan 2024
                            </div>
                            <div class="item-reason">
                                Mengikuti ujian akhir semester dan persiapan wisuda
                            </div>
                            <div class="item-meta">
                                <span class="meta-days">
                                    <i class="fas fa-calendar-day"></i>
                                    5 Hari
                                </span>
                                <span class="meta-date">
                                    <i class="fas fa-paper-plane"></i>
                                    Diajukan: 20 Des 2023
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="modal">
    <div class="modal-content">
        <div class="modal-icon success">
            <i class="fas fa-check-circle"></i>
        </div>
        <h3 class="modal-title">Pengajuan Berhasil!</h3>
        <p class="modal-message">Pengajuan Anda telah berhasil dikirim dan sedang menunggu persetujuan.</p>
        <button class="modal-btn" id="modal-close">Tutup</button>
    </div>
</div>

<style>
/* Base Styles */
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

.pengajuan-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* Header Styles */
.pengajuan-header {
    margin-bottom: 30px;
}

.pengajuan-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--secondary);
    margin-bottom: 8px;
}

.pengajuan-subtitle {
    font-size: 1.1rem;
    color: var(--gray);
}

/* Stats Cards */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 25px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    transition: var(--transition);
    border-left: 4px solid var(--primary);
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    color: white;
    font-size: 1.5rem;
}

.stat-info h3 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 5px;
}

.stat-label {
    color: var(--gray);
    font-size: 0.9rem;
    font-weight: 500;
}

/* Main Content Layout */
.pengajuan-content {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 30px;
    min-height: 600px;
}

@media (max-width: 1200px) {
    .pengajuan-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

/* Form Section */
.form-section {
    height: 100%;
}

.form-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 25px;
    box-shadow: var(--shadow);
    height: fit-content;
    position: sticky;
    top: 100px;
}

.form-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--secondary);
    border-bottom: 2px solid var(--light);
    padding-bottom: 10px;
}

/* Tab Navigation */
.tab-navigation {
    display: flex;
    background: var(--light);
    border-radius: 8px;
    padding: 4px;
    margin-bottom: 25px;
}

.tab-btn {
    flex: 1;
    padding: 12px 20px;
    border: none;
    background: transparent;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    color: var(--gray);
}

.tab-btn.active {
    background: white;
    color: var(--primary);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Form Elements */
.pengajuan-form {
    display: none;
}

.pengajuan-form.active {
    display: block;
}

.form-group {
    margin-bottom: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--secondary);
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid var(--light);
    border-radius: 6px;
    font-size: 1rem;
    transition: var(--transition);
    background: white;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

/* Submit Button */
.submit-btn {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(52, 152, 219, 0.3);
}

.btn-loader {
    display: none;
}

.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* History Section dengan Scroll */
.history-section {
    height: 100%;
}

.history-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 25px;
    box-shadow: var(--shadow);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.history-header {
    margin-bottom: 25px;
}

.history-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--secondary);
    border-bottom: 2px solid var(--light);
    padding-bottom: 10px;
}

/* Quick Stats */
.quick-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

@media (max-width: 768px) {
    .quick-stats {
        grid-template-columns: 1fr;
    }
}

.quick-stat {
    display: flex;
    align-items: center;
    padding: 15px;
    background: var(--light);
    border-radius: 8px;
    gap: 12px;
    transition: var(--transition);
}

.quick-stat:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.quick-stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.quick-stat-icon.pending {
    background: var(--warning);
}

.quick-stat-icon.approved {
    background: var(--success);
}

.quick-stat-icon.rejected {
    background: var(--danger);
}

.quick-stat-info {
    display: flex;
    flex-direction: column;
}

.quick-stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--secondary);
}

.quick-stat-label {
    font-size: 0.8rem;
    color: var(--gray);
    font-weight: 500;
}

/* Chart Container */
.chart-container-scroll {
    background: var(--light);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 25px;
}

.chart-header {
    margin-bottom: 15px;
}

.chart-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--secondary);
}

.chart-bars {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.chart-bar-item {
    display: flex;
    align-items: center;
    gap: 15px;
}

.bar-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 150px;
}

.bar-label {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--secondary);
}

.bar-percentage {
    font-size: 0.8rem;
    color: var(--gray);
    font-weight: 500;
}

.bar-track {
    flex: 1;
    height: 20px;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.bar-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 1s ease;
    position: relative;
}

.bar-fill.sakit { background: var(--primary); }
.bar-fill.pribadi { background: var(--accent); }
.bar-fill.tahunan { background: var(--success); }
.bar-fill.lainnya { background: var(--warning); }

.bar-count {
    width: 30px;
    text-align: center;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--secondary);
}

/* Filter Section */
.filter-section {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    padding: 15px;
    background: var(--light);
    border-radius: 8px;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-label {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--secondary);
    white-space: nowrap;
}

.filter-select {
    padding: 8px 12px;
    border: 2px solid var(--light);
    border-radius: 6px;
    font-size: 0.9rem;
    background: white;
    cursor: pointer;
    min-width: 120px;
    transition: var(--transition);
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
}

.filter-reset {
    padding: 8px 15px;
    background: var(--gray);
    border: none;
    border-radius: 6px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 5px;
    color: white;
}

.filter-reset:hover {
    background: var(--secondary);
}

/* History List dengan Scroll */
.history-list-scroll {
    flex: 1;
    overflow: hidden;
    border-radius: 8px;
}

.history-list-container {
    height: 100%;
    max-height: 500px;
    overflow-y: auto;
    padding-right: 10px;
}

.history-list-container::-webkit-scrollbar {
    width: 6px;
}

.history-list-container::-webkit-scrollbar-track {
    background: var(--light);
    border-radius: 3px;
}

.history-list-container::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 3px;
}

.history-list-container::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}

.history-item {
    background: var(--light);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid var(--primary);
    transition: var(--transition);
}

.history-item:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow);
}

.history-item[data-status="pending"] {
    border-left-color: var(--warning);
}

.history-item[data-status="approved"] {
    border-left-color: var(--success);
}

.history-item[data-status="rejected"] {
    border-left-color: var(--danger);
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    flex-wrap: wrap;
    gap: 10px;
}

.item-type {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: var(--primary);
}

.item-type i {
    font-size: 1.1rem;
}

.item-status {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.item-status.pending {
    background: rgba(243, 156, 18, 0.1);
    color: var(--warning);
}

.item-status.approved {
    background: rgba(46, 204, 113, 0.1);
    color: var(--success);
}

.item-status.rejected {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger);
}

.item-dates {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: var(--gray);
    margin-bottom: 8px;
}

.item-reason {
    font-size: 0.95rem;
    color: var(--secondary);
    line-height: 1.5;
    margin-bottom: 12px;
}

.item-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.meta-days, .meta-date {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.8rem;
    color: var(--gray);
    font-weight: 500;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    border-radius: var(--border-radius);
    padding: 40px;
    text-align: center;
    max-width: 400px;
    width: 90%;
    animation: modalAppear 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

@keyframes modalAppear {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

.modal-icon.success {
    color: var(--success);
}

.modal-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: var(--secondary);
}

.modal-message {
    color: var(--gray);
    margin-bottom: 25px;
    line-height: 1.6;
}

.modal-btn {
    padding: 12px 30px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.modal-btn:hover {
    background: var(--primary-dark);
}

/* Responsive Design */
@media (max-width: 768px) {
    .pengajuan-container {
        padding: 15px;
    }
    
    .pengajuan-title {
        font-size: 1.8rem;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .filter-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        justify-content: space-between;
    }
    
    .item-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .item-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .history-list-container {
        max-height: 400px;
    }
}

/* Animation for form switching */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.pengajuan-form.active {
    animation: fadeIn 0.3s ease;
}

/* Empty state untuk riwayat kosong */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: var(--gray);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

.empty-state p {
    font-size: 1.1rem;
    margin-bottom: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation
    const tabBtns = document.querySelectorAll('.tab-btn');
    const forms = document.querySelectorAll('.pengajuan-form');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Update active tab
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Show corresponding form
            forms.forEach(form => {
                form.classList.remove('active');
                if (form.id === `${targetTab}-form`) {
                    form.classList.add('active');
                }
            });
        });
    });
    
    // Date calculation for cuti form
    const startDateCuti = document.getElementById('tanggal_mulai_cuti');
    const endDateCuti = document.getElementById('tanggal_selesai_cuti');
    const jumlahHari = document.getElementById('jumlah_hari');
    
    function calculateDays() {
        if (startDateCuti.value && endDateCuti.value) {
            const start = new Date(startDateCuti.value);
            const end = new Date(endDateCuti.value);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            jumlahHari.value = diffDays;
        }
    }
    
    if (startDateCuti && endDateCuti) {
        startDateCuti.addEventListener('change', calculateDays);
        endDateCuti.addEventListener('change', calculateDays);
    }
    
    // Form submission
    const formsToSubmit = document.querySelectorAll('.pengajuan-form');
    const successModal = document.getElementById('success-modal');
    const modalClose = document.getElementById('modal-close');
    
    formsToSubmit.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('.submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoader = submitBtn.querySelector('.btn-loader');
            
            // Show loading state
            btnText.style.display = 'none';
            btnLoader.style.display = 'block';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Reset button
                btnText.style.display = 'block';
                btnLoader.style.display = 'none';
                submitBtn.disabled = false;
                
                // Show success modal
                successModal.style.display = 'flex';
                
                // Reset form
                this.reset();
                if (jumlahHari) jumlahHari.value = '';
            }, 2000);
        });
    });
    
    // Close modal
    modalClose.addEventListener('click', function() {
        successModal.style.display = 'none';
    });
    
    // Filter history
    const statusFilter = document.getElementById('status-filter');
    const typeFilter = document.getElementById('type-filter');
    const resetFilter = document.getElementById('reset-filter');
    const historyItems = document.querySelectorAll('.history-item');
    
    function filterHistory() {
        const statusValue = statusFilter.value;
        const typeValue = typeFilter.value;
        
        historyItems.forEach(item => {
            const itemStatus = item.getAttribute('data-status');
            const itemType = item.getAttribute('data-type');
            
            const statusMatch = statusValue === 'all' || itemStatus === statusValue;
            const typeMatch = typeValue === 'all' || itemType === typeValue;
            
            if (statusMatch && typeMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
    
    if (statusFilter && typeFilter) {
        statusFilter.addEventListener('change', filterHistory);
        typeFilter.addEventListener('change', filterHistory);
        
        resetFilter.addEventListener('click', function() {
            statusFilter.value = 'all';
            typeFilter.value = 'all';
            filterHistory();
        });
    }
    
    // Initialize chart animations
    setTimeout(() => {
        const barFills = document.querySelectorAll('.bar-fill');
        barFills.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 300);
        });
    }, 500);
});
</script>
@endsection