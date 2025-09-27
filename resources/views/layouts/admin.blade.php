<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin CleanPlus Jambi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --clean-white: #f8fafc;
            --accent-teal: #0d9488;
            --dark-blue: #1e3a8a;
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, var(--clean-white) 0%, var(--light-blue) 100%);
            min-height: 100vh;
        }
        
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .admin-sidebar {
            width: 280px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            box-shadow: 4px 0 15px rgba(30, 64, 175, 0.3);
            transition: all 0.3s ease;
        }
        
        .admin-content {
            flex: 1;
            background: var(--clean-white);
            overflow-x: hidden;
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin: 0.2rem 0;
        }
        
        .sidebar-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--accent-teal);
            transform: translateX(5px);
        }
        
        .sidebar-menu i {
            width: 25px;
            font-size: 1.1rem;
            margin-right: 12px;
        }
        
        /* Header Styles */
        .admin-header {
            background: white;
            box-shadow: 0 2px 15px rgba(30, 64, 175, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        /* Card Styles */
        .admin-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(30, 64, 175, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .admin-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.15);
        }
        
        .admin-card .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            border: none;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.2rem 1.5rem;
        }
        
        /* Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, white 0%, var(--light-blue) 100%);
            border: none;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(30, 64, 175, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(30, 64, 175, 0.2);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        
        .stat-icon i {
            font-size: 1.5rem;
            color: var(--primary-blue);
        }
        
        /* Table Styles */
        .admin-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(30, 64, 175, 0.1);
        }
        
        .admin-table th {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--secondary-blue) 100%);
            color: var(--dark-blue);
            border: none;
            padding: 1rem;
            font-weight: 600;
        }
        
        .admin-table td {
            padding: 0.8rem 1rem;
            border-color: #e2e8f0;
        }
        
        /* Button Styles */
        .btn-admin {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                position: fixed;
                left: -280px;
                z-index: 1000;
                height: 100vh;
            }
            
            .admin-sidebar.active {
                left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <div class="sidebar-brand">
                <div class="d-flex align-items-center">
                    <div class="logo-placeholder bg-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                         style="width: 50px; height: 50px;">
                        <i class="fas fa-cogs text-primary"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">Admin Panel</h4>
                        <small class="opacity-75">CleanPlus Jambi</small>
                    </div>
                </div>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Kelola Pesanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.services') }}" class="{{ request()->routeIs('admin.services') ? 'active' : '' }}">
                        <i class="fas fa-broom"></i> Kelola Layanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers') }}" class="{{ request()->routeIs('admin.customers') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Kelola Customer
                    </a>
                </li>
                <li class="mt-4">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Kembali ke Website
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="admin-content">
            <!-- Header -->
            <header class="admin-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col">
                            <button class="btn btn-outline-primary d-md-none" id="sidebarToggle">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="container-fluid p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show admin-card">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 fa-lg"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Berhasil!</h6>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show admin-card">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Error!</h6>
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle for Mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.admin-sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            
            if (window.innerWidth < 768 && sidebar.classList.contains('active') && 
                !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>