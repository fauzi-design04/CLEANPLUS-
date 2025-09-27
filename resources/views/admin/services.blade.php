@extends('layouts.admin')

@section('title', 'Kelola Layanan - Admin CleanPlus')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="fw-bold text-primary mb-2"><i class="fas fa-broom me-2"></i>Kelola Layanan</h3>
                            <p class="text-muted mb-0">Manajemen lengkap layanan kebersihan CleanPlus Jambi</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-admin" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                <i class="fas fa-plus me-2"></i>Tambah Layanan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto bg-primary">
                    <i class="fas fa-broom text-white"></i>
                </div>
                <h3 class="fw-bold text-primary">{{ $services->count() }}</h3>
                <p class="text-muted mb-0">Total Layanan</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto bg-success">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
                <h3 class="fw-bold text-success">{{ $services->where('is_active', true)->count() }}</h3>
                <p class="text-muted mb-0">Layanan Aktif</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto bg-secondary">
                    <i class="fas fa-pause-circle text-white"></i>
                </div>
                <h3 class="fw-bold text-secondary">{{ $services->where('is_active', false)->count() }}</h3>
                <p class="text-muted mb-0">Layanan Nonaktif</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto bg-info">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
                <h3 class="fw-bold text-info">Rp {{ number_format($services->avg('price_per_hour'), 0, ',', '.') }}</h3>
                <p class="text-muted mb-0">Rata-rata Harga/Jam</p>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="admin-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Layanan</h5>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control form-control-sm me-2" placeholder="Cari layanan..." id="searchService" style="width: 200px;">
                <span class="badge bg-primary">{{ $services->count() }} Layanan</span>
            </div>
        </div>
        <div class="card-body">
            @if($services->count() > 0)
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Layanan</th>
                                <th>Harga/Jam</th>
                                <th>Durasi Min</th>
                                <th>Status</th>
                                <th>Pesanan</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
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
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-clock me-1"></i>{{ $service->duration_hours }} jam
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">
                                        {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $service->orders_count ?? 0 }} pesanan
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $service->created_at->format('d M Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editServiceModal"
                                                data-service-id="{{ $service->id }}"
                                                data-service-name="{{ $service->name }}"
                                                data-service-description="{{ $service->description }}"
                                                data-service-price="{{ $service->price_per_hour }}"
                                                data-service-duration="{{ $service->duration_hours }}"
                                                data-service-active="{{ $service->is_active }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan {{ $service->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-broom fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada layanan</h4>
                    <p class="text-muted">Tambahkan layanan pertama Anda dengan menekan tombol "Tambah Layanan"</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Layanan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Layanan *</label>
                                    <input type="text" class="form-control" name="name" required 
                                           placeholder="Contoh: Bersih-bersih Rumah Standar">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Harga per Jam *</label>
                                    <input type="number" class="form-control" name="price_per_hour" min="10000" 
                                           required placeholder="50000">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Durasi Minimal (jam) *</label>
                                    <input type="number" class="form-control" name="duration_hours" min="1" 
                                           required placeholder="3">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Layanan *</label>
                            <textarea class="form-control" name="description" rows="4" required 
                                      placeholder="Deskripsi lengkap tentang layanan ini..."></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                <label class="form-check-label">Aktifkan layanan</label>
                            </div>
                            <small class="text-muted">Layanan yang nonaktif tidak akan ditampilkan ke customer</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-admin">
                            <i class="fas fa-save me-2"></i>Simpan Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div class="modal fade" id="editServiceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editServiceForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Layanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Layanan *</label>
                                    <input type="text" class="form-control" name="name" id="editName" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Harga per Jam *</label>
                                    <input type="number" class="form-control" name="price_per_hour" id="editPrice" min="10000" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Durasi Minimal (jam) *</label>
                                    <input type="number" class="form-control" name="duration_hours" id="editDuration" min="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Layanan *</label>
                            <textarea class="form-control" name="description" id="editDescription" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="editActive" value="1">
                                <label class="form-check-label">Aktifkan layanan</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-admin">
                            <i class="fas fa-save me-2"></i>Update Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Modal Handler
        const editModal = document.getElementById('editServiceModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const serviceId = button.getAttribute('data-service-id');
            const serviceName = button.getAttribute('data-service-name');
            const serviceDescription = button.getAttribute('data-service-description');
            const servicePrice = button.getAttribute('data-service-price');
            const serviceDuration = button.getAttribute('data-service-duration');
            const serviceActive = button.getAttribute('data-service-active') === '1';

            const form = document.getElementById('editServiceForm');
            form.action = `/admin/services/${serviceId}`;

            document.getElementById('editName').value = serviceName;
            document.getElementById('editDescription').value = serviceDescription;
            document.getElementById('editPrice').value = servicePrice;
            document.getElementById('editDuration').value = serviceDuration;
            document.getElementById('editActive').checked = serviceActive;
        });

        // Search Functionality
        const searchInput = document.getElementById('searchService');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const serviceName = row.querySelector('h6').textContent.toLowerCase();
                    const serviceDesc = row.querySelector('small').textContent.toLowerCase();
                    
                    if (serviceName.includes(searchTerm) || serviceDesc.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection