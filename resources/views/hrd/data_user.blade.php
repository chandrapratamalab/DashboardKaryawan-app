@extends('layout.apphrd')

@section('title', 'Manajemen User - HRD System')

@section('page-title', 'Manajemen Pengguna')

@php
    // Handle undefined variables dengan aman
    $users = $users ?? collect([]);
    $totalUsers = $totalUsers ?? 0;
    $activeUsers = $activeUsers ?? 0;
    $adminCount = $adminCount ?? 0;
    $hrdCount = $hrdCount ?? 0;
    $karyawanCount = $karyawanCount ?? 0;
    $unverifiedCount = $unverifiedCount ?? 0;
    $newThisMonth = $newThisMonth ?? 0;
@endphp

@section('content')
<div class="container-fluid">
    <!-- Header dengan Gradient -->
    <div class="card border-0 custom-gradient mb-4">
        <div class="card-body py-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="avatar-container me-4">
                            <div class="avatar-circle bg-white text-primary">
                                <i class="bi bi-people-fill fs-3"></i>
                            </div>
                        </div>
                        <div class="text-white">
                            <h1 class="h2 mb-2 fw-bold">Manajemen Pengguna</h1>
                            <p class="mb-0 opacity-90">Kelola data pengguna dan akses sistem dengan mudah dan efisien</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-3 justify-content-end">
                        <button class="btn btn-light btn-refresh" id="refresh-btn" title="Refresh Data">
                            <i class="bi bi-arrow-clockwise me-2"></i>Refresh
                        </button>
                        <button class="btn btn-white btn-add-user" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="bi bi-person-plus me-2"></i>Tambah User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards dengan 4 Card berdasarkan 3 Role -->
    <div class="row g-4 mb-4">
        <!-- Total Users -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card card-hover border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="stat-badge bg-primary bg-opacity-10 text-primary mb-2">Total User</span>
                            <h2 class="text-primary mb-1 fw-bold">{{ $totalUsers }}</h2>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-2">
                                    <i class="bi bi-arrow-up-short"></i>{{ $activeUsers }}
                                </span>
                                <span class="text-muted small">aktif</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-primary">
                                <i class="bi bi-people text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Admin -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card card-hover border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="stat-badge bg-danger bg-opacity-10 text-danger mb-2">Administrator</span>
                            <h2 class="text-danger mb-1 fw-bold">{{ $adminCount }}</h2>
                            <div class="text-muted small">Akses penuh sistem</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-danger">
                                <i class="bi bi-shield-check text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- HRD -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card card-hover border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="stat-badge bg-warning bg-opacity-10 text-warning mb-2">HR Department</span>
                            <h2 class="text-warning mb-1 fw-bold">{{ $hrdCount }}</h2>
                            <div class="text-muted small">Manajemen karyawan</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-warning">
                                <i class="bi bi-person-badge text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Karyawan -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card card-hover border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="stat-badge bg-success bg-opacity-10 text-success mb-2">Karyawan</span>
                            <h2 class="text-success mb-1 fw-bold">{{ $karyawanCount }}</h2>
                            <div class="text-muted small">Staff perusahaan</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="stat-icon bg-success">
                                <i class="bi bi-person-vcard text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <div class="alert-icon me-3">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="flex-grow-1">
                <strong class="fw-semibold">Sukses!</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="card-title mb-0 text-dark fw-semibold">
                        <i class="bi bi-list-ul me-2 text-primary"></i>
                        Daftar Pengguna Sistem
                        <span class="badge bg-primary bg-opacity-10 text-primary ms-2" id="user-counter">{{ $users->count() }}</span>
                    </h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <!-- Search Box -->
                        <div class="search-box position-relative">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text" class="form-control search-input ps-4" placeholder="Cari nama, email, atau username..." id="search-input">
                            <div class="search-actions">
                                <button class="btn btn-sm btn-link text-muted clear-search" type="button" style="display: none;">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Filter Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-funnel me-2"></i>
                                <span>Filter</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><h6 class="dropdown-header">Status Akun</h6></li>
                                <li><a class="dropdown-item filter-option active" href="#" data-filter="all">Semua User</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="active">Aktif</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="inactive">Nonaktif</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><h6 class="dropdown-header">Role User</h6></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="admin">Administrator</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="hrd">HR Department</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="karyawan">Karyawan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <!-- Users Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3" style="width: 25%;">
                                <div class="d-flex align-items-center">
                                    <span>User Profile</span>
                                    <i class="bi bi-arrow-down-up text-muted ms-1 small"></i>
                                </div>
                            </th>
                            <th class="py-3" style="width: 20%;">Kontak</th>
                            <th class="py-3" style="width: 15%;">Role</th>
                            <th class="py-3" style="width: 15%;">Status</th>
                            <th class="py-3" style="width: 15%;">Bergabung</th>
                            <th class="text-center py-3" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="user-row animate-fade-in" data-user-id="{{ $user->id }}" data-status="{{ $user->is_active ? 'active' : 'inactive' }}" data-role="{{ $user->role }}">
                            <!-- User Profile -->
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3 position-relative">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=ffffff&bold=true&size=48" 
                                             alt="{{ $user->name }}" class="avatar-img rounded-circle shadow-sm">
                                        <div class="user-status-indicator {{ $user->is_active ? 'online' : 'offline' }}"></div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 user-name fw-semibold text-dark">{{ $user->name }}</h6>
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
                                        <span class="contact-email text-truncate small">{{ $user->email }}</span>
                                    </div>
                                    @if($user->phone)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-phone me-2 text-success contact-icon"></i>
                                        <span class="contact-phone small">{{ $user->phone }}</span>
                                    </div>
                                    @endif
                                    <div class="mt-2">
                                        @if($user->email_verified_at)
                                        <span class="badge verified-badge small">
                                            <i class="bi bi-patch-check-fill me-1"></i>Terverifikasi
                                        </span>
                                        @else
                                        <span class="badge unverified-badge small">
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
                                        'admin' => ['color' => 'danger', 'icon' => 'shield-check', 'label' => 'Administrator'],
                                        'hrd' => ['color' => 'warning', 'icon' => 'person-badge', 'label' => 'HR Department'],
                                        'karyawan' => ['color' => 'success', 'icon' => 'person-vcard', 'label' => 'Karyawan']
                                    ];
                                    $config = $roleConfig[$user->role] ?? $roleConfig['karyawan'];
                                @endphp
                                <span class="role-badge bg-{{ $config['color'] }} bg-opacity-10 text-{{ $config['color'] }} border-0 px-3 py-2">
                                    <i class="bi bi-{{ $config['icon'] }} me-2"></i>
                                    {{ $config['label'] }}
                                </span>
                            </td>
                            
                            <!-- Status -->
                            <td>
                                <span class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }} border-0 px-3 py-2">
                                    <i class="bi bi-circle-fill me-2 small {{ $user->is_active ? 'text-success' : 'text-secondary' }}"></i>
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            
                            <!-- Tanggal Bergabung -->
                            <td>
                                <div class="join-date">
                                    <div class="date-main fw-semibold text-dark">{{ $user->created_at->format('d M Y') }}</div>
                                    <div class="date-time text-muted small">{{ $user->created_at->format('H:i') }}</div>
                                    <div class="date-ago text-muted smaller">
                                        <i class="bi bi-clock-history me-1"></i>
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Aksi -->
                            <td>
                                <div class="action-buttons d-flex justify-content-center">
                                    <button class="btn btn-sm btn-icon btn-outline-primary btn-edit me-1" 
                                            data-bs-toggle="tooltip" 
                                            title="Edit User"
                                            onclick="editUser({{ $user->id }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-outline-info btn-view me-1" 
                                            data-bs-toggle="tooltip" 
                                            title="Lihat Detail"
                                            onclick="viewUser({{ $user->id }})">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle" 
                                                data-bs-toggle="dropdown"
                                                title="Lainnya">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
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
                                                    <i class="bi bi-trash me-2"></i>Hapus User
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
                                    <div class="empty-icon mb-4">
                                        <i class="bi bi-people display-1 text-muted opacity-25"></i>
                                    </div>
                                    <h4 class="empty-title text-muted mb-3">Belum ada data user</h4>
                                    <p class="empty-description text-muted mb-4">Mulai dengan menambahkan user pertama ke dalam sistem</p>
                                    <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#userModal">
                                        <i class="bi bi-person-plus me-2"></i>Tambah User Pertama
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(isset($users) && method_exists($users, 'links') && $users->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="text-muted small">
                            Menampilkan <strong>{{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}</strong> 
                            dari <strong>{{ $users->total() }}</strong> user
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            {{ $users->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @elseif($users->count() > 0)
            <div class="card-footer bg-white border-top py-3">
                <div class="text-center text-muted small">
                    Total <strong>{{ $users->count() }}</strong> user ditemukan
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modals -->
<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="userModalLabel">Tambah User Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="userForm" method="POST">
                @csrf
                <div id="form-method"></div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan username">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="email@company.com">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="08123456789">
                        </div>
                        <div class="col-md-6" id="password-field">
                            <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Minimal 8 karakter">
                        </div>
                        <div class="col-md-6" id="password-confirm-field">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password">
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="karyawan">Karyawan</option>
                                <option value="hrd">HR Department</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Akun</label>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submit-btn">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title fw-semibold">Reset Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="resetPasswordForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-semibold">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password" name="password" required placeholder="Masukkan password baru">
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="password_confirmation" required placeholder="Konfirmasi password baru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeUserManagement();
});

function initializeUserManagement() {
    // Search functionality
    const searchInput = document.getElementById('search-input');
    const userRows = document.querySelectorAll('.user-row');
    const clearSearchBtn = document.querySelector('.clear-search');
    
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function(e) {
            const searchTerm = e.target.value.toLowerCase();
            let visibleCount = 0;
            
            userRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const isVisible = text.includes(searchTerm);
                row.style.display = isVisible ? '' : 'none';
                if (isVisible) visibleCount++;
            });
            
            // Update counter
            const counter = document.getElementById('user-counter');
            if (counter) {
                counter.textContent = visibleCount;
            }
            
            // Show/hide clear button
            if (clearSearchBtn) {
                clearSearchBtn.style.display = searchTerm ? 'block' : 'none';
            }
        }, 300));
        
        // Clear search
        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
                this.style.display = 'none';
            });
        }
    }

    // Filter functionality
    document.querySelectorAll('.filter-option').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.getAttribute('data-filter');
            
            // Update active state
            document.querySelectorAll('.filter-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            let visibleCount = 0;
            userRows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                    visibleCount++;
                } else if (filter === 'active' || filter === 'inactive') {
                    const show = row.getAttribute('data-status') === filter;
                    row.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                } else {
                    const show = row.getAttribute('data-role') === filter;
                    row.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                }
            });
            
            // Update counter
            const counter = document.getElementById('user-counter');
            if (counter) {
                counter.textContent = visibleCount;
            }
        });
    });

    // Refresh button animation
    const refreshBtn = document.getElementById('refresh-btn');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            this.classList.add('rotating');
            setTimeout(() => {
                window.location.reload();
            }, 800);
        });
    }

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Debounce function
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

// Basic function implementations
function editUser(userId) {
    alert('Edit user: ' + userId + '\nFitur akan diimplementasikan');
}

function viewUser(userId) {
    alert('Lihat detail user: ' + userId + '\nFitur akan diimplementasikan');
}

function resetPassword(userId) {
    const modal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
    
    document.getElementById('resetPasswordForm').onsubmit = function(e) {
        e.preventDefault();
        alert('Reset password untuk user: ' + userId + '\nFitur akan diimplementasikan');
        modal.hide();
    };
    
    modal.show();
}

function toggleStatus(userId) {
    if (confirm('Apakah Anda yakin ingin mengubah status user?')) {
        alert('Toggle status untuk user: ' + userId + '\nFitur akan diimplementasikan');
    }
}

function confirmDelete(userId, userName) {
    if (confirm(`Apakah Anda yakin ingin menghapus user "${userName}"? Tindakan ini tidak dapat dibatalkan.`)) {
        alert('Hapus user: ' + userId + '\nFitur akan diimplementasikan');
    }
}
</script>
@endpush

@push('styles')
<style>
/* Custom CSS untuk UI/UX yang lebih menarik */

/* Gradient Background */
.custom-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

/* Card Hover Effects */
.card-hover {
    transition: all 0.3s ease;
    cursor: pointer;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

/* Stat Cards */
.stat-card {
    border-radius: 12px;
    overflow: hidden;
}

.stat-badge {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

/* Avatar Styles */
.avatar-container {
    position: relative;
}

.avatar-circle {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.user-avatar {
    position: relative;
}

.avatar-img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.user-row:hover .avatar-img {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.user-status-indicator {
    position: absolute;
    bottom: 3px;
    right: 3px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    transition: all 0.3s ease;
}

.user-status-indicator.online {
    background: #28a745;
    box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.3);
}

.user-status-indicator.offline {
    background: #6c757d;
}

/* Badge Improvements */
.verified-badge {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #065f46;
    border-radius: 12px;
    padding: 4px 8px;
    font-size: 0.75rem;
    font-weight: 500;
}

.unverified-badge {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border-radius: 12px;
    padding: 4px 8px;
    font-size: 0.75rem;
    font-weight: 500;
}

.role-badge, .status-badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
}

.role-badge:hover, .status-badge:hover {
    transform: scale(1.05);
}

/* Action Buttons */
.action-buttons .btn-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.action-buttons .btn-icon:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Search Box Improvements */
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
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.1);
    transform: translateY(-1px);
}

