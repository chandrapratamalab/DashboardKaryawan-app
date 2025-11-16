<!-- resources/views/admin/absensi.blade.php -->
@extends('layout.apphrd')

@section('title', 'Manajemen Absensi - Sistem Shift')

@section('page-title', 'Manajemen Absensi')

@section('content')
<div class="container-fluid">
    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-md-3">
            <label for="dateFilter" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="dateFilter" value="{{ date('Y-m-d') }}">
        </div>
        <div class="col-md-3">
            <label for="shiftFilter" class="form-label">Shift</label>
            <select class="form-select" id="shiftFilter">
                <option value="">Semua Shift</option>
                <option value="pagi">Shift Pagi</option>
                <option value="siang">Shift Siang</option>
                <option value="malam">Shift Malam</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="statusFilter" class="form-label">Status</label>
            <select class="form-select" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="present">Hadir</option>
                <option value="late">Terlambat</option>
                <option value="absent">Tidak Hadir</option>
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-outline-primary w-100" id="applyFilter">
                <i class="fas fa-filter me-1"></i>
                Terapkan Filter
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-muted">Total Hadir</h6>
                            <h3 class="text-success">24</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-check fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-muted">Terlambat</h6>
                            <h3 class="text-warning">3</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-muted">Tidak Hadir</h6>
                            <h3 class="text-danger">2</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-times fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-muted">Total Karyawan</h6>
                            <h3 class="text-primary">29</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="card card-shadow border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Absensi Hari Ini</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAttendanceModal">
                <i class="fas fa-plus me-1"></i>
                Tambah Absensi
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="attendanceTable">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Shift</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Pagi (08:00-16:00)</td>
                            <td>07:55</td>
                            <td>16:05</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td>-</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Pagi (08:00-16:00)</td>
                            <td>08:15</td>
                            <td>16:10</td>
                            <td><span class="badge bg-warning text-dark">Terlambat</span></td>
                            <td>Lalu lintas padat</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Attendance Modal -->
<div class="modal fade" id="addAttendanceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="attendanceForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="employee" class="form-label">Karyawan</label>
                                <select class="form-select" id="employee" required>
                                    <option value="">Pilih Karyawan</option>
                                    <option value="1">John Doe</option>
                                    <option value="2">Jane Smith</option>
                                    <option value="3">Bob Johnson</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="attendanceDate" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="attendanceDate" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="clockIn" class="form-label">Jam Masuk</label>
                                <input type="time" class="form-control" id="clockIn">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="clockOut" class="form-label">Jam Keluar</label>
                                <input type="time" class="form-control" id="clockOut">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" required>
                                    <option value="present">Hadir</option>
                                    <option value="late">Terlambat</option>
                                    <option value="absent">Tidak Hadir</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" required>
                                    <option value="pagi">Shift Pagi (08:00-16:00)</option>
                                    <option value="siang">Shift Siang (16:00-24:00)</option>
                                    <option value="malam">Shift Malam (00:00-08:00)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveAttendance">Simpan</button>
            </div>
        </div>
    </div>
</div>

<style>
    .card-shadow {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('attendanceDate').value = today;
        
        // Filter functionality
        document.getElementById('applyFilter').addEventListener('click', function() {
            applyFilters();
        });
        
        // Save attendance
        document.getElementById('saveAttendance').addEventListener('click', function() {
            saveAttendance();
        });
        
        function applyFilters() {
            const date = document.getElementById('dateFilter').value;
            const shift = document.getElementById('shiftFilter').value;
            const status = document.getElementById('statusFilter').value;
            
            // In a real application, you would make an AJAX request here
            console.log('Applying filters:', { date, shift, status });
            alert('Filter diterapkan!');
        }
        
        function saveAttendance() {
            const form = document.getElementById('attendanceForm');
            if (form.checkValidity()) {
                // In a real application, you would make an AJAX request here
                console.log('Saving attendance data...');
                alert('Data absensi berhasil disimpan!');
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addAttendanceModal'));
                modal.hide();
                
                // Reset form
                form.reset();
                document.getElementById('attendanceDate').value = today;
            } else {
                form.reportValidity();
            }
        }
    });
</script>
@endsection