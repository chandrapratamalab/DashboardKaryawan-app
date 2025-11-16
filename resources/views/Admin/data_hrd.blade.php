@extends('layout.app')

@section('title', 'Manajemen HRD - Admin Panel')

@section('page-title', 'Data HRD')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <div class="d-flex align-items-center">
                    <div class="header-icon me-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h1 class="page-title mb-1">Manajemen Pengguna</h1>
                        <p class="page-subtitle mb-0">Kelola data pengguna dan akses sistem</p>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="btn-group">
                    <button class="btn btn-light btn-refresh" id="refresh-btn" title="Refresh Data">
                        <i class="bi bi-arrow-clockwise"></i>Refresh
                    </button>
                    <button class="btn btn-primary btn-add-user" data-bs-toggle="modal" data-bs-target="#userModal">
                        <i class="bi bi-person-plus me-2"></i>Tambah HRD
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Total Pengguna</h6>
                            <h3 class="text-primary mb-0">{{ $totalUsers }}</h3>
                            <small class="text-success">
                                <i class="bi bi-arrow-up-short"></i>
                                {{ $activeUsers }} aktif
                            </small>
                        </div>
                        <div class="stat-icon bg-primary">
                            <i class="bi bi-people text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Administrator</h6>
                            <h3 class="text-success mb-0">{{ $adminCount }}</h3>
                            <small class="text-muted">Akses penuh sistem</small>
                        </div>
                        <div class="stat-icon bg-success">
                            <i class="bi bi-shield-check text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">Belum Verifikasi</h6>
                            <h3 class="text-warning mb-0">{{ $unverifiedCount }}</h3>
                            <small class="text-muted">Email pending</small>
                        </div>
                        <div class="stat-icon bg-warning">
                            <i class="bi bi-envelope-exclamation text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-2">HRD Baru</h6>
                            <h3 class="text-info mb-0">{{ $newThisMonth }}</h3>
                            <small class="text-muted">Bulan ini</small>
                        </div>
                        <div class="stat-icon bg-info">
                            <i class="bi bi-person-plus text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
            <div class="alert-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="alert-heading mb-1">Sukses!</h6>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- Main Content Card -->
    <div class="card main-content-card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-list-ul me-2 text-primary"></i>
                        Daftar Pengguna Sistem
                    </h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <!-- Search Box -->
                        <div class="search-box">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text" class="form-control search-input" placeholder="Cari user..." id="search-input">
                            <button class="btn btn-sm search-clear d-none" id="clear-search">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>

                        <!-- Filter Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-funnel me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Status</h6></li>
                                <li><a class="dropdown-item filter-option active" href="#" data-filter="all">Semua HRD</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="active">Aktif</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="inactive">Nonaktif</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><h6 class="dropdown-header">Role</h6></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="admin">Admin</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="hrd">HRD Biasa</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="manager">Manager</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- Users Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="users-table">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">User Profile</th>
                            <th>Kontak</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="user-row" data-user-id="{{ $user->id }}" data-status="{{ $user->is_active ? 'active' : 'inactive' }}" data-role="{{ $user->role }}">
                            <!-- User Profile -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3 position-relative">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=ffffff&bold=true&size=64"
                                             alt="{{ $user->name }}" class="avatar-img">
                                        <div class="user-status-indicator {{ $user->is_active ? 'online' : 'offline' }}"></div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 user-name">{{ $user->name }}</h6>
                                        <div class="text-muted small">
                                            <span class="user-id">ID: {{ $user->id }}</span>
                                            @if($user->username)
                                            <span class="ms-2 user-username">@{{ $user->username }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Kontak -->
                            <td>
                                <div class="contact-info">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-envelope me-2 text-primary contact-icon"></i>
                                        <span class="contact-email text-truncate">{{ $user->email }}</span>
                                    </div>
                                    @if($user->phone)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-phone me-2 text-success contact-icon"></i>
                                        <span class="contact-phone">{{ $user->phone }}</span>
                                    </div>
                                    @endif
                                    <div class="mt-2">
                                        @if($user->email_verified_at)
                                        <span class="badge verified-badge">
                                            <i class="bi bi-patch-check-fill me-1"></i>Terverifikasi
                                        </span>
                                        @else
                                        <span class="badge unverified-badge">
                                            <i class="bi bi-clock me-1"></i>Belum Verifikasi
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Role -->
                            <td>
                                @php
                                    $roleConfig = [
                                        'admin' => ['color' => 'danger', 'icon' => 'shield-check', 'label' => 'Admin'],
                                        'superadmin' => ['color' => 'purple', 'icon' => 'star-fill', 'label' => 'Super Admin'],
                                        'manager' => ['color' => 'success', 'icon' => 'person-gear', 'label' => 'Manager'],
                                        'user' => ['color' => 'primary', 'icon' => 'person', 'label' => 'User'],
                                        'editor' => ['color' => 'info', 'icon' => 'pencil-square', 'label' => 'Editor']
                                    ];
                                    $config = $roleConfig[$user->role] ?? $roleConfig['user'];
                                @endphp
                                <div class="role-badge bg-{{ $config['color'] }}">
                                    <i class="bi bi-{{ $config['icon'] }} me-1"></i>
                                    {{ $config['label'] }}
                                </div>
                            </td>

                            <!-- Status -->
                            <td>
                                <div class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                                    <div class="status-dot me-2"></div>
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </div>
                            </td>

                            <!-- Tanggal Bergabung -->
                            <td>
                                <div class="join-date">
                                    @if($user->created_at)
                                        <div class="date-main">{{ $user->created_at->format('d M Y') }}</div>
                                        <div class="date-time text-muted">{{ $user->created_at->format('H:i') }}</div>
                                        <div class="date-ago text-muted small">
                                            <i class="bi bi-clock-history me-1"></i>
                                            {{ $user->created_at->diffForHumans() }}
                                        </div>
                                    @else
                                        <div class="text-muted">-</div>
                                    @endif
                                </div>
                            </td>

                            <!-- Aksi -->
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-icon btn-outline-primary btn-edit"
                                            data-bs-toggle="tooltip"
                                            title="Edit User"
                                            onclick="editUser({{ $user->id }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-outline-info btn-view"
                                            data-bs-toggle="tooltip"
                                            title="Lihat Detail"
                                            onclick="viewUser({{ $user->id }})">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown"
                                                data-bs-toggle="tooltip"
                                                title="Lainnya">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="resetPassword({{ $user->id }})">
                                                    <i class="bi bi-key me-2"></i>Reset Password
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="toggleStatus({{ $user->id }})">
                                                    <i class="bi bi-power me-2"></i>
                                                    {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                                    <i class="bi bi-trash me-2"></i>Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon mb-3">
                                        <i class="bi bi-people" style="font-size: 4rem;"></i>
                                    </div>
                                    <h5 class="empty-title">Belum ada data HRD</h5>
                                    <p class="empty-description text-muted mb-4">Mulai dengan menambahkan HRD pertama ke sistem</p>
                                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#userModal">
                                        <i class="bi bi-person-plus me-2"></i>Tambah HRD Pertama
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="card-footer">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="text-muted">
                            Menampilkan <strong>{{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}</strong>
                            dari <strong>{{ $users->total() }}</strong> user
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($users->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="bi bi-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                                <i class="bi bi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @php
                                        $current = $users->currentPage();
                                        $last = $users->lastPage();
                                        $start = max(1, $current - 1);
                                        $end = min($last, $current + 1);

                                        if($start > 1) {
                                            $start = max(1, $current - 1);
                                            $end = min($last, $start + 2);
                                        }
                                        if($end == $last && $last > 3) {
                                            $start = max(1, $last - 2);
                                        }
                                    @endphp

                                    {{-- First Page Link --}}
                                    @if($start > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url(1) }}">1</a>
                                        </li>
                                        @if($start > 2)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                    @endif

                                    {{-- Page Number Links --}}
                                    @for ($page = $start; $page <= $end; $page++)
                                        @if ($page == $users->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endfor

                                    {{-- Last Page Link --}}
                                    @if($end < $last)
                                        @if($end < $last - 1)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url($last) }}">{{ $last }}</a>
                                        </li>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if ($users->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="bi bi-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="userForm" method="POST">
                @csrf
                <div id="form-method"></div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telepon</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="password-fields">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified">
                                    <label class="form-check-label" for="email_verified">Email Terverifikasi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submit-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="resetPasswordForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// CSRF Token for AJAX requests
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.addEventListener('DOMContentLoaded', function() {
    initializeUserManagement();
});

function initializeUserManagement() {
    // Search functionality
    const searchInput = document.getElementById('search-input');
    const clearSearch = document.getElementById('clear-search');
    const userRows = document.querySelectorAll('.user-row');

    searchInput.addEventListener('input', debounce(function(e) {
        const searchTerm = e.target.value.toLowerCase();

        userRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const isVisible = text.includes(searchTerm);
            row.style.display = isVisible ? '' : 'none';
        });

        // Show/hide clear button
        clearSearch.classList.toggle('d-none', !searchTerm);
    }, 300));

    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        clearSearch.classList.add('d-none');
    });

    // Filter functionality
    document.querySelectorAll('.filter-option').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.getAttribute('data-filter');

            // Update active state
            document.querySelectorAll('.filter-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');

            userRows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else if (filter === 'active' || filter === 'inactive') {
                    row.style.display = row.getAttribute('data-status') === filter ? '' : 'none';
                } else {
                    row.style.display = row.getAttribute('data-role') === filter ? '' : 'none';
                }
            });
        });
    });

    // Refresh button
    document.getElementById('refresh-btn').addEventListener('click', function() {
        this.classList.add('rotating');
        setTimeout(() => {
            window.location.reload();
        }, 500);
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // User form handling
    const userForm = document.getElementById('userForm');
    userForm.addEventListener('submit', handleUserSubmit);

    // Reset password form handling
    const resetPasswordForm = document.getElementById('resetPasswordForm');
    resetPasswordForm.addEventListener('submit', handleResetPassword);
}

// Debounce function for search
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function editUser(userId) {
    fetch(`/users/${userId}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('userModalLabel').textContent = 'Edit User';
            document.getElementById('form-method').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('userForm').action = `/users/${userId}`;

            // Fill form data
            document.getElementById('name').value = user.name;
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('phone').value = user.phone || '';
            document.getElementById('role').value = user.role;
            document.getElementById('is_active').checked = user.is_active;
            document.getElementById('email_verified').checked = user.email_verified_at !== null;

            // Hide password fields for edit
            document.getElementById('password-fields').style.display = 'none';

            // Update submit button
            document.getElementById('submit-btn').textContent = 'Update User';

            const modal = new bootstrap.Modal(document.getElementById('userModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Gagal memuat data HRD!', 'error');
        });
}

function viewUser(userId) {
    // Implement view user functionality
    showAlert('Fitur lihat detail user akan segera tersedia', 'info');
}

function handleUserSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const url = form.action;
    const method = form.querySelector('[name="_method"]') ? 'PUT' : 'POST';

    // Show loading state
    const submitBtn = form.querySelector('#submit-btn');
    const originalText = submitBtn.textContent;
    submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Memproses...';
    submitBtn.disabled = true;

    fetch(url, {
        method: method,
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.success, 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
            modal.hide();
            setTimeout(() => window.location.reload(), 1500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan!', 'error');
    })
    .finally(() => {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    });
}

function resetPassword(userId) {
    document.getElementById('resetPasswordForm').onsubmit = function(e) {
        e.preventDefault();
        handleResetPassword(e, userId);
    };

    const modal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
    modal.show();
}

function handleResetPassword(e, userId) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch(`/users/${userId}/reset-password`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.success, 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('resetPasswordModal'));
            modal.hide();
            form.reset();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan!', 'error');
    });
}

function toggleStatus(userId) {
    fetch(`/users/${userId}/toggle-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan!', 'error');
    });
}

function confirmDelete(userId, userName) {
    Swal.fire({
        title: 'Hapus User?',
        html: `User <strong>"${userName}"</strong> akan dihapus secara permanen.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            deleteUser(userId);
        }
    });
}

function deleteUser(userId) {
    fetch(`/users/${userId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.success, 'success');
            setTimeout(() => window.location.reload(), 1500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan!', 'error');
    });
}

function showAlert(message, type) {
    const alertClass = {
        'success': 'alert-success',
        'error': 'alert-danger',
        'warning': 'alert-warning',
        'info': 'alert-info'
    }[type] || 'alert-info';

    const iconClass = {
        'success': 'check-circle-fill',
        'error': 'exclamation-triangle-fill',
        'warning': 'exclamation-triangle-fill',
        'info': 'info-circle-fill'
    }[type] || 'info-circle-fill';

    const alertDiv = document.createElement('div');
    alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
    alertDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${iconClass} me-2"></i>
            <div class="flex-grow-1">${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    // Add to page
    document.body.appendChild(alertDiv);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 5000);
}

// Reset modal when hidden
document.getElementById('userModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('userForm').reset();
    document.getElementById('userModalLabel').textContent = 'Tambah User Baru';
    document.getElementById('form-method').innerHTML = '';
    document.getElementById('userForm').action = '{{ route("users.store") }}';
    document.getElementById('password-fields').style.display = 'block';
    document.getElementById('submit-btn').textContent = 'Simpan';
});
</script>
@endpush

