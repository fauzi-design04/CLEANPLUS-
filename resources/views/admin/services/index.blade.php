@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3 class="fw-bold text-primary mb-2"><i class="fas fa-broom me-2"></i>Kelola Layanan</h3>
                            <p class="text-muted mb-0">Manajemen layanan kebersihan CleanPlus Jambi</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-admin">
                                <i class="fas fa-plus me-2"></i>Tambah Layanan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="admin-card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Layanan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Harga/Jam</th>
                            <th>Durasi Min</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-broom text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $service->name }}</h6>
                                        <small class="text-muted">{{ Str::limit($service->description, 50) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-bold text-primary">Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}</td>
                            <td>{{ $service->duration_hours }} jam</td>
                            <td>
                                <span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">
                                    {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>{{ $service->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection