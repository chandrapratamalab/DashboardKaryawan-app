@extends('layout.app')

@section('title', 'Data Karyawan')

@section('page-title', 'Data Karyawan')

@section('content')
<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan</h6>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Karyawan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Shift</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>EMP001</td>
                        <td>John Doe</td>
                        <td>john.doe@company.com</td>
                        <td>IT</td>
                        <td>Developer</td>
                        <td>Shift Pagi</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>EMP002</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@company.com</td>
                        <td>HRD</td>
                        <td>HR Manager</td>
                        <td>Shift Sore</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>EMP003</td>
                        <td>Bob Johnson</td>
                        <td>bob.johnson@company.com</td>
                        <td>Produksi</td>
                        <td>Operator</td>
                        <td>Shift Malam</td>
                        <td><span class="badge bg-secondary">Non-Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>EMP004</td>
                        <td>Alice Brown</td>
                        <td>alice.brown@company.com</td>
                        <td>Marketing</td>
                        <td>Marketing Specialist</td>
                        <td>Shift Pagi</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Karyawan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h4>156</h4>
                                <p class="text-muted">Total Karyawan</p>
                            </div>
                            <div class="col-md-3">
                                <h4>142</h4>
                                <p class="text-muted">Karyawan Aktif</p>
                            </div>
                            <div class="col-md-3">
                                <h4>14</h4>
                                <p class="text-muted">Karyawan Non-Aktif</p>
                            </div>
                            <div class="col-md-3">
                                <h4>5</h4>
                                <p class="text-muted">Departemen</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection