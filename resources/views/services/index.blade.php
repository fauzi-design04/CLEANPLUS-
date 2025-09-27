@extends('layouts.app')

@section('title', 'Layanan Kebersihan - CleanPlus Jambi')

@section('content')
    <!-- Header Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold">Layanan Kebersihan Profesional CleanPlus Jambi</h1>
                    <p class="lead">Pilih layanan yang sesuai dengan kebutuhan kebersihan rumah Anda di Kota Jambi</p>
                </div>
                <div class="col-lg-4 text-end">
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                         alt="Cleaning Tools" class="img-fluid rounded-3">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Filter -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Temukan Layanan yang Tepat</h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari layanan..." id="searchService">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-5">
        <div class="container">
            @if($services->count() > 0)
                <div class="row" id="servicesContainer">
                    @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 mb-4 service-item">
                        <div class="service-card h-100">
                            <div class="service-icon">
                                <i class="fas fa-broom"></i>
                            </div>
                            <div class="card-body text-center p-4">
                                <h5 class="card-title fw-bold text-primary">{{ $service->name }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($service->description, 120) }}</p>
                                
                                <div class="service-features mb-3">
                                    <div class="d-flex justify-content-between small text-muted mb-1">
                                        <span><i class="fas fa-clock me-1"></i>Min. {{ $service->duration_hours }} jam</span>
                                        <span><i class="fas fa-users me-1"></i>2-3 staff</span>
                                    </div>
                                </div>
                                
                                <div class="price-tag mb-3">
                                    Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}/jam
                                </div>
                                
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                        <i class="fas fa-info-circle me-1"></i>Detail
                                    </a>
                                    @auth
                                    <a href="{{ route('orders.create', $service->id) }}" class="btn btn-primary btn-sm flex-fill">
                                        <i class="fas fa-calendar-plus me-1"></i>Pesan
                                    </a>
                                    @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm flex-fill">
                                        <i class="fas fa-sign-in-alt me-1"></i>Login
                                    </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-broom fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada layanan tersedia</h4>
                    <p class="text-muted">Silakan hubungi admin untuk informasi lebih lanjut</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Service Comparison Table - PASTIKAN BAGIAN INI ADA -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Perbandingan Layanan</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Layanan</th>
                            <th>Harga per Jam</th>
                            <th>Durasi Minimal</th>
                            <th>Jumlah Staff</th>
                            <th>Bahan Pembersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td class="fw-bold">{{ $service->name }}</td>
                            <td>Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}</td>
                            <td>{{ $service->duration_hours }} jam</td>
                            <td>2-3 orang</td>
                            <td>Premium</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--accent-teal) 0%, var(--primary-blue) 100%);">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">Butuh Layanan Khusus?</h3>
            <p class="mb-4">Kami siap memberikan solusi kebersihan yang disesuaikan dengan kebutuhan khusus Anda</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                <i class="fas fa-headset me-2"></i>Konsultasi Gratis
            </a>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchService');
        const serviceItems = document.querySelectorAll('.service-item');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            serviceItems.forEach(item => {
                const serviceName = item.querySelector('.card-title').textContent.toLowerCase();
                const serviceDesc = item.querySelector('.card-text').textContent.toLowerCase();
                
                if (serviceName.includes(searchTerm) || serviceDesc.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection