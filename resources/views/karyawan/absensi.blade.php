@extends('layout.appkaryawan')

@section('title', 'Absensi Harian - Sistem Absensi')

@section('page-title', 'Absensi Karyawan')

@section('content')
<div class="container-fluid py-4">
    <!-- Main Dashboard -->
    <div class="dashboard-layout">
        <!-- Left Panel - Absensi Manual -->
        <div class="left-panel">
            <!-- Quick Status -->
            <div class="card quick-status-card animate-fade-in">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-day me-2"></i>
                        Status Hari Ini
                    </h3>
                    <div class="status-indicator success">
                        <i class="fas fa-check-circle me-1"></i>
                        SUDAH CHECK-IN
                    </div>
                </div>
                <div class="card-body">
                    <div class="status-timeline">
                        <div class="timeline-item completed animate-slide-left">
                            <div class="timeline-marker">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="time">07:30:15</span>
                                <span class="label">Check-in</span>
                                <span class="status">Tepat Waktu</span>
                            </div>
                        </div>
                        <div class="timeline-item pending animate-slide-left" style="animation-delay: 0.1s">
                            <div class="timeline-marker">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="time">--:--:--</span>
                                <span class="label">Check-out</span>
                                <span class="status">Menunggu</span>
                            </div>
                        </div>
                    </div>
                    <div class="working-hours animate-fade-in" style="animation-delay: 0.2s">
                        <div class="hours-info">
                            <div class="hours-item">
                                <span class="label">Jam Kerja Hari Ini:</span>
                                <span class="value">08:00 - 17:00</span>
                            </div>
                            <div class="hours-item">
                                <span class="label">Durasi Bekerja:</span>
                                <span class="value" id="workingDuration">4 jam 30 menit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manual Attendance Form -->
            <div class="card attendance-form-card animate-fade-in" style="animation-delay: 0.1s">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit me-2"></i>
                        Form Absensi Manual
                    </h3>
                    <div class="form-guide">
                        <i class="fas fa-info-circle"></i>
                        Lengkapi semua field dengan benar
                    </div>
                </div>
                <div class="card-body">
                    <form id="manualAttendanceForm" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Step 1: Basic Information -->
                        <div class="form-section active" id="section1">
                            <h4 class="section-title">
                                <span class="step-number">1</span>
                                Informasi Dasar
                            </h4>
                            
                            <div class="form-grid">
                                <div class="form-group animate-fade-in">
                                    <label class="form-label required">Jenis Absensi</label>
                                    <div class="radio-group">
                                        <label class="radio-card">
                                            <input type="radio" name="attendance_type" value="checkin" checked>
                                            <div class="radio-content">
                                                <i class="fas fa-sign-in-alt"></i>
                                                <span>Check-in</span>
                                                <small>Absensi Masuk Kerja</small>
                                            </div>
                                        </label>
                                        <label class="radio-card">
                                            <input type="radio" name="attendance_type" value="checkout">
                                            <div class="radio-content">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Check-out</span>
                                                <small>Absensi Pulang Kerja</small>
                                            </div>
                                        </label>
                                        <label class="radio-card">
                                            <input type="radio" name="attendance_type" value="izin">
                                            <div class="radio-content">
                                                <i class="fas fa-envelope"></i>
                                                <span>Izin</span>
                                                <small>Tidak Masuk Kerja</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group animate-fade-in" style="animation-delay: 0.1s">
                                    <label class="form-label required">Tanggal & Waktu</label>
                                    <div class="datetime-inputs">
                                        <div class="input-group">
                                            <span class="input-icon">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                            <input type="date" class="form-control" name="attendance_date" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-icon">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                            <input type="time" class="form-control" name="attendance_time" value="{{ date('H:i') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group animate-fade-in" style="animation-delay: 0.2s">
                                    <label class="form-label required">Lokasi Absensi</label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <select class="form-control" name="location" required>
                                            <option value="">Pilih Lokasi</option>
                                            <option value="kantor_pusat" selected>Kantor Pusat</option>
                                            <option value="kantor_cabang">Kantor Cabang</option>
                                            <option value="work_from_home">Work From Home</option>
                                            <option value="site_visit">Site Visit</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group animate-fade-in" style="animation-delay: 0.3s">
                                    <label class="form-label">Keterangan Tambahan</label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-comment"></i>
                                        </span>
                                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Tambahkan keterangan jika diperlukan..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-navigation">
                                <button type="button" class="btn btn-next" onclick="showSection(2)">
                                    Lanjut ke Foto <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Photo Evidence -->
                        <div class="form-section" id="section2">
                            <h4 class="section-title">
                                <span class="step-number">2</span>
                                Bukti Foto
                            </h4>

                            <div class="photo-section">
                                <div class="photo-requirements animate-fade-in">
                                    <h5>Persyaratan Foto:</h5>
                                    <ul>
                                        <li><i class="fas fa-check"></i> Wajah terlihat jelas dan menghadap kamera</li>
                                        <li><i class="fas fa-check"></i> Pencahayaan cukup tanpa bayangan</li>
                                        <li><i class="fas fa-check"></i> Background menunjukkan lokasi kerja</li>
                                        <li><i class="fas fa-check"></i> Tidak menggunakan filter atau edit</li>
                                        <li><i class="fas fa-check"></i> Format JPG/PNG, maksimal 5MB</li>
                                    </ul>
                                </div>

                                <div class="photo-upload-area">
                                    <div class="upload-container" id="uploadContainer">
                                        <div class="upload-placeholder" id="uploadPlaceholder">
                                            <i class="fas fa-camera"></i>
                                            <h5>Klik untuk Mengambil Foto</h5>
                                            <p>Gunakan kamera atau upload dari galeri</p>
                                            <div class="upload-options">
                                                <button type="button" class="btn-option primary" onclick="capturePhoto()">
                                                    <i class="fas fa-camera me-2"></i>Ambil Foto
                                                </button>
                                                <button type="button" class="btn-option secondary" onclick="uploadPhoto()">
                                                    <i class="fas fa-upload me-2"></i>Upload dari Galeri
                                                </button>
                                            </div>
                                        </div>
                                        <div class="photo-preview" id="photoPreview" style="display: none;">
                                            <img id="previewImage" class="preview-img">
                                            <div class="preview-actions">
                                                <button type="button" class="btn-action small" onclick="retakePhoto()">
                                                    <i class="fas fa-redo me-1"></i>Ulangi
                                                </button>
                                                <button type="button" class="btn-action small" onclick="rotatePhoto()">
                                                    <i class="fas fa-sync me-1"></i>Putar
                                                </button>
                                            </div>
                                        </div>
                                        <input type="file" id="photoInput" name="attendance_photo" accept="image/*" capture="camera" style="display: none;">
                                    </div>
                                </div>

                                <div class="photo-tips animate-fade-in" style="animation-delay: 0.2s">
                                    <h6><i class="fas fa-lightbulb me-2"></i>Tips Foto yang Baik:</h6>
                                    <div class="tips-grid">
                                        <div class="tip-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Pastikan wajah terlihat jelas</span>
                                        </div>
                                        <div class="tip-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Gunakan pencahayaan alami</span>
                                        </div>
                                        <div class="tip-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Hindari background yang ramai</span>
                                        </div>
                                        <div class="tip-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Foto dalam posisi berdiri</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-navigation">
                                <button type="button" class="btn btn-outline" onclick="showSection(1)">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </button>
                                <button type="button" class="btn btn-next" id="nextToReview" onclick="showSection(3)" disabled>
                                    Lanjut ke Review <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Review & Submit -->
                        <div class="form-section" id="section3">
                            <h4 class="section-title">
                                <span class="step-number">3</span>
                                Review & Submit
                            </h4>

                            <div class="review-section">
                                <div class="review-card animate-fade-in">
                                    <div class="review-header">
                                        <i class="fas fa-clipboard-check"></i>
                                        <h5>Konfirmasi Data Absensi</h5>
                                    </div>
                                    <div class="review-content">
                                        <div class="review-grid">
                                            <div class="review-item">
                                                <span class="label">Jenis Absensi:</span>
                                                <span class="value" id="reviewType">Check-in</span>
                                            </div>
                                            <div class="review-item">
                                                <span class="label">Tanggal:</span>
                                                <span class="value" id="reviewDate">{{ date('d M Y') }}</span>
                                            </div>
                                            <div class="review-item">
                                                <span class="label">Waktu:</span>
                                                <span class="value" id="reviewTime">{{ date('H:i') }}</span>
                                            </div>
                                            <div class="review-item">
                                                <span class="label">Lokasi:</span>
                                                <span class="value" id="reviewLocation">Kantor Pusat</span>
                                            </div>
                                            <div class="review-item full-width">
                                                <span class="label">Keterangan:</span>
                                                <span class="value" id="reviewKeterangan">-</span>
                                            </div>
                                        </div>
                                        <div class="photo-review">
                                            <h6>Foto Bukti:</h6>
                                            <img id="reviewPhoto" class="review-photo">
                                        </div>
                                    </div>
                                </div>

                                <div class="confirmation-check animate-fade-in" style="animation-delay: 0.1s">
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="confirmationCheck" required>
                                        <span class="checkmark"></span>
                                        Saya menyatakan bahwa data yang diisi adalah benar dan dapat dipertanggungjawabkan
                                    </label>
                                </div>
                            </div>

                            <div class="form-navigation">
                                <button type="button" class="btn btn-outline" onclick="showSection(2)">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </button>
                                <button type="submit" class="btn btn-submit" id="submitBtn" disabled>
                                    <i class="fas fa-paper-plane me-2"></i> Submit Absensi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Panel - Statistics & Information -->
        <div class="right-panel">
            <!-- Monthly Statistics -->
            <div class="card statistics-card animate-fade-in" style="animation-delay: 0.2s">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistik Bulan {{ date('F Y') }}
                    </h3>
                    <div class="period-selector">
                        <select class="form-control-sm">
                            <option>Desember 2024</option>
                            <option>November 2024</option>
                            <option>Oktober 2024</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="stats-overview">
                        <div class="stat-main">
                            <div class="stat-number">22</div>
                            <div class="stat-label">Hari Kerja</div>
                            <div class="stat-progress">
                                <div class="progress">
                                    <div class="progress-bar" style="width: 88%"></div>
                                </div>
                                <span>88% Kehadiran</span>
                            </div>
                        </div>
                    </div>

                    <div class="stats-details">
                        <div class="stat-item animate-slide-right">
                            <div class="stat-icon success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="stat-info">
                                <span class="value">18</span>
                                <span class="label">Hadir Tepat Waktu</span>
                            </div>
                            <div class="stat-percentage">82%</div>
                        </div>
                        <div class="stat-item animate-slide-right" style="animation-delay: 0.1s">
                            <div class="stat-icon warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-info">
                                <span class="value">4</span>
                                <span class="label">Terlambat</span>
                            </div>
                            <div class="stat-percentage">18%</div>
                        </div>
                        <div class="stat-item animate-slide-right" style="animation-delay: 0.2s">
                            <div class="stat-icon info">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="stat-info">
                                <span class="value">2</span>
                                <span class="label">Izin</span>
                            </div>
                            <div class="stat-percentage">9%</div>
                        </div>
                        <div class="stat-item animate-slide-right" style="animation-delay: 0.3s">
                            <div class="stat-icon danger">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="stat-info">
                                <span class="value">0</span>
                                <span class="label">Alpha</span>
                            </div>
                            <div class="stat-percentage">0%</div>
                        </div>
                    </div>

                    <div class="stats-chart">
                        <div class="chart-placeholder">
                            <div class="chart-bars">
                                <div class="chart-bar success animate-grow" style="height: 80%"></div>
                                <div class="chart-bar warning animate-grow" style="height: 60%; animation-delay: 0.1s"></div>
                                <div class="chart-bar info animate-grow" style="height: 40%; animation-delay: 0.2s"></div>
                                <div class="chart-bar danger animate-grow" style="height: 20%; animation-delay: 0.3s"></div>
                            </div>
                            <div class="chart-labels">
                                <span>Minggu 1</span>
                                <span>Minggu 2</span>
                                <span>Minggu 3</span>
                                <span>Minggu 4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="card information-card animate-fade-in" style="animation-delay: 0.3s">
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
                                <h6>Batas Waktu Absensi</h6>
                                <p>Check-in maksimal 30 menit setelah jam masuk. Lebih dari itu dianggap terlambat.</p>
                            </div>
                        </div>
                        <div class="info-item animate-slide-right" style="animation-delay: 0.1s">
                            <div class="info-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <div class="info-content">
                                <h6>Wajib Foto Selfie</h6>
                                <p>Setiap absensi harus disertai foto selfie yang jelas sebagai bukti kehadiran.</p>
                            </div>
                        </div>
                        <div class="info-item animate-slide-right" style="animation-delay: 0.2s">
                            <div class="info-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="info-content">
                                <h6>Pengajuan Izin</h6>
                                <p>Izin harus diajukan minimal 1 hari sebelumnya melalui form khusus.</p>
                            </div>
                        </div>
                        <div class="info-item animate-slide-right" style="animation-delay: 0.3s">
                            <div class="info-icon">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            <div class="info-content">
                                <h6>Lapor Sakit</h6>
                                <p>Wajib melampirkan surat dokter untuk ketidakhadiran karena sakit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-support animate-fade-in" style="animation-delay: 0.4s">
                        <h6>Butuh Bantuan?</h6>
                        <p>Hubungi tim HR untuk pertanyaan seputar absensi:</p>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>(021) 1234-5678</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>hr@company.com</span>
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
:root {
    --primary: #4361ee;
    --primary-light: #eef2ff;
    --primary-dark: #3a56d4;
    --success: #10b981;
    --success-light: #ecfdf5;
    --warning: #f59e0b;
    --warning-light: #fffbeb;
    --info: #06b6d4;
    --info-light: #ecfeff;
    --danger: #ef4444;
    --danger-light: #fef2f2;
    --dark: #1f2937;
    --light: #f8fafc;
    --gray: #6b7280;
    --border-radius: 16px;
    --shadow: 0 8px 25px -8px rgba(0, 0, 0, 0.15);
    --shadow-hover: 0 15px 35px -12px rgba(0, 0, 0, 0.2);
    --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Global Styles */
body {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
}

/* Dashboard Layout */
.dashboard-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    align-items: start;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
}

.left-panel {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.right-panel {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    position: sticky;
    top: 2rem;
}

/* Card Styles */
.card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    transition: var(--transition);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
}

.card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-4px);
}

