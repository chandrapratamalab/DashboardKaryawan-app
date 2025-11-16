@extends('layout.appkaryawan')

@section('title', 'Profil Karyawan')
@section('page-title', 'Profil Karyawan')

@section('content')
<div class="profile-container">
    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">3</h3>
                <p class="stat-label">Tahun Bergabung</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">24</h3>
                <p class="stat-label">Proyek Selesai</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">98%</h3>
                <p class="stat-label">Rating Kinerja</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">95%</h3>
                <p class="stat-label">Kehadiran</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-content">
        <!-- Sidebar Navigation -->
        <div class="sidebar-section">
            <div class="sidebar-card">
                <!-- Profile Summary -->
                <div class="profile-summary">
                    <div class="avatar-container">
                        <img src="{{ asset('storage/' . ($user->avatar ?? 'images/default-avatar.png')) }}" alt="Profile Picture" class="profile-avatar">
                        <button class="change-avatar-btn" id="changeAvatarBtn">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <div class="profile-details">
                        <h2 class="profile-name">{{ $user->name ?? 'Nama Karyawan' }}</h2>
                        <p class="profile-position">{{ $user->position ?? 'Software Engineer' }}</p>
                        <div class="profile-badges">
                            <span class="badge badge-primary">{{ $user->department ?? 'IT Department' }}</span>
                            <span class="badge badge-secondary">ID: {{ $user->employee_id ?? 'EMP001' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="profile-nav">
                    <ul>
                        <li class="nav-item active" data-tab="personal-info">
                            <div class="nav-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>Informasi Pribadi</span>
                            <i class="nav-arrow fas fa-chevron-right"></i>
                        </li>
                        <li class="nav-item" data-tab="shift-schedule">
                            <div class="nav-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <span>Jadwal Shift</span>
                            <i class="nav-arrow fas fa-chevron-right"></i>
                        </li>
                        <li class="nav-item" data-tab="documents">
                            <div class="nav-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <span>Dokumen</span>
                            <i class="nav-arrow fas fa-chevron-right"></i>
                        </li>
                        <li class="nav-item" data-tab="settings">
                            <div class="nav-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <span>Pengaturan</span>
                            <i class="nav-arrow fas fa-chevron-right"></i>
                        </li>
                    </ul>
                </nav>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h3 class="actions-title">Aksi Cepat</h3>
                    <div class="action-buttons">
                        <button class="action-btn" id="exportProfile">
                            <i class="fas fa-download"></i>
                            <span>Ekspor Profil</span>
                        </button>
                        <button class="action-btn" id="printProfile">
                            <i class="fas fa-print"></i>
                            <span>Cetak Profil</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-section">
            <!-- Tab Informasi Pribadi -->
            <div class="tab-content active" id="personal-info">
                <div class="tab-card">
                    <div class="tab-header">
                        <h2 class="tab-title">Informasi Pribadi</h2>
                        <button class="edit-btn" data-edit="personal-info">
                            <i class="fas fa-edit"></i> 
                            <span class="btn-text">Edit Profil</span>
                            <div class="btn-loader" style="display: none;">
                                <div class="spinner"></div>
                            </div>
                        </button>
                    </div>

                    <div class="info-grid">
                        <div class="info-group">
                            <h3 class="info-group-title">Data Diri</h3>
                            <div class="info-row">
                                <div class="info-item">
                                    <label class="info-label">Nama Lengkap</label>
                                    <p class="info-value view-mode">{{ $user->name ?? 'Nama Karyawan' }}</p>
                                    <input type="text" class="info-input edit-mode" value="{{ $user->name ?? 'Nama Karyawan' }}" style="display: none;">
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Email</label>
                                    <p class="info-value view-mode">{{ $user->email ?? 'email@perusahaan.com' }}</p>
                                    <input type="email" class="info-input edit-mode" value="{{ $user->email ?? 'email@perusahaan.com' }}" style="display: none;">
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-item">
                                    <label class="info-label">Nomor Telepon</label>
                                    <p class="info-value view-mode">{{ $user->phone ?? '+62 812-3456-7890' }}</p>
                                    <input type="tel" class="info-input edit-mode" value="{{ $user->phone ?? '+62 812-3456-7890' }}" style="display: none;">
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Tanggal Lahir</label>
                                    <p class="info-value view-mode">{{ $user->birth_date ?? '01 Januari 1990' }}</p>
                                    <input type="date" class="info-input edit-mode" value="{{ $user->birth_date ?? '1990-01-01' }}" style="display: none;">
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-item">
                                    <label class="info-label">Jenis Kelamin</label>
                                    <p class="info-value view-mode">{{ $user->gender ?? 'Laki-laki' }}</p>
                                    <select class="info-input edit-mode" style="display: none;">
                                        <option value="Laki-laki" {{ ($user->gender ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ ($user->gender ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Status Pernikahan</label>
                                    <p class="info-value view-mode">{{ $user->marital_status ?? 'Belum Menikah' }}</p>
                                    <select class="info-input edit-mode" style="display: none;">
                                        <option value="Belum Menikah" {{ ($user->marital_status ?? '') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                        <option value="Menikah" {{ ($user->marital_status ?? '') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                        <option value="Duda" {{ ($user->marital_status ?? '') == 'Duda' ? 'selected' : '' }}>Duda</option>
                                        <option value="Janda" {{ ($user->marital_status ?? '') == 'Janda' ? 'selected' : '' }}>Janda</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="info-group">
                            <h3 class="info-group-title">Alamat</h3>
                            <div class="info-item full-width">
                                <label class="info-label">Alamat Lengkap</label>
                                <p class="info-value view-mode">{{ $user->address ?? 'Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta 12345' }}</p>
                                <textarea class="info-textarea edit-mode" style="display: none;">{{ $user->address ?? 'Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta 12345' }}</textarea>
                            </div>
                        </div>

                        <div class="info-group">
                            <h3 class="info-group-title">Informasi Darurat</h3>
                            <div class="info-row">
                                <div class="info-item">
                                    <label class="info-label">Kontak Darurat</label>
                                    <p class="info-value view-mode">{{ $user->emergency_contact ?? '+62 813-9876-5432' }}</p>
                                    <input type="tel" class="info-input edit-mode" value="{{ $user->emergency_contact ?? '+62 813-9876-5432' }}" style="display: none;">
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Hubungan</label>
                                    <p class="info-value view-mode">{{ $user->emergency_relation ?? 'Ibu Kandung' }}</p>
                                    <input type="text" class="info-input edit-mode" value="{{ $user->emergency_relation ?? 'Ibu Kandung' }}" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <div class="info-group">
                            <h3 class="info-group-title">Informasi Kerja</h3>
                            <div class="info-row">
                                <div class="info-item">
                                    <label class="info-label">Posisi</label>
                                    <p class="info-value">{{ $user->position ?? 'Software Engineer' }}</p>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Departemen</label>
                                    <p class="info-value">{{ $user->department ?? 'Teknologi Informasi' }}</p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-item">
                                    <label class="info-label">Tanggal Bergabung</label>
                                    <p class="info-value">{{ $user->join_date ?? '15 Maret 2021' }}</p>
                                </div>
                                <div class="info-item">
                                    <label class="info-label">Status</label>
                                    <p class="info-value">
                                        <span class="status-badge active">Aktif</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons edit-mode" style="display: none;">
                        <button class="btn-save">
                            <span class="btn-text">Simpan Perubahan</span>
                            <div class="btn-loader" style="display: none;">
                                <div class="spinner"></div>
                            </div>
                        </button>
                        <button class="btn-cancel">Batal</button>
                    </div>
                </div>
            </div>

            <!-- Tab Jadwal Shift -->
            <div class="tab-content" id="shift-schedule">
                <div class="tab-card">
                    <div class="tab-header">
                        <h2 class="tab-title">Jadwal Shift</h2>
                        <div class="tab-actions">
                            <button class="action-btn-secondary">
                                <i class="fas fa-download"></i>
                                <span>Ekspor Jadwal</span>
                            </button>
                            <button class="action-btn-secondary">
                                <i class="fas fa-print"></i>
                                <span>Cetak Jadwal</span>
                            </button>
                        </div>
                    </div>

                    <div class="shift-container">
                        <!-- Shift Overview -->
                        <div class="shift-overview">
                            <div class="overview-cards">
                                <div class="overview-card">
                                    <div class="overview-icon">
                                        <i class="fas fa-sun"></i>
                                    </div>
                                    <div class="overview-info">
                                        <h3>12</h3>
                                        <p>Shift Pagi</p>
                                    </div>
                                </div>
                                <div class="overview-card">
                                    <div class="overview-icon">
                                        <i class="fas fa-cloud-sun"></i>
                                    </div>
                                    <div class="overview-info">
                                        <h3>8</h3>
                                        <p>Shift Siang</p>
                                    </div>
                                </div>
                                <div class="overview-card">
                                    <div class="overview-icon">
                                        <i class="fas fa-moon"></i>
                                    </div>
                                    <div class="overview-info">
                                        <h3>6</h3>
                                        <p>Shift Malam</p>
                                    </div>
                                </div>
                                <div class="overview-card">
                                    <div class="overview-icon">
                                        <i class="fas fa-umbrella-beach"></i>
                                    </div>
                                    <div class="overview-info">
                                        <h3>4</h3>
                                        <p>Hari Libur</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calendar Section -->
                        <div class="calendar-section">
                            <div class="calendar-header">
                                <div class="calendar-nav">
                                    <button class="nav-btn" id="prevMonth">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <h3 class="current-month">Desember 2023</h3>
                                    <button class="nav-btn" id="nextMonth">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <div class="calendar-views">
                                    <button class="view-btn active" data-view="month">Bulan</button>
                                    <button class="view-btn" data-view="week">Minggu</button>
                                    <button class="view-btn" data-view="list">Daftar</button>
                                </div>
                            </div>

                            <!-- Month View -->
                            <div class="calendar-view active" id="month-view">
                                <div class="calendar-grid">
                                    <div class="calendar-weekdays">
                                        <div class="weekday">Senin</div>
                                        <div class="weekday">Selasa</div>
                                        <div class="weekday">Rabu</div>
                                        <div class="weekday">Kamis</div>
                                        <div class="weekday">Jumat</div>
                                        <div class="weekday">Sabtu</div>
                                        <div class="weekday">Minggu</div>
                                    </div>
                                    <div class="calendar-days">
                                        <!-- Week 1 -->
                                        <div class="calendar-day empty"></div>
                                        <div class="calendar-day empty"></div>
                                        <div class="calendar-day empty"></div>
                                        <div class="calendar-day empty"></div>
                                        <div class="calendar-day">
                                            <span class="day-number">1</span>
                                            <div class="shift-badge pagi">
                                                <i class="fas fa-sun"></i>
                                                <span>Pagi</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day weekend">
                                            <span class="day-number">2</span>
                                            <div class="shift-badge libur">
                                                <i class="fas fa-umbrella-beach"></i>
                                                <span>Libur</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day weekend">
                                            <span class="day-number">3</span>
                                            <div class="shift-badge libur">
                                                <i class="fas fa-umbrella-beach"></i>
                                                <span>Libur</span>
                                            </div>
                                        </div>

                                        <!-- Week 2 -->
                                        <div class="calendar-day">
                                            <span class="day-number">4</span>
                                            <div class="shift-badge pagi">
                                                <i class="fas fa-sun"></i>
                                                <span>Pagi</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day">
                                            <span class="day-number">5</span>
                                            <div class="shift-badge pagi">
                                                <i class="fas fa-sun"></i>
                                                <span>Pagi</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day">
                                            <span class="day-number">6</span>
                                            <div class="shift-badge siang">
                                                <i class="fas fa-cloud-sun"></i>
                                                <span>Siang</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day">
                                            <span class="day-number">7</span>
                                            <div class="shift-badge siang">
                                                <i class="fas fa-cloud-sun"></i>
                                                <span>Siang</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day">
                                            <span class="day-number">8</span>
                                            <div class="shift-badge malam">
                                                <i class="fas fa-moon"></i>
                                                <span>Malam</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day weekend">
                                            <span class="day-number">9</span>
                                            <div class="shift-badge malam">
                                                <i class="fas fa-moon"></i>
                                                <span>Malam</span>
                                            </div>
                                        </div>
                                        <div class="calendar-day weekend">
                                            <span class="day-number">10</span>
                                            <div class="shift-badge libur">
                                                <i class="fas fa-umbrella-beach"></i>
                                                <span>Libur</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- List View -->
                            <div class="calendar-view" id="list-view">
                                <div class="shift-list">
                                    <div class="shift-list-item">
                                        <div class="shift-date">
                                            <div class="date-day">Senin</div>
                                            <div class="date-number">4 Des 2023</div>
                                        </div>
                                        <div class="shift-details">
                                            <div class="shift-type pagi">
                                                <i class="fas fa-sun"></i>
                                                <span>Shift Pagi</span>
                                            </div>
                                            <div class="shift-time">07:00 - 15:00</div>
                                        </div>
                                        <div class="shift-notes">
                                            <span class="note">Normal shift</span>
                                        </div>
                                    </div>
                                    <div class="shift-list-item">
                                        <div class="shift-date">
                                            <div class="date-day">Selasa</div>
                                            <div class="date-number">5 Des 2023</div>
                                        </div>
                                        <div class="shift-details">
                                            <div class="shift-type pagi">
                                                <i class="fas fa-sun"></i>
                                                <span>Shift Pagi</span>
                                            </div>
                                            <div class="shift-time">07:00 - 15:00</div>
                                        </div>
                                        <div class="shift-notes">
                                            <span class="note">Normal shift</span>
                                        </div>
                                    </div>
                                    <div class="shift-list-item">
                                        <div class="shift-date">
                                            <div class="date-day">Rabu</div>
                                            <div class="date-number">6 Des 2023</div>
                                        </div>
                                        <div class="shift-details">
                                            <div class="shift-type siang">
                                                <i class="fas fa-cloud-sun"></i>
                                                <span>Shift Siang</span>
                                            </div>
                                            <div class="shift-time">15:00 - 23:00</div>
                                        </div>
                                        <div class="shift-notes">
                                            <span class="note">Meeting tim 14:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shift Legend -->
                        <div class="shift-legend">
                            <h4>Legenda Shift</h4>
                            <div class="legend-items">
                                <div class="legend-item">
                                    <div class="legend-color pagi"></div>
                                    <span>Shift Pagi (07:00 - 15:00)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color siang"></div>
                                    <span>Shift Siang (15:00 - 23:00)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color malam"></div>
                                    <span>Shift Malam (23:00 - 07:00)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color libur"></div>
                                    <span>Hari Libur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Dokumen -->
            <div class="tab-content" id="documents">
                <div class="tab-card">
                    <div class="tab-header">
                        <h2 class="tab-title">Dokumen & File</h2>
                        <button class="edit-btn" id="uploadDocumentBtn">
                            <i class="fas fa-upload"></i> 
                            <span class="btn-text">Unggah Dokumen</span>
                        </button>
                    </div>

                    <div class="documents-container">
                        <!-- Documents Stats -->
                        <div class="documents-stats">
                            <div class="doc-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>8</h3>
                                    <p>File PDF</p>
                                </div>
                            </div>
                            <div class="doc-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-file-image"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>5</h3>
                                    <p>File Gambar</p>
                                </div>
                            </div>
                            <div class="doc-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>12.5</h3>
                                    <p>MB Terpakai</p>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Grid -->
                        <div class="documents-grid">
                            <div class="document-item">
                                <div class="document-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="document-info">
                                    <h4 class="document-name">CV_Update_2024.pdf</h4>
                                    <p class="document-meta">Diunggah: 15 Jan 2024 • 2.4 MB</p>
                                    <div class="document-tags">
                                        <span class="tag">CV</span>
                                        <span class="tag">Personal</span>
                                    </div>
                                </div>
                                <div class="document-actions">
                                    <button class="action-btn" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="action-btn" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="document-item">
                                <div class="document-icon">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <div class="document-info">
                                    <h4 class="document-name">Kontrak_Kerja.pdf</h4>
                                    <p class="document-meta">Diunggah: 10 Mar 2023 • 1.8 MB</p>
                                    <div class="document-tags">
                                        <span class="tag">Kontrak</span>
                                        <span class="tag">HR</span>
                                    </div>
                                </div>
                                <div class="document-actions">
                                    <button class="action-btn" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="action-btn" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Share">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Pengaturan -->
            <div class="tab-content" id="settings">
                <div class="tab-card">
                    <div class="tab-header">
                        <h2 class="tab-title">Pengaturan Akun</h2>
                    </div>

                    <div class="settings-container">
                        <!-- Security Settings -->
                        <div class="settings-group">
                            <h3 class="settings-group-title">
                                <i class="fas fa-lock"></i>
                                Keamanan Akun
                            </h3>
                            <div class="settings-items">
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4 class="setting-name">Kata Sandi</h4>
                                        <p class="setting-description">Terakhir diubah 3 bulan yang lalu</p>
                                    </div>
                                    <button class="setting-action">Ubah</button>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4 class="setting-name">Verifikasi 2 Langkah</h4>
                                        <p class="setting-description">Aktifkan untuk keamanan ekstra</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Settings -->
                        <div class="settings-group">
                            <h3 class="settings-group-title">
                                <i class="fas fa-bell"></i>
                                Notifikasi
                            </h3>
                            <div class="settings-items">
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4 class="setting-name">Email Notifikasi</h4>
                                        <p class="setting-description">Pemberitahuan melalui email</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4 class="setting-name">Notifikasi Shift</h4>
                                        <p class="setting-description">Pengingat jadwal shift</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengubah avatar -->
<div id="avatar-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Ubah Foto Profil</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="avatar-options">
                <div class="avatar-option">
                    <img src="{{ asset('storage/' . ($user->avatar ?? 'images/default-avatar.png')) }}" alt="Current Avatar" id="currentAvatar">
                    <p>Foto Saat Ini</p>
                </div>
                <div class="avatar-option">
                    <div class="upload-area" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Klik untuk mengunggah foto baru</p>
                        <input type="file" id="avatarUpload" accept="image/*" style="display: none;">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel">Batal</button>
            <button class="btn-save">
                <span class="btn-text">Simpan Perubahan</span>
                <div class="btn-loader" style="display: none;">
                    <div class="spinner"></div>
                </div>
            </button>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="modal">
    <div class="modal-content">
        <div class="modal-icon success">
            <i class="fas fa-check-circle"></i>
        </div>
        <h3 class="modal-title">Perubahan Berhasil Disimpan!</h3>
        <p class="modal-message">Perubahan pada profil Anda telah berhasil disimpan.</p>
        <button class="modal-btn" id="modal-close">Tutup</button>
    </div>
</div>

<style>
/* Base Styles - Konsisten dengan layout.appkaryawan */
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

.profile-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
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
.profile-content {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 30px;
    min-height: 600px;
}

@media (max-width: 1200px) {
    .profile-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

/* Sidebar Section */
.sidebar-section {
    height: 100%;
}

.sidebar-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 25px;
    box-shadow: var(--shadow);
    height: fit-content;
    position: sticky;
    top: 100px;
}

/* Profile Summary */
.profile-summary {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 25px;
    border-bottom: 1px solid var(--light);
}

.avatar-container {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--light);
    transition: var(--transition);
}

.avatar-container:hover .profile-avatar {
    border-color: var(--primary);
}

.change-avatar-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.change-avatar-btn:hover {
    background: var(--primary-dark);
    transform: scale(1.1);
}

.profile-details {
    margin-top: 15px;
}

.profile-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--secondary);
    margin-bottom: 5px;
}

.profile-position {
    color: var(--gray);
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.profile-badges {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
}

.badge {
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.badge-primary {
    background: var(--primary);
    color: white;   
}

.badge-secondary {
    background: var(--light);
    color: var(--gray);
}

/* Navigation Menu */
.profile-nav ul {
    list-style: none;
    margin-bottom: 25px;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 15px;
    cursor: pointer;
    transition: var(--transition);
    border-radius: var(--border-radius);
    margin-bottom: 8px;
    border-left: 3px solid transparent;
}

.nav-item:hover {
    background: var(--light);
    transform: translateX(5px);
}

.nav-item.active {
    background: var(--light);
    border-left-color: var(--primary);
    color: var(--primary);
    font-weight: 600;
}

.nav-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: var(--light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    color: var(--gray);
    transition: var(--transition);
}

.nav-item.active .nav-icon {
    background: var(--primary);
    color: white;
}

.nav-arrow {
    margin-left: auto;
    color: var(--gray);
    font-size: 0.9rem;
    transition: var(--transition);
}

.nav-item.active .nav-arrow {
    color: var(--primary);
    transform: rotate(90deg);
}

/* Quick Actions */
.quick-actions {
    padding-top: 20px;
    border-top: 1px solid var(--light);
}

.actions-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: var(--secondary);
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px;
    background: none;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
}

.action-btn:hover {
    color: var(--primary);
}

/* Content Section */
.content-section {
    height: 100%;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.tab-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 30px;
    box-shadow: var(--shadow);
    height: 100%;
    min-height: 600px;
}

.tab-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--light);
}

.tab-title {
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--secondary);
}

.tab-actions {
    display: flex;
    gap: 12px;
}

.action-btn-secondary {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 15px;
    background: var(--light);
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
    color: var(--secondary);
}

.action-btn-secondary:hover {
    background: var(--primary);
    color: white;
}

/* Edit Button */
.edit-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
    position: relative;
}

.edit-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
}

.btn-loader {
    display: none;
}

.spinner {
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* ===== INFORMASI PRIBADI STYLES ===== */
.info-grid {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.info-group {
    background: var(--light);
    border-radius: var(--border-radius);
    padding: 25px;
}

.info-group-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--secondary);
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.info-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .info-row {
        grid-template-columns: 1fr;
    }
}

.info-item {
    margin-bottom: 15px;
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--secondary);
    font-size: 0.95rem;
}

.info-value {
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
    color: var(--text);
    font-size: 1rem;
}

.info-input, .info-textarea, .info-input select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid var(--light);
    border-radius: 6px;
    font-size: 1rem;
    transition: var(--transition);
    background: white;
}

.info-input:focus, .info-textarea:focus, .info-input select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.info-textarea {
    resize: vertical;
    min-height: 100px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--light);
}

