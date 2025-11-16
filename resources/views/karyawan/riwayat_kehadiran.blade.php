@extends('layout.appkaryawan')

@section('title', 'Riwayat Kehadiran - Sistem Absensi')

@section('page-title', 'Riwayat Kehadiran')

@section('content')
<div class="container-fluid py-4">
    <!-- Main Dashboard -->
    <div class="dashboard-layout">
        <!-- Left Panel - Riwayat Kehadiran -->
        <div class="left-panel">
            <!-- Quick Stats -->
            <div class="card quick-stats-card animate-fade-in">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Ringkasan Kehadiran
                    </h3>
                    <div class="period-selector">
                        <select class="form-select-sm" id="periodSelect">
                            <option value="2024-01">Januari 2024</option>
                            <option value="2024-02">Februari 2024</option>
                            <option value="2024-03">Maret 2024</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="stats-grid">
                        <div class="stat-item success animate-slide-left">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="totalHadir">0</div>
                                <div class="stat-label">Hadir Tepat Waktu</div>
                            </div>
                            <div class="stat-progress">
                                <div class="progress">
                                    <div class="progress-bar" id="hadirProgressBar" style="width: 0%"></div>
                                </div>
                                <span id="hadirPercentage">0%</span>
                            </div>
                        </div>

                        <div class="stat-item warning animate-slide-left" style="animation-delay: 0.1s">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="totalTerlambat">0</div>
                                <div class="stat-label">Terlambat</div>
                            </div>
                            <div class="stat-progress">
                                <div class="progress">
                                    <div class="progress-bar" id="terlambatProgressBar" style="width: 0%"></div>
                                </div>
                                <span id="terlambatPercentage">0%</span>
                            </div>
                        </div>

                        <div class="stat-item info animate-slide-left" style="animation-delay: 0.2s">
                            <div class="stat-icon">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="totalIzin">0</div>
                                <div class="stat-label">Izin</div>
                            </div>
                            <div class="stat-progress">
                                <div class="progress">
                                    <div class="progress-bar" id="izinProgressBar" style="width: 0%"></div>
                                </div>
                                <span id="izinPercentage">0%</span>
                            </div>
                        </div>

                        <div class="stat-item danger animate-slide-left" style="animation-delay: 0.3s">
                            <div class="stat-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="totalSakit">0</div>
                                <div class="stat-label">Sakit</div>
                            </div>
                            <div class="stat-progress">
                                <div class="progress">
                                    <div class="progress-bar" id="sakitProgressBar" style="width: 0%"></div>
                                </div>
                                <span id="sakitPercentage">0%</span>
                            </div>
                        </div>
                    </div>

                    <div class="overall-stat animate-fade-in" style="animation-delay: 0.4s">
                        <div class="overall-content">
                            <div class="overall-number">
                                <span id="persentaseKehadiran">0</span>%
                            </div>
                            <div class="overall-label">Persentase Kehadiran Bulan Ini</div>
                        </div>
                        <div class="overall-chart">
                            <div class="chart-circle">
                                <div class="chart-progress" id="kehadiranProgress"></div>
                                <div class="chart-text" id="chartText">0%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search Section -->
            <div class="card filter-card animate-fade-in" style="animation-delay: 0.1s">
                <div class="card-body">
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label class="form-label">Tanggal</label>
                            <div class="date-inputs">
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="startDate" value="{{ date('Y-m-01') }}">
                                </div>
                                <span class="date-separator">s/d</span>
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="endDate" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <div class="filter-group">
                            <label class="form-label">Status</label>
                            <div class="input-group">
                                <span class="input-icon">
                                    <i class="fas fa-filter"></i>
                                </span>
                                <select class="form-control" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Terlambat">Terlambat</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Cuti">Cuti</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-group">
                            <label class="form-label">Cari</label>
                            <div class="input-group">
                                <span class="input-icon">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari berdasarkan keterangan...">
                            </div>
                        </div>

                        <div class="filter-actions">
                            <button class="btn btn-outline" id="resetFilter">
                                <i class="fas fa-redo me-2"></i>Reset
                            </button>
                            <button class="btn btn-primary" id="applyFilter">
                                <i class="fas fa-filter me-2"></i>Terapkan Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table Section -->
            <div class="card data-table-card animate-fade-in" style="animation-delay: 0.2s">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history me-2"></i>
                        Riwayat Kehadiran
                    </h3>
                    <div class="table-actions">
                        <button class="btn btn-sm btn-outline-success" id="refreshBtn">
                            <i class="fas fa-sync-alt me-1"></i>Refresh
                        </button>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <!-- Loading State -->
                    <div id="loadingState" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mt-2">Memuat data kehadiran...</p>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="text-center py-5" style="display: none;">
                        <div class="empty-icon mb-3">
                            <i class="fas fa-inbox fa-3x text-muted"></i>
                        </div>
                        <h5 class="text-muted">Tidak ada data kehadiran</h5>
                        <p class="text-muted">Data kehadiran akan muncul di sini setelah Anda melakukan absensi</p>
                        <button class="btn btn-primary mt-2" id="reloadDataBtn">
                            <i class="fas fa-sync me-2"></i>Muat Ulang Data
                        </button>
                    </div>

                    <!-- Data Table -->
                    <div id="dataTable" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="120">Tanggal</th>
                                        <th width="100">Hari</th>
                                        <th width="120">Check In</th>
                                        <th width="120">Check Out</th>
                                        <th width="100">Durasi</th>
                                        <th width="120">Status</th>
                                        <th>Keterangan</th>
                                        <th width="100" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceBody">
                                    <!-- Data akan diisi oleh JavaScript -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <span class="text-muted" id="paginationInfo">Menampilkan 0 dari 0 data</span>
                                </div>
                                <div class="col-md-6">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-end mb-0" id="pagination">
                                            <!-- Pagination akan di-generate oleh JavaScript -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Information -->
        <div class="right-panel">
            <!-- Recent Activity -->
            <div class="card activity-card animate-fade-in" style="animation-delay: 0.3s">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-alt me-2"></i>
                        Aktivitas Terbaru
                    </h3>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        <div class="activity-item success animate-slide-right">
                            <div class="activity-marker"></div>
                            <div class="activity-content">
                                <div class="activity-title">Check-out berhasil</div>
                                <div class="activity-desc">17:05 - Kantor Pusat</div>
                                <div class="activity-time">Hari ini, 17:05</div>
                            </div>
                        </div>

                        <div class="activity-item warning animate-slide-right" style="animation-delay: 0.1s">
                            <div class="activity-marker"></div>
                            <div class="activity-content">
                                <div class="activity-title">Terlambat 15 menit</div>
                                <div class="activity-desc">Check-in: 08:15</div>
                                <div class="activity-time">Kemarin, 08:15</div>
                            </div>
                        </div>

                        <div class="activity-item info animate-slide-right" style="animation-delay: 0.2s">
                            <div class="activity-marker"></div>
                            <div class="activity-content">
                                <div class="activity-title">Izin setengah hari</div>
                                <div class="activity-desc">Keperluan keluarga</div>
                                <div class="activity-time">2 hari lalu</div>
                            </div>
                        </div>

                        <div class="activity-item success animate-slide-right" style="animation-delay: 0.3s">
                            <div class="activity-marker"></div>
                            <div class="activity-content">
                                <div class="activity-title">Check-in tepat waktu</div>
                                <div class="activity-desc">08:00 - Kantor Pusat</div>
                                <div class="activity-time">3 hari lalu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Panel -->
            <div class="card info-panel-card animate-fade-in" style="animation-delay: 0.4s">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Penting
                    </h3>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-item urgent animate-slide-right">
                            <div class="info-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="info-content">
                                <h6>Batas Koreksi Data</h6>
                                <p>Pengajuan koreksi data maksimal 3 hari setelah tanggal absensi</p>
                            </div>
                        </div>
                        <div class="info-item animate-slide-right" style="animation-delay: 0.1s">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <h6>Jam Kerja Normal</h6>
                                <p>Senin - Jumat: 08:00 - 17:00 WIB</p>
                            </div>
                        </div>
                        <div class="info-item animate-slide-right" style="animation-delay: 0.2s">
                            <div class="info-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="info-content">
                                <h6>HR Contact</h6>
                                <p>Email: hr@company.com<br>Telp: (021) 1234-5678</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
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

