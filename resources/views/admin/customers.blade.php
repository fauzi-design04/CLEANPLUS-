@extends('layouts.admin')

@section('title', 'Kelola Customer - Admin CleanPlus')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="fw-bold text-primary mb-2">
                                <i class="fas fa-users me-2"></i>Kelola Customer
                            </h3>
                            <p class="text-muted mb-0">Manajemen data customer CleanPlus Jambi</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari customer..." id="searchCustomer">
                                <button class="btn btn-admin" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="fw-bold text-primary">{{ $customers->count() }}</h3>
                <p class="text-muted mb-0">Total Customer</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="fw-bold text-success">{{ $customers->sum('orders_count') }}</h3>
                <p class="text-muted mb-0">Total Pesanan</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="fw-bold text-info">Rp {{ number_format($customers->sum('orders_sum_total_price'), 0, ',', '.') }}</h3>
                <p class="text-muted mb-0">Total Pengeluaran</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="fw-bold text-warning">{{ number_format($customers->avg('orders_count'), 1) }}</h3>
                <p class="text-muted mb-0">Rata-rata Pesanan</p>
            </div>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="admin-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Customer</h5>
            <span class="badge bg-primary">{{ $customers->count() }} Customer</span>
        </div>
        <div class="card-body">
            @if($customers->count() > 0)
                <div class="table-responsive">
                    <table class="table admin-table" id="customersTable">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Kontak</th>
                                <th>Bergabung</th>
                                <th>Total Pesanan</th>
                                <th>Total Pengeluaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 45px; height: 45px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $customer->name }}</h6>
                                            <small class="text-muted">ID: {{ $customer->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="mb-1">
                                            <i class="fas fa-envelope me-2 text-muted"></i>
                                            {{ $customer->email }}
                                        </div>
                                        <div>
                                            <i class="fas fa-phone me-2 text-muted"></i>
                                            {{ $customer->phone ?? 'Belum diatur' }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="fw-bold">{{ $customer->created_at->format('d M Y') }}</div>
                                        <small class="text-muted">{{ $customer->created_at->diffForHumans() }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $customer->orders_count }} pesanan</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-success">Rp {{ number_format($customer->orders_sum_total_price ?? 0, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    @if($customer->orders_count > 0)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-clock me-1"></i>Baru
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-info" 
                                                data-bs-toggle="tooltip" 
                                                title="Kirim Notifikasi">
                                            <i class="fas fa-bell"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Customer Segmentation -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="admin-card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Segmentasi Customer</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small">Customer Baru</span>
                                    <span class="badge bg-secondary">{{ $customers->where('orders_count', 0)->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small">Customer Aktif</span>
                                    <span class="badge bg-success">{{ $customers->where('orders_count', '>', 0)->where('orders_count', '<=', 3)->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small">Customer Loyal</span>
                                    <span class="badge bg-primary">{{ $customers->where('orders_count', '>', 3)->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small">VIP Customer</span>
                                    <span class="badge bg-warning">{{ $customers->where('orders_sum_total_price', '>', 500000)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="admin-card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-trophy me-2"></i>Top 5 Customer</h6>
                            </div>
                            <div class="card-body">
                                @foreach($customers->sortByDesc('orders_sum_total_price')->take(5) as $index => $customer)
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary me-2">#{{ $index + 1 }}</span>
                                            <div>
                                                <div class="fw-bold">{{ $customer->name }}</div>
                                                <small class="text-muted">{{ $customer->orders_count }} pesanan</small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold text-success">Rp {{ number_format($customer->orders_sum_total_price ?? 0, 0, ',', '.') }}</div>
                                            <small class="text-muted">Total belanja</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada customer</h4>
                    <p class="text-muted">Tidak ada customer yang terdaftar</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchCustomer');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#customersTable tbody tr');
            
            rows.forEach(row => {
                const customerName = row.querySelector('h6').textContent.toLowerCase();
                const customerEmail = row.querySelector('.fa-envelope').parentNode.textContent.toLowerCase();
                
                if (customerName.includes(searchTerm) || customerEmail.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection