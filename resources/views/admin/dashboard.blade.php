@extends('layouts.admin')

@section('content')
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="fw-bold text-primary mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                            <p class="text-muted mb-0">Berikut adalah ringkasan aktivitas dan statistik CleanPlus Jambi</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-primary rounded p-3 text-white">
                                <small class="d-block">Hari Ini</small>
                                <strong class="h4 mb-0">{{ now()->format('d F Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="row mb-4">
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="fw-bold text-primary">{{ $stats['total_orders'] }}</h3>
                <p class="text-muted mb-0">Total Pesanan</p>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="fw-bold text-warning">{{ $stats['pending_orders'] }}</h3>
                <p class="text-muted mb-0">Pending</p>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="fw-bold text-success">{{ $stats['completed_orders'] }}</h3>
                <p class="text-muted mb-0">Selesai</p>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="fw-bold text-info">{{ $stats['total_customers'] }}</h3>
                <p class="text-muted mb-0">Customer</p>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-broom"></i>
                </div>
                <h3 class="fw-bold text-secondary">{{ $stats['total_services'] }}</h3>
                <p class="text-muted mb-0">Layanan</p>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="fw-bold text-success">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                <p class="text-muted mb-0">Pendapatan</p>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Orders -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-8 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table admin-table">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Customer</th>
                                    <th>Layanan</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_orders as $order)
                                <tr>
                                    <td class="fw-bold">#{{ $order->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                 style="width: 30px; height: 30px;">
                                                <i class="fas fa-user text-white small"></i>
                                            </div>
                                            <span>{{ $order->user->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($order->service->name, 20) }}</td>
                                    <td>{{ $order->order_date->format('d M Y') }}</td>
                                    <td class="fw-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status === 'completed') bg-success
                                            @elseif($order->status === 'pending') bg-warning
                                            @elseif($order->status === 'in_progress') bg-primary
                                            @else bg-secondary @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.orders') }}" class="btn btn-admin">
                            <i class="fas fa-list me-2"></i>Lihat Semua Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.orders') }}" class="btn btn-admin btn-lg">
                            <i class="fas fa-clipboard-list me-2"></i>Kelola Pesanan
                        </a>
                        <a href="{{ route('admin.services') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-broom me-2"></i>Kelola Layanan
                        </a>
                        <a href="{{ route('admin.customers') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-users me-2"></i>Kelola Customer
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i>Kunjungi Website
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="admin-card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-server me-2"></i>System Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Server Status</span>
                        <span class="badge bg-success">Online</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Database</span>
                        <span class="badge bg-success">Connected</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Last Backup</span>
                        <span class="text-muted small">{{ now()->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection