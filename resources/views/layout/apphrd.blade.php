<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard HRD - Sistem Manajemen Shift')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-light: #60a5fa;
            --secondary-color: #1e293b;
            --secondary-light: #334155;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-light: #e2e8f0;
            --text-lighter: #94a3b8;
            --text-dark: #1e293b;
            --hover-color: #334155;
            --active-color: #3b82f6;
            --sidebar-width: 280px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles - Optimized for space */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, var(--secondary-color) 0%, #0f172a 100%);
            color: white;
            padding: 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(30, 41, 59, 0.95);
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }
        
        .sidebar-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .logo-text h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 2px;
            color: white;
            line-height: 1.2;
        }
        
        .logo-text p {
            font-size: 0.7rem;
            color: var(--text-lighter);
            margin: 0;
            opacity: 0.8;
        }
        
        .sidebar-menu {
            flex: 1;
            padding: 15px 0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        
        .menu-section {
            padding: 0 12px;
            margin-bottom: 20px;
        }
        
        .menu-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--text-lighter);
            margin-bottom: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 0 8px;
            opacity: 0.7;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
            background: transparent;
            font-size: 0.9rem;
            cursor: pointer;
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            border-radius: 0 4px 4px 0;
        }
        
        .menu-item::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            transition: all 0.4s ease;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        
        /* Hover State - Optimized */
        .menu-item:hover {
            background: linear-gradient(135deg, rgba(51, 65, 85, 0.8), rgba(30, 41, 59, 0.6));
            color: white;
            transform: translateX(6px);
            border-color: rgba(59, 130, 246, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .menu-item:hover::before {
            transform: scaleX(1);
        }
        
        .menu-item:hover::after {
            width: 100%;
            height: 100%;
        }
        
        .menu-item:hover i {
            transform: scale(1.05);
            color: var(--primary-light);
        }
        
        /* Active State - Optimized */
        .menu-item.active {
            background: linear-gradient(135deg, var(--active-color), var(--primary-light));
            color: white;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.3);
            transform: translateX(6px) scale(1.01);
            position: relative;
            z-index: 1;
        }
        
        .menu-item.active::before {
            transform: scaleX(1);
            background: white;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
        }
        
        .menu-item.active::after {
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
        }
        
        .menu-item.active i {
            transform: scale(1.1);
            color: white;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
        }
        
        .menu-item i {
            width: 18px;
            margin-right: 10px;
            font-size: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }
        
        .menu-item span {
            position: relative;
            z-index: 2;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .menu-item.active span {
            font-weight: 600;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
        }
        
        .menu-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }
        
        .menu-item.active .menu-arrow {
            transform: rotate(90deg);
        }
        
        /* Submenu Styles - Compact */
        .submenu {
            margin-left: 18px;
            border-left: 1px solid rgba(255, 255, 255, 0.1);
            padding-left: 8px;
            margin-top: 3px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }
        
        .submenu.open {
            max-height: 200px;
        }
        
        .submenu-item {
            display: flex;
            align-items: center;
            color: var(--text-lighter);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 2px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
            background: transparent;
            font-size: 0.85rem;
        }
        
        .submenu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2px;
            background: var(--accent-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            border-radius: 0 4px 4px 0;
        }
        
        .submenu-item:hover {
            background: linear-gradient(135deg, rgba(51, 65, 85, 0.6), rgba(30, 41, 59, 0.4));
            color: white;
            transform: translateX(4px);
            border-color: rgba(245, 158, 11, 0.2);
        }
        
        .submenu-item:hover::before {
            transform: scaleX(1);
        }
        
        .submenu-item.active {
            background: linear-gradient(135deg, var(--accent-color), #fbbf24);
            color: white;
            box-shadow: 0 3px 12px rgba(245, 158, 11, 0.3);
            border-color: rgba(245, 158, 11, 0.3);
            transform: translateX(4px);
        }
        
        .submenu-item.active::before {
            transform: scaleX(1);
            background: white;
        }
        
        .submenu-item i {
            width: 16px;
            margin-right: 8px;
            font-size: 0.9rem;
        }
        
        /* Sidebar Footer with Logout - Compact */
        .sidebar-footer {
            margin-top: auto;
            padding: 15px 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(15, 23, 42, 0.8);
            flex-shrink: 0;
        }
        
        .logout-container {
            padding: 0 8px;
        }
        
        .btn-logout {
            width: 100%;
            padding: 12px 16px;
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            border: none;
            color: white;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            position: relative;
            overflow: hidden;
            font-size: 0.9rem;
        }
        
        .btn-logout::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s;
        }
        
        .btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }
        
        .btn-logout:hover::before {
            left: 100%;
        }
        
        .btn-logout:active {
            transform: translateY(0);
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 0;
            min-height: 100vh;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
        }
        
        .topbar {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(229, 231, 235, 0.8);
            padding: 12px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .page-title h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            background: linear-gradient(135deg, var(--text-dark), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box input {
            padding: 10px 15px 10px 40px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: 250px;
            transition: all 0.3s ease;
            font-size: 14px;
            background: #f8fafc;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white;
        }
        
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-lighter);
        }
        
        .notification {
            position: relative;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: var(--text-dark);
        }
        
        .notification:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }
        
        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--danger-color);
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .user-profile:hover {
            background: #f1f5f9;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }
        
        .user-role {
            font-size: 0.75rem;
            color: var(--text-lighter);
        }
        
        .content {
            padding: 25px;
            min-height: calc(100vh - 72px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 10px 0 25px rgba(0, 0, 0, 0.15);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: flex !important;
            }
            
            .search-box input {
                width: 180px;
            }
            
            .user-info {
                display: none;
            }
        }
        
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .menu-toggle:hover {
            background: #f3f4f6;
            transform: rotate(90deg);
        }
        
        /* Animation for menu items */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-15px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .menu-item {
            animation: slideIn 0.3s ease forwards;
        }
        
        .menu-item:nth-child(1) { animation-delay: 0.1s; }
        .menu-item:nth-child(2) { animation-delay: 0.2s; }
        .menu-item:nth-child(3) { animation-delay: 0.3s; }
        .menu-item:nth-child(4) { animation-delay: 0.4s; }
    </style>
    
    <!-- Additional Styles for Content Pages -->
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="logo-text">
                    <h3>HRD System</h3>
                    <p>Manajemen Karyawan</p>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Menu - Optimized for space -->
        <div class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-title">Menu Utama</div>
                <a href="{{ route('hrd.dashboard') }}" class="menu-item {{ request()->routeIs('hrd.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            
            <div class="menu-section">
                <div class="menu-title">Manajemen</div>
                
                <!-- Menu Manajemen Shift - DIPERBAIKI -->
                <div class="menu-item {{ request()->is('hrd/manajemen-shift*') ? 'active' : '' }}" id="shift-menu">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Manajemen Shift</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </div>
                <div class="submenu {{ request()->is('hrd/manajemen-shift*') ? 'open' : '' }}" id="shift-submenu">
                    <a href="{{ route('hrd.manajemen-shift.shift') }}" class="submenu-item {{ request()->is('hrd/manajemen-shift/shift') ? 'active' : '' }}">Shift</a>
                    <a href="{{ route('hrd.manajemen-shift.absen') }}" class="submenu-item {{ request()->is('hrd/manajemen-shift/absen') ? 'active' : '' }}">Absen</a>
                </div>
                
                <!-- Menu Manajemen Data - DIPERBAIKI -->
                <div class="menu-item {{ request()->is('hrd/manajemen-data*') ? 'active' : '' }}" id="data-menu">
                    <i class="fas fa-database"></i>
                    <span>Manajemen Data</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </div>
                <div class="submenu {{ request()->is('hrd/manajemen-data*') ? 'open' : '' }}" id="data-submenu">
                    <a href="{{ route('hrd.manajemen-data.data-karyawan') }}" class="submenu-item {{ request()->is('hrd/manajemen-data/data-karyawan') ? 'active' : '' }}">Data Karyawan</a>
                    <a href="{{ route('hrd.manajemen-data.data-user') }}" class="submenu-item {{ request()->is('hrd/manajemen-data/data-user') ? 'active' : '' }}">Data User</a>
                </div>
            </div>
            
            <div class="menu-section">
                <div class="menu-title">Laporan</div>
                <div class="menu-item {{ request()->is('hrd/laporan*') ? 'active' : '' }}" id="report-menu">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </div>
                <div class="submenu {{ request()->is('hrd/laporan*') ? 'open' : '' }}" id="report-submenu">
                    <!-- DIPERBAIKI: route name yang benar -->
                    <a href="{{ route('hrd.laporan.ketidakhadiran') }}" class="submenu-item {{ request()->is('hrd/laporan/ketidakhadiran') ? 'active' : '' }}">Laporan Ketidakhadiran</a>
                    <a href="{{ route('hrd.laporan.shift') }}" class="submenu-item {{ request()->is('hrd/laporan/shift') ? 'active' : '' }}">Laporan Shift</a>
                    <a href="{{ route('hrd.laporan.absensi') }}" class="submenu-item {{ request()->is('hrd/laporan/absensi') ? 'active' : '' }}">Laporan Absensi</a>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Footer with Logout -->
        <div class="sidebar-footer">
            <div class="logout-container">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="page-title">
                <h1>@yield('page-title', 'Dashboard HRD')</h1>
            </div>
            
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari...">
                </div>
                
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <div class="notification-badge">3</div>
                </div>
                
                <div class="user-profile">
                    <div class="user-avatar">
                        <span>SJ</span>
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? '' }}</div>
                        <div class="user-role">HR Manager</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <!-- Content will be injected from child views -->
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar for mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            this.querySelector('i').classList.toggle('fa-bars');
            this.querySelector('i').classList.toggle('fa-times');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.getElementById('menuToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) && 
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                menuToggle.querySelector('i').classList.add('fa-bars');
                menuToggle.querySelector('i').classList.remove('fa-times');
            }
        });

        // Submenu Toggle
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            if (item.id) {
                item.addEventListener('click', function() {
                    const submenuId = this.id.replace('menu', 'submenu');
                    const submenu = document.getElementById(submenuId);
                    
                    if (submenu) {
                        // Close all other submenus
                        document.querySelectorAll('.submenu').forEach(menu => {
                            if (menu.id !== submenuId) {
                                menu.classList.remove('open');
                                menu.previousElementSibling.classList.remove('active');
                            }
                        });
                        
                        // Toggle current submenu
                        submenu.classList.toggle('open');
                        this.classList.toggle('active');
                    }
                });
            }
        });
        
        // Auto-set active menu based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');
            const submenuItems = document.querySelectorAll('.submenu-item');
            
            menuItems.forEach(item => {
                const href = item.getAttribute('href');
                if (href && currentPath.startsWith(href.replace(/^https?:\/\/[^\/]+/, ''))) {
                    item.classList.add('active');
                }
            });
            
            submenuItems.forEach(item => {
                const href = item.getAttribute('href');
                if (href && currentPath.startsWith(href.replace(/^https?:\/\/[^\/]+/, ''))) {
                    item.classList.add('active');
                    
                    // Also activate parent menu
                    const parentMenu = item.closest('.submenu').previousElementSibling;
                    if (parentMenu) {
                        parentMenu.classList.add('active');
                        parentMenu.querySelector('.menu-arrow').style.transform = 'rotate(90deg)';
                        item.closest('.submenu').classList.add('open');
                    }
                }
            });
        });

        // Add resize listener for responsive behavior
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.querySelector('.sidebar').classList.remove('active');
                const menuToggle = document.getElementById('menuToggle');
                menuToggle.querySelector('i').classList.add('fa-bars');
                menuToggle.querySelector('i').classList.remove('fa-times');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>