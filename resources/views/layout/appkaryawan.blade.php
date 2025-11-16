<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Absensi Karyawan')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --accent: #1abc9c;
            --light: #ecf0f1;
            --danger: #e74c3c;
            --warning: #f39c12;
            --success: #2ecc71;
            --gray: #95a5a6;
            --text: #333;
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 80px;
            --mobile-breakpoint: 768px;
            --tablet-breakpoint: 992px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f7fa;
            color: var(--text);
            overflow-x: hidden;
        }

        /* Sidebar Styles - Responsive */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(var(--secondary) 0%, #1a2530 100%);
            color: white;
            height: 100vh;
            position: fixed;
            transition: all 0.3s ease;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            transform: translateX(0);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 20px 15px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.2);
            min-height: 80px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .logo-icon {
            font-size: 24px;
            color: var(--accent);
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .toggle-btn {
            margin-left: auto;
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: transform 0.3s;
            flex-shrink: 0;
            padding: 5px;
        }

        .sidebar.collapsed .toggle-btn {
            transform: rotate(180deg);
        }

        .user-profile {
            padding: 20px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            color: white;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.2);
            flex-shrink: 0;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 12px;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar.collapsed .user-info {
            display: none;
        }

        .sidebar-menu {
            padding: 15px 0;
            flex: 1;
            overflow-y: auto;
        }

        .menu-section {
            margin-bottom: 10px;
        }

        .menu-title {
            font-size: 12px;
            color: var(--white);
            padding: 10px 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .sidebar.collapsed .menu-title {
            display: none;
        }

        .menu-items {
            list-style: none;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            text-decoration: none;
            color: white;
            white-space: nowrap;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-left-color: var(--accent);
        }

        .menu-item.active {
            background-color: rgba(26, 188, 156, 0.1);
            border-left-color: var(--accent);
            color: var(--accent);
        }

        .menu-icon {
            font-size: 18px;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
        }

        .menu-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar.collapsed .menu-text {
            display: none;
        }

        .badge {
            background-color: var(--danger);
            color: white;
            border-radius: 10px;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .menu-divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.1);
            margin: 10px 20px;
        }

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            background-color: rgba(231, 76, 60, 0.1);
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            white-space: nowrap;
        }

        .logout-btn:hover {
            background-color: rgba(255, 0, 0, 0.742);
        }

        .sidebar.collapsed .logout-btn span {
            display: none;
        }

        /* Header Styles - Responsive */
        .header {
            height: var(--header-height);
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 999;
            gap: 15px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            min-width: 0;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--secondary);
            cursor: pointer;
            padding: 8px;
            flex-shrink: 0;
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .action-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: var(--secondary);
            cursor: pointer;
            position: relative;
            transition: color 0.2s;
            padding: 8px;
            flex-shrink: 0;
        }

        .action-btn:hover {
            color: var(--primary);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background-color: var(--danger);
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 6px 10px;
            border-radius: 8px;
            transition: background-color 0.2s;
            flex-shrink: 0;
        }

        .user-menu:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .header-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .header-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .user-greeting {
            font-size: 11px;
            color: var(--white);
            white-space: nowrap;
        }

        .user-name-header {
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-arrow {
            font-size: 11px;
            color: var(--white);
            transition: transform 0.2s;
            flex-shrink: 0;
        }

        .user-menu.open .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Main Content - Responsive */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed);
            width: calc(100% - var(--sidebar-collapsed));
        }

        .main-content.full-width {
            margin-left: 0;
            width: 100%;
        }

        .content-area {
            padding: 20px;
            flex: 1;
            overflow-y: auto;
            min-height: calc(100vh - var(--header-height));
        }

        /* Overlay for Mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* ===== RESPONSIVE BREAKPOINTS ===== */

        /* Tablet Devices (768px - 991px) */
        @media (max-width: 991px) {
            .sidebar {
                width: var(--sidebar-collapsed);
                transform: translateX(-100%);
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
                width: var(--sidebar-width);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .user-details {
                display: none;
            }
            
            .header-actions {
                gap: 8px;
            }
            
            .action-btn {
                padding: 6px;
            }
            
            .content-area {
                padding: 15px;
            }
        }

        /* Mobile Devices (767px and below) */
        @media (max-width: 767px) {
            :root {
                --header-height: 60px;
            }
            
            .header {
                padding: 0 15px;
                height: var(--header-height);
            }
            
            .page-title {
                font-size: 16px;
            }
            
            .header-actions {
                gap: 5px;
            }
            
            .action-btn {
                font-size: 16px;
                padding: 6px;
            }
            
            .notification-badge {
                width: 14px;
                height: 14px;
                font-size: 9px;
                top: -1px;
                right: -1px;
            }
            
            .user-menu {
                padding: 4px 8px;
                gap: 6px;
            }
            
            .header-avatar {
                width: 32px;
                height: 32px;
            }
            
            .content-area {
                padding: 12px;
            }
            
            .sidebar.mobile-open {
                width: 85%;
                max-width: 300px;
            }
            
            /* Hide some action buttons on very small screens */
            .header-actions .action-btn:nth-child(2) {
                display: none;
            }
        }

        /* Small Mobile Devices (480px and below) */
        @media (max-width: 480px) {
            .header {
                padding: 0 10px;
            }
            
            .page-title {
                font-size: 15px;
            }
            
            .header-left {
                gap: 10px;
            }
            
            .mobile-menu-btn {
                padding: 6px;
            }
            
            .content-area {
                padding: 10px;
            }
            
            /* Hide user menu text on very small screens */
            .user-details {
                display: none;
            }
            
            .dropdown-arrow {
                display: none;
            }
            
            .header-actions .action-btn:nth-child(3) {
                display: none;
            }
        }

        /* Large Desktop (1200px and above) */
        @media (min-width: 1200px) {
            .sidebar {
                width: var(--sidebar-width);
            }
            
            .main-content {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }
        }

        /* Extra Large Desktop (1400px and above) */
        @media (min-width: 1400px) {
            .content-area {
                padding: 30px;
                max-width: 1400px;
                margin: 0 auto;
                width: 100%;
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .header {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .content-area {
                padding: 0;
            }
        }

        /* High DPI Screens */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .logo-icon, .menu-icon, .action-btn {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            .header {
                background:  linear-gradient(var(--secondary) 0%, #1a2530 100%);
                color: white;
            }
            
            .page-title {
                color: white;
            }
            
            .action-btn {
                color: #ccc;
            }
        }

        /* Touch Device Optimizations */
        @media (hover: none) and (pointer: coarse) {
            .menu-item:hover {
                background-color: transparent;
            }
            
            .menu-item:active {
                background-color: rgba(255, 255, 255, 0.05);
            }
            
            .action-btn {
                min-height: 44px;
                min-width: 44px;
            }
            
            .logout-btn {
                min-height: 44px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-fingerprint logo-icon"></i>
                <span class="logo-text">AbsensiKu</span>
            </div>
            <button class="toggle-btn" id="toggleBtn" aria-label="Toggle Sidebar">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        
        <div class="user-profile">
            <div class="avatar">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'John Doe' }}&background=1abc9c&color=fff" alt="User Avatar">
            </div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name ?? 'John Doe' }}</div>
                <div class="user-role">Karyawan - {{ Auth::user()->department ?? 'IT Department' }}</div>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-title">Menu Utama</div>
                <ul class="menu-items">
                    <li>
                        <a href="{{ url('/karyawan/dashboard') }}" class="menu-item {{ request()->is('karyawan/dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home menu-icon"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/karyawan/absensi') }}" class="menu-item {{ request()->is('karyawan/absensi') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check menu-icon"></i>
                            <span class="menu-text">Absensi / Presensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/karyawan/riwayat') }}" class="menu-item {{ request()->is('karyawan/riwayat') ? 'active' : '' }}">
                            <i class="fas fa-history menu-icon"></i>
                            <span class="menu-text">Riwayat Kehadiran</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="menu-divider"></div>
            
            <div class="menu-section">
                <div class="menu-title">Pengajuan</div>
                <ul class="menu-items">
                    <li>
                        <a href="{{ url('/karyawan/pengajuan') }}" class="menu-item {{ request()->is('karyawan/pengajuan') ? 'active' : '' }}">
                            <i class="fas fa-file-alt menu-icon"></i>
                            <span class="menu-text">Pengajuan Izin / Cuti</span>
                            <span class="badge">2</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="menu-divider"></div>
            
            <div class="menu-section">
                <div class="menu-title">Akun</div>
                <ul class="menu-items">
                    <li>
                        <a href="{{ url('/karyawan/profil') }}" class="menu-item {{ request()->is('karyawan/profil') ? 'active' : '' }}">
                            <i class="fas fa-user menu-icon"></i>
                            <span class="menu-text">Profil Karyawan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/karyawan/notifikasi') }}" class="menu-item {{ request()->is('karyawan/notifikasi') ? 'active' : '' }}">
                            <i class="fas fa-bell menu-icon"></i>
                            <span class="menu-text">Notifikasi</span>
                            <span class="badge">5</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle Menu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">@yield('page-title', 'Dashboard Karyawan')</h1>
            </div>
            
            <div class="header-right">
                <div class="header-actions">
                    <button class="action-btn" aria-label="Notifications">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <button class="action-btn" aria-label="Messages">
                        <i class="fas fa-envelope"></i>
                        <span class="notification-badge">5</span>
                    </button>
                    <button class="action-btn" aria-label="Settings">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
                
                <div class="user-menu" id="userMenu" role="button" aria-label="User Menu" tabindex="0">
                    <div class="header-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'John Doe' }}&background=1abc9c&color=fff" alt="User Avatar">
                    </div>
                    <div class="user-details">
                        <div class="user-greeting">Halo,</div>
                        <div class="user-name-header">{{ Auth::user()->name ?? 'John Doe' }}</div>
                    </div>
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                </div>
            </div>
        </header>
        
        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const userMenu = document.getElementById('userMenu');

        // Check if device is mobile
        function isMobile() {
            return window.innerWidth <= 991;
        }

        // Toggle sidebar
        function toggleSidebar() {
            if (isMobile()) {
                sidebar.classList.toggle('mobile-open');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('mobile-open') ? 'hidden' : '';
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                
                // Change icon based on state
                const icon = toggleBtn.querySelector('i');
                if (sidebar.classList.contains('collapsed')) {
                    icon.classList.remove('fa-chevron-left');
                    icon.classList.add('fa-chevron-right');
                } else {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-chevron-left');
                }
            }
        }

        // Close sidebar on mobile
        function closeMobileSidebar() {
            if (isMobile()) {
                sidebar.classList.remove('mobile-open');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Event Listeners
        toggleBtn.addEventListener('click', toggleSidebar);
        mobileMenuBtn.addEventListener('click', toggleSidebar);
        
        // Close sidebar when clicking overlay
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
        
        // Close sidebar when clicking menu items on mobile
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                if (isMobile()) {
                    closeMobileSidebar();
                }
            });
        });

        // User menu toggle
        userMenu.addEventListener('click', function() {
            this.classList.toggle('open');
        });

        // Keyboard navigation
        userMenu.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.classList.toggle('open');
            }
        });

        // Close sidebar when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isMobile() && sidebar.classList.contains('mobile-open')) {
                closeMobileSidebar();
            }
        });

        // Handle window resize
        function handleResize() {
            if (window.innerWidth > 991) {
                // Desktop - ensure sidebar is visible
                sidebar.classList.remove('mobile-open', 'mobile-hidden');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                // Mobile - ensure sidebar is hidden by default
                if (!sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.add('mobile-hidden');
                }
            }
        }

        // Initial setup
        handleResize();

        // Add resize listener
        window.addEventListener('resize', handleResize);

        // Touch gesture support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const swipeDistance = touchEndX - touchStartX;

            if (Math.abs(swipeDistance) > swipeThreshold) {
                if (swipeDistance > 0 && touchStartX <= 50 && isMobile()) {
                    // Swipe right from left edge - open sidebar
                    if (!sidebar.classList.contains('mobile-open')) {
                        toggleSidebar();
                    }
                } else if (swipeDistance < 0 && sidebar.classList.contains('mobile-open')) {
                    // Swipe left - close sidebar
                    closeMobileSidebar();
                }
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html>