.btn-save {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 25px;
    background: var(--success);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 600;
    position: relative;
}

.btn-save:hover {
    background: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
}

.btn-cancel {
    padding: 12px 25px;
    background: var(--gray);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 600;
}

.btn-cancel:hover {
    background: #7f8c8d;
}

/* Status Badge */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-badge.active {
    background: rgba(46, 204, 113, 0.1);
    color: var(--success);
}

/* ===== JADWAL SHIFT STYLES ===== */
.shift-overview {
    margin-bottom: 30px;
}

.overview-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.overview-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 25px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    transition: var(--transition);
    border-left: 4px solid var(--primary);
}

.overview-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.overview-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: var(--primary);
    font-size: 1.3rem;
}

.overview-info h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 5px;
}

.overview-info p {
    color: var(--gray);
    font-size: 0.9rem;
    font-weight: 500;
}

/* Calendar Section */
.calendar-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 25px;
    box-shadow: var(--shadow);
    margin-bottom: 30px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.calendar-nav {
    display: flex;
    align-items: center;
    gap: 15px;
}

.nav-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--light);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    color: var(--secondary);
}

.nav-btn:hover {
    background: var(--primary);
    color: white;
}

.current-month {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--secondary);
    min-width: 180px;
    text-align: center;
}

.calendar-views {
    display: flex;
    background: var(--light);
    border-radius: var(--border-radius);
    padding: 4px;
}

