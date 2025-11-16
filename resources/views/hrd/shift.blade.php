@extends('layout.apphrd')

@section('title', 'Data Master Shift')

@section('page-title', 'Manajemen Data Shift')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">🔄 Data Master Shift</h1>
            <p class="mb-0 text-muted">Kelola definisi dan konfigurasi shift kerja</p>
        </div>
        <div class="btn-group">
            <a href="{{ url('/reports/shift') }}    " class="btn btn-success">
                <i class="fas fa-chart-bar me-2"></i>Lihat Laporan
            </a>
            <a href="{{ route('hrd.manajemen-shift.shift.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Shift
            </a>
        </div>
    </div>

    <!-- Info Panel -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Data Master Shift</strong> - Kelola template shift yang akan digunakan untuk penjadwalan karyawan.
    </div>

    <!-- Data Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table me-2"></i>Daftar Master Shift
            </h6>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-cog me-1"></i>Aksi
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sync me-2"></i>Refresh</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Export</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Nama Shift</th>
                            <th width="15%">Kode</th>
                            <th width="15%">Jam Mulai</th>
                            <th width="15%">Jam Selesai</th>
                            <th width="10%">Durasi</th>
                            <th width="10%">Warna</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Shift Pagi -->
                        <tr>
                            <td>1</td>
                            <td><strong>Shift Pagi</strong></td>
                            <td><code>PAGI-01</code></td>
                            <td>08:00</td>
                            <td>16:00</td>
                            <td>8 Jam</td>
                            <td><span class="badge bg-primary" style="width: 20px; height: 20px; display: inline-block;"></span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Shift Siang -->
                        <tr>
                            <td>2</td>
                            <td><strong>Shift Siang</strong></td>
                            <td><code>SIANG-01</code></td>
                            <td>16:00</td>
                            <td>00:00</td>
                            <td>8 Jam</td>
                            <td><span class="badge bg-success" style="width: 20px; height: 20px; display: inline-block;"></span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Shift Malam -->
                        <tr>
                            <td>3</td>
                            <td><strong>Shift Malam</strong></td>
                            <td><code>MALAM-01</code></td>
                            <td>00:00</td>
                            <td>08:00</td>
                            <td>8 Jam</td>
                            <td><span class="badge bg-warning" style="width: 20px; height: 20px; display: inline-block;"></span></td>
                            <td><span class="badge bg-secondary">Non-Aktif</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Shift Libur -->
                        <tr>
                            <td>4</td>
                            <td><strong>Shift Libur</strong></td>
                            <td><code>LIBUR-01</code></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><span class="badge bg-secondary" style="width: 20px; height: 20px; display: inline-block;"></span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Tentang Data Master Shift
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Fungsi Data Master Shift:</strong></p>
                            <ul>
                                <li>Mendefinisikan template shift kerja</li>
                                <li>Mengatur jam kerja standar</li>
                                <li>Konfigurasi warna untuk kalender</li>
                                <li>Status aktif/non-aktif shift</li>
                                <li>Sebagai referensi untuk penjadwalan</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Contoh Penggunaan:</strong></p>
                            <ul>
                                <li><strong>Shift Pagi:</strong> 08:00 - 16:00</li>
                                <li><strong>Shift Siang:</strong> 16:00 - 00:00</li>
                                <li><strong>Shift Malam:</strong> 00:00 - 08:00</li>
                                <li><strong>Shift Libur:</strong> Tidak ada jam kerja</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DataTable initialization
        $('#dataTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            responsive: true
        });
    });
</script>
@endsection