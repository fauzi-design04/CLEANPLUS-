@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Admin CleanPlus')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="fw-bold text-primary mb-2">
                                <i class="fas fa-clipboard-list me-2"></i>Kelola Pesanan
                            </h3>
                            <p class="text-muted mb-0">Manajemen semua pesanan layanan kebersihan</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="btn-group">
                                <button class="btn btn-outline-primary btn-sm" id="filterButton">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="fw-bold text-primary">{{ $orders->count() }}</h3>
                <p class="text-muted mb-0">Total Pesanan</p>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="fw-bold text-warning">{{ $orders->where('status', 'pending')->count() }}</h3>
                <p class="text-muted mb-0">Pending</p>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="fw-bold text-success">{{ $orders->where('status', 'completed')->count() }}</h3>
                <p class="text-muted mb-0">Selesai</p>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-spinner"></i>
                </div>
                <h3 class="fw-bold text-info">{{ $orders->where('status', 'in_progress')->count() }}</h3>
                <p class="text-muted mb-0">Proses</p>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h3 class="fw-bold text-danger">{{ $orders->where('status', 'cancelled')->count() }}</h3>
                <p class="text-muted mb-0">Dibatalkan</p>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="fw-bold text-teal">Rp {{ number_format($orders->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}</h3>
                <p class="text-muted mb-0">Total Pendapatan</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="admin-card mb-4" id="filterSection" style="display: none;">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Pesanan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Dikonfirmasi</option>
                        <option value="in_progress">Dalam Proses</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="startDateFilter">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="endDateFilter">
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button class="btn btn-admin" id="applyFilter">Terapkan Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="admin-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Pesanan</h5>
            <span class="badge bg-primary">{{ $orders->count() }} Pesanan</span>
        </div>
        <div class="card-body">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table admin-table" id="ordersTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Customer</th>
                                <th>Layanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr data-status="{{ $order->status }}" data-date="{{ $order->order_date }}">
                                <td class="fw-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-white small"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $order->user->name }}</div>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $order->service->name }}</div>
                                    <small class="text-muted">{{ $order->duration }} jam</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $order->order_date->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $order->order_time }}</small>
                                </td>
                                <td class="fw-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge status-{{ $order->status }}">
                                        @if($order->status === 'pending')
                                            <i class="fas fa-clock me-1"></i>Pending
                                        @elseif($order->status === 'confirmed')
                                            <i class="fas fa-check me-1"></i>Dikonfirmasi
                                        @elseif($order->status === 'in_progress')
                                            <i class="fas fa-spinner me-1"></i>Proses
                                        @elseif($order->status === 'completed')
                                            <i class="fas fa-check-circle me-1"></i>Selesai
                                        @else
                                            <i class="fas fa-times-circle me-1"></i>Dibatalkan
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" 
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="dropdown-item">Konfirmasi</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="in_progress">
                                                    <button type="submit" class="dropdown-item">Proses</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="dropdown-item">Selesai</button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="dropdown-item text-danger">Batalkan</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada pesanan</h4>
                    <p class="text-muted">Tidak ada pesanan yang ditemukan</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('styles')
<style>
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-confirmed { background: #d1fae5; color: #065f46; }
    .status-in_progress { background: #dbeafe; color: #1e40af; }
    .status-completed { background: #dcfce7; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #dc2626; }
    
    .table tbody tr:hover {
        background-color: rgba(59, 130, 246, 0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle filter section
        const filterButton = document.getElementById('filterButton');
        const filterSection = document.getElementById('filterSection');
        
        filterButton.addEventListener('click', function() {
            if (filterSection.style.display === 'none') {
                filterSection.style.display = 'block';
                filterButton.innerHTML = '<i class="fas fa-times me-2"></i>Tutup Filter';
                filterButton.classList.remove('btn-outline-primary');
                filterButton.classList.add('btn-primary');
            } else {
                filterSection.style.display = 'none';
                filterButton.innerHTML = '<i class="fas fa-filter me-2"></i>Filter';
                filterButton.classList.remove('btn-primary');
                filterButton.classList.add('btn-outline-primary');
            }
        });

        // Filter functionality
        const applyFilter = document.getElementById('applyFilter');
        applyFilter.addEventListener('click', function() {
            const statusFilter = document.getElementById('statusFilter').value;
            const startDate = document.getElementById('startDateFilter').value;
            const endDate = document.getElementById('endDateFilter').value;
            
            const rows = document.querySelectorAll('#ordersTable tbody tr');
            
            rows.forEach(row => {
                let showRow = true;
                const rowStatus = row.getAttribute('data-status');
                const rowDate = row.getAttribute('data-date');
                
                // Status filter
                if (statusFilter && rowStatus !== statusFilter) {
                    showRow = false;
                }
                
                // Date filter
                if (startDate && rowDate < startDate) {
                    showRow = false;
                }
                
                if (endDate && rowDate > endDate) {
                    showRow = false;
                }
                
                row.style.display = showRow ? '' : 'none';
            });
        });
    });
</script>
@endsection