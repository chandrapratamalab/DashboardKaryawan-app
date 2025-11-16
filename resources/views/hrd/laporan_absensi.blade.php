@extends('layout.apphrd')

@section('title', 'Laporan Absensi')

@section('page-title', 'Laporan Absensi Karyawan')

@section('content')
<div class="container-fluid px-4">
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
                                <li><a class="dropdown-item" href="#" data-period="january">Januari 2024</a></li>
                                <li><a class="dropdown-item" href="#" data-period="february">Februari 2024</a></li>
                                <li><a class="dropdown-item" href="#" data-period="march">Maret 2024</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" data-period="custom">Custom Range</a></li>
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
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-bar me-2"></i>Kehadiran per Departemen
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="departmentAttendanceChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-area me-2"></i>Keterlambatan per Jam
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="lateHoursChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- More Charts -->
        <div class="row mb-4">
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-calendar-alt me-2"></i>Kehadiran per Hari
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="dailyAttendanceChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-user-clock me-2"></i>Durasi Kerja Rata-rata
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="workingHoursChart" height="300"></canvas>
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
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-success text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-chart-bar me-2"></i>Ringkasan Laporan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-2"><strong>Periode Analisis:</strong></p>
                                <p class="mb-2"><strong>Total Karyawan:</strong></p>
                                <p class="mb-2"><strong>Rata-rata Kehadiran:</strong></p>
                                <p class="mb-2"><strong>Karyawan Terlambat Terbanyak:</strong></p>
                                <p class="mb-2"><strong>Departemen Terbaik:</strong></p>
                                <p class="mb-0"><strong>Rekomendasi:</strong></p>
                            </div>
                            <div class="col-6">
                                <p class="mb-2">{{ date('d M Y', strtotime(date('Y-m-01'))) }} - {{ date('d M Y', strtotime(date('Y-m-t'))) }}</p>
                                <p class="mb-2">175 karyawan</p>
                                <p class="mb-2">89.1%</p>
                                <p class="mb-2">Karyawan 7 (5x terlambat)</p>
                                <p class="mb-2">IT Department (95%)</p>
                                <p class="mb-0 text-success">Performa baik, pertahankan!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-info text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-lightbulb me-2"></i>Insights & Analytics
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong> Terdapat peningkatan keterlambatan sebesar 15% dibanding bulan sebelumnya.
                        </div>
                        <div class="alert alert-success">
                            <i class="fas fa-trophy me-2"></i>
                            <strong>Pencapaian:</strong> Departemen IT memiliki tingkat kehadiran tertinggi (95%).
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-chart-line me-2"></i>
                            <strong>Trend:</strong> Kehadiran meningkat 3% dibanding bulan lalu.
                        </div>
                    </div>
                </div>
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
    
    .chart-bar, .chart-pie, .chart-line {
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

    .chart-container {
        position: relative;
        margin: auto;
        height: 300px;
        width: 100%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    let attendanceTrendChart, attendanceDistributionChart, departmentAttendanceChart, lateHoursChart, dailyAttendanceChart, workingHoursChart;

    document.addEventListener('DOMContentLoaded', function() {
        initializeCharts();
        setupEventListeners();
    });

    function initializeCharts() {
        // Trend Chart - Line Chart
        const trendCtx = document.getElementById('attendanceTrendChart').getContext('2d');
        attendanceTrendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'],
                datasets: [{
                    label: 'Hadir',
                    data: [45, 47, 48, 46, 49, 48, 47, 46, 48, 49, 47, 48, 46, 47, 48],
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderColor: '#28a745',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#28a745',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }, {
                    label: 'Terlambat',
                    data: [2, 3, 1, 2, 1, 3, 2, 1, 2, 1, 3, 2, 1, 2, 1],
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
                    borderColor: '#ffc107',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffc107',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }, {
                    label: 'Tidak Hadir',
                    data: [3, 2, 1, 2, 0, 1, 2, 3, 0, 1, 2, 0, 3, 1, 1],
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    borderColor: '#dc3545',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#dc3545',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Trend Kehadiran Harian - 15 Hari Terakhir',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Karyawan',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Distribution Chart - Doughnut
        const distCtx = document.getElementById('attendanceDistributionChart').getContext('2d');
        attendanceDistributionChart = new Chart(distCtx, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Terlambat', 'Tidak Hadir', 'Izin', 'Cuti', 'Sakit'],
                datasets: [{
                    data: [156, 24, 15, 8, 12, 5],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107', 
                        '#dc3545',
                        '#17a2b8',
                        '#6c757d',
                        '#fd7e14'
                    ],
                    hoverBackgroundColor: [
                        '#218838',
                        '#e0a800',
                        '#c82333',
                        '#138496',
                        '#5a6268',
                        '#e56a0c'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverBorderWidth: 4
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
                                return `${label}: ${value} karyawan (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '65%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            },
        });

        // Department Attendance Chart - Bar Chart
        const deptCtx = document.getElementById('departmentAttendanceChart').getContext('2d');
        departmentAttendanceChart = new Chart(deptCtx, {
            type: 'bar',
            data: {
                labels: ['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales'],
                datasets: [{
                    label: 'Tingkat Kehadiran (%)',
                    data: [95, 88, 92, 85, 90, 87],
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.8)',
                        'rgba(54, 185, 204, 0.8)',
                        'rgba(28, 200, 138, 0.8)',
                        'rgba(246, 194, 62, 0.8)',
                        'rgba(231, 74, 59, 0.8)',
                        'rgba(133, 135, 150, 0.8)'
                    ],
                    borderColor: [
                        '#4e73df',
                        '#36b9cc',
                        '#1cc88a',
                        '#f6c23e',
                        '#e74a3b',
                        '#858796'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Tingkat Kehadiran per Departemen',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Kehadiran: ${context.raw}%`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Persentase Kehadiran (%)',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Departemen',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Late Hours Chart - Bar Chart
        const lateCtx = document.getElementById('lateHoursChart').getContext('2d');
        lateHoursChart = new Chart(lateCtx, {
            type: 'bar',
            data: {
                labels: ['07:00-08:00', '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00'],
                datasets: [{
                    label: 'Jumlah Keterlambatan',
                    data: [45, 28, 12, 5, 2],
                    backgroundColor: 'rgba(255, 193, 7, 0.8)',
                    borderColor: '#ffc107',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribusi Keterlambatan per Jam',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Keterlambatan',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Rentang Waktu',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Daily Attendance Chart - Bar Chart
        const dailyCtx = document.getElementById('dailyAttendanceChart').getContext('2d');
        dailyAttendanceChart = new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                datasets: [{
                    label: 'Rata-rata Kehadiran (%)',
                    data: [92, 94, 91, 93, 88, 75],
                    backgroundColor: 'rgba(40, 167, 69, 0.8)',
                    borderColor: '#28a745',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Rata-rata Kehadiran per Hari',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Kehadiran: ${context.raw}%`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Persentase Kehadiran (%)',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Hari',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Working Hours Chart - Bar Chart
        const hoursCtx = document.getElementById('workingHoursChart').getContext('2d');
        workingHoursChart = new Chart(hoursCtx, {
            type: 'bar',
            data: {
                labels: ['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales'],
                datasets: [{
                    label: 'Rata-rata Jam Kerja per Hari',
                    data: [8.5, 8.2, 8.7, 8.1, 8.9, 8.3],
                    backgroundColor: 'rgba(54, 185, 204, 0.8)',
                    borderColor: '#36b9cc',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Durasi Kerja Rata-rata per Departemen',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Rata-rata: ${context.raw} jam/hari`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jam Kerja per Hari',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Departemen',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    function setupEventListeners() {
        // Event listener untuk dropdown periode
        document.querySelectorAll('.dropdown-menu a[data-period]').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const period = this.getAttribute('data-period');
                updateChartsByPeriod(period);
                
                // Update dropdown text
                const dropdownBtn = document.querySelector('.dropdown-toggle');
                const icon = dropdownBtn.querySelector('i').outerHTML;
                let text = '';
                
                switch(period) {
                    case 'january':
                        text = 'Januari 2024';
                        break;
                    case 'february':
                        text = 'Februari 2024';
                        break;
                    case 'march':
                        text = 'Maret 2024';
                        break;
                    case 'custom':
                        text = 'Custom Range';
                        break;
                    default:
                        text = '{{ date("F Y") }}';
                }
                
                dropdownBtn.innerHTML = `${icon}${text}`;
            });
        });

        // Export PDF Functions
        document.getElementById('exportFullPDF').addEventListener('click', function(e) {
            e.preventDefault();
            exportToPDF('full');
        });

        document.getElementById('exportTablePDF').addEventListener('click', function(e) {
            e.preventDefault();
            exportToPDF('table');
        });

        document.getElementById('exportTableOnlyPDF').addEventListener('click', function(e) {
            e.preventDefault();
            exportToPDF('table');
        });

        // Export Excel Functions
        document.getElementById('exportFullExcel').addEventListener('click', function(e) {
            e.preventDefault();
            exportToExcel('full');
        });

        document.getElementById('exportTableExcel').addEventListener('click', function(e) {
            e.preventDefault();
            exportToExcel('table');
        });

        document.getElementById('exportTableOnlyExcel').addEventListener('click', function(e) {
            e.preventDefault();
            exportToExcel('table');
        });

        // Print Functions
        document.getElementById('printReport').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('printTable').addEventListener('click', function(e) {
            e.preventDefault();
            printTable();
        });

        // Refresh Data
        document.getElementById('refreshData').addEventListener('click', function(e) {
            e.preventDefault();
            refreshData();
        });

        // Filter functionality
        document.getElementById('applyFilter').addEventListener('click', function() {
            applyFilters();
        });

        // Reset filter
        document.getElementById('resetFilter').addEventListener('click', function() {
            resetFilters();
        });
    }

    function updateChartsByPeriod(period) {
        showLoading();
        
        // Simulate data update based on period
        setTimeout(() => {
            let trendData, distributionData, deptData;
            
            switch(period) {
                case 'january':
                    trendData = {
                        hadir: [42, 44, 45, 43, 46, 45, 44, 43, 45, 46, 44, 45, 43, 44, 45],
                        terlambat: [3, 4, 2, 3, 2, 4, 3, 2, 3, 2, 4, 3, 2, 3, 2],
                        tidakHadir: [5, 4, 3, 4, 2, 3, 4, 5, 2, 3, 4, 2, 5, 3, 3]
                    };
                    distributionData = [142, 34, 18, 12, 15, 8];
                    deptData = [92, 85, 89, 82, 87, 84];
                    break;
                    
                case 'february':
                    trendData = {
                        hadir: [44, 46, 47, 45, 48, 47, 46, 45, 47, 48, 46, 47, 45, 46, 47],
                        terlambat: [2, 3, 1, 2, 1, 3, 2, 1, 2, 1, 3, 2, 1, 2, 1],
                        tidakHadir: [4, 3, 2, 3, 1, 2, 3, 4, 1, 2, 3, 1, 4, 2, 2]
                    };
                    distributionData = [152, 28, 12, 10, 13, 6];
                    deptData = [94, 87, 91, 84, 89, 86];
                    break;
                    
                case 'march':
                    trendData = {
                        hadir: [45, 47, 48, 46, 49, 48, 47, 46, 48, 49, 47, 48, 46, 47, 48],
                        terlambat: [2, 3, 1, 2, 1, 3, 2, 1, 2, 1, 3, 2, 1, 2, 1],
                        tidakHadir: [3, 2, 1, 2, 0, 1, 2, 3, 0, 1, 2, 0, 3, 1, 1]
                    };
                    distributionData = [156, 24, 15, 8, 12, 5];
                    deptData = [95, 88, 92, 85, 90, 87];
                    break;
                    
                default:
                    // Current month data (already set)
                    return;
            }
            
            // Update trend chart
            attendanceTrendChart.data.datasets[0].data = trendData.hadir;
            attendanceTrendChart.data.datasets[1].data = trendData.terlambat;
            attendanceTrendChart.data.datasets[2].data = trendData.tidakHadir;
            attendanceTrendChart.update();
            
            // Update distribution chart
            attendanceDistributionChart.data.datasets[0].data = distributionData;
            attendanceDistributionChart.update();
            
            // Update department chart
            departmentAttendanceChart.data.datasets[0].data = deptData;
            departmentAttendanceChart.update();
            
            hideLoading();
            showNotification(`Data untuk periode ${period} berhasil dimuat`, 'success');
        }, 1500);
    }

    function exportToPDF(type) {
        showLoading();
        
        setTimeout(() => {
            const element = type === 'full' ? document.getElementById('exportContainer') : document.getElementById('attendanceReportTable');
            const reportHeader = document.getElementById('reportHeader');
            const exportPeriod = document.getElementById('exportPeriod');
            
            exportPeriod.textContent = `${document.getElementById('startDate').value} s/d ${document.getElementById('endDate').value}`;
            reportHeader.classList.remove('d-none');
            
            const opt = {
                margin: [0.5, 0.5, 0.5, 0.5],
                filename: type === 'full' ? `Laporan_Absensi_Lengkap_${getCurrentDate()}.pdf` : `Laporan_Absensi_Tabel_${getCurrentDate()}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { 
                    scale: 2,
                    useCORS: true,
                    logging: false
                },
                jsPDF: { 
                    unit: 'cm', 
                    format: 'a4', 
                    orientation: type === 'full' ? 'portrait' : 'landscape'
                },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };
            
            html2pdf().set(opt).from(element).save().then(() => {
                reportHeader.classList.add('d-none');
                hideLoading();
                showNotification('Laporan berhasil diekspor ke PDF!', 'success');
            });
        }, 1000);
    }

    function exportToExcel(type) {
        showLoading();
        
        setTimeout(() => {
            let data = [];
            
            if (type === 'full') {
                data = [
                    ['LAPORAN ABSENSI KARYAWAN - LENGKAP'],
                    ['Periode', `${document.getElementById('startDate').value} s/d ${document.getElementById('endDate').value}`],
                    ['Dibuat pada', new Date().toLocaleString('id-ID')],
                    [''],
                    ['STATISTIK UTAMA'],
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
            } else {
                // Table only
                const table = document.getElementById('attendanceReportTable');
                data = XLSX.utils.table_to_sheet(table);
            }
            
            // Buat workbook
            const wb = XLSX.utils.book_new();
            const ws = type === 'full' ? XLSX.utils.aoa_to_sheet(data) : data;
            
            if (type === 'full') {
                // Styling kolom untuk full report
                ws['!cols'] = [
                    { wch: 5 }, { wch: 20 }, { wch: 15 }, { wch: 12 }, 
                    { wch: 10 }, { wch: 10 }, { wch: 10 }, { wch: 10 }, 
                    { wch: 12 }, { wch: 10 }
                ];
            }

            XLSX.utils.book_append_sheet(wb, ws, type === 'full' ? "Laporan Absensi" : "Data Absensi");
            XLSX.writeFile(wb, type === 'full' ? `Laporan_Absensi_Lengkap_${getCurrentDate()}.xlsx` : `Laporan_Absensi_Tabel_${getCurrentDate()}.xlsx`);
            
            hideLoading();
            showNotification('Laporan berhasil diekspor ke Excel!', 'success');
        }, 1000);
    }

    function printTable() {
        const printWindow = window.open('', '_blank');
        const tableContent = document.getElementById('attendanceReportTable').outerHTML;
        
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Tabel Absensi</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f8f9fa; font-weight: bold; }
                        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
                        .bg-success { background-color: #28a745; color: white; }
                        .bg-warning { background-color: #ffc107; color: black; }
                        .bg-danger { background-color: #dc3545; color: white; }
                        .bg-primary { background-color: #007bff; color: white; }
                        .bg-info { background-color: #17a2b8; color: white; }
                        .bg-secondary { background-color: #6c757d; color: white; }
                        @media print { 
                            body { margin: 0; } 
                            table { font-size: 12px; }
                        }
                    </style>
                </head>
                <body>
                    <h2>Laporan Absensi - Tabel Data</h2>
                    <p><strong>Periode:</strong> ${document.getElementById('startDate').value} s/d ${document.getElementById('endDate').value}</p>
                    <p><strong>Dibuat pada:</strong> ${new Date().toLocaleString('id-ID')}</p>
                    ${tableContent}
                    <script>
                        window.onload = function() { window.print(); }
                    <\/script>
                </body>
            </html>
        `);
    }

    function refreshData() {
        showLoading();
        setTimeout(() => {
            updateStatistics();
            hideLoading();
            showNotification('Data berhasil diperbarui!', 'success');
        }, 1500);
    }

    function applyFilters() {
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
            updateChartsByFilter();
            hideLoading();
            showNotification(
                `Filter diterapkan!\nPeriode: ${startDate} - ${endDate}\nDepartemen: ${department || 'Semua'}\nStatus: ${status || 'Semua'}\nLokasi: ${location || 'Semua'}\nShift: ${shift || 'Semua'}`,
                'success'
            );
        }, 1500);
    }

    function resetFilters() {
        document.getElementById('startDate').value = '{{ date("Y-m-01") }}';
        document.getElementById('endDate').value = '{{ date("Y-m-t") }}';
        document.getElementById('department').value = '';
        document.getElementById('status').value = '';
        document.getElementById('location').value = '';
        document.getElementById('shift').value = '';
        document.getElementById('sortBy').value = 'tanggal_desc';
        
        showNotification('Filter telah direset ke default', 'info');
    }

    function updateChartsByFilter() {
        // Simulate chart updates based on filters
        const randomFactor = Math.random() * 0.2 + 0.9; // Random factor between 0.9 and 1.1
        
        // Update trend chart with slight variations
        attendanceTrendChart.data.datasets.forEach(dataset => {
            dataset.data = dataset.data.map(value => Math.round(value * randomFactor));
        });
        attendanceTrendChart.update();
        
        // Update other charts similarly
        const newDeptData = departmentAttendanceChart.data.datasets[0].data.map(
            value => Math.min(100, Math.round(value * randomFactor))
        );
        departmentAttendanceChart.data.datasets[0].data = newDeptData;
        departmentAttendanceChart.update();
    }

    function updateStatistics() {
        // Simulate statistics update based on filters
        const totalHadir = Math.floor(Math.random() * 20) + 150;
        const totalTerlambat = Math.floor(Math.random() * 8) + 20;
        const totalAbsen = Math.floor(Math.random() * 6) + 10;
        const persentase = ((totalHadir / 175) * 100).toFixed(1);
        
        document.getElementById('totalHadir').textContent = totalHadir;
        document.getElementById('totalTerlambat').textContent = totalTerlambat;
        document.getElementById('totalAbsen').textContent = totalAbsen;
        document.getElementById('persentaseHadir').textContent = persentase + '%';
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

    function getCurrentDate() {
        return new Date().toISOString().split('T')[0];
    }
</script>
@endpush