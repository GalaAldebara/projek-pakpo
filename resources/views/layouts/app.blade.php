<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Purchasing Order') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #1a1a1a;
            overflow-x: hidden;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-260px);
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #1a1a1a;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .sidebar-brand i {
            font-size: 1.75rem;
            color: #6366f1;
        }

        .sidebar-menu {
            flex: 1;
            padding: 1rem 0.75rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 8px;
            text-decoration: none;
            color: #6b7280;
            font-size: 0.9375rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .menu-item:hover {
            background: #f3f4f6;
            color: #1a1a1a;
        }

        .menu-item.active {
            background: #eef2ff;
            color: #6366f1;
        }

        .menu-item i {
            font-size: 1.125rem;
            width: 20px;
        }

        .menu-item .chevron {
            margin-left: auto;
            font-size: 0.875rem;
            transition: transform 0.2s ease;
        }

        .menu-item.expanded .chevron {
            transform: rotate(180deg);
        }

        .submenu {
            display: none;
            padding-left: 2.5rem;
            margin-top: 0.25rem;
        }

        .submenu.show {
            display: block;
        }

        .submenu-item {
            display: block;
            padding: 0.625rem 1rem;
            margin-bottom: 0.125rem;
            border-radius: 6px;
            text-decoration: none;
            color: #6b7280;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .submenu-item:hover {
            background: #f3f4f6;
            color: #1a1a1a;
        }

        .submenu-item.active {
            background: #eef2ff;
            color: #6366f1;
            font-weight: 500;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Top Navbar */
        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .sidebar-toggle {
            background: transparent;
            border: 1px solid #e5e7eb;
            padding: 0.5rem;
            border-radius: 6px;
            color: #6b7280;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .sidebar-toggle:hover {
            background: #f3f4f6;
            color: #1a1a1a;
        }

        .sidebar-toggle i {
            font-size: 1.25rem;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #6366f1;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        .user-name {
            color: #1a1a1a;
            font-weight: 600;
            font-size: 0.875rem;
            line-height: 1;
        }

        .user-role {
            color: #6b7280;
            font-size: 0.75rem;
            line-height: 1;
        }

        .btn-logout {
            background: transparent;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            color: #6b7280;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-logout:hover {
            background: #f8f9fa;
            color: #1a1a1a;
            border-color: #d1d5db;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .top-navbar {
                padding: 1rem;
            }

            .content-area {
                padding: 1rem;
            }

            .user-section {
                padding: 0.5rem;
            }

            .user-info {
                display: none;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-overlay.show {
            display: block;
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebarMobile()"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('menu') }}" class="sidebar-brand">
                    <i class="bi bi-shop"></i>
                    <span>Purchasing Orders</span>
                </a>
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('menu') }}" class="menu-item {{ request()->routeIs('menu') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Home</span>
                </a>

                <div class="menu-group">
                    <button class="menu-item {{ request()->routeIs('orders.*') ? 'active expanded' : '' }}" onclick="toggleSubmenu('orders-submenu', this)">
                        <i class="bi bi-receipt"></i>
                        <span>Orders</span>
                        <i class="bi bi-chevron-down chevron"></i>
                    </button>
<div class="submenu show" id="orders-submenu">
    <a href="{{ route('orders.index') }}" class="submenu-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
        List Pembelian
    </a>
    <a href="{{ route('orders.create') }}" class="submenu-item {{ request()->routeIs('orders.create') ? 'active' : '' }}">
        Order Pembelian
    </a>
    <a href="{{ route('barang-masuk.index') }}" class="submenu-item {{ request()->routeIs('barang-masuk.index') ? 'active' : '' }}">
        List Barang Masuk
    </a>
    <a href="{{ route('barang-masuk.create') }}" class="submenu-item {{ request()->routeIs('barang-masuk.create') ? 'active' : '' }}">
        Terima Barang Masuk
    </a>
</div>

                <div class="menu-group">
                    <button class="menu-item {{ request()->routeIs('items.*') ? 'active expanded' : '' }}" onclick="toggleSubmenu('products-submenu', this)">
                        <i class="bi bi-tag-fill"></i>
                        <span>Products</span>
                        <i class="bi bi-chevron-down chevron"></i>
                    </button>
                    <div class="submenu {{ request()->routeIs('items.*') ? 'show' : '' }}" id="products-submenu">
                        {{-- <a href="{{ route('items.index') }}" class="submenu-item {{ request()->routeIs('items.index') ? 'active' : '' }}">
                            Product List
                        </a> --}}
                        <a href="{{ route('items.create') }}" class="submenu-item {{ request()->routeIs('items.create') ? 'active' : '' }}">
                            Tambahkan Item
                        </a>
                    </div>
                </div>

                <a href="{{ route('suppliers.index') }}" class="menu-item {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Suppliers</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="#" class="menu-item">
                    <i class="bi bi-gear-fill"></i>
                    <span>Settings</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Navbar -->
            <header class="top-navbar">
                <div class="navbar-left">
                    <button class="sidebar-toggle" onclick="toggleSidebarDesktop()" title="Toggle Sidebar">
                        <i class="bi bi-list"></i>
                    </button>
                </div>

                <div class="navbar-right">
                    @auth
                        <div class="user-section">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <span class="user-role">Admin</span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span class="d-none d-sm-inline">Logout</span>
                            </button>
                        </form>
                    @endauth
                </div>
            </header>

            <!-- Content -->
            <main class="content-area">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle submenu
        function toggleSubmenu(id, button) {
            const submenu = document.getElementById(id);
            submenu.classList.toggle('show');
            button.classList.toggle('expanded');
        }

        // Toggle sidebar for desktop (collapse/expand)
        function toggleSidebarDesktop() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            // Only for desktop view
            if (window.innerWidth > 768) {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');

                // Save state to localStorage
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            } else {
                // For mobile, toggle mobile menu
                toggleSidebarMobile();
            }
        }

        // Toggle sidebar for mobile
        function toggleSidebarMobile() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('show');
        }

        // Restore sidebar state on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth > 768) {
                const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (isCollapsed) {
                    document.getElementById('sidebar').classList.add('collapsed');
                    document.getElementById('mainContent').classList.add('expanded');
                }
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.sidebar-toggle');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('mobile-open');
                    document.getElementById('sidebarOverlay').classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');

            if (window.innerWidth > 768) {
                // Remove mobile classes
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('show');

                // Restore desktop state
                const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (isCollapsed) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            } else {
                // Remove desktop classes on mobile
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
