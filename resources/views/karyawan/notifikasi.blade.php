@extends('layout.appkaryawan')

@section('title', 'Notifikasi - Sistem Absensi Karyawan')

@section('page-title', 'Notifikasi')

@section('content')
<div class="notifications-container">
    <div class="notifications-header">
        <div class="header-content">
            <h2>Notifikasi Saya</h2>
            <div class="header-actions">
                <button class="btn-early mark-all-read" id="markAllRead">
                    <i class="fas fa-check-double"></i>
                    Tandai Semua Sudah Dibaca
                </button>
                <button class="btn-early filter-btn" id="filterBtn">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
            </div>
        </div>
        <div class="stats-bar">
            <div class="stat-item">
                <span class="stat-count">{{ $unreadCount ?? 5 }}</span>
                <span class="stat-label">Belum Dibaca</span>
            </div>
            <div class="stat-item">
                <span class="stat-count">{{ $totalCount ?? 12 }}</span>
                <span class="stat-label">Total Notifikasi</span>
            </div>
        </div>
    </div>

    <div class="notifications-content">
        <div class="notifications-list" id="notificationsList">
            <!-- Notifikasi akan dimuat di sini -->
            <div class="notification-item unread" data-id="1">
                <div class="notification-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">
                        <span class="title-text">Pengajuan Cuti Disetujui</span>
                        <span class="notification-time">2 jam yang lalu</span>
                    </div>
                    <div class="notification-message">
                        Pengajuan cuti tanggal 15-17 Juni 2023 telah disetujui oleh atasan Anda.
                    </div>
                    <div class="notification-actions">
                        <button class="action-link mark-read">Tandai Sudah Dibaca</button>
                        <button class="action-link delete-notif">Hapus</button>
                    </div>
                </div>
                <div class="notification-status">
                    <span class="unread-indicator"></span>
                </div>
            </div>

            <div class="notification-item" data-id="2">
                <div class="notification-icon info">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">
                        <span class="title-text">Pengingat Absensi</span>
                        <span class="notification-time">Kemarin, 08:45</span>
                    </div>
                    <div class="notification-message">
                        Anda belum melakukan absensi masuk hari ini. Jangan lupa untuk melakukan absensi sebelum pukul 09:00.
                    </div>
                    <div class="notification-actions">
                        <button class="action-link mark-unread">Tandai Belum Dibaca</button>
                        <button class="action-link delete-notif">Hapus</button>
                    </div>
                </div>
                <div class="notification-status">
                    <span class="read-indicator"></span>
                </div>
            </div>

            <div class="notification-item unread" data-id="3">
                <div class="notification-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">
                        <span class="title-text">Perubahan Jadwal Kerja</span>
                        <span class="notification-time">2 hari yang lalu</span>
                    </div>
                    <div class="notification-message">
                        Terdapat perubahan jadwal kerja untuk hari Jumat, 16 Juni 2023. Silakan periksa jadwal terbaru di aplikasi.
                    </div>
                    <div class="notification-actions">
                        <button class="action-link mark-read">Tandai Sudah Dibaca</button>
                        <button class="action-link delete-notif">Hapus</button>
                    </div>
                </div>
                <div class="notification-status">
                    <span class="unread-indicator"></span>
                </div>
            </div>

            <div class="notification-item" data-id="4">
                <div class="notification-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">
                        <span class="title-text">Penggajian Bulan Ini</span>
                        <span class="notification-time">5 hari yang lalu</span>
                    </div>
                    <div class="notification-message">
                        Gaji untuk bulan Mei 2023 telah ditransfer ke rekening Anda. Silakan periksa detailnya di menu penggajian.
                    </div>
                    <div class="notification-actions">
                        <button class="action-link mark-unread">Tandai Belum Dibaca</button>
                        <button class="action-link delete-notif">Hapus</button>
                    </div>
                </div>
                <div class="notification-status">
                    <span class="read-indicator"></span>
                </div>
            </div>

            <div class="notification-item unread" data-id="5">
                <div class="notification-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">
                        <span class="title-text">Pengumuman Perusahaan</span>
                        <span class="notification-time">1 minggu yang lalu</span>
                    </div>
                    <div class="notification-message">
                        Akan diadakan rapat seluruh karyawan pada hari Jumat, 23 Juni 2023 pukul 14:00 di aula utama.
                    </div>
                    <div class="notification-actions">
                        <button class="action-link mark-read">Tandai Sudah Dibaca</button>
                        <button class="action-link delete-notif">Hapus</button>
                    </div>
                </div>
                <div class="notification-status">
                    <span class="unread-indicator"></span>
                </div>
            </div>
        </div>

        <div class="notifications-sidebar">
            <div class="sidebar-section">
                <h3>Filter Notifikasi</h3>
                <div class="filter-options">
                    <div class="filter-option">
                        <input type="checkbox" id="filter-unread" checked>
                        <label for="filter-unread">Belum Dibaca</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="filter-read" checked>
                        <label for="filter-read">Sudah Dibaca</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="filter-important" checked>
                        <label for="filter-important">Penting</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="filter-general" checked>
                        <label for="filter-general">Umum</label>
                    </div>
                </div>
            </div>

            <div class="sidebar-section">
                <h3>Kategori</h3>
                <div class="category-list">
                    <div class="category-item active" data-category="all">
                        <i class="fas fa-inbox"></i>
                        <span>Semua Notifikasi</span>
                        <span class="category-count">12</span>
                    </div>
                    <div class="category-item" data-category="attendance">
                        <i class="fas fa-calendar-check"></i>
                        <span>Absensi</span>
                        <span class="category-count">4</span>
                    </div>
                    <div class="category-item" data-category="leave">
                        <i class="fas fa-umbrella-beach"></i>
                        <span>Cuti & Izin</span>
                        <span class="category-count">3</span>
                    </div>
                    <div class="category-item" data-category="announcement">
                        <i class="fas fa-bullhorn"></i>
                        <span>Pengumuman</span>
                        <span class="category-count">2</span>
                    </div>
                    <div class="category-item" data-category="payroll">
                        <i class="fas fa-money-check-alt"></i>
                        <span>Penggajian</span>
                        <span class="category-count">2</span>
                    </div>
                    <div class="category-item" data-category="system">
                        <i class="fas fa-cog"></i>
                        <span>Sistem</span>
                        <span class="category-count">1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Hapus Notifikasi</h3>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus notifikasi ini? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" id="cancelDelete">Batal</button>
            <button class="btn btn-danger" id="confirmDelete">Hapus</button>
        </div>
    </div>
