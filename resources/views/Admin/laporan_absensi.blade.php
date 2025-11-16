@extends('layout.app')

@section('title', 'Laporan Absensi')

@section('page-title', 'Laporan Absensi Karyawan')

@section('content')
<div class="container-fluid px-4" style="overflow-x: hidden;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">📊 Laporan Absensi</h1>
            <p class="mb-0 text-muted">Analisis dan monitoring data kehadiran karyawan</p>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-download me-2"></i>Export Laporan
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" id="exportFullPDF"><i class="fas fa-file-pdf me-2 text-danger"></i>Download PDF Lengkap</a></li>
                <li><a class="dropdown-item" href="#" id="exportTablePDF"><i class="fas fa-file-pdf me-2 text-danger"></i>Download PDF Tabel</a></li>
                <li><a class="dropdown-item" href="#" id="exportFullExcel"><i class="fas fa-file-excel me-2 text-success"></i>Download Excel Lengkap</a></li>
                <li><a class="dropdown-item" href="#" id="exportTableExcel"><i class="fas fa-file-excel me-2 text-success"></i>Download Excel Tabel</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" id="printReport"><i class="fas fa-print me-2"></i>Print Laporan</a></li>
            </ul>
            <a href="/attendance" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Absensi
            </a>
        </div>
    </div>

    <!-- Container untuk Export -->
    <div id="exportContainer">
        <!-- Header Laporan untuk Export -->
        <div id="reportHeader" class="text-center mb-4 d-none">
            <h2 class="mb-1">LAPORAN ABSENSI KARYAWAN</h2>
            <p class="mb-1">Periode: <span id="exportPeriod">{{ date('d F Y', strtotime(date('Y-m-01'))) }} - {{ date('d F Y', strtotime(date('Y-m-t'))) }}</span></p>
            <p class="mb-0">Dibuat pada: {{ date('d/m/Y H:i:s') }}</p>
            <hr class="my-3">
        </div>

        <!-- Info Panel -->
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Laporan Analitik Absensi</strong> - Halaman ini khusus untuk melihat dan menganalisis data kehadiran karyawan dengan berbagai filter dan opsi export.
        </div>

        <!-- Statistik Cards -->
        <div class="row mb-4" id="statsSection">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Hadir</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalHadir">156</div>
                                <div class="text-xs text-muted mt-1">Dari 175 karyawan</div>
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
                                    Terlambat</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalTerlambat">24</div>
                                <div class="text-xs text-muted mt-1">13.7% dari total</div>
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
                                    Tidak Hadir</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalAbsen">15</div>
                                <div class="text-xs text-muted mt-1">8.6% dari total</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-times fa-2x text-gray-300"></i>
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
                                    Kehadiran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="persentaseHadir">89.1%</div>
                                <div class="text-xs text-muted mt-1">Rata-rata kehadiran</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-percent fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-filter me-2"></i>Filter Laporan Absensi</h6>
                <div>
                    <button class="btn btn-sm btn-light me-2" type="button" id="resetFilter">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button>
                    <button class="btn btn-sm btn-warning" type="button" id="applyFilter">
                        <i class="fas fa-search me-1"></i>Terapkan
                    </button>
                </div>
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
                            <option value="IT">IT & Technology</option>
                            <option value="HR">Human Resources</option>
                            <option value="Finance">Finance & Accounting</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Operations">Operations</option>
                            <option value="Sales">Sales</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Status Kehadiran</label>
                        <select class="form-select" id="status">
                            <option value="">Semua Status</option>
                            <option value="hadir">Hadir</option>
                            <option value="terlambat">Terlambat</option>
                            <option value="tidak_hadir">Tidak Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="cuti">Cuti</option>
                            <option value="sakit">Sakit</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Lokasi Kerja</label>
                        <select class="form-select" id="location">
                            <option value="">Semua Lokasi</option>
                            <option value="kantor_pusat">Kantor Pusat</option>
                            <option value="kantor_cabang">Kantor Cabang</option>
                            <option value="remote">Remote/WFH</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Shift Kerja</label>
                        <select class="form-select" id="shift">
                            <option value="">Semua Shift</option>
                            <option value="pagi">Shift Pagi</option>
                            <option value="siang">Shift Siang</option>
                            <option value="malam">Shift Malam</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Sort By</label>
                        <select class="form-select" id="sortBy">
                            <option value="tanggal_desc">Tanggal (Terbaru)</option>
                            <option value="tanggal_asc">Tanggal (Terlama)</option>
                            <option value="nama_asc">Nama (A-Z)</option>
                            <option value="nama_desc">Nama (Z-A)</option>
                            <option value="departemen_asc">Departemen</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Analytics -->
        <div class="row mb-4">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-line me-2"></i>Trend Kehadiran Bulanan
                        </h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-calendar me-1"></i>{{ date('F Y') }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Januari 2024</a></li>
                                <li><a class="dropdown-item" href="#">Februari 2024</a></li>
                                <li><a class="dropdown-item" href="#">Maret 2024</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Custom Range</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="attendanceTrendChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-pie me-2"></i>Distribusi Status Kehadiran
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="attendanceDistributionChart" height="250"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="me-3">
                                <i class="fas fa-circle text-success"></i> Hadir
                            </span>
                            <span class="me-3">
                                <i class="fas fa-circle text-warning"></i> Terlambat
                            </span>
                            <span class="me-3">
                                <i class="fas fa-circle text-danger"></i> Tidak Hadir
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
                        <h6 class="m-0 font-weight-bold text-primary">Distribusi Kehadiran per Departemen</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="departmentAttendanceChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Perbandingan Shift Kerja</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="shiftComparisonChart" height="250"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Pagi
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Siang
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Malam
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-table me-2"></i>Data Rekap Absensi
                    <span class="badge bg-secondary ms-2" id="totalRecords">175 records</span>
                </h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-cog me-1"></i>Opsi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="exportTableOnlyPDF"><i class="fas fa-file-pdf me-2 text-danger"></i>Export PDF Tabel</a></li>
                        <li><a class="dropdown-item" href="#" id="exportTableOnlyExcel"><i class="fas fa-file-excel me-2 text-success"></i>Export Excel Tabel</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" id="printTable"><i class="fas fa-print me-2"></i>Print Tabel</a></li>
                        <li><a class="dropdown-item" href="#" id="refreshData"><i class="fas fa-sync me-2"></i>Refresh Data</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="attendanceReportTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Nama Karyawan</th>
                                <th width="12%">Departemen</th>
                                <th width="10%">Tanggal</th>
                                <th width="10%">Shift</th>
                                <th width="10%">Jam Masuk</th>
                                <th width="10%">Jam Keluar</th>
                                <th width="10%">Durasi</th>
                                <th width="10%">Status</th>
                                <th width="8%">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 15; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><strong>Karyawan {{ $i }}</strong></td>
                                <td>
                                    @if($i % 5 == 0) IT
                                    @elseif($i % 5 == 1) HR
                                    @elseif($i % 5 == 2) Finance
                                    @elseif($i % 5 == 3) Marketing
                                    @else Operations @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime("-$i days")) }}</td>
                                <td>
                                    @if($i % 3 == 0) <span class="badge bg-primary">Pagi</span>
                                    @elseif($i % 3 == 1) <span class="badge bg-success">Siang</span>
                                    @else <span class="badge bg-warning text-dark">Malam</span> @endif
                                </td>
                                <td>
                                    @if($i % 7 != 0)
                                        {{ $i % 2 == 0 ? '08:0'.($i % 5) : '07:5'.($i % 5) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($i % 7 != 0)
                                        {{ $i % 2 == 0 ? '16:0'.($i % 5) : '17:3'.($i % 5) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($i % 7 != 0)
                                        {{ $i % 2 == 0 ? '8j 0m' : '9j 3'.($i % 5).'m' }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($i % 10 == 0)
                                        <span class="badge bg-danger">Tidak Hadir</span>
                                    @elseif($i % 7 == 0)
                                        <span class="badge bg-warning text-dark">Terlambat</span>
                                    @else
                                        <span class="badge bg-success">Hadir</span>
                                    @endif
                                </td>
                                <td>
                                    @if($i % 4 == 0) <span class="badge bg-info">Remote</span>
                                    @else <span class="badge bg-secondary">Kantor</span> @endif
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Summary & Insights -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-success text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-chart-bar me-2"></i>Ringkasan Laporan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-2"><strong>Periode Analisis</strong></p>
                                <p class="mb-2"><strong>Total Karyawan</strong></p>
                                <p class="mb-2"><strong>Rata-rata Kehadiran</strong></p>
                                <p class="mb-2"><strong>Karyawan Terlambat Terbanyak</strong></p>
                                <p class="mb-2"><strong>Departemen Terbaik</strong></p>
                                <p class="mb-0"><strong>Rekomendasi</strong></p>
                            </div>
                            <div class="col-6">
                                <p class="mb-2">: {{ date('d M Y', strtotime(date('Y-m-01'))) }} - {{ date('d M Y', strtotime(date('Y-m-t'))) }}</p>
                                <p class="mb-2">: 175 karyawan</p>
                                <p class="mb-2">: 89.1%</p>
                                <p class="mb-2">: Karyawan 7 (5x terlambat)</p>
                                <p class="mb-2">: IT Department (95%)</p>
                                <p class="mb-0 text-success">: Performa baik, pertahankan!</p>
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
    /* Menghilangkan scroll vertikal di body */
    body {
        overflow-x: hidden;
        overflow-y: auto;
    }

    /* Menghilangkan scroll horizontal di container utama */
    .container-fluid {
        overflow-x: hidden;
        max-width: 100%;
    }

    /* Memastikan table responsive tanpa scroll vertikal yang tidak perlu */
    .table-responsive {
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

    /* Menghilangkan scroll di card body */
    .card-body {
        overflow: visible;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
    }

    .card-header {
        border-bottom: 1px solid #e3e6f0;
        background-color: #f8f9fc;
        border-radius: 12px 12px 0 0 !important;
    }

    .table th {
        background-color: #f8f9fc;
        font-weight: 700;
        color: #4e73df;
        border-bottom: 2px solid #e3e6f0;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(78, 115, 223, 0.05);
    }

    .border-left-primary { border-left: 0.25rem solid #4e73df !important; }
    .border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
    .border-left-danger { border-left: 0.25rem solid #e74a3b !important; }
    .border-left-success { border-left: 0.25rem solid #1cc88a !important; }
    .border-left-info { border-left: 0.25rem solid #36b9cc !important; }

    .text-xs {
        font-size: 0.7rem;
    }

    .chart-bar, .chart-pie {
        position: relative;
        height: 100%;
    }

    .badge {
        font-size: 0.75em;
        font-weight: 600;
        padding: 0.35em 0.65em;
    }

    /* Print Styles */
    @media print {
        .btn-group, .dropdown, .card-header .dropdown,
        .alert, .pagination, .bg-primary {
            display: none !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            margin-bottom: 1rem;
        }

        .table {
            font-size: 11px;
        }

        #reportHeader {
            display: block !important;
        }
    }

    /* Loading Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card {
        animation: fadeIn 0.5s ease-out;
    }

    /* Menghilangkan scrollbar yang tidak perlu */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ==================== INISIALISASI GRAFIK ====================

        // Trend Chart - Line Chart
        const trendCtx = document.getElementById('attendanceTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'],
                datasets: [{
                    label: 'Hadir',
                    data: [45, 47, 48, 46, 49, 48, 47, 46, 48, 49, 47, 48, 46, 47, 48],
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderColor: '#28a745',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Terlambat',
                    data: [2, 3, 1, 2, 1, 3, 2, 1, 2, 1, 3, 2, 1, 2, 1],
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
                    borderColor: '#ffc107',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Trend Kehadiran Harian'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Karyawan'
                        }
                    }
                }
            }
        });

        // Distribution Chart - Doughnut
        const distCtx = document.getElementById('attendanceDistributionChart').getContext('2d');
        new Chart(distCtx, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Terlambat', 'Tidak Hadir', 'Izin', 'Cuti'],
                datasets: [{
                    data: [156, 24, 15, 8, 12],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d'],
                    hoverBackgroundColor: ['#218838', '#e0a800', '#c82333', '#138496', '#5a6268'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '60%',
            },
        });

        // Department Attendance Chart - Bar Chart
        const deptCtx = document.getElementById('departmentAttendanceChart').getContext('2d');
        new Chart(deptCtx, {
            type: 'bar',
            data: {
                labels: ['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales'],
                datasets: [{
                    label: 'Hadir',
                    data: [48, 42, 38, 45, 40, 43],
                    backgroundColor: '#28a745',
                    borderColor: '#28a745',
                    borderWidth: 1
                }, {
                    label: 'Terlambat',
                    data: [2, 5, 3, 4, 6, 4],
                    backgroundColor: '#ffc107',
                    borderColor: '#ffc107',
                    borderWidth: 1
                }, {
                    label: 'Tidak Hadir',
                    data: [1, 3, 4, 2, 5, 3],
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
        });

        // Shift Comparison Chart - Pie Chart
        const shiftCtx = document.getElementById('shiftComparisonChart').getContext('2d');
        new Chart(shiftCtx, {
            type: 'pie',
            data: {
                labels: ['Shift Pagi', 'Shift Siang', 'Shift Malam'],
                datasets: [{
                    data: [65, 45, 30],
                    backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#dda20a'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
        });

        // ==================== FITUR EXPORT PDF ====================

        // Export Full Report PDF
        document.getElementById('exportFullPDF').addEventListener('click', function() {
            const element = document.getElementById('exportContainer');
            const reportHeader = document.getElementById('reportHeader');
            const exportPeriod = document.getElementById('exportPeriod');

            // Update period for export
            exportPeriod.textContent = `${document.getElementById('startDate').value} s/d ${document.getElementById('endDate').value}`;

            // Show header for export
            reportHeader.classList.remove('d-none');

            const opt = {
                margin: [0.5, 0.5, 0.5, 0.5],
                filename: `Laporan_Absensi_Lengkap_${getCurrentDate()}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    logging: false
                },
                jsPDF: {
                    unit: 'cm',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                reportHeader.classList.add('d-none');
            });
        });

        // Export Table Only PDF
        document.getElementById('exportTablePDF').addEventListener('click', function() {
            const element = document.getElementById('attendanceReportTable');
            const reportHeader = document.getElementById('reportHeader');
            const exportPeriod = document.getElementById('exportPeriod');

            exportPeriod.textContent = `${document.getElementById('startDate').value} s/d ${document.getElementById('endDate').value}`;
            reportHeader.classList.remove('d-none');

            const opt = {
                margin: [0.5, 0.5, 0.5, 0.5],
                filename: `Laporan_Absensi_Tabel_${getCurrentDate()}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'cm', format: 'a4', orientation: 'landscape' }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                reportHeader.classList.add('d-none');
            });
        });

        // Export dari dropdown tabel
        document.getElementById('exportTableOnlyPDF').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('exportTablePDF').click();
        });

        // ==================== FITUR EXPORT EXCEL ====================

        // Export Full Data Excel
        document.getElementById('exportFullExcel').addEventListener('click', function() {
            const data = [
                ['LAPORAN ABSENSI KARYAWAN - LENGKAP'],
                ['Periode', `${document.getElementById('startDate').value} s/d ${document.getElementById('endDate').value}`],
                ['Dibuat pada', new Date().toLocaleString('id-ID')],
                ['Total Karyawan', '175'],
                ['Total Hadir', '156 (89.1%)'],
                ['Total Terlambat', '24 (13.7%)'],
                ['Total Tidak Hadir', '15 (8.6%)'],
                [''],
                ['DATA REKAP ABSENSI']
            ];

            // Header tabel
            const table = document.getElementById('attendanceReportTable');
            const headers = [];
            table.querySelectorAll('thead th').forEach(th => {
                headers.push(th.textContent.trim());
            });
            data.push(headers);

            // Data tabel
            table.querySelectorAll('tbody tr').forEach(tr => {
                const row = [];
                tr.querySelectorAll('td').forEach(td => {
                    row.push(td.textContent.trim());
                });
                data.push(row);
            });

            // Buat workbook
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);

            // Styling kolom
            ws['!cols'] = [
                { wch: 5 }, { wch: 20 }, { wch: 15 }, { wch: 12 },
                { wch: 10 }, { wch: 10 }, { wch: 10 }, { wch: 10 },
                { wch: 12 }, { wch: 10 }
            ];

            XLSX.utils.book_append_sheet(wb, ws, "Laporan Absensi");
            XLSX.writeFile(wb, `Laporan_Absensi_Lengkap_${getCurrentDate()}.xlsx`);
        });

        // Export Table Only Excel
        document.getElementById('exportTableExcel').addEventListener('click', function() {
            const table = document.getElementById('attendanceReportTable');
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Data Absensi",
                raw: true
            });

            XLSX.writeFile(wb, `Laporan_Absensi_Tabel_${getCurrentDate()}.xlsx`);
        });

        // Export dari dropdown tabel
        document.getElementById('exportTableOnlyExcel').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('exportTableExcel').click();
        });

        // ==================== FITUR LAINNYA ====================

        // Print Report
        document.getElementById('printReport').addEventListener('click', function() {
            window.print();
        });

        // Print Table
        document.getElementById('printTable').addEventListener('click', function(e) {
            e.preventDefault();
            const printWindow = window.open('', '_blank');
            const tableContent = document.getElementById('attendanceReportTable').outerHTML;

            printWindow.document.write(`
                <html>
                    <head>
                        <title>Print Tabel Absensi</title>
                        <style>
                            body { font-family: Arial, sans-serif; }
                            table { width: 100%; border-collapse: collapse; }
                            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            th { background-color: #f8f9fa; }
                            @media print {
                                body { margin: 0; }
                                table { font-size: 12px; }
                            }
                        </style>
                    </head>
                    <body>
                        <h2>Laporan Absensi - Tabel Data</h2>
                        <p>Periode: ${document.getElementById('startDate').value} s/d ${document.getElementById('endDate').value}</p>
                        ${tableContent}
                        <script>
                            window.onload = function() { window.print(); }
                        <\/script>
                    </body>
                </html>
            `);
        });

        // Refresh Data
        document.getElementById('refreshData').addEventListener('click', function(e) {
            e.preventDefault();
            showLoading();
            setTimeout(() => {
                alert('Data berhasil diperbarui!');
                hideLoading();
            }, 1000);
        });

        // Filter functionality
        document.getElementById('applyFilter').addEventListener('click', function() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const department = document.getElementById('department').value;
            const status = document.getElementById('status').value;
            const location = document.getElementById('location').value;
            const shift = document.getElementById('shift').value;

            showLoading();

            // Simulate API call
            setTimeout(() => {
                updateStatistics();
                alert(`Filter diterapkan!\nPeriode: ${startDate} - ${endDate}\nDepartemen: ${department || 'Semua'}\nStatus: ${status || 'Semua'}\nLokasi: ${location || 'Semua'}\nShift: ${shift || 'Semua'}`);
                hideLoading();
            }, 1500);
        });

        // Reset filter
        document.getElementById('resetFilter').addEventListener('click', function() {
            document.getElementById('startDate').value = '{{ date("Y-m-01") }}';
            document.getElementById('endDate').value = '{{ date("Y-m-t") }}';
            document.getElementById('department').value = '';
            document.getElementById('status').value = '';
            document.getElementById('location').value = '';
            document.getElementById('shift').value = '';
            document.getElementById('sortBy').value = 'tanggal_desc';

            alert('Filter telah direset ke default');
        });

        // Helper functions
        function getCurrentDate() {
            return new Date().toISOString().split('T')[0];
        }

        function showLoading() {
            // Implement loading indicator
            console.log('Loading...');
        }

        function hideLoading() {
            // Hide loading indicator
            console.log('Loading complete');
        }

        function updateStatistics() {
            // Simulate statistics update based on filters
            const totalHadir = Math.floor(Math.random() * 50) + 150;
            const totalTerlambat = Math.floor(Math.random() * 10) + 20;
            const totalAbsen = Math.floor(Math.random() * 8) + 10;
            const persentase = ((totalHadir / 175) * 100).toFixed(1);

            document.getElementById('totalHadir').textContent = totalHadir;
            document.getElementById('totalTerlambat').textContent = totalTerlambat;
            document.getElementById('totalAbsen').textContent = totalAbsen;
            document.getElementById('persentaseHadir').textContent = persentase + '%';
        }

        // Menghilangkan scroll vertikal yang tidak perlu
        document.body.style.overflowY = 'auto';
        document.documentElement.style.overflowY = 'auto';
    });
</script>
@endpush