.view-btn {
    padding: 8px 16px;
    border: none;
    background: transparent;
    border-radius: 6px;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
    color: var(--gray);
}

.view-btn.active {
    background: white;
    color: var(--primary);
    box-shadow: var(--shadow);
}

/* Calendar Grid */
.calendar-view {
    display: none;
}

.calendar-view.active {
    display: block;
}

.calendar-grid {
    background: white;
}

.calendar-weekdays {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: var(--light);
    border-radius: var(--border-radius) var(--border-radius) 0 0;
    overflow: hidden;
}

.weekday {
    padding: 15px;
    text-align: center;
    font-weight: 600;
    color: var(--secondary);
    background: white;
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: var(--light);
    border-radius: 0 0 var(--border-radius) var(--border-radius);
    overflow: hidden;
}

.calendar-day {
    aspect-ratio: 1;
    background: white;
    padding: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    transition: var(--transition);
    position: relative;
    min-height: 100px;
}

.calendar-day:hover {
    background: #f8f9fa;
    transform: scale(1.02);
}

.calendar-day.empty {
    background: #f8f9fa;
}

.calendar-day.weekend {
    background: #f8f9fa;
}

.day-number {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--secondary);
    align-self: flex-start;
}

.shift-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 0.7rem;
    font-weight: 500;
    padding: 6px 8px;
    border-radius: 6px;
    width: 100%;
    text-align: center;
}