</div>

<style>
    /* Notifications Container */
    .notifications-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 10px;
    }

    /* Notifications Header */
    .notifications-header {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #f0f0f0;
    }

    .notifications-header h2 {
        font-size: 24px;
        font-weight: 700;
        color: var(--secondary);
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 12px;
    }

    .btn-early {
        background: var(--primary);
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px;
        border: none;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .action-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px;
        background: none;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
            color: var(--primary);
        }

    .action-btn.filter-btn {
        background: white;
        color: var(--secondary);
        border: 1px solid #e0e0e0;
    }

    .action-btn.filter-btn:hover {
        background: #f8f9fa;
        border-color: var(--primary);
    }

    /* Stats Bar */
    .stats-bar {
        display: flex;
        padding: 16px 24px;
        background: #f8f9fa;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0 20px;
        border-right: 1px solid #e0e0e0;
    }

    .stat-item:last-child {
        border-right: none;
    }

    .stat-count {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
    }

    .stat-label {
        font-size: 14px;
        color: var(--gray);
        margin-top: 4px;
    }

    /* Notifications Content */
    .notifications-content {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 24px;
    }

    /* Notifications List */
    .notifications-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .notification-item {
        display: flex;
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
        position: relative;
    }

    .notification-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .notification-item.unread {
        border-left-color: var(--primary);
        background: #f8fbff;
    }

    .notification-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        flex-shrink: 0;
        background: var(--primary);
        color: white;
        font-size: 20px;
    }

    .notification-icon.info {
        background: var(--primary);
    }

    .notification-icon.warning {
        background: var(--warning);
    }

    .notification-icon.success {
        background: var(--success);
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-title {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .title-text {
        font-weight: 600;
        font-size: 16px;
        color: var(--secondary);
    }

    .notification-time {
        font-size: 12px;
        color: var(--gray);
        white-space: nowrap;
        margin-left: 12px;
    }

    .notification-message {
        color: var(--text);
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .notification-actions {
        display: flex;
        gap: 16px;
    }

    .action-link {
        background: none;
        border: none;
        color: var(--primary);
        font-size: 13px;
        cursor: pointer;
        padding: 0;
        transition: color 0.2s;
    }

    .action-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .notification-status {
        display: flex;
        align-items: flex-start;
        margin-left: 12px;
    }

    .unread-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary);
        display: block;
    }

    .read-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--gray);
        display: block;
        margin: 2px;
    }

    /* Notifications Sidebar */
    .notifications-sidebar {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        height: fit-content;
        position: sticky;
        top: 100px;
    }

    .sidebar-section {
        margin-bottom: 24px;
    }

    .sidebar-section:last-child {
        margin-bottom: 0;
    }

    .sidebar-section h3 {
        font-size: 16px;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f0f0f0;
    }

    .filter-options {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-option input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
    }

    .filter-option label {
        font-size: 14px;
        color: var(--text);
        cursor: pointer;
    }

    .category-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        color: var(--text);
        text-decoration: none;
    }

    .category-item:hover {
        background: #f8f9fa;
    }

    .category-item.active {
        background: var(--primary);
        color: white;
    }

    .category-item i {
        width: 20px;
        text-align: center;
        font-size: 16px;
    }

    .category-item span:not(.category-count) {
        flex: 1;
        font-size: 14px;
    }

    .category-count {
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
    }

    .category-item.active .category-count {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1100;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #f0f0f0;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 18px;
        color: var(--secondary);
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--gray);
        transition: color 0.2s;
    }

    .close-modal:hover {
        color: var(--secondary);
    }

    .modal-body {
        padding: 20px 24px;
    }

    .modal-body p {
        margin: 0;
        color: var(--text);
        line-height: 1.5;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 16px 24px;
        border-top: 1px solid #f0f0f0;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary {
        background: #f8f9fa;
        color: var(--text);
    }

    .btn-secondary:hover {
        background: #e9ecef;
    }

    .btn-danger {
        background: var(--danger);
        color: white;
    }

    .btn-danger:hover {
        background: #c0392b;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .empty-state i {
        font-size: 64px;
        color: var(--gray);
        margin-bottom: 16px;
    }

    .empty-state h3 {
        font-size: 20px;
        color: var(--secondary);
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--gray);
        margin-bottom: 24px;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .notifications-content {
            grid-template-columns: 1fr;
        }
        
        .notifications-sidebar {
            position: static;
            order: -1;
        }
        
        .header-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }
        
        .header-actions {
            width: 100%;
            justify-content: space-between;
        }
        
        .action-btn {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 767px) {
        .notification-item {
            flex-direction: column;
        }
        
        .notification-icon {
            margin-right: 0;
            margin-bottom: 12px;
        }
        
        .notification-status {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        
        .notification-title {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .notification-time {
            margin-left: 0;
            margin-top: 4px;
        }
        
        .stats-bar {
            flex-direction: column;
            gap: 12px;
        }
        
        .stat-item {
            border-right: none;
            border-bottom: 1px solid #e0e0e0;
            padding: 8px 0;
        }
        
        .stat-item:last-child {
            border-bottom: none;
        }
    }

    @media (max-width: 480px) {
        .notifications-header h2 {
            font-size: 20px;
        }
        
        .action-btn span {
            display: none;
        }
        
        .action-btn {
            padding: 10px;
        }
        
        .notification-actions {
            flex-direction: column;
            gap: 8px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const notificationsList = document.getElementById('notificationsList');
        const markAllReadBtn = document.getElementById('markAllRead');
        const filterBtn = document.getElementById('filterBtn');
        const deleteModal = document.getElementById('deleteModal');
        const closeModal = document.getElementById('closeModal');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');
        const categoryItems = document.querySelectorAll('.category-item');
        const filterOptions = document.querySelectorAll('.filter-options input');
        
        // Mark all as read
        markAllReadBtn.addEventListener('click', function() {
            const unreadNotifications = document.querySelectorAll('.notification-item.unread');
            
            unreadNotifications.forEach(notification => {
                notification.classList.remove('unread');
                
                // Update status indicator
                const statusIndicator = notification.querySelector('.notification-status');
                statusIndicator.innerHTML = '<span class="read-indicator"></span>';
                
                // Update action buttons
                const actions = notification.querySelector('.notification-actions');
                actions.innerHTML = `
                    <button class="action-link mark-unread">Tandai Belum Dibaca</button>
                    <button class="action-link delete-notif">Hapus</button>
                `;
                
                // Reattach event listeners
                attachEventListenersToNotification(notification);
            });
            
            // Update stats
            updateNotificationStats();
            
            // Show confirmation
            showToast('Semua notifikasi telah ditandai sebagai sudah dibaca');
        });
        
        // Filter button functionality
        filterBtn.addEventListener('click', function() {
            // In a real app, this would toggle filter options visibility
            // For this example, we'll just show a message
            showToast('Filter options would be displayed here');
        });
        
        // Category filtering
        categoryItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                categoryItems.forEach(i => i.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                const category = this.getAttribute('data-category');
                
                // In a real app, this would filter notifications by category
                // For this example, we'll just show a message
                showToast(`Memfilter notifikasi berdasarkan kategori: ${category}`);
            });
        });
        
        // Filter options
        filterOptions.forEach(option => {
            option.addEventListener('change', function() {
                // In a real app, this would apply the selected filters
                // For this example, we'll just show a message
                showToast('Filter diterapkan');
            });
        });
        
        // Modal functionality
        let notificationToDelete = null;
        
        // Function to open delete modal
        function openDeleteModal(notification) {
            notificationToDelete = notification;
            deleteModal.classList.add('active');
        }
        
        // Function to close delete modal
        function closeDeleteModal() {
            deleteModal.classList.remove('active');
            notificationToDelete = null;
        }
        
        // Close modal events
        closeModal.addEventListener('click', closeDeleteModal);
        cancelDelete.addEventListener('click', closeDeleteModal);
        
        // Confirm delete
        confirmDelete.addEventListener('click', function() {
            if (notificationToDelete) {
                // Add fade out animation
                notificationToDelete.style.opacity = '0';
                notificationToDelete.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    notificationToDelete.remove();
                    updateNotificationStats();
                    showToast('Notifikasi berhasil dihapus');
                }, 300);
            }
            
            closeDeleteModal();
        });
        
        // Close modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                closeDeleteModal();
            }
        });
        
        // Function to attach event listeners to a notification
        function attachEventListenersToNotification(notification) {
            const markReadBtn = notification.querySelector('.mark-read');
            const markUnreadBtn = notification.querySelector('.mark-unread');
            const deleteBtn = notification.querySelector('.delete-notif');
            
            if (markReadBtn) {
                markReadBtn.addEventListener('click', function() {
                    notification.classList.remove('unread');
                    
                    // Update status indicator
                    const statusIndicator = notification.querySelector('.notification-status');
                    statusIndicator.innerHTML = '<span class="read-indicator"></span>';
                    
                    // Update action buttons
                    const actions = notification.querySelector('.notification-actions');
                    actions.innerHTML = `
                        <button class="action-link mark-unread">Tandai Belum Dibaca</button>
                        <button class="action-link delete-notif">Hapus</button>
                    `;
                    
                    // Reattach event listeners
                    attachEventListenersToNotification(notification);
                    
                    updateNotificationStats();
                    showToast('Notifikasi ditandai sebagai sudah dibaca');
                });
            }
            
            if (markUnreadBtn) {
                markUnreadBtn.addEventListener('click', function() {
                    notification.classList.add('unread');
                    
                    // Update status indicator
                    const statusIndicator = notification.querySelector('.notification-status');
                    statusIndicator.innerHTML = '<span class="unread-indicator"></span>';
                    
                    // Update action buttons
                    const actions = notification.querySelector('.notification-actions');
                    actions.innerHTML = `
                        <button class="action-link mark-read">Tandai Sudah Dibaca</button>
                        <button class="action-link delete-notif">Hapus</button>
                    `;
                    
                    // Reattach event listeners
                    attachEventListenersToNotification(notification);
                    
                    updateNotificationStats();
                    showToast('Notifikasi ditandai sebagai belum dibaca');
                });
            }
            
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    openDeleteModal(notification);
                });
            }
        }
        
        // Attach event listeners to all existing notifications
        document.querySelectorAll('.notification-item').forEach(notification => {
            attachEventListenersToNotification(notification);
        });
        
        // Function to update notification stats
        function updateNotificationStats() {
            const unreadCount = document.querySelectorAll('.notification-item.unread').length;
            const totalCount = document.querySelectorAll('.notification-item').length;
            
            // Update stats display
            document.querySelector('.stat-count').textContent = unreadCount;
            
            // In a real app, you would update both counts
            // For this example, we're just updating the unread count
        }
        
        // Function to show toast message
        function showToast(message) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast-message';
            toast.textContent = message;
            toast.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: var(--secondary);
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1200;
                animation: toastSlideIn 0.3s ease;
                max-width: 300px;
            `;
            
            // Add to page
            document.body.appendChild(toast);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'toastSlideOut 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }
        
        // Add CSS for toast animations
        const toastStyles = document.createElement('style');
        toastStyles.textContent = `
            @keyframes toastSlideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes toastSlideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(toastStyles);
    });
</script>
@endsection