/* Enhanced Dashboard Layout */
.dashboard-layout {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 1.5rem;
    align-items: start;
    margin: 0 auto;
}

.left-panel {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.right-panel {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    position: sticky;
    top: 1rem;
    height: fit-content;
}

/* Enhanced Card Styles */
.card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    transition: var(--transition);
    border: none;
    overflow: hidden;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

.card-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    background: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--secondary);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-title i {
    color: var(--primary);
}

.card-body {
    padding: 1.5rem;
}

/* Enhanced Quick Stats */
.quick-stats-card .stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: white;
    border-radius: var(--border-radius);
    transition: var(--transition);
    border: 1px solid #f0f0f0;
    position: relative;
    overflow: hidden;
}

.stat-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    transition: var(--transition);
}

.stat-item.success::before { background: var(--success); }
.stat-item.warning::before { background: var(--warning); }
.stat-item.info::before { background: var(--primary); }
.stat-item.danger::before { background: var(--danger); }

.stat-item:hover {
    transform: translateY(-2px);
    border-color: #e0e0e0;
}

.stat-item:hover::before {
    width: 6px;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    flex-shrink: 0;
    transition: var(--transition);
}

.stat-item:hover .stat-icon {
    transform: scale(1.1);
}

.stat-item.success .stat-icon { 
    background: linear-gradient(135deg, var(--success), #27ae60);
}
.stat-item.warning .stat-icon { 
    background: linear-gradient(135deg, var(--warning), #e67e22);
}
.stat-item.info .stat-icon { 
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
}
.stat-item.danger .stat-icon { 
    background: linear-gradient(135deg, var(--danger), #c0392b);
}

.stat-content {
    flex: 1;
    min-width: 0;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--secondary);
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-progress {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 80px;
    align-items: flex-end;
}

.progress {
    height: 6px;
    background: #f0f0f0;
    border-radius: 3px;
    overflow: hidden;
    width: 100%;
    max-width: 80px;
}

.progress-bar {
    height: 100%;
    border-radius: 3px;
    transition: width 1s ease;
}

.stat-item.success .progress-bar { 
    background: linear-gradient(90deg, var(--success), #27ae60);
}
.stat-item.warning .progress-bar { 
    background: linear-gradient(90deg, var(--warning), #e67e22);
}
.stat-item.info .progress-bar { 
    background: linear-gradient(90deg, var(--primary), var(--primary-dark));
}
.stat-item.danger .progress-bar { 
    background: linear-gradient(90deg, var(--danger), #c0392b);
}

.stat-progress span {
    font-size: 0.7rem;
    color: var(--gray);
    font-weight: 600;
}

/* Enhanced Overall Stat */
.overall-stat {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: var(--border-radius);
    color: white;
    position: relative;
    overflow: hidden;
}

.overall-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
}

.overall-label {
    font-size: 0.875rem;
    opacity: 0.9;
    margin-top: 0.5rem;
}

.chart-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: conic-gradient(white 0%, rgba(255,255,255,0.3) 0%);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chart-text {
    position: absolute;
    font-size: 1rem;
    font-weight: 700;
    color: white;
}

/* Enhanced Filter Section */
.filter-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--secondary);
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.date-inputs {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.date-separator {
    color: var(--gray);
    font-weight: 600;
    font-size: 0.875rem;
    padding: 0 0.5rem;
}

.input-group {
    position: relative;
    display: flex;
    align-items: center;
    flex: 1;
}

.input-icon {
    position: absolute;
    left: 0.75rem;
    color: var(--gray);
    z-index: 2;
}

.form-control, .form-select {
    width: 100%;
    padding: 0.75rem 0.75rem 0.75rem 2.5rem;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    transition: var(--transition);
    background: white;
}

.form-control:focus, .form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

.filter-actions {
    display: flex;
    gap: 0.75rem;
    align-items: flex-end;
}

/* Enhanced Button Styles */
.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.btn-outline {
    background: white;
    border: 1px solid #ddd;
    color: var(--gray);
}

.btn-outline:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: #f8f9fa;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.75rem;
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-success:hover {
    background: #27ae60;
}

/* Enhanced Table Styles */
.table-responsive {
    border-radius: var(--border-radius);
    overflow: hidden;
}

.table {
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.table thead th {
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    font-weight: 600;
    color: var(--secondary);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem 0.75rem;
    white-space: nowrap;
}

.table tbody tr {
    transition: var(--transition);
}

.table tbody tr:hover {
    background: #f8f9fa;
}

.table tbody td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-bottom: 1px solid #f8f9fa;
}

/* Enhanced Status Badges */
.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.hadir { 
    background: rgba(46, 204, 113, 0.1); 
    color: var(--success);
}
.status-badge.terlambat { 
    background: rgba(243, 156, 18, 0.1); 
    color: var(--warning);
}
.status-badge.izin { 
    background: rgba(52, 152, 219, 0.1); 
    color: var(--primary);
}
.status-badge.sakit { 
    background: rgba(231, 76, 60, 0.1); 
    color: var(--danger);
}

/* Enhanced Activity Timeline */
.activity-timeline {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    border-radius: var(--border-radius);
    transition: var(--transition);
    border-left: 3px solid transparent;
}

.activity-item.success { 
    border-left-color: var(--success);
    background: rgba(46, 204, 113, 0.05);
}
.activity-item.warning { 
    border-left-color: var(--warning);
    background: rgba(243, 156, 18, 0.05);
}
.activity-item.info { 
    border-left-color: var(--primary);
    background: rgba(52, 152, 219, 0.05);
}

.activity-item:hover {
    transform: translateX(2px);
}

.activity-marker {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-top: 0.375rem;
    flex-shrink: 0;
}

.activity-item.success .activity-marker { background: var(--success); }
.activity-item.warning .activity-marker { background: var(--warning); }
.activity-item.info .activity-marker { background: var(--primary); }

.activity-title {
    font-weight: 600;
    color: var(--secondary);
    font-size: 0.75rem;
    margin-bottom: 0.125rem;
}

.activity-desc {
    font-size: 0.7rem;
    color: var(--gray);
    margin-bottom: 0.125rem;
}

.activity-time {
    font-size: 0.65rem;
    color: var(--gray);
}

/* Enhanced Info Panel */
.info-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.info-item:hover {
    background: #e9ecef;
    transform: translateX(2px);
}

.info-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.125rem;
    flex-shrink: 0;
    transition: var(--transition);
}

.info-item:hover .info-icon {
    transform: scale(1.1);
}

.info-item.urgent .info-icon {
    background: var(--warning);
}

.info-content h6 {
    font-weight: 600;
    margin: 0 0 0.25rem 0;
    color: var(--secondary);
    font-size: 0.75rem;
}

.info-content p {
    margin: 0;
    font-size: 0.7rem;
    color: var(--gray);
    line-height: 1.4;
}

/* Enhanced Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out forwards;
}

.animate-slide-left {
    animation: slideInLeft 0.6s ease-out forwards;
}

.animate-slide-right {
    animation: slideInRight 0.6s ease-out forwards;
}

/* Enhanced Responsive Design */
@media (max-width: 1200px) {
    .dashboard-layout {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .right-panel {
        position: static;
        order: -1;
    }
    
    .quick-stats-card .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .quick-stats-card .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .filter-grid {
        grid-template-columns: 1fr;
    }
    
    .date-inputs {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .date-separator {
        display: none;
    }
    
    .overall-stat {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .stat-item {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .stat-progress {
        align-items: center;
        width: 100%;
    }
    
    .progress {
        max-width: 100%;
    }
    
    .table-responsive {
        font-size: 0.8rem;
    }
    
    .card-header {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start;
    }
    
    .table-actions {
        width: 100%;
        justify-content: space-between;
    }
}

@media (max-width: 480px) {
    .filter-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Sample Data yang lebih realistis
const sampleData = [
    {
        id: 1,
        tanggal: '2024-01-15',
        hari: 'Senin',
        check_in: '08:00',
        check_out: '17:00',
        status: 'Hadir',
        keterangan: 'Tepat waktu',
        durasi: '9 jam',
        lokasi: 'Kantor Pusat'
    },
    {
        id: 2,
        tanggal: '2024-01-16',
        hari: 'Selasa', 
        check_in: '08:15',
        check_out: '17:05',
        status: 'Terlambat',
        keterangan: 'Terlambat 15 menit karena macet',
        durasi: '8 jam 50 menit',
        lokasi: 'Kantor Cabang'
    },
    {
        id: 3,
        tanggal: '2024-01-17',
        hari: 'Rabu',
        check_in: '08:00',
        check_out: '16:30',
        status: 'Izin',
        keterangan: 'Izin setengah hari - keperluan keluarga',
        durasi: '8 jam 30 menit',
        lokasi: 'Kantor Pusat'
    },
    {
        id: 4,
        tanggal: '2024-01-18',
        hari: 'Kamis',
        check_in: '08:05',
        check_out: '17:10',
        status: 'Hadir',
        keterangan: 'Tepat waktu',
        durasi: '9 jam 5 menit',
        lokasi: 'Kantor Pusat'
    },
    {
        id: 5,
        tanggal: '2024-01-19',
        hari: 'Jumat',
        check_in: '07:55',
        check_out: '16:45',
        status: 'Hadir',
        keterangan: 'Pulang lebih awal - rapat luar',
        durasi: '8 jam 50 menit',
        lokasi: 'Site Visit'
    }
];

class AttendanceHistory {
    constructor() {
        this.currentData = [];
        this.filteredData = [];
        this.currentPage = 1;
        this.itemsPerPage = 5;
        this.init();
    }

    init() {
        this.loadData();
        this.bindEvents();
    }

    loadData() {
        this.showLoading(true);
        
        // Simulasi loading data
        setTimeout(() => {
            this.currentData = [...sampleData, ...this.generateDummyData(15)];
            this.applyFilters();
            this.showLoading(false);
            this.renderTable();
            this.updateStatistics();
            
            // Animate progress bars after data load
            setTimeout(() => {
                this.animateProgressBars();
            }, 500);
        }, 1000);
    }

    generateDummyData(count) {
        const statuses = ['Hadir', 'Terlambat', 'Izin', 'Sakit'];
        const locations = ['Kantor Pusat', 'Kantor Cabang', 'Remote', 'Site Visit'];
        const data = [];
        
        const startDate = new Date('2024-01-01');
        
        for (let i = 1; i <= count; i++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i + 5);
            
            const status = statuses[Math.floor(Math.random() * statuses.length)];
            const isWeekend = date.getDay() === 0 || date.getDay() === 6;
            
            if (!isWeekend) {
                data.push({
                    id: i + 5,
                    tanggal: date.toISOString().split('T')[0],
                    hari: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][date.getDay()],
                    check_in: `08:${String(Math.floor(Math.random() * 20)).padStart(2, '0')}`,
                    check_out: `17:${String(Math.floor(Math.random() * 30)).padStart(2, '0')}`,
                    status: status,
                    keterangan: this.generateKeterangan(status),
                    durasi: `${8 + Math.floor(Math.random() * 2)} jam ${Math.floor(Math.random() * 60)} menit`,
                    lokasi: locations[Math.floor(Math.random() * locations.length)]
                });
            }
        }
        return data;
    }

    generateKeterangan(status) {
        const keterangan = {
            'Hadir': ['Tepat waktu', 'Hadir sesuai jadwal', 'Kerja penuh', 'Sesuai target'],
            'Terlambat': ['Terlambat karena macet', 'Transportasi terlambat', 'Kondisi jalan padat', 'Hujan deras'],
            'Izin': ['Izin keluarga', 'Keperluan mendesak', 'Izin pribadi', 'Urusan keluarga'],
            'Sakit': ['Sakit demam', 'Kontrol dokter', 'Istirahat sakit', 'Konsultasi medis']
        };
        const options = keterangan[status] || ['Tidak ada keterangan'];
        return options[Math.floor(Math.random() * options.length)];
    }

    applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        this.filteredData = this.currentData.filter(item => {
            const matchesSearch = !searchTerm || 
                item.tanggal.includes(searchTerm) ||
                item.hari.toLowerCase().includes(searchTerm) ||
                item.status.toLowerCase().includes(searchTerm) ||
                item.keterangan.toLowerCase().includes(searchTerm) ||
                item.lokasi.toLowerCase().includes(searchTerm);

            const matchesStatus = !statusFilter || item.status === statusFilter;
            const matchesDate = (!startDate || item.tanggal >= startDate) && 
                              (!endDate || item.tanggal <= endDate);

            return matchesSearch && matchesStatus && matchesDate;
        });

        this.currentPage = 1;
    }

    showLoading(show) {
        const loading = document.getElementById('loadingState');
        const empty = document.getElementById('emptyState');
        const table = document.getElementById('dataTable');

        if (show) {
            loading.style.display = 'block';
            empty.style.display = 'none';
            table.style.display = 'none';
        } else {
            loading.style.display = 'none';
        }
    }

    renderTable() {
        const tbody = document.getElementById('attendanceBody');
        const empty = document.getElementById('emptyState');
        const table = document.getElementById('dataTable');

        if (this.filteredData.length === 0) {
            empty.style.display = 'block';
            table.style.display = 'none';
            this.renderPagination();
            return;
        }

        empty.style.display = 'none';
        table.style.display = 'block';

        const startIndex = (this.currentPage - 1) * this.itemsPerPage;
        const endIndex = startIndex + this.itemsPerPage;
        const pageData = this.filteredData.slice(startIndex, endIndex);

        tbody.innerHTML = pageData.map(item => `
            <tr>
                <td>
                    <div class="fw-bold text-dark">${this.formatDate(item.tanggal)}</div>
                </td>
                <td>
                    <span class="badge bg-light text-dark border">${item.hari}</span>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-sign-in-alt text-success me-2 fs-6"></i>
                        <span class="fw-bold">${item.check_in}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-sign-out-alt text-danger me-2 fs-6"></i>
                        <span class="fw-bold">${item.check_out}</span>
                    </div>
                </td>
                <td>
                    <span class="badge bg-info bg-opacity-10 text-info border border-info">${item.durasi}</span>
                </td>
                <td>
                    <span class="status-badge ${item.status.toLowerCase()}">${item.status}</span>
                </td>
                <td>
                    <small class="text-muted d-block">${item.keterangan}</small>
                    <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>${item.lokasi}</small>
                </td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary btn-sm view-detail" data-id="${item.id}" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        this.renderPagination();
    }

    renderPagination() {
        const pagination = document.getElementById('pagination');
        const totalPages = Math.ceil(this.filteredData.length / this.itemsPerPage);
        
        const startItem = ((this.currentPage - 1) * this.itemsPerPage) + 1;
        const endItem = Math.min(this.currentPage * this.itemsPerPage, this.filteredData.length);
        
        document.getElementById('paginationInfo').textContent = 
            `Menampilkan ${startItem}-${endItem} dari ${this.filteredData.length} data`;

        if (totalPages <= 1) {
            pagination.innerHTML = '';
            return;
        }

        let paginationHTML = '';
        
        // Previous button
        paginationHTML += `
            <li class="page-item ${this.currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${this.currentPage - 1}">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        `;

        // Page numbers
        const maxVisiblePages = 5;
        let startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        
        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `
                <li class="page-item ${this.currentPage === i ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `;
        }

        // Next button
        paginationHTML += `
            <li class="page-item ${this.currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${this.currentPage + 1}">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        `;

        pagination.innerHTML = paginationHTML;
    }

    updateStatistics() {
        const total = this.filteredData.length;
        const hadir = this.filteredData.filter(item => item.status === 'Hadir').length;
        const terlambat = this.filteredData.filter(item => item.status === 'Terlambat').length;
        const izin = this.filteredData.filter(item => item.status === 'Izin').length;
        const sakit = this.filteredData.filter(item => item.status === 'Sakit').length;
        const persentase = total > 0 ? Math.round((hadir / total) * 100) : 0;

        // Update numbers
        document.getElementById('totalHadir').textContent = hadir;
        document.getElementById('totalTerlambat').textContent = terlambat;
        document.getElementById('totalIzin').textContent = izin;
        document.getElementById('totalSakit').textContent = sakit;
        document.getElementById('persentaseKehadiran').textContent = persentase;

        // Update percentages
        document.getElementById('hadirPercentage').textContent = total > 0 ? Math.round((hadir / total) * 100) + '%' : '0%';
        document.getElementById('terlambatPercentage').textContent = total > 0 ? Math.round((terlambat / total) * 100) + '%' : '0%';
        document.getElementById('izinPercentage').textContent = total > 0 ? Math.round((izin / total) * 100) + '%' : '0%';
        document.getElementById('sakitPercentage').textContent = total > 0 ? Math.round((sakit / total) * 100) + '%' : '0%';

        // Update chart
        document.getElementById('chartText').textContent = persentase + '%';
    }

    animateProgressBars() {
        const total = this.filteredData.length;
        const hadir = this.filteredData.filter(item => item.status === 'Hadir').length;
        const terlambat = this.filteredData.filter(item => item.status === 'Terlambat').length;
        const izin = this.filteredData.filter(item => item.status === 'Izin').length;
        const sakit = this.filteredData.filter(item => item.status === 'Sakit').length;
        const persentase = total > 0 ? Math.round((hadir / total) * 100) : 0;

        // Animate progress bars
        this.animateProgressBar('hadirProgressBar', hadir, total);
        this.animateProgressBar('terlambatProgressBar', terlambat, total);
        this.animateProgressBar('izinProgressBar', izin, total);
        this.animateProgressBar('sakitProgressBar', sakit, total);

        // Animate chart circle
        const chartProgress = document.getElementById('kehadiranProgress');
        chartProgress.style.background = `conic-gradient(white ${persentase}%, rgba(255,255,255,0.3) ${persentase}%)`;
    }

    animateProgressBar(barId, value, total) {
        const percentage = total > 0 ? (value / total) * 100 : 0;
        const bar = document.getElementById(barId);
        if (bar) {
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = percentage + '%';
            }, 300);
        }
    }

    showDetail(id) {
        const item = this.currentData.find(d => d.id === id);
        if (!item) return;

        const modalContent = document.getElementById('detailContent');
        modalContent.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-section">
                        <h6 class="detail-section-title">
                            <i class="fas fa-info-circle me-2 text-primary"></i>Informasi Kehadiran
                        </h6>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">Tanggal</span>
                                <span class="detail-value">${this.formatDate(item.tanggal)}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Hari</span>
                                <span class="detail-value">${item.hari}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Status</span>
                                <span class="detail-value"><span class="status-badge ${item.status.toLowerCase()}">${item.status}</span></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Durasi</span>
                                <span class="detail-value"><span class="badge bg-info bg-opacity-10 text-info">${item.durasi}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-section">
                        <h6 class="detail-section-title">
                            <i class="fas fa-map-marker-alt me-2 text-success"></i>Lokasi & Waktu
                        </h6>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">Lokasi</span>
                                <span class="detail-value">${item.lokasi}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Check In</span>
                                <span class="detail-value"><i class="fas fa-sign-in-alt text-success me-1"></i>${item.check_in}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Check Out</span>
                                <span class="detail-value"><i class="fas fa-sign-out-alt text-danger me-1"></i>${item.check_out}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Lama Kerja</span>
                                <span class="detail-value">${item.durasi}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="detail-section">
                        <h6 class="detail-section-title">
                            <i class="fas fa-sticky-note me-2 text-warning"></i>Keterangan
                        </h6>
                        <div class="keterangan-content">
                            <p class="mb-0">${item.keterangan}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;

        new bootstrap.Modal(document.getElementById('detailModal')).show();
    }

    bindEvents() {
        // Filter buttons
        document.getElementById('applyFilter').addEventListener('click', () => {
            this.applyFilters();
            this.renderTable();
            this.updateStatistics();
            this.animateProgressBars();
        });

        document.getElementById('resetFilter').addEventListener('click', () => {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('startDate').value = '{{ date('Y-m-01') }}';
            document.getElementById('endDate').value = '{{ date('Y-m-d') }}';
            this.applyFilters();
            this.renderTable();
            this.updateStatistics();
            this.animateProgressBars();
        });

        // Search input dengan debounce
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.applyFilters();
                this.renderTable();
                this.updateStatistics();
                this.animateProgressBars();
            }, 500);
        });

        // Status filter change
        document.getElementById('statusFilter').addEventListener('change', () => {
            this.applyFilters();
            this.renderTable();
            this.updateStatistics();
            this.animateProgressBars();
        });

        // Date filters
        document.getElementById('startDate').addEventListener('change', () => {
            this.applyFilters();
            this.renderTable();
            this.updateStatistics();
            this.animateProgressBars();
        });

        document.getElementById('endDate').addEventListener('change', () => {
            this.applyFilters();
            this.renderTable();
            this.updateStatistics();
            this.animateProgressBars();
        });

        // Pagination
        document.getElementById('pagination').addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target.classList.contains('page-link')) {
                const page = parseInt(e.target.dataset.page);
                if (page && page !== this.currentPage) {
                    this.currentPage = page;
                    this.renderTable();
                    this.scrollToTop();
                }
            }
        });

        // Refresh button
        document.getElementById('refreshBtn').addEventListener('click', () => {
            this.loadData();
            this.showToast('Data berhasil diperbarui', 'success');
        });

        // View detail
        document.addEventListener('click', (e) => {
            if (e.target.closest('.view-detail')) {
                const id = parseInt(e.target.closest('.view-detail').dataset.id);
                this.showDetail(id);
            }
        });

        // Reload data button
        document.getElementById('reloadDataBtn').addEventListener('click', () => {
            this.loadData();
        });
    }

    scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    showToast(message, type = 'info') {
        // Simple toast implementation
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
        toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    new AttendanceHistory();
    
    // Add hover effects to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Add CSS for detail modal
const detailStyle = document.createElement('style');
detailStyle.textContent = `
    .detail-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 1.5rem;
        height: 100%;
    }
    .detail-section-title {
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        font-size: 0.9rem;
    }
    .detail-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        background: white;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }
    .detail-label {
        font-weight: 600;
        color: var(--gray);
        font-size: 0.8rem;
    }
    .detail-value {
        font-weight: 600;
        color: var(--secondary);
        font-size: 0.85rem;
    }
    .keterangan-content {
        background: white;
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 0.9rem;
        line-height: 1.5;
    }
`;
document.head.appendChild(detailStyle);
</script>
@endpush