.shift-badge.pagi {
    background: rgba(52, 152, 219, 0.1);
    color: var(--primary);
    border: 1px solid rgba(52, 152, 219, 0.2);
}

.shift-badge.siang {
    background: rgba(46, 204, 113, 0.1);
    color: var(--success);
    border: 1px solid rgba(46, 204, 113, 0.2);
}

.shift-badge.malam {
    background: rgba(155, 89, 182, 0.1);
    color: #9b59b6;
    border: 1px solid rgba(155, 89, 182, 0.2);
}

.shift-badge.libur {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger);
    border: 1px solid rgba(231, 76, 60, 0.2);
}

/* List View */
.shift-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.shift-list-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: var(--light);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.shift-list-item:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow);
}

.shift-date {
    min-width: 120px;
    margin-right: 20px;
}

.date-day {
    font-weight: 600;
    color: var(--secondary);
    margin-bottom: 5px;
}

.date-number {
    font-size: 0.9rem;
    color: var(--gray);
}

.shift-details {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 20px;
}

.shift-type {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.9rem;
}

.shift-type.pagi {
    background: rgba(52, 152, 219, 0.1);
    color: var(--primary);
}

.shift-type.siang {
    background: rgba(46, 204, 113, 0.1);
    color: var(--success);
}

