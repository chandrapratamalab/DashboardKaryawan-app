@extends('layout.apphrd')

@section('title', 'Laporan Ketidakhadiran')

@section('page-title', 'Laporan Ketidakhadiran')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-4">
        <div>
            <p class="mb-0 text-muted">Monitor dan kelola data Ketidakhadiran karyawan</p>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-download me-2"></i>Export Laporan
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" id="exportPDF"><i class="fas fa-file-pdf me-2 text-danger"></i>Download PDF</a></li>
                <li><a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-2 text-success"></i>Download Excel</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print</a></li>
            </ul>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">150</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Hadir Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">142</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Persetujuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-filter me-2"></i>Filter Laporan Ketidakhadiran</h6>
            <button class="btn btn-sm btn-outline-secondary" type="button" id="resetFilter">
                <i class="fas fa-redo me-1"></i>Reset
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Periode Mulai</label>
                    <input type="date" class="form-control" id="startDate" value="{{ date('Y-m-01') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Periode Akhir</label>
                    <input type="date" class="form-control" id="endDate" value="{{ date('Y-m-t') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Departemen</label>
                    <select class="form-select" id="department">
                        <option value="">Semua Departemen</option>
                        <option value="IT">IT</option>
                        <option value="HRD">HRD</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Status Persetujuan</label>
                    <select class="form-select" id="approvalStatus">
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" id="applyFilter">
                        <i class="fas fa-search me-2"></i>Terapkan Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Statistics -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Ketidakhadiran Bulan Ini</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-1"></i>Bulanan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-period="weekly">Mingguan</a></li>
                            <li><a class="dropdown-item" href="#" data-period="monthly">Bulanan</a></li>
                            <li><a class="dropdown-item" href="#" data-period="yearly">Tahunan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="absenceChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Persetujuan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="approvalChart" height="250"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Disetujui
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Menunggu
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Ditolak
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Charts -->
    <div class="row mb-4">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ketidakhadiran per Departemen</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="departmentChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Trend Ketidakhadiran 6 Bulan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-line">
                        <canvas id="trendChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Ketidakhadiran</h6>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-cog me-1"></i>Aksi
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" id="exportTablePDF"><i class="fas fa-file-pdf me-2 text-danger"></i>Export PDF</a></li>
                    <li><a class="dropdown-item" href="#" id="exportTableExcel"><i class="fas fa-file-excel me-2 text-success"></i>Export Excel</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Tabel</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="absenceTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Karyawan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="absenceTableBody">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan <span id="showingFrom" class="fw-bold">1</span> sampai 
                    <span id="showingTo" class="fw-bold">10</span> dari 
                    <span id="totalData" class="fw-bold">50</span> data
                </div>
                <div class="btn-group">
                    <button class="btn btn-outline-primary btn-sm" id="prevPage">
                        <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                    </button>
                    <button class="btn btn-outline-primary btn-sm" id="nextPage">
                        Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail & Approval -->