.card-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid rgba(241, 245, 249, 0.8);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
    display: flex;
    align-items: center;
}

.card-body {
    padding: 2rem;
}

/* Animations */
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

@keyframes growHeight {
    from {
        transform: scaleY(0);
        opacity: 0;
    }
    to {
        transform: scaleY(1);
        opacity: 1;
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
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

.animate-grow {
    animation: growHeight 0.8s ease-out forwards;
    transform-origin: bottom;
}

.animate-pulse {
    animation: pulse 2s infinite;
}

/* Quick Status Card */
.status-indicator {
    padding: 0.75rem 1.25rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

.status-indicator.success {
    background: linear-gradient(135deg, var(--success) 0%, #0da271 100%);
    color: white;
}

.status-timeline {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.timeline-item {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1.5rem;
    background: var(--light);
    border-radius: 12px;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.timeline-item:hover {
    transform: translateX(8px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.timeline-item.completed {
    border-left: 6px solid var(--success);
    background: linear-gradient(135deg, var(--success-light) 0%, #ffffff 100%);
}

.timeline-item.pending {
    border-left: 6px solid var(--warning);
    background: linear-gradient(135deg, var(--warning-light) 0%, #ffffff 100%);
}

.timeline-marker {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.timeline-item.completed .timeline-marker {
    background: linear-gradient(135deg, var(--success) 0%, #0da271 100%);
    color: white;
}

.timeline-item.pending .timeline-marker {
    background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
    color: white;
}

.timeline-content {
    flex: 1;
}

.timeline-content .time {
    font-size: 1.375rem;
    font-weight: 700;
    color: var(--dark);
    display: block;
    margin-bottom: 0.25rem;
}

.timeline-content .label {
    font-size: 0.875rem;
    color: var(--gray);
    display: block;
    margin-bottom: 0.25rem;
}

.timeline-content .status {
    font-size: 0.75rem;
    font-weight: 700;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    display: inline-block;
}

.timeline-item.completed .timeline-content .status {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
}

.timeline-item.pending .timeline-content .status {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
}

.working-hours {
    background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid rgba(67, 97, 238, 0.1);
}

.hours-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
}

.hours-item .label {
    color: var(--gray);
    font-size: 0.875rem;
    font-weight: 600;
}

.hours-item .value {
    font-weight: 700;
    color: var(--dark);
    font-size: 0.875rem;
}

/* Attendance Form Card */
.form-guide {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--gray);
    background: var(--light);
    padding: 0.75rem 1rem;
    border-radius: 8px;
    border-left: 4px solid var(--primary);
}

.form-section {
    display: none;
}

.form-section.active {
    display: block;
    animation: fadeIn 0.6s ease-out;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--primary-light);
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.form-grid {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-label {
    font-weight: 700;
    color: var(--dark);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-label.required::after {
    content: " *";
    color: var(--danger);
    font-weight: 700;
}

.radio-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 1.25rem;
}

.radio-card {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem 1rem;
    cursor: pointer;
    transition: var(--transition);
    background: white;
    position: relative;
    overflow: hidden;
}

.radio-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--primary);
    transform: scaleX(0);
    transition: var(--transition);
}

.radio-card:hover {
    border-color: var(--primary);
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.15);
}

.radio-card:hover::before {
    transform: scaleX(1);
}

.radio-card input:checked + .radio-content {
    border-color: var(--primary);
    background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
}

.radio-card input:checked + .radio-content::before {
    transform: scaleX(1);
}

.radio-content {
    text-align: center;
    transition: var(--transition);
    padding: 0.5rem;
    border-radius: 8px;
    position: relative;
}

.radio-content i {
    font-size: 2rem;
    margin-bottom: 0.75rem;
    display: block;
    color: var(--primary);
    transition: var(--transition);
}

.radio-card:hover .radio-content i {
    transform: scale(1.1);
}

.radio-content span {
    font-weight: 700;
    color: var(--dark);
    display: block;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.radio-content small {
    font-size: 0.75rem;
    color: var(--gray);
    line-height: 1.4;
}

.datetime-inputs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
}

.input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    left: 1rem;
    color: var(--gray);
    z-index: 2;
    transition: var(--transition);
}

.form-control {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 0.875rem;
    transition: var(--transition);
    background: white;
    font-weight: 500;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    transform: translateY(-2px);
}

.form-control:focus + .input-icon {
    color: var(--primary);
    transform: scale(1.1);
}

textarea.form-control {
    min-height: 100px;
    resize: vertical;
    line-height: 1.5;
}

/* Photo Section */
.photo-requirements {
    background: linear-gradient(135deg, var(--light) 0%, #ffffff 100%);
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    border: 1px solid rgba(241, 245, 249, 0.8);
}

.photo-requirements h5 {
    font-weight: 700;
    margin-bottom: 1.25rem;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.photo-requirements ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.photo-requirements li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    color: var(--dark);
    font-size: 0.875rem;
    font-weight: 500;
}

.photo-requirements li i {
    color: var(--success);
    font-size: 0.875rem;
    width: 20px;
    text-align: center;
}

.photo-upload-area {
    margin-bottom: 2rem;
}

.upload-container {
    border: 3px dashed #d1d5db;
    border-radius: 16px;
    padding: 3rem 2rem;
    text-align: center;
    transition: var(--transition);
    cursor: pointer;
    background: rgba(248, 250, 252, 0.5);
    position: relative;
    overflow: hidden;
}

.upload-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(67, 97, 238, 0.05), transparent);
    transition: left 0.6s;
}

.upload-container:hover::before {
    left: 100%;
}

.upload-container:hover {
    border-color: var(--primary);
    background: rgba(67, 97, 238, 0.02);
    transform: translateY(-2px);
}

.upload-placeholder i {
    font-size: 4rem;
    color: #9ca3af;
    margin-bottom: 1.5rem;
    transition: var(--transition);
}

.upload-container:hover .upload-placeholder i {
    color: var(--primary);
    transform: scale(1.1);
}

.upload-placeholder h5 {
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--dark);
    font-size: 1.25rem;
}

.upload-placeholder p {
    color: var(--gray);
    margin-bottom: 2rem;
    font-size: 0.875rem;
}

.upload-options {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-option {
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-option.primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
}

.btn-option.primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
}

.btn-option.secondary {
    background: white;
    color: var(--dark);
    border: 2px solid #e5e7eb;
}

.btn-option.secondary:hover {
    background: var(--light);
    border-color: var(--primary);
    transform: translateY(-2px);
}

.photo-preview {
    text-align: center;
}

.preview-img {
    max-width: 100%;
    max-height: 300px;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border: 3px solid white;
}

.preview-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-action.small {
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    border-radius: 10px;
    font-weight: 600;
}

.photo-tips {
    background: linear-gradient(135deg, var(--info-light) 0%, #ffffff 100%);
    padding: 2rem;
    border-radius: 12px;
    border: 1px solid rgba(6, 182, 212, 0.1);
}

.photo-tips h6 {
    font-weight: 700;
    margin-bottom: 1.25rem;
    color: var(--info);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tips-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.tip-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: var(--dark);
    font-weight: 500;
    padding: 0.5rem;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.5);
}

.tip-item i {
    color: var(--success);
    font-size: 0.875rem;
    width: 20px;
    text-align: center;
}

/* Review Section */
.review-card {
    border: 2px solid var(--primary-light);
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 2rem;
    background: white;
    box-shadow: 0 8px 25px rgba(67, 97, 238, 0.1);
}

.review-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 1.5rem 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    color: white;
}

.review-header i {
    font-size: 1.5rem;
}

.review-header h5 {
    margin: 0;
    font-weight: 700;
    font-size: 1.125rem;
}

.review-content {
    padding: 2rem;
}

.review-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.review-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    padding: 1rem;
    background: var(--light);
    border-radius: 10px;
    border-left: 4px solid var(--primary);
}

.review-item.full-width {
    grid-column: 1 / -1;
}

.review-item .label {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.review-item .value {
    font-weight: 700;
    color: var(--dark);
    font-size: 0.875rem;
}

.photo-review h6 {
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--dark);
    font-size: 1rem;
}

.review-photo {
    width: 100%;
    max-height: 250px;
    object-fit: cover;
    border-radius: 12px;
    border: 3px solid var(--primary-light);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.confirmation-check {
    margin-top: 2rem;
    padding: 1.5rem;
    background: var(--light);
    border-radius: 12px;
    border: 2px dashed #e5e7eb;
}

.checkbox-container {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    cursor: pointer;
    font-size: 0.875rem;
    color: var(--dark);
    font-weight: 500;
    line-height: 1.5;
}

.checkbox-container input {
    display: none;
}

.checkmark {
    width: 22px;
    height: 22px;
    border: 2px solid #d1d5db;
    border-radius: 6px;
    position: relative;
    flex-shrink: 0;
    transition: var(--transition);
    background: white;
}

.checkbox-container:hover .checkmark {
    border-color: var(--primary);
    transform: scale(1.1);
}

.checkbox-container input:checked + .checkmark {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-color: var(--primary);
}

.checkbox-container input:checked + .checkmark::after {
    content: "✓";
    position: absolute;
    color: white;
    font-size: 14px;
    font-weight: bold;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Form Navigation */
.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid var(--primary-light);
}

.btn {
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-outline {
    background: white;
    border: 2px solid #e5e7eb;
    color: var(--gray);
}

.btn-outline:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
}

.btn-next, .btn-submit {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
}

.btn-next:hover, .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
}

.btn-next:disabled, .btn-submit:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Statistics Card */
.period-selector select {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition);
}

.period-selector select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
}

.stats-overview {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid var(--primary-light);
}

.stat-main .stat-number {
    font-size: 3.5rem;
    font-weight: 900;
    color: var(--primary);
    line-height: 1;
    margin-bottom: 0.75rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-main .stat-label {
    font-size: 0.875rem;
    color: var(--gray);
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.stat-progress {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.progress {
    height: 8px;
    background: #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

.progress-bar {
    height: 100%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 10px;
    transition: width 1.5s ease-in-out;
}

.stat-progress span {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 600;
}

.stats-details {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1.25rem;
    background: var(--light);
    border-radius: 12px;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.stat-item:hover {
    transform: translateX(8px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.stat-icon.success { 
    background: linear-gradient(135deg, var(--success) 0%, #0da271 100%); 
}
.stat-icon.warning { 
    background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%); 
}
.stat-icon.info { 
    background: linear-gradient(135deg, var(--info) 0%, #0891b2 100%); 
}
.stat-icon.danger { 
    background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%); 
}

.stat-info {
    flex: 1;
}

.stat-info .value {
    font-size: 1.375rem;
    font-weight: 800;
    color: var(--dark);
    display: block;
    margin-bottom: 0.25rem;
}

.stat-info .label {
    font-size: 0.75rem;
    color: var(--gray);
    display: block;
    font-weight: 600;
}

.stat-percentage {
    font-weight: 800;
    color: var(--dark);
    font-size: 0.875rem;
    background: var(--light);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    border: 1px solid #e5e7eb;
}

.stats-chart {
    margin-top: 2rem;
}

.chart-placeholder {
    background: var(--light);
    padding: 1.5rem;
    border-radius: 12px;
    height: 140px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.chart-bars {
    display: flex;
    align-items: flex-end;
    gap: 0.75rem;
    height: 100px;
    margin-bottom: 0.75rem;
}

.chart-bar {
    flex: 1;
    border-radius: 8px 8px 0 0;
    min-height: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.chart-bar.success { 
    background: linear-gradient(135deg, var(--success) 0%, #0da271 100%); 
}
.chart-bar.warning { 
    background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%); 
}
.chart-bar.info { 
    background: linear-gradient(135deg, var(--info) 0%, #0891b2 100%); 
}
.chart-bar.danger { 
    background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%); 
}

.chart-labels {
    display: flex;
    justify-content: space-between;
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 600;
    padding: 0 0.5rem;
}

/* Information Card */
.info-list {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    padding: 1.5rem;
    background: var(--light);
    border-radius: 12px;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.info-item:hover {
    transform: translateX(8px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

.info-item.urgent {
    border-left: 6px solid var(--warning);
    background: linear-gradient(135deg, var(--warning-light) 0%, #ffffff 100%);
}

.info-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.info-item.urgent .info-icon {
    background: var(--warning-light);
    color: var(--warning);
}

.info-content h6 {
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    color: var(--dark);
    font-size: 0.875rem;
}

.info-content p {
    margin: 0;
    font-size: 0.75rem;
    color: var(--gray);
    line-height: 1.5;
    font-weight: 500;
}

.contact-support {
    background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
    padding: 2rem;
    border-radius: 12px;
    border: 1px solid rgba(67, 97, 238, 0.1);
}

.contact-support h6 {
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--primary);
    font-size: 1rem;
}

.contact-support p {
    font-size: 0.875rem;
    color: var(--gray);
    margin-bottom: 1.5rem;
    font-weight: 500;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: var(--dark);
    font-weight: 600;
    padding: 0.5rem;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.5);
}

.contact-item i {
    color: var(--primary);
    width: 20px;
    text-align: center;
}

/* Success Modal Styles */
.success-modal-content {
    border: none;
    border-radius: 24px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);
    overflow: hidden;
    background: white;
}

.success-animation-container {
    margin: 2rem 0;
}

.success-checkmark {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    position: relative;
}

.check-icon {
    width: 100px;
    height: 100px;
    position: relative;
    border-radius: 50%;
    box-sizing: content-box;
    border: 6px solid var(--success);
    background: white;
}

.check-icon::before {
    top: 4px;
    left: -3px;
    width: 35px;
    transform-origin: 100% 50%;
}

.check-icon::after {
    top: 0;
    left: 35px;
    width: 70px;
    transform-origin: 0 50%;
}

.check-icon::before, .check-icon::after {
    content: '';
    height: 6px;
    background: var(--success);
    position: absolute;
    transform: scaleX(0);
    animation: icon-line 0.8s cubic-bezier(0.65, 0, 0.45, 1) 0.2s forwards;
}

.icon-line {
    height: 6px;
    background: var(--success);
    display: block;
    border-radius: 3px;
    position: absolute;
    z-index: 10;
}

.line-tip {
    top: 56px;
    left: 18px;
    width: 30px;
    transform: rotate(45deg);
    animation: icon-line-tip 0.75s;
}

.line-long {
    top: 46px;
    right: 10px;
    width: 55px;
    transform: rotate(-45deg);
    animation: icon-line-long 0.75s;
}

.icon-circle {
    top: -6px;
    left: -6px;
    z-index: 10;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    box-sizing: content-box;
    border: 6px solid rgba(16, 185, 129, 0.2);
}

.icon-fix {
    top: 10px;
    width: 6px;
    left: 32px;
    z-index: 1;
    height: 100px;
    position: absolute;
    transform: rotate(-45deg);
    background-color: white;
}

@keyframes icon-line-tip {
    0% { width: 0; left: 2px; top: 24px; }
    54% { width: 0; left: 2px; top: 24px; }
    70% { width: 60px; left: -10px; top: 45px; }
    84% { width: 20px; left: 26px; top: 58px; }
    100% { width: 30px; left: 18px; top: 56px; }
}

@keyframes icon-line-long {
    0% { width: 0; right: 56px; top: 65px; }
    65% { width: 0; right: 56px; top: 65px; }
    84% { width: 65px; right: 0px; top: 42px; }
    100% { width: 55px; right: 10px; top: 46px; }
}

@keyframes icon-line {
    0% { transform: scaleX(0); }
    100% { transform: scaleX(1); }
}

.success-message {
    margin: 2rem 0;
}

.success-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 0.75rem;
    background: linear-gradient(135deg, var(--success) 0%, #0da271 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.success-description {
    color: var(--gray);
    font-size: 1rem;
    margin: 0;
    font-weight: 500;
}

.success-details-card {
    background: linear-gradient(135deg, var(--success-light) 0%, #ffffff 100%);
    border-radius: 16px;
    padding: 2rem;
    margin: 2rem 0;
    border: 2px solid rgba(16, 185, 129, 0.1);
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(16, 185, 129, 0.1);
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.detail-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.detail-label {
    font-size: 0.75rem;
    color: var(--gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.detail-value {
    font-size: 1rem;
    color: var(--dark);
    font-weight: 800;
}

.success-actions {
    margin-top: 2rem;
}

.btn-success-action {
    background: linear-gradient(135deg, var(--success) 0%, #0da271 100%);
    color: white;
    border: none;
    padding: 1.25rem 2rem;
    border-radius: 14px;
    font-weight: 700;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.btn-success-action:hover {
    background: linear-gradient(135deg, #0da271 0%, #0c8f63 100%);
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .dashboard-layout {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .right-panel {
        position: static;
    }
}

@media (max-width: 768px) {
    .dashboard-layout {
        padding: 0 0.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .radio-group {
        grid-template-columns: 1fr;
    }
    
    .datetime-inputs {
        grid-template-columns: 1fr;
    }
    
    .upload-options {
        flex-direction: column;
    }
    
    .tips-grid {
        grid-template-columns: 1fr;
    }
    
    .review-grid {
        grid-template-columns: 1fr;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-navigation .btn {
        width: 100%;
        justify-content: center;
    }
    
    .stats-overview .stat-number {
        font-size: 2.5rem;
    }
}

@media (max-width: 480px) {
    .card-header {
        padding: 1.25rem 1.5rem;
    }
    
    .card-body {
        padding: 1.25rem;
    }
    
    .btn-option,
    .btn {
        padding: 0.875rem 1.5rem;
    }
    
    .upload-container {
        padding: 2rem 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update current time
    function updateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            timeZone: 'Asia/Jakarta'
        };
        
        const timeString = now.toLocaleDateString('id-ID', options);
        document.getElementById('currentTime').innerHTML = 
            `<i class="fas fa-clock me-2"></i>${timeString}`;
        
        // Update working duration
        updateWorkingDuration();
    }

    function updateWorkingDuration() {
        const checkInTime = new Date();
        checkInTime.setHours(7, 30, 15); // Set check-in time to 07:30:15
        
        const now = new Date();
        const diffMs = now - checkInTime;
        const diffHrs = Math.floor(diffMs / (1000 * 60 * 60));
        const diffMins = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
        
        document.getElementById('workingDuration').textContent = 
            `${diffHrs} jam ${diffMins} menit`;
    }

    updateTime();
    setInterval(updateTime, 1000);
    setInterval(updateWorkingDuration, 60000); // Update every minute

    // Add hover effects to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Add loading animation to progress bars
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });

    // Form handling
    const photoInput = document.getElementById('photoInput');
    const uploadContainer = document.getElementById('uploadContainer');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const photoPreview = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');
    const reviewPhoto = document.getElementById('reviewPhoto');
    const nextToReview = document.getElementById('nextToReview');
    const confirmationCheck = document.getElementById('confirmationCheck');
    const submitBtn = document.getElementById('submitBtn');

    // Update form values in real-time
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('change', updateReviewSection);
        element.addEventListener('input', updateReviewSection);
    });

    // Confirmation check
    confirmationCheck.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
        if (this.checked) {
            this.parentElement.classList.add('animate-pulse');
            setTimeout(() => {
                this.parentElement.classList.remove('animate-pulse');
            }, 2000);
        }
    });

    // Add animation to radio cards
    const radioCards = document.querySelectorAll('.radio-card');
    radioCards.forEach(card => {
        card.addEventListener('click', function() {
            radioCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
        });
    });
});

function showSection(sectionNumber) {
    // Hide all sections
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Show target section with animation
    const targetSection = document.getElementById(`section${sectionNumber}`);
    targetSection.classList.add('active');
    
    // Add entrance animation to form elements
    const formElements = targetSection.querySelectorAll('.form-group, .photo-requirements, .photo-tips, .review-card, .confirmation-check');
    formElements.forEach((element, index) => {
        element.style.animationDelay = `${index * 0.1}s`;
        element.classList.add('animate-fade-in');
    });
}

function capturePhoto() {
    document.getElementById('photoInput').click();
}

function uploadPhoto() {
    document.getElementById('photoInput').click();
}

function retakePhoto() {
    document.getElementById('photoInput').value = '';
    document.getElementById('uploadPlaceholder').style.display = 'block';
    document.getElementById('photoPreview').style.display = 'none';
    document.getElementById('nextToReview').disabled = true;
}

function rotatePhoto() {
    const img = document.getElementById('previewImage');
    const currentRotation = parseInt(img.style.transform.replace('rotate(', '').replace('deg)', '')) || 0;
    img.style.transform = `rotate(${currentRotation + 90}deg)`;
}

document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            reviewPhoto.src = e.target.result;
            
            document.getElementById('uploadPlaceholder').style.display = 'none';
            document.getElementById('photoPreview').style.display = 'block';
            document.getElementById('nextToReview').disabled = false;
            
            // Add success animation
            const previewContainer = document.getElementById('photoPreview');
            previewContainer.classList.add('animate-fade-in');
        };
        reader.readAsDataURL(file);
    }
});

function updateReviewSection() {
    // Update type
    const selectedType = document.querySelector('input[name="attendance_type"]:checked');
    document.getElementById('reviewType').textContent = 
        selectedType ? selectedType.value.charAt(0).toUpperCase() + selectedType.value.slice(1) : '-';

    // Update date
    const dateInput = document.querySelector('input[name="attendance_date"]');
    if (dateInput.value) {
        const date = new Date(dateInput.value);
        document.getElementById('reviewDate').textContent = 
            date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    // Update time
    const timeInput = document.querySelector('input[name="attendance_time"]');
    document.getElementById('reviewTime').textContent = timeInput.value || '-';

    // Update location
    const locationSelect = document.querySelector('select[name="location"]');
    document.getElementById('reviewLocation').textContent = 
        locationSelect.options[locationSelect.selectedIndex].text;

    // Update keterangan
    const keteranganTextarea = document.querySelector('textarea[name="keterangan"]');
    document.getElementById('reviewKeterangan').textContent = 
        keteranganTextarea.value || '-';
}

// Form submission
document.getElementById('manualAttendanceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('.btn-submit');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
    submitBtn.disabled = true;
    
    // Add loading animation to the form
    this.classList.add('loading');
    
    // Simulate API call
    setTimeout(() => {
        // Update success modal
        document.getElementById('successType').textContent = 
            document.getElementById('reviewType').textContent;
        document.getElementById('successTime').textContent = 
            document.getElementById('reviewTime').textContent;
        document.getElementById('successDate').textContent = 
            document.getElementById('reviewDate').textContent;
        
        const modal = new bootstrap.Modal(document.getElementById('successModal'));
        modal.show();
        
        // Update status if check-out
        const selectedType = document.querySelector('input[name="attendance_type"]:checked').value;
        if (selectedType === 'checkout') {
            document.querySelector('.status-indicator').innerHTML = 
                '<i class="fas fa-check-circle me-1"></i>SUDAH CHECK-OUT';
            document.querySelector('.timeline-item.pending .time').textContent = 
                document.getElementById('reviewTime').textContent;
            document.querySelector('.timeline-item.pending').classList.remove('pending');
            document.querySelector('.timeline-item.pending').classList.add('completed');
            document.querySelector('.timeline-item.pending .timeline-marker').innerHTML = '<i class="fas fa-check"></i>';
            document.querySelector('.timeline-item.pending .status').textContent = 'Selesai';
        }
        
        // Remove loading state
        this.classList.remove('loading');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
    }, 2000);
});

function resetForm() {
    const form = document.getElementById('manualAttendanceForm');
    form.reset();
    showSection(1);
    retakePhoto();
    document.getElementById('confirmationCheck').checked = false;
    document.getElementById('submitBtn').disabled = true;
    
    // Reset confirmation check
    const submitBtn = document.querySelector('.btn-submit');
    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Submit Absensi';
    submitBtn.disabled = false;
    
    // Add reset animation
    form.classList.add('animate-fade-in');
    setTimeout(() => {
        form.classList.remove('animate-fade-in');
    }, 600);
}

function showHistory() {
    // Add animation to button click
    const btn = event.target;
    btn.classList.add('animate-pulse');
    setTimeout(() => {
        btn.classList.remove('animate-pulse');
    }, 600);
    alert('Fitur riwayat absensi akan segera tersedia!');
}

function showSettings() {
    // Add animation to button click
    const btn = event.target;
    btn.classList.add('animate-pulse');
    setTimeout(() => {
        btn.classList.remove('animate-pulse');
    }, 600);
    alert('Fitur pengaturan akan segera tersedia!');
}

// Add intersection observer for scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, observerOptions);

// Observe all animated elements
document.querySelectorAll('.animate-fade-in, .animate-slide-left, .animate-slide-right, .animate-grow').forEach(el => {
    observer.observe(el);
});
</script>
@endpush