.shift-type.malam {
    background: rgba(155, 89, 182, 0.1);
    color: #9b59b6;
}

.shift-time {
    font-weight: 600;
    color: var(--secondary);
}

.shift-notes {
    margin-left: auto;
}

.note {
    padding: 6px 12px;
    background: white;
    border-radius: 15px;
    font-size: 0.8rem;
    color: var(--gray);
}

/* Shift Legend */
.shift-legend {
    background: white;
    border-radius: var(--border-radius);
    padding: 20px;
    box-shadow: var(--shadow);
}

.shift-legend h4 {
    margin-bottom: 15px;
    color: var(--secondary);
    font-weight: 600;
}

.legend-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.legend-color {
    width: 20px;
    height: 20px;
    border-radius: 4px;
}

.legend-color.pagi {
    background: var(--primary);
}

.legend-color.siang {
    background: var(--success);
}

.legend-color.malam {
    background: #9b59b6;
}

.legend-color.libur {
    background: var(--danger);
}

/* ===== DOKUMEN STYLES ===== */
.documents-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.doc-stat {
    display: flex;
    align-items: center;
    padding: 20px;
    background: var(--light);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.doc-stat:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow);
}

.doc-stat .stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
    font-size: 1.2rem;
}

.doc-stat .stat-info h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 5px;
}