@push('styles')
<style>
/* Header Styles */
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem 0;
    margin: -1.5rem -1.5rem 2rem -1.5rem;
    border-radius: 0 0 20px 20px;
}

.breadcrumb {
    margin-bottom: 0.5rem;
}

.breadcrumb-item a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: white;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.page-subtitle {
    opacity: 0.9;
    font-size: 0.9rem;
}

.btn-refresh {
    border-radius: 10px;
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Statistics Cards */
.stat-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

/* Alert Styling */
.alert {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.alert-icon {
    width: 40px;
    height: 40px;
    background: rgba(25,135,84,0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #198754;
}

/* Main Content */
.main-content-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    background: white;
    border-bottom: 1px solid #f1f3f4;
    padding: 1.5rem 1.5rem;
}

.card-title {
    font-weight: 600;
    color: #2d3748;
}

/* Search Box */
.search-box {
    position: relative;
    min-width: 300px;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    z-index: 10;
}

.search-input {
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.1);
}

.search-clear {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: none;
    color: #6c757d;
    padding: 4px;
    z-index: 10;
}

/* Table Styles */
.table {
    margin-bottom: 0;
    font-size: 0.9rem;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem 0.75rem;
    background: #f8f9fa;
}

.table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* User Avatar */
.user-avatar {
    position: relative;
}

.avatar-img {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    object-fit: cover;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.user-status-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
}

.user-status-indicator.online {
    background: #28a745;
}

.user-status-indicator.offline {
    background: #6c757d;
}

.user-name {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.25rem;
    font-size: 0.95rem;
}

.user-id, .user-username {
    font-size: 0.8rem;
}

/* Contact Info */
.contact-info {
    min-width: 200px;
}

.contact-icon {
    width: 16px;
    flex-shrink: 0;
}

.contact-email {
    font-size: 0.85rem;
}

.verified-badge {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #065f46;
    border-radius: 20px;
    padding: 0.35rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid #a7f3d0;
}

.unverified-badge {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border-radius: 20px;
    padding: 0.35rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid #fde68a;
}

/* Role Badges */
.role-badge {
    padding: 0.6rem 1rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    width: fit-content;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.role-badge.bg-danger {
    background: linear-gradient(135deg, #fecaca, #fca5a5) !important;
    color: #dc2626;
    border: 1px solid #fca5a5;
}
.role-badge.bg-success {
    background: linear-gradient(135deg, #bbf7d0, #86efac) !important;
    color: #15803d;
    border: 1px solid #86efac;
}
.role-badge.bg-primary {
    background: linear-gradient(135deg, #93c5fd, #60a5fa) !important;
    color: #1d4ed8;
    border: 1px solid #60a5fa;
}
.role-badge.bg-info {
    background: linear-gradient(135deg, #a5f3fc, #67e8f9) !important;
    color: #0e7490;
    border: 1px solid #67e8f9;
}
.role-badge.bg-purple {
    background: linear-gradient(135deg, #d8b4fe, #c084fc) !important;
    color: #7e22ce;
    border: 1px solid #c084fc;
}

/* Status Badges */
.status-badge {
    padding: 0.6rem 1rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    width: fit-content;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.status-active {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.status-inactive {
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    color: #6b7280;
    border: 1px solid #e5e7eb;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 0.5rem;
}

.status-active .status-dot {
    background: #10b981;
}

.status-inactive .status-dot {
    background: #6b7280;
}

/* Join Date */
.join-date {
    min-width: 120px;
}

.date-main {
    font-weight: 600;
    color: #2d3748;
    font-size: 0.9rem;
}

.date-time {
    font-size: 0.8rem;
}

.date-ago {
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    align-items: center;
}

.btn-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.btn-icon:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.btn-edit:hover {
    background: #0d6efd;
    color: white;
    border-color: #0d6efd;
}

.btn-view:hover {
    background: #0dcaf0;
    color: white;
    border-color: #0dcaf0;
}

/* Pagination Styles */
.pagination {
    margin-bottom: 0;
}

.page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: 1px solid #e9ecef;
    color: #6c757d;
    min-width: 38px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-color: #6366f1;
    color: white;
    box-shadow: 0 2px 4px rgba(99, 102, 241, 0.3);
}

.page-link:hover {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #6366f1;
}

.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

/* Empty State */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-icon {
    color: #d1d5db;
    margin-bottom: 1.5rem;
}

.empty-title {
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.75rem;
    font-size: 1.25rem;
}

.empty-description {
    color: #6b7280;
    font-size: 0.95rem;
    max-width: 400px;
    margin: 0 auto 2rem;
}

/* Refresh Animation */
.rotating {
    animation: rotate 1s ease;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Spinner */
.spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Modal Styles */
.modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.modal-header {
    border-bottom: 1px solid #f1f3f4;
    padding: 1.5rem;
}

.modal-footer {
    border-top: 1px solid #f1f3f4;
    padding: 1.5rem;
}

/* Form Styles */
.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #e9ecef;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.1);
}

.form-check-input:checked {
    background-color: #6366f1;
    border-color: #6366f1;
}

.form-switch .form-check-input {
    width: 3em;
    height: 1.5em;
}

/* Responsive */
@media (max-width: 768px) {
    .page-header {
        margin: -1rem -1rem 2rem -1rem;
        padding: 1.5rem 0;
        border-radius: 0 0 15px 15px;
    }

    .search-box {
        min-width: 100%;
        margin-bottom: 1rem;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
    }

    .avatar-img {
        width: 40px;
        height: 40px;
    }

    .stat-card {
        margin-bottom: 1rem;
    }

    .table-responsive {
        font-size: 0.8rem;
    }

    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }

    .page-link {
        margin: 1px;
        font-size: 0.8rem;
        min-width: 32px;
        height: 32px;
    }
}
</style>
@endpush
