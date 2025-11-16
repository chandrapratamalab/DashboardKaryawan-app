@extends('layout.apphrd')

@section('title', 'Dashboard HRD')

@section('page-title', 'Dashboard HRD')

@section('content')
<div class="dashboard-cards">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Total Karyawan</div>
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="card-value">{{ $totalEmployees ?? 0 }}</div>
        <div class="card-change">
            <i class="fas fa-arrow-up"></i>
            <span>5.2% dari bulan lalu</span>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="card-title">Hadir Hari Ini</div>
            <div class="card-icon">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
        <div class="card-value">{{ $todayAttendance ?? 0 }}/{{ $totalEmployees ?? 0 }}</div>
        <div class="card-change">
            <i class="fas fa-arrow-up"></i>
            <span>2.4% dari kemarin</span>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="card-title">Terlambat</div>
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="card-value">{{ $lateEmployees ?? 0 }}</div>
        <div class="card-change negative">
            <i class="fas fa-arrow-down"></i>
            <span>1.2% dari kemarin</span>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="card-title">Shift Aktif</div>
            <div class="card-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
        <div class="card-value">{{ $activeShifts ?? 0 }}</div>
        <div class="card-change">
            <span>{{ $morningShift ?? 0 }} Pagi, {{ $eveningShift ?? 0 }} Sore</span>
        </div>
    </div>
</div>

<!-- Charts Grid -->
<div class="charts-grid">
    <!-- Statistik Kehadiran 7 Hari Terakhir -->
    <div class="chart-section">
        <div class="section-header">
            <div class="section-title">Statistik Kehadiran 7 Hari Terakhir</div>
            <div class="section-actions">
                <select class="form-select" id="timeRange">
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="quarter">Kuartal Ini</option>
                </select>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="attendanceChart" height="300"></canvas>
        </div>
    </div>

    <!-- Distribusi Status Kehadiran -->
    <div class="chart-section">
        <div class="section-header">
            <div class="section-title">Distribusi Status Kehadiran</div>
            <div class="section-actions">
                <button class="btn btn-outline" id="refreshPieChart">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="attendancePieChart" height="300"></canvas>
        </div>
    </div>

    <!-- Trend Kehadiran Bulanan -->
    <div class="chart-section full-width">
        <div class="section-header">
            <div class="section-title">Trend Kehadiran Bulanan</div>
            <div class="section-actions">
                <div class="btn-group">
                    <button class="btn btn-outline active" data-period="6">6 Bulan</button>
                    <button class="btn btn-outline" data-period="12">12 Bulan</button>
                </div>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="monthlyTrendChart" height="250"></canvas>
        </div>
    </div>

    <!-- Kehadiran per Departemen -->
    <div class="chart-section">
        <div class="section-header">
            <div class="section-title">Kehadiran per Departemen</div>
            <div class="section-actions">
                <select class="form-select" id="deptTimeRange">
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                </select>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="departmentChart" height="300"></canvas>
        </div>
    </div>

    <!-- Keterlambatan per Jam -->
    <div class="chart-section">
        <div class="section-header">
            <div class="section-title">Keterlambatan per Jam</div>
            <div class="section-actions">
                <button class="btn btn-outline" id="refreshLateChart">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="lateHoursChart" height="300"></canvas>
        </div>
    </div>
</div>