.doc-stat .stat-info p {
    color: var(--gray);
    font-size: 0.9rem;
}

/* Documents Grid */
.documents-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
}

.document-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: var(--light);
    border-radius: var(--border-radius);
    transition: var(--transition);
    border-left: 4px solid var(--primary);
}

.document-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow);
}

.document-icon {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: var(--primary);
    font-size: 1.5rem;
}

.document-info {
    flex: 1;
}

.document-name {
    font-weight: 600;
    margin-bottom: 5px;
    color: var(--secondary);
}

.document-meta {
    font-size: 0.9rem;
    color: var(--gray);
    margin-bottom: 8px;
}

.document-tags {
    display: flex;
    gap: 5px;
}

.tag {
    padding: 4px 8px;
    background: white;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 500;
    color: var(--gray);
}

.document-actions {
    display: flex;
    gap: 8px;
}

.document-actions .action-btn {
    width: 36px;
    height: 36px;
    border-radius: 6px;
    background: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    color: var(--gray);
}

.document-actions .action-btn:hover {
    background: var(--primary);
    color: white;
}

/* ===== PENGATURAN STYLES ===== */
.settings-group {
    background: white;
    border-radius: var(--border-radius);
    padding: 25px;
    box-shadow: var(--shadow);
    margin-bottom: 25px;
}

