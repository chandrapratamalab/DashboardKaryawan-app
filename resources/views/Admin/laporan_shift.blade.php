@extends('layout.app')

@section('page-title', 'Laporan Shift Karyawan')

@section('content')
<div class="container-fluid px-4" style="overflow-x: hidden;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">📋 Laporan Shift</h1>
            <p class="mb-0 text-muted">Monitor dan kelola jadwal shift karyawan</p>
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
            <a href="{{ route('shifts.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-cog me-2"></i>Kelola Data Shift
            </a>
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
                                Total Shift Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
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
                                Shift Pagi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">45</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sun fa-2x text-gray-300"></i>
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
                                Shift Malam</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">28</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-moon fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Karyawan Terjadwal</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">73</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-filter me-2"></i>Filter Laporan Shift</h6>
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
                    <label class="form-label fw-semibold">Tipe Shift</label>
                    <select class="form-select" id="shiftType">
                        <option value="">Semua Shift</option>
                        <option value="pagi">Shift Pagi</option>
                        <option value="siang">Shift Siang</option>
                        <option value="malam">Shift Malam</option>
                        <option value="libur">Shift Libur</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Departemen</label>
                    <select class="form-select" id="department">
                        <option value="">Semua Departemen</option>
                        <option value="IT">IT</option>
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Operations">Operations</option>
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
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Shift per Departemen</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-1"></i>Bulanan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Mingguan</a></li>
                            <li><a class="dropdown-item" href="#">Bulanan</a></li>
                            <li><a class="dropdown-item" href="#">Tahunan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="shiftDistributionChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Proporsi Tipe Shift</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="shiftTypeChart" height="250"></canvas>
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

    <!-- Additional Charts -->
    <div class="row mb-4">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Trend Shift Bulanan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="monthlyTrendChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Kehadiran Shift</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="attendanceStatusChart" height="250"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Hadir
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Terlambat
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Absen
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Jadwal Shift</h6>
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
                <table class="table table-bordered table-hover" id="shiftTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Karyawan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>IT</td>
                            <td>{{ date('d/m/Y') }}</td>
                            <td><span class="badge bg-primary">Pagi</span></td>
                            <td>08:00</td>
                            <td>16:00</td>
                            <td><span class="badge bg-success">Terjadwal</span></td>
                            <td>Kantor Pusat</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>HR</td>
                            <td>{{ date('d/m/Y') }}</td>
                            <td><span class="badge bg-success">Siang</span></td>
                            <td>16:00</td>
                            <td>00:00</td>
                            <td><span class="badge bg-success">Terjadwal</span></td>
                            <td>Kantor Pusat</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Bob Johnson</td>
                            <td>Finance</td>
                            <td>{{ date('d/m/Y') }}</td>
                            <td><span class="badge bg-warning text-dark">Malam</span></td>
                            <td>00:00</td>
                            <td>08:00</td>
                            <td><span class="badge bg-success">Terjadwal</span></td>
                            <td>Kantor Cabang</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Alice Brown</td>
                            <td>Marketing</td>
                            <td>{{ date('d/m/Y', strtotime('+1 day')) }}</td>
                            <td><span class="badge bg-secondary">Libur</span></td>
                            <td>-</td>
                            <td>-</td>
                            <td><span class="badge bg-info">Libur</span></td>
                            <td>-</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Michael Wilson</td>
                            <td>Operations</td>
                            <td>{{ date('d/m/Y') }}</td>
                            <td><span class="badge bg-primary">Pagi</span></td>
                            <td>07:00</td>
                            <td>15:00</td>
                            <td><span class="badge bg-warning text-dark">Perubahan</span></td>
                            <td>Gudang</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Calendar View -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-calendar me-2"></i>Kalender Shift</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <i class="fas fa-calendar-week me-2"></i>Minggu Ini
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-alt me-2"></i>Bulan Ini
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-day me-2"></i>Hari Ini
                        </a>
                    </div>
                    <div class="mt-3">
                        <h6 class="text-muted">Legenda:</h6>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-primary me-2" style="width: 20px; height: 20px;"></span>
                            <small>Shift Pagi</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-success me-2" style="width: 20px; height: 20px;"></span>
                            <small>Shift Siang</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-warning me-2" style="width: 20px; height: 20px;"></span>
                            <small>Shift Malam</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-secondary me-2" style="width: 20px; height: 20px;"></span>
                            <small>Libur</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                    <th>Minggu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @for($i = 1; $i <= 7; $i++)
                                    <td>
                                        <div class="p-2">
                                            <strong>{{ $i }}</strong>
                                            <div class="mt-1">
                                                <span class="badge bg-primary mb-1">P: 15</span>
                                                <span class="badge bg-success mb-1">S: 8</span>
                                                <span class="badge bg-warning text-dark">M: 5</span>
                                            </div>
                                        </div>
                                    </td>
                                    @endfor
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Laporan Shift</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-1"><strong>Periode</strong></p>
                            <p class="mb-1"><strong>Total Shift</strong></p>
                            <p class="mb-1"><strong>Shift Terbanyak</strong></p>
                            <p class="mb-1"><strong>Departemen Terbanyak</strong></p>
                        </div>
                        <div class="col-6">
                            <p class="mb-1">: {{ date('d M Y') }} - {{ date('d M Y', strtotime('+7 days')) }}</p>
                            <p class="mb-1">: 85 shift</p>
                            <p class="mb-1">: Shift Pagi (45)</p>
                            <p class="mb-1">: Operations (25)</p>
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
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .text-xs {
        font-size: 0.7rem;
    }
    .chart-bar, .chart-pie {
        position: relative;
        height: 100%;
    }
    .list-group-item.active {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    .badge {
        font-size: 0.75em;
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
        // Bar Chart - Distribusi Shift per Departemen
        const distributionCtx = document.getElementById('shiftDistributionChart').getContext('2d');
        new Chart(distributionCtx, {
            type: 'bar',
            data: {
                labels: ['IT', 'HR', 'Finance', 'Marketing', 'Operations'],
                datasets: [{
                    label: 'Shift Pagi',
                    data: [12, 8, 6, 10, 9],
                    backgroundColor: '#4e73df',
                    borderColor: '#4e73df',
                    borderWidth: 1
                }, {
                    label: 'Shift Siang',
                    data: [5, 7, 4, 6, 8],
                    backgroundColor: '#1cc88a',
                    borderColor: '#1cc88a',
                    borderWidth: 1
                }, {
                    label: 'Shift Malam',
                    data: [3, 2, 4, 2, 5],
                    backgroundColor: '#f6c23e',
                    borderColor: '#f6c23e',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });

        // Pie Chart - Tipe Shift
        const pieCtx = document.getElementById('shiftTypeChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Shift Pagi', 'Shift Siang', 'Shift Malam', 'Libur'],
                datasets: [{
                    data: [45, 25, 15, 5],
                    backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#858796'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#dda20a', '#60616f'],
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

        // Line Chart - Trend Shift Bulanan
        const trendCtx = document.getElementById('monthlyTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Shift Pagi',
                    data: [40, 42, 38, 45, 47, 43, 45, 48, 46, 44, 42, 45],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Shift Siang',
                    data: [22, 25, 28, 26, 24, 25, 27, 26, 28, 25, 24, 26],
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28, 200, 138, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Shift Malam',
                    data: [15, 16, 14, 18, 17, 16, 19, 18, 17, 16, 15, 18],
                    borderColor: '#f6c23e',
                    backgroundColor: 'rgba(246, 194, 62, 0.1)',
                    tension: 0.4,
                    fill: true
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

        // Pie Chart - Status Kehadiran
        const attendanceCtx = document.getElementById('attendanceStatusChart').getContext('2d');
        new Chart(attendanceCtx, {
            type: 'pie',
            data: {
                labels: ['Hadir Tepat Waktu', 'Terlambat', 'Tidak Hadir', 'Izin'],
                datasets: [{
                    data: [65, 15, 8, 12],
                    backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b', '#36b9cc'],
                    hoverBackgroundColor: ['#17a673', '#dda20a', '#be2617', '#2c9faf'],
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
            },
        });

        // Export PDF Function
        document.getElementById('exportPDF').addEventListener('click', function() {
            const element = document.getElementById('shiftTable');
            const opt = {
                margin: 1,
                filename: 'laporan_shift_{{ date("Y-m-d") }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'cm', format: 'a4', orientation: 'landscape' }
            };

            html2pdf().set(opt).from(element).save();
        });

        // Export Excel Function
        document.getElementById('exportExcel').addEventListener('click', function() {
            const table = document.getElementById('shiftTable');
            const wb = XLSX.utils.table_to_book(table, {sheet: "Laporan Shift"});
            XLSX.writeFile(wb, 'laporan_shift_{{ date("Y-m-d") }}.xlsx');
        });

        // Table-specific exports
        document.getElementById('exportTablePDF').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('exportPDF').click();
        });

        document.getElementById('exportTableExcel').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('exportExcel').click();
        });

        // Quick Export
        document.getElementById('quickExport').addEventListener('click', function() {
            if(confirm('Export laporan shift dalam format Excel?')) {
                document.getElementById('exportExcel').click();
            }
        });

        // Filter functionality
        document.getElementById('applyFilter').addEventListener('click', function() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const shiftType = document.getElementById('shiftType').value;
            const department = document.getElementById('department').value;

            // Simulate filtering
            alert(`Filter shift diterapkan:\nPeriode: ${startDate} - ${endDate}\nTipe Shift: ${shiftType || 'Semua'}\nDepartemen: ${department || 'Semua'}`);
        });

        // Reset filter
        document.getElementById('resetFilter').addEventListener('click', function() {
            document.getElementById('startDate').value = '{{ date("Y-m-01") }}';
            document.getElementById('endDate').value = '{{ date("Y-m-t") }}';
            document.getElementById('shiftType').value = '';
            document.getElementById('department').value = '';
            alert('Filter shift telah direset');
        });

        // Menghilangkan scroll vertikal yang tidak perlu
        document.body.style.overflowY = 'auto';
        document.documentElement.style.overflowY = 'auto';
    });
</script>
@endpush