<div class="section">
    <div class="section-header">
        <div class="section-title">Aktivitas Terbaru</div>
        <div class="section-actions">
            <button class="btn btn-outline" id="refreshActivities">
                <i class="fas fa-sync-alt"></i>
                Refresh
            </button>
        </div>
    </div>
    
    <div class="activity-list">
        @foreach($recentActivities ?? [] as $activity)
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-{{ $activity['icon'] }}"></i>
            </div>
            <div class="activity-content">
                <div class="activity-message">{{ $activity['message'] }}</div>
                <div class="activity-time">{{ $activity['time'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary-color);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    
    .card-title {
        font-size: 14px;
        color: var(--text-lighter);
        font-weight: 500;
    }
    
    .card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    
    .card-value {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--text-dark);
    }
    
    .card-change {
        font-size: 12px;
        color: var(--success-color);
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .card-change.negative {
        color: var(--danger-color);
    }
    
    .section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .section-actions {
        display: flex;
        gap: 10px;
    }
    
    .form-select {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        background: white;
        font-size: 14px;
    }
    
    /* Charts Grid */
    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .chart-section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .chart-section.full-width {
        grid-column: 1 / -1;
    }
    
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    
    .chart-container canvas {
        width: 100% !important;
        height: 100% !important;
    }
    
    .btn-group {
        display: flex;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        overflow: hidden;
    }
    
    .btn-group .btn {
        border-radius: 0;
        border: none;
        margin: 0;
    }
    
    .btn-group .btn.active {
        background: var(--primary-color);
        color: white;
    }
    
    .activity-list {
        space-y: 4;
    }
    
    .activity-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .activity-item:hover {
        background: #f8fafc;
        border-left-color: var(--primary-color);
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-message {
        font-size: 14px;
        color: var(--text-dark);
        margin-bottom: 4px;
    }
    
    .activity-time {
        font-size: 12px;
        color: var(--text-lighter);
    }
    
    .btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    
    .btn-primary {
        background: var(--primary-color);
        color: white;
    }
    
    .btn-primary:hover {
        background: var(--primary-light);
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid #e2e8f0;
        color: var(--text-dark);
    }
    
    .btn-outline:hover {
        background: #f8fafc;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
        
        .dashboard-cards {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }
    
    @media (max-width: 768px) {
        .dashboard-cards {
            grid-template-columns: 1fr 1fr;
        }
        
        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .section-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
    
    @media (max-width: 480px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all charts
        initializeAttendanceChart();
        initializePieChart();
        initializeMonthlyTrendChart();
        initializeDepartmentChart();
        initializeLateHoursChart();
        
        // Setup event listeners
        setupEventListeners();
    });

    function initializeAttendanceChart() {
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [
                    {
                        label: 'Hadir',
                        data: [45, 52, 48, 55, 49, 53, 47],
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderColor: 'rgb(34, 197, 94)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    },
                    {
                        label: 'Terlambat',
                        data: [3, 5, 2, 4, 6, 1, 2],
                        backgroundColor: 'rgba(234, 179, 8, 0.8)',
                        borderColor: 'rgb(234, 179, 8)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    },
                    {
                        label: 'Tidak Hadir',
                        data: [2, 1, 3, 1, 2, 1, 3],
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Statistik Kehadiran 7 Hari Terakhir',
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
                            text: 'Hari',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    function initializePieChart() {
        const ctx = document.getElementById('attendancePieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Terlambat', 'Tidak Hadir', 'Izin', 'Cuti'],
                datasets: [{
                    data: [156, 24, 15, 8, 12],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(234, 179, 8, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(168, 85, 247, 0.8)'
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(234, 179, 8)',
                        'rgb(239, 68, 68)',
                        'rgb(59, 130, 246)',
                        'rgb(168, 85, 247)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribusi Status Kehadiran',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
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
                cutout: '50%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    }

    function initializeMonthlyTrendChart() {
        const ctx = document.getElementById('monthlyTrendChart').getContext('2d');
        const trendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Rata-rata Kehadiran (%)',
                    data: [88, 92, 90, 89, 91, 93, 90, 92, 91, 89, 90, 92],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Trend Kehadiran Bulanan',
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
                        beginAtZero: false,
                        min: 80,
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
                            text: 'Bulan',
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

    function initializeDepartmentChart() {
        const ctx = document.getElementById('departmentChart').getContext('2d');
        const departmentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales'],
                datasets: [{
                    label: 'Tingkat Kehadiran (%)',
                    data: [95, 88, 92, 85, 90, 87],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(14, 165, 233, 0.8)',
                        'rgba(236, 72, 153, 0.8)'
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(245, 158, 11)',
                        'rgb(139, 92, 246)',
                        'rgb(14, 165, 233)',
                        'rgb(236, 72, 153)'
                    ],
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Kehadiran per Departemen',
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
    }

    function initializeLateHoursChart() {
        const ctx = document.getElementById('lateHoursChart').getContext('2d');
        const lateChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['07:00-08:00', '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00'],
                datasets: [{
                    label: 'Jumlah Keterlambatan',
                    data: [45, 28, 12, 5, 2],
                    backgroundColor: 'rgba(234, 179, 8, 0.8)',
                    borderColor: 'rgb(234, 179, 8)',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
    }

    function setupEventListeners() {
        // Time range selector for attendance chart
        document.getElementById('timeRange').addEventListener('change', function(e) {
            updateAttendanceChart(e.target.value);
        });

        // Refresh pie chart
        document.getElementById('refreshPieChart').addEventListener('click', function() {
            refreshPieChart();
        });

        // Refresh late chart
        document.getElementById('refreshLateChart').addEventListener('click', function() {
            refreshLateChart();
        });

        // Refresh activities
        document.getElementById('refreshActivities').addEventListener('click', function() {
            refreshActivities();
        });

        // Monthly trend period buttons
        document.querySelectorAll('.btn-group .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.btn-group .btn').forEach(b => {
                    b.classList.remove('active');
                });
                // Add active class to clicked button
                this.classList.add('active');
                
                const period = this.dataset.period;
                updateMonthlyTrendChart(period);
            });
        });

        // Department time range
        document.getElementById('deptTimeRange').addEventListener('change', function(e) {
            updateDepartmentChart(e.target.value);
        });
    }

    function updateAttendanceChart(period) {
        // Simulate data update based on period
        let data;
        
        switch(period) {
            case 'week':
                data = {
                    hadir: [45, 52, 48, 55, 49, 53, 47],
                    terlambat: [3, 5, 2, 4, 6, 1, 2],
                    tidakHadir: [2, 1, 3, 1, 2, 1, 3]
                };
                break;
            case 'month':
                data = {
                    hadir: [48, 51, 49, 53, 50, 52, 48, 49, 51, 50, 52, 49, 48, 50, 51, 49, 52, 50, 48, 51, 49, 50, 52, 48, 49, 51, 50, 48, 52, 49],
                    terlambat: [4, 3, 5, 2, 4, 3, 2, 5, 3, 4, 2, 3, 5, 2, 4, 3, 2, 5, 3, 4, 2, 3, 5, 2, 4, 3, 2, 5, 3, 4],
                    tidakHadir: [1, 2, 1, 0, 2, 1, 3, 1, 2, 1, 0, 2, 1, 3, 1, 2, 1, 0, 2, 1, 3, 1, 2, 1, 0, 2, 1, 3, 1, 2]
                };
                break;
            case 'quarter':
                data = {
                    hadir: [50, 52, 51, 53, 52, 54, 51, 53, 52, 50, 53, 51, 52],
                    terlambat: [3, 4, 2, 3, 4, 2, 3, 4, 2, 3, 4, 2, 3],
                    tidakHadir: [2, 1, 2, 1, 1, 0, 2, 1, 2, 2, 1, 2, 1]
                };
                break;
        }
        
        // Update chart data
        const chart = Chart.getChart('attendanceChart');
        if (chart) {
            chart.data.datasets[0].data = data.hadir;
            chart.data.datasets[1].data = data.terlambat;
            chart.data.datasets[2].data = data.tidakHadir;
            chart.update();
        }
    }

    function refreshPieChart() {
        // Simulate data refresh with slight variations
        const chart = Chart.getChart('attendancePieChart');
        if (chart) {
            const newData = chart.data.datasets[0].data.map(value => {
                const variation = Math.floor(Math.random() * 5) - 2; // -2 to +2
                return Math.max(0, value + variation);
            });
            chart.data.datasets[0].data = newData;
            chart.update();
        }
    }

    function refreshLateChart() {
        // Simulate data refresh
        const chart = Chart.getChart('lateHoursChart');
        if (chart) {
            const newData = chart.data.datasets[0].data.map(value => {
                const variation = Math.floor(Math.random() * 3) - 1; // -1 to +1
                return Math.max(0, value + variation);
            });
            chart.data.datasets[0].data = newData;
            chart.update();
        }
    }

    function updateMonthlyTrendChart(period) {
        const chart = Chart.getChart('monthlyTrendChart');
        if (chart) {
            const months = period === '6' ? 6 : 12;
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'].slice(0, months);
            
            // Generate data based on period
            const baseData = [88, 92, 90, 89, 91, 93, 90, 92, 91, 89, 90, 92];
            const data = baseData.slice(0, months);
            
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }
    }

    function updateDepartmentChart(period) {
        const chart = Chart.getChart('departmentChart');
        if (chart) {
            // Simulate different data based on period
            const data = period === 'week' ? 
                [95, 88, 92, 85, 90, 87] : 
                [93, 86, 90, 83, 88, 85];
            
            chart.data.datasets[0].data = data;
            chart.update();
        }
    }

    function refreshActivities() {
        // Simulate refreshing activities
        const activityList = document.querySelector('.activity-list');
        const loadingText = document.createElement('div');
        loadingText.className = 'activity-item';
        loadingText.innerHTML = `
            <div class="activity-icon">
                <i class="fas fa-sync-alt fa-spin"></i>
            </div>
            <div class="activity-content">
                <div class="activity-message">Memperbarui aktivitas...</div>
                <div class="activity-time">Saat ini</div>
            </div>
        `;
        
        activityList.prepend(loadingText);
        
        setTimeout(() => {
            loadingText.remove();
            // Add new activity
            const newActivity = document.createElement('div');
            newActivity.className = 'activity-item';
            newActivity.innerHTML = `
                <div class="activity-icon">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-message">Data aktivitas berhasil diperbarui</div>
                    <div class="activity-time">Baru saja</div>
                </div>
            `;
            activityList.prepend(newActivity);
        }, 1000);
    }
</script>
@endpush