.settings-group-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--secondary);
    border-bottom: 1px solid var(--light);
    padding-bottom: 10px;
}

.settings-items {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.setting-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background: var(--light);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.setting-item:hover {
    transform: translateX(5px);
}

.setting-info {
    flex: 1;
}

.setting-name {
    font-weight: 600;
    margin-bottom: 5px;
    color: var(--secondary);
}

.setting-description {
    font-size: 0.9rem;
    color: var(--gray);
}

/* Switch Toggle */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 24px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: var(--success);
}

input:checked + .slider:before {
    transform: translateX(26px);
}

/* Setting Action Buttons */
.setting-action {
    padding: 8px 16px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
}

.setting-action:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
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
    padding: 30px;
    max-width: 500px;
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

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--light);
}

.modal-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--secondary);
}

.close-modal {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--gray);
    transition: var(--transition);
}

.close-modal:hover {
    color: var(--danger);
}

.modal-body {
    margin-bottom: 25px;
}

.avatar-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.avatar-option {
    text-align: center;
}

.avatar-option img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
    border: 3px solid var(--light);
}

.upload-area {
    border: 2px dashed #ced4da;
    border-radius: var(--border-radius);
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    height: 150px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.upload-area:hover {
    border-color: var(--primary);
    background: var(--light);
}

.upload-area i {
    font-size: 2.5rem;
    color: var(--gray);
    margin-bottom: 10px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    padding-top: 20px;
    border-top: 1px solid var(--light);
}

/* Success Modal */
#success-modal .modal-content {
    text-align: center;
    padding: 40px;
}

.modal-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