.search-actions {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
}

.clear-search {
    padding: 2px 6px;
    border-radius: 50%;
    font-size: 0.8rem;
}

/* Table Improvements */
.table {
    font-size: 0.875rem;
    margin: 0;
}

.table th {
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    background-color: #f8f9fa;
    color: #495057;
}

.table td {
    padding: 16px 8px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
    transition: all 0.3s ease;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.002);
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* Empty State */
.empty-state {
    padding: 3rem 2rem;
    text-align: center;
}

.empty-icon {
    color: #d1d5db;
    margin-bottom: 1.5rem;
}

.empty-title {
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.empty-description {
    color: #6b7280;
    font-size: 0.9rem;
    max-width: 400px;
    margin: 0 auto 1.5rem;
}

/* Animations */
.rotating {
    animation: rotate 1s ease;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Modal Improvements */
.modal-content {
    border-radius: 12px;
    border: none;
}

.modal-header {
    border-radius: 12px 12px 0 0;
    padding: 1.5rem;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    border-radius: 0 0 12px 12px;
    padding: 1.5rem;
}

/* Button Improvements */
.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-white {
    background: white;
    color: #6366f1;
    border: 1px solid white;
}

.btn-white:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Text Sizes */
.smaller {
    font-size: 0.7rem;
}

/* Custom Colors */
.bg-purple {
    background-color: #8b5cf6 !important;
}

.text-purple {
    color: #8b5cf6 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding: 15px;
    }
    
    .search-box {
        min-width: 100%;
        margin-bottom: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .action-buttons .btn-icon {
        width: 28px;
        height: 28px;
        font-size: 0.8rem;
    }
    
    .avatar-img {
        width: 40px;
        height: 40px;
    }
    
    .table-responsive {
        font-size: 0.8rem;
    }
    
    .role-badge, .status-badge {
        padding: 4px 8px;
        font-size: 0.7rem;
    }
}

/* Scrollbar Styling */
.table-responsive::-webkit-scrollbar {
    height: 6px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
@endpush