<div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approvalModalLabel">Detail Permohonan Izin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="approvalModalBody">
                <!-- Konten modal akan diisi oleh JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="rejectBtn" data-id="">
                    <i class="fas fa-times me-2"></i>Tolak
                </button>
                <button type="button" class="btn btn-success" id="approveBtn" data-id="">
                    <i class="fas fa-check me-2"></i>Setujui
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Penolakan -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="rejectModalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menolak permohonan izin ini?</p>
                <div class="mb-3">
                    <label for="rejectionReason" class="form-label">Alasan Penolakan (Opsional):</label>
                    <textarea class="form-control" id="rejectionReason" rows="3" placeholder="Berikan alasan penolakan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmRejectBtn">
                    <i class="fas fa-times me-2"></i>Ya, Tolak
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Spinner -->
<div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mb-0 text-muted">Memuat data...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    .card-header {
        border-bottom: 1px solid #e3e6f0;
        background-color: #f8f9fc;
    }
    .table th {
        background-color: #f8f9fc;
        font-weight: 600;
        color: #6e707e;
    }
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
    }
    .text-xs {
        font-size: 0.7rem;
    }
    .chart-bar, .chart-pie, .chart-line {
        position: relative;
        height: 100%;
    }
    .badge {
        font-size: 0.75em;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fc;
    }
    .approval-card {
        transition: all 0.3s ease;
        border-left: 4px solid #f6c23e;
    }
    .approval-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .quick-action-btn {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    // Sample data dengan status persetujuan
    const sampleData = [
        { 
            id: 1, 
            name: "Ahmad Rizki", 
            department: "IT", 
            date: "2024-01-15", 
            type: "Izin", 
            description: "Sakit demam tinggi dan harus beristirahat", 
            status: "approved",
            submission_date: "2024-01-14",
            attachment: "surat_sakit.pdf",
            contact: "08123456789"
        },
        { 
            id: 2, 
            name: "Siti Nurhaliza", 
            department: "HRD", 
            date: "2024-01-15", 
            type: "Cuti", 
            description: "Cuti tahunan yang sudah dijadwalkan", 
            status: "approved",
            submission_date: "2024-01-10",
            attachment: null,
            contact: "08123456788"
        },
        { 
            id: 3, 
            name: "Budi Santoso", 
            department: "Finance", 
            date: "2024-01-14", 
            type: "Izin", 
            description: "Perlu mengantar anak ke dokter spesialis", 
            status: "pending",
            submission_date: "2024-01-13",
            attachment: "janji_dokter.jpg",
            contact: "08123456787"
        },
        { 
            id: 4, 
            name: "Maya Sari", 
            department: "Marketing", 
            date: "2024-01-14", 
            type: "Izin", 
            description: "Keperluan keluarga yang mendesak", 
            status: "pending",
            submission_date: "2024-01-13",
            attachment: null,
            contact: "08123456786"
        },
        { 
            id: 5, 
            name: "Rizky Pratama", 
            department: "IT", 
            date: "2024-01-13", 
            type: "Cuti", 
            description: "Menikah", 
            status: "approved",
            submission_date: "2024-01-01",
            attachment: "undangan_pernikahan.pdf",
            contact: "08123456785"
        },
        { 
            id: 6, 
            name: "Dewi Anggraini", 
            department: "HRD", 
            date: "2024-01-13", 
            type: "Sakit", 
            description: "Demam dan batuk pilek", 
            status: "pending",
            submission_date: "2024-01-12",
            attachment: null,
            contact: "08123456784"
        },
        { 
            id: 7, 
            name: "Fajar Setiawan", 
            department: "Finance", 
            date: "2024-01-12", 
            type: "Izin", 
            description: "Acara keluarga besar", 
            status: "rejected",
            submission_date: "2024-01-11",
            attachment: null,
            contact: "08123456783",
            rejection_reason: "Tidak disertai undangan resmi"
        }
    ];

    let currentPage = 1;
    const itemsPerPage = 10;
    let currentApprovalId = null;
    let absenceChart, approvalChart, departmentChart, trendChart;

    document.addEventListener('DOMContentLoaded', function() {
        loadTableData();
        initializeCharts();
        setupEventListeners();
    });

    function loadTableData() {
        const tableBody = document.getElementById('absenceTableBody');
        tableBody.innerHTML = '';

        sampleData.forEach((item, index) => {
            const row = document.createElement('tr');
            const typeBadge = getTypeBadge(item.type);
            const statusBadge = getStatusBadge(item.status);
            const actionButtons = getActionButtons(item);
            
            row.innerHTML = `
                <td>${item.id}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 35px; height: 35px; font-size: 12px; font-weight: bold;">
                                ${item.name.split(' ').map(n => n[0]).join('')}
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold text-gray-800">${item.name}</div>
                            <div class="text-muted small">${item.department}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-primary">${item.department}</span>
                </td>
                <td class="text-nowrap">${new Date(item.date).toLocaleDateString('id-ID')}</td>
                <td>${typeBadge}</td>
                <td>${item.description}</td>
                <td>${statusBadge}</td>
                <td class="text-nowrap">${new Date(item.submission_date).toLocaleDateString('id-ID')}</td>
                <td>
                    ${actionButtons}
                </td>
            `;
            
            tableBody.appendChild(row);
        });
    }

    function getTypeBadge(type) {
        const badges = {
            'Izin': 'bg-warning text-dark',
            'Cuti': 'bg-success',
            'Alpha': 'bg-danger',
            'Sakit': 'bg-info'
        };
        
        return `<span class="badge ${badges[type] || 'bg-secondary'}">${type}</span>`;
    }

    function getStatusBadge(status) {
        const badges = {
            'approved': 'bg-success',
            'pending': 'bg-warning text-dark',
            'rejected': 'bg-danger'
        };
        
        const texts = {
            'approved': 'Disetujui',
            'pending': 'Menunggu',
            'rejected': 'Ditolak'
        };
        
        return `<span class="badge ${badges[status]}">${texts[status]}</span>`;
    }

    function getActionButtons(item) {
        if (item.status === 'pending') {
            return `
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" onclick="viewDetail(${item.id})" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-outline-success" onclick="showApprovalModal(${item.id})" title="Setujui">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="btn btn-outline-danger" onclick="showRejectModal(${item.id})" title="Tolak">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        } else {
            return `
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" onclick="viewDetail(${item.id})" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-outline-secondary" onclick="editData(${item.id})" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            `;
        }
    }

    // Fungsi untuk menampilkan modal persetujuan
    function showApprovalModal(id) {
        const item = sampleData.find(d => d.id === id);
        if (!item) return;

        currentApprovalId = id;
        
        const modalBody = document.getElementById('approvalModalBody');
        modalBody.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Informasi Karyawan</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>${item.name}</td>
                        </tr>
                        <tr>
                            <td><strong>Departemen</strong></td>
                            <td>${item.department}</td>
                        </tr>
                        <tr>
                            <td><strong>Kontak</strong></td>
                            <td>${item.contact}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Detail Izin</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Jenis</strong></td>
                            <td>${item.type}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal</strong></td>
                            <td>${new Date(item.date).toLocaleDateString('id-ID')}</td>
                        </tr>
                        <tr>
                            <td><strong>Pengajuan</strong></td>
                            <td>${new Date(item.submission_date).toLocaleDateString('id-ID')}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h6>Keterangan</h6>
                    <div class="border rounded p-3 bg-light">
                        ${item.description}
                    </div>
                </div>
            </div>
            ${item.attachment ? `
            <div class="row mt-3">
                <div class="col-12">
                    <h6>Lampiran</h6>
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-paperclip me-1"></i>${item.attachment}
                    </a>
                </div>
            </div>
            ` : ''}
        `;

        document.getElementById('approveBtn').setAttribute('data-id', id);
        document.getElementById('rejectBtn').setAttribute('data-id', id);
        
        const modal = new bootstrap.Modal(document.getElementById('approvalModal'));
        modal.show();
    }

    // Fungsi untuk menampilkan modal penolakan
    function showRejectModal(id) {
        currentApprovalId = id;
        const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
        modal.show();
    }

    // Fungsi persetujuan cepat
    function quickApprove(id) {
        if (confirm('Setujui permohonan izin ini?')) {
            processApproval(id, 'approved');
        }
    }

    // Fungsi untuk memproses persetujuan
    function processApproval(id, status, reason = '') {
        showLoading();
        
        setTimeout(() => {
            // Simulasi update data
            const itemIndex = sampleData.findIndex(item => item.id === id);
            if (itemIndex !== -1) {
                sampleData[itemIndex].status = status;
                if (status === 'rejected') {
                    sampleData[itemIndex].rejection_reason = reason;
                }
            }
            
            hideLoading();
            loadTableData();
            updateCharts();
            
            const actionText = status === 'approved' ? 'disetujui' : 'ditolak';
            showNotification(`Permohonan izin berhasil ${actionText}!`, status === 'approved' ? 'success' : 'warning');
            
            // Tutup modal
            const approvalModal = bootstrap.Modal.getInstance(document.getElementById('approvalModal'));
            if (approvalModal) approvalModal.hide();
            
            const rejectModal = bootstrap.Modal.getInstance(document.getElementById('rejectModal'));
            if (rejectModal) rejectModal.hide();
        }, 1000);
    }

    function initializeCharts() {
        // Data untuk grafik
        const weeklyData = {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Izin',
                data: [3, 5, 2, 4],
                backgroundColor: '#f6c23e',
                borderColor: '#f6c23e',
                borderWidth: 1
            }, {
                label: 'Cuti',
                data: [2, 3, 1, 2],
                backgroundColor: '#1cc88a',
                borderColor: '#1cc88a',
                borderWidth: 1
            }, {
                label: 'Alpha',
                data: [1, 2, 0, 1],
                backgroundColor: '#e74a3b',
                borderColor: '#e74a3b',
                borderWidth: 1
            }]
        };

        const monthlyData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Izin',
                data: [12, 15, 8, 10, 9, 11],
                backgroundColor: '#f6c23e',
                borderColor: '#f6c23e',
                borderWidth: 1
            }, {
                label: 'Cuti',
                data: [8, 6, 10, 7, 9, 5],
                backgroundColor: '#1cc88a',
                borderColor: '#1cc88a',
                borderWidth: 1
            }, {
                label: 'Alpha',
                data: [3, 2, 1, 4, 2, 3],
                backgroundColor: '#e74a3b',
                borderColor: '#e74a3b',
                borderWidth: 1
            }]
        };

        // Hitung statistik persetujuan
        const approvedCount = sampleData.filter(item => item.status === 'approved').length;
        const pendingCount = sampleData.filter(item => item.status === 'pending').length;
        const rejectedCount = sampleData.filter(item => item.status === 'rejected').length;

        // Chart Status Persetujuan
        const ctx2 = document.getElementById('approvalChart').getContext('2d');
        approvalChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Disetujui', 'Menunggu', 'Ditolak'],
                datasets: [{
                    data: [approvedCount, pendingCount, rejectedCount],
                    backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                    hoverBackgroundColor: ['#17a673', '#dda20a', '#be2617'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '70%',
            },
        });

        // Bar Chart for Monthly Statistics
        const ctx1 = document.getElementById('absenceChart').getContext('2d');
        absenceChart = new Chart(ctx1, {
            type: 'bar',
            data: monthlyData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Ketidakhadiran'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Statistik Ketidakhadiran 6 Bulan Terakhir'
                    }
                }
            }
        });

        // Department Chart
        const ctx3 = document.getElementById('departmentChart').getContext('2d');
        departmentChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['IT', 'HRD', 'Finance', 'Marketing'],
                datasets: [{
                    label: 'Jumlah Ketidakhadiran',
                    data: [8, 5, 6, 4],
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e'
                    ],
                    borderColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Ketidakhadiran'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Departemen'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Ketidakhadiran per Departemen'
                    }
                }
            }
        });

        // Trend Chart
        const ctx4 = document.getElementById('trendChart').getContext('2d');
        trendChart = new Chart(ctx4, {
            type: 'line',
            data: {
                labels: ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Izin',
                    data: [10, 12, 8, 11, 9, 7],
                    borderColor: '#f6c23e',
                    backgroundColor: 'rgba(246, 194, 62, 0.1)',
                    tension: 0.3,
                    fill: true
                }, {
                    label: 'Cuti',
                    data: [6, 8, 5, 7, 10, 8],
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28, 200, 138, 0.1)',
                    tension: 0.3,
                    fill: true
                }, {
                    label: 'Alpha',
                    data: [2, 3, 1, 2, 1, 3],
                    borderColor: '#e74a3b',
                    backgroundColor: 'rgba(231, 74, 59, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Ketidakhadiran'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }

    function updateCharts() {
        // Update approval chart
        const approvedCount = sampleData.filter(item => item.status === 'approved').length;
        const pendingCount = sampleData.filter(item => item.status === 'pending').length;
        const rejectedCount = sampleData.filter(item => item.status === 'rejected').length;

        approvalChart.data.datasets[0].data = [approvedCount, pendingCount, rejectedCount];
        approvalChart.update();
    }

    function setupEventListeners() {
        // Event listener untuk tombol setujui di modal
        document.getElementById('approveBtn').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            processApproval(id, 'approved');
        });

        // Event listener untuk tombol tolak di modal konfirmasi
        document.getElementById('confirmRejectBtn').addEventListener('click', function() {
            const reason = document.getElementById('rejectionReason').value;
            processApproval(currentApprovalId, 'rejected', reason);
        });

        // Event listener untuk dropdown periode
        document.querySelectorAll('.dropdown-menu a[data-period]').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const period = this.getAttribute('data-period');
                updateAbsenceChart(period);
                
                // Update dropdown text
                const dropdownBtn = document.querySelector('.dropdown-toggle');
                const icon = dropdownBtn.querySelector('i').outerHTML;
                let text = '';
                
                switch(period) {
                    case 'weekly':
                        text = 'Mingguan';
                        break;
                    case 'monthly':
                        text = 'Bulanan';
                        break;
                    case 'yearly':
                        text = 'Tahunan';
                        break;
                }
                
                dropdownBtn.innerHTML = `${icon}${text}`;
            });
        });

        // Event listener untuk filter
        document.getElementById('applyFilter').addEventListener('click', function() {
            applyFilters();
        });

        // Event listener untuk reset filter
        document.getElementById('resetFilter').addEventListener('click', function() {
            resetFilters();
        });

        // Event listener untuk export
        document.getElementById('exportPDF').addEventListener('click', function(e) {
            e.preventDefault();
            exportToPDF();
        });

        document.getElementById('exportExcel').addEventListener('click', function(e) {
            e.preventDefault();
            exportToExcel();
        });
    }

    function updateAbsenceChart(period) {
        let data;
        
        switch(period) {
            case 'weekly':
                data = {
                    labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                    datasets: [{
                        label: 'Izin',
                        data: [3, 5, 2, 4],
                        backgroundColor: '#f6c23e',
                        borderColor: '#f6c23e',
                        borderWidth: 1
                    }, {
                        label: 'Cuti',
                        data: [2, 3, 1, 2],
                        backgroundColor: '#1cc88a',
                        borderColor: '#1cc88a',
                        borderWidth: 1
                    }, {
                        label: 'Alpha',
                        data: [1, 2, 0, 1],
                        backgroundColor: '#e74a3b',
                        borderColor: '#e74a3b',
                        borderWidth: 1
                    }]
                };
                break;
                
            case 'monthly':
                data = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Izin',
                        data: [12, 15, 8, 10, 9, 11],
                        backgroundColor: '#f6c23e',
                        borderColor: '#f6c23e',
                        borderWidth: 1
                    }, {
                        label: 'Cuti',
                        data: [8, 6, 10, 7, 9, 5],
                        backgroundColor: '#1cc88a',
                        borderColor: '#1cc88a',
                        borderWidth: 1
                    }, {
                        label: 'Alpha',
                        data: [3, 2, 1, 4, 2, 3],
                        backgroundColor: '#e74a3b',
                        borderColor: '#e74a3b',
                        borderWidth: 1
                    }]
                };
                break;
                
            case 'yearly':
                data = {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    datasets: [{
                        label: 'Izin',
                        data: [110, 125, 98, 115, 65],
                        backgroundColor: '#f6c23e',
                        borderColor: '#f6c23e',
                        borderWidth: 1
                    }, {
                        label: 'Cuti',
                        data: [85, 92, 78, 105, 45],
                        backgroundColor: '#1cc88a',
                        borderColor: '#1cc88a',
                        borderWidth: 1
                    }, {
                        label: 'Alpha',
                        data: [25, 18, 22, 30, 15],
                        backgroundColor: '#e74a3b',
                        borderColor: '#e74a3b',
                        borderWidth: 1
                    }]
                };
                break;
        }
        
        absenceChart.data = data;
        absenceChart.update();
    }

    function applyFilters() {
        showLoading();
        
        setTimeout(() => {
            // Simulasi penerapan filter
            hideLoading();
            showNotification('Filter berhasil diterapkan!', 'success');
        }, 1000);
    }

    function resetFilters() {
        document.getElementById('startDate').value = "{{ date('Y-m-01') }}";
        document.getElementById('endDate').value = "{{ date('Y-m-t') }}";
        document.getElementById('department').value = "";
        document.getElementById('approvalStatus').value = "";
        
        showNotification('Filter berhasil direset!', 'info');
    }

    function exportToPDF() {
        showLoading();
        
        setTimeout(() => {
            hideLoading();
            showNotification('Laporan berhasil diekspor ke PDF!', 'success');
        }, 1500);
    }

    function exportToExcel() {
        showLoading();
        
        setTimeout(() => {
            hideLoading();
            showNotification('Laporan berhasil diekspor ke Excel!', 'success');
        }, 1500);
    }

    function viewDetail(id) {
        const item = sampleData.find(d => d.id === id);
        if (!item) return;
        
        showApprovalModal(id);
    }

    function editData(id) {
        showNotification('Fitur edit data akan segera tersedia!', 'info');
    }

    function showLoading() {
        const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
        loadingModal.show();
    }

    function hideLoading() {
        const loadingModal = bootstrap.Modal.getInstance(document.getElementById('loadingModal'));
        if (loadingModal) loadingModal.hide();
    }

    function showNotification(message, type = 'info') {
        // Buat elemen notifikasi
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Hapus notifikasi setelah 5 detik
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 5000);
    }
</script>
@endpush