.modal-icon.success {
    color: var(--success);
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
    .profile-container {
        padding: 15px;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .profile-content {
        grid-template-columns: 1fr;
    }
    
    .sidebar-card {
        position: static;
    }
    
    .tab-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .tab-actions {
        width: 100%;
        justify-content: flex-start;
    }
    
    .calendar-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .calendar-views {
        width: 100%;
        justify-content: center;
    }
    
    .avatar-options {
        grid-template-columns: 1fr;
    }
    
    .documents-grid {
        grid-template-columns: 1fr;
    }
    
    .overview-cards {
        grid-template-columns: 1fr;
    }
    
    .legend-items {
        grid-template-columns: 1fr;
    }
    
    .shift-list-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .shift-details {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .shift-notes {
        margin-left: 0;
    }
}

/* Animation for calendar days and list items */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.calendar-day, .shift-list-item, .document-item, .setting-item {
    animation: slideIn 0.3s ease;
}

/* Loading states */
.loading {
    opacity: 0.7;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation
    const navItems = document.querySelectorAll('.nav-item');
    const tabContents = document.querySelectorAll('.tab-content');
    
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Update active nav item
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
            
            // Show corresponding tab content
            tabContents.forEach(tab => {
                tab.classList.remove('active');
                if (tab.id === tabId) {
                    tab.classList.add('active');
                }
            });
        });
    });
    
    // Edit mode untuk informasi pribadi
    const editButtons = document.querySelectorAll('.edit-btn');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-edit');
            const tabContent = document.getElementById(tabId);
            
            if (tabId === 'personal-info') {
                const viewModeElements = tabContent.querySelectorAll('.view-mode');
                const editModeElements = tabContent.querySelectorAll('.edit-mode');
                const actionButtons = tabContent.querySelector('.action-buttons');
                
                viewModeElements.forEach(el => el.style.display = 'none');
                editModeElements.forEach(el => {
                    if (el.tagName !== 'BUTTON') {
                        el.style.display = 'block';
                    }
                });
                actionButtons.style.display = 'flex';
            }
        });
    });
    
    // Cancel edit mode
    const cancelButtons = document.querySelectorAll('.btn-cancel');
    
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabContent = this.closest('.tab-content');
            const viewModeElements = tabContent.querySelectorAll('.view-mode');
            const editModeElements = tabContent.querySelectorAll('.edit-mode');
            const actionButtons = tabContent.querySelector('.action-buttons');
            
            viewModeElements.forEach(el => el.style.display = 'block');
            editModeElements.forEach(el => {
                if (el.tagName !== 'BUTTON') {
                    el.style.display = 'none';
                }
            });
            actionButtons.style.display = 'none';
        });
    });
    
    // Modal untuk mengubah avatar
    const changeAvatarBtn = document.getElementById('changeAvatarBtn');
    const avatarModal = document.getElementById('avatar-modal');
    const closeModalBtn = document.querySelector('.close-modal');
    const cancelModalBtn = document.querySelector('.modal .btn-cancel');
    const uploadArea = document.getElementById('uploadArea');
    const avatarUpload = document.getElementById('avatarUpload');
    
    changeAvatarBtn.addEventListener('click', function() {
        avatarModal.style.display = 'flex';
    });
    
    function closeModal() {
        avatarModal.style.display = 'none';
    }
    
    closeModalBtn.addEventListener('click', closeModal);
    cancelModalBtn.addEventListener('click', closeModal);
    
    // Close modal ketika klik di luar konten modal
    avatarModal.addEventListener('click', function(e) {
        if (e.target === avatarModal) {
            closeModal();
        }
    });
    
    // Upload avatar
    uploadArea.addEventListener('click', function() {
        avatarUpload.click();
    });
    
    avatarUpload.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(event) {
                const currentAvatar = document.getElementById('currentAvatar');
                currentAvatar.src = event.target.result;
                
                // Juga update avatar di sidebar
                const profileAvatar = document.querySelector('.profile-avatar');
                profileAvatar.src = event.target.result;
            }
            
            reader.readAsDataURL(e.target.files[0]);
        }
    });
    
    // Form submission dengan loading state
    const saveButtons = document.querySelectorAll('.btn-save');
    const successModal = document.getElementById('success-modal');
    const modalClose = document.getElementById('modal-close');
    
    saveButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const btnText = this.querySelector('.btn-text');
            const btnLoader = this.querySelector('.btn-loader');
            
            // Show loading state
            if (btnText && btnLoader) {
                btnText.style.display = 'none';
                btnLoader.style.display = 'block';
                this.disabled = true;
            }
            
            // Simulate API call
            setTimeout(() => {
                // Reset button
                if (btnText && btnLoader) {
                    btnText.style.display = 'block';
                    btnLoader.style.display = 'none';
                    this.disabled = false;
                }
                
                // Show success modal
                successModal.style.display = 'flex';
                
                // Close avatar modal if open
                closeModal();
                
                // Exit edit mode if in personal info
                const personalInfoTab = document.getElementById('personal-info');
                if (personalInfoTab.classList.contains('active')) {
                    const viewModeElements = personalInfoTab.querySelectorAll('.view-mode');
                    const editModeElements = personalInfoTab.querySelectorAll('.edit-mode');
                    const actionButtons = personalInfoTab.querySelector('.action-buttons');
                    
                    viewModeElements.forEach(el => el.style.display = 'block');
                    editModeElements.forEach(el => {
                        if (el.tagName !== 'BUTTON') {
                            el.style.display = 'none';
                        }
                    });
                    actionButtons.style.display = 'none';
                }
            }, 1500);
        });
    });
    
    // Close success modal
    modalClose.addEventListener('click', function() {
        successModal.style.display = 'none';
    });
    
    // Quick actions
    const exportBtn = document.getElementById('exportProfile');
    const printBtn = document.getElementById('printProfile');
    
    if (exportBtn) {
        exportBtn.addEventListener('click', function() {
            // Simulate export functionality
            const btnText = this.querySelector('span');
            const originalText = btnText.textContent;
            
            btnText.textContent = 'Mengekspor...';
            this.disabled = true;
            
            setTimeout(() => {
                btnText.textContent = originalText;
                this.disabled = false;
                alert('Profil berhasil diekspor!');
            }, 2000);
        });
    }
    
    if (printBtn) {
        printBtn.addEventListener('click', function() {
            window.print();
        });
    }
    
    // Shift Calendar Navigation
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    const currentMonthEl = document.querySelector('.current-month');
    
    let currentDate = new Date();
    
    function updateCalendar() {
        const options = { year: 'numeric', month: 'long' };
        currentMonthEl.textContent = currentDate.toLocaleDateString('id-ID', options);
        
        // In a real application, you would fetch and update the calendar data here
        // For demo purposes, we'll just update the month display
    }
    
    if (prevMonthBtn && nextMonthBtn) {
        prevMonthBtn.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateCalendar();
        });
        
        nextMonthBtn.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateCalendar();
        });
    }
    
    // Calendar View Switching
    const viewBtns = document.querySelectorAll('.view-btn');
    const calendarViews = document.querySelectorAll('.calendar-view');
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.getAttribute('data-view');
            
            // Update active view button
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Show corresponding view
            calendarViews.forEach(viewEl => {
                viewEl.classList.remove('active');
                if (viewEl.id === `${view}-view`) {
                    viewEl.classList.add('active');
                }
            });
        });
    });
    
    // Initialize calendar
    updateCalendar();
});
</script>
@endsection