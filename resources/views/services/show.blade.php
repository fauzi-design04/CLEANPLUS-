@extends('layouts.app')

@section('title', $service->name . ' - CleanPlus Jambi')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="py-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Layanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
            </ol>
        </div>
    </nav>

    <!-- Service Detail Header -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="service-badge mb-3">
                        <span class="badge bg-primary">Layanan Terpopuler</span>
                    </div>
                    <h1 class="display-6 fw-bold text-primary mb-3">{{ $service->name }}</h1>
                    <p class="lead text-muted">{{ $service->description }}</p>
                    
                    <div class="service-highlights mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-primary text-white me-3">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">Durasi Minimal</small>
                                        <div class="fw-bold">{{ $service->duration_hours }} Jam</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-success text-white me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">Jumlah Staff</small>
                                        <div class="fw-bold">2-3 Orang Profesional</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-warning text-white me-3">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">Garansi</small>
                                        <div class="fw-bold">100% Puas</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="price-section mb-4">
                        <h3 class="text-primary">Rp {{ number_format($service->price_per_hour, 0, ',', '.') }} <small class="text-muted fs-6">/jam</small></h3>
                        <p class="text-muted">*Harga sudah termasuk bahan pembersih premium</p>
                    </div>

                    <div class="action-buttons">
                        @auth
                            <a href="{{ route('orders.create', $service->id) }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-calendar-plus me-2"></i>Pesan Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login untuk Memesan
                            </a>
                        @endauth
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-headset me-2"></i>Konsultasi Gratis
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="service-image-card">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="{{ $service->name }}" class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Details Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4">Detail Layanan</h3>
                            
                            <div class="service-includes mb-5">
                                <h5 class="fw-bold text-primary mb-3">Apa yang termasuk dalam layanan ini:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Pembersihan menyeluruh</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Bahan pembersih premium</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Staff profesional bersertifikat</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Perlengkapan lengkap</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Garansi kepuasan</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Laporan hasil cleaning</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="service-process mb-5">
                                <h5 class="fw-bold text-primary mb-3">Proses Pengerjaan:</h5>
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold">1. Konsultasi Awal</h6>
                                            <p class="text-muted mb-0">Diskusikan kebutuhan spesifik Anda dengan tim kami</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-success"></div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold">2. Penjadwalan</h6>
                                            <p class="text-muted mb-0">Tentukan waktu yang tepat untuk pembersihan</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-warning"></div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold">3. Eksekusi</h6>
                                            <p class="text-muted mb-0">Tim profesional kami melakukan pembersihan</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info"></div>
                                        <div class="timeline-content">
                                            <h6 class="fw-bold">4. Quality Check</h6>
                                            <p class="text-muted mb-0">Pengecekan kualitas sebelum penyerahan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="service-faq">
                                <h5 class="fw-bold text-primary mb-3">Pertanyaan Umum:</h5>
                                <div class="accordion" id="faqAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                                Berapa lama waktu yang dibutuhkan?
                                            </button>
                                        </h2>
                                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                Minimal {{ $service->duration_hours }} jam, tergantung luas area dan tingkat kekotoran.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                                Apakah bahan pembersih aman untuk anak dan hewan peliharaan?
                                            </button>
                                        </h2>
                                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                Ya, kami menggunakan bahan pembersih ramah lingkungan yang aman untuk anak dan hewan peliharaan.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                                Bagaimana jika saya tidak puas dengan hasilnya?
                                            </button>
                                        </h2>
                                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                Kami memberikan garansi 100% kepuasan. Jika tidak puas, kami akan melakukan perbaikan tanpa biaya tambahan.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <!-- Pricing Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white text-center py-3">
                                <h5 class="mb-0">Estimasi Biaya</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label for="hours" class="form-label">Jumlah Jam:</label>
                                    <input type="range" class="form-range" id="hours" min="{{ $service->duration_hours }}" max="8" value="{{ $service->duration_hours }}">
                                    <div class="d-flex justify-content-between">
                                        <small>Min: {{ $service->duration_hours }} jam</small>
                                        <small>Max: 8 jam</small>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-primary" id="totalPrice">Rp {{ number_format($service->price_per_hour * $service->duration_hours, 0, ',', '.') }}</h4>
                                    <small class="text-muted">*Harga dapat berubah sesuai kondisi lapangan</small>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-body text-center p-4">
                                <div class="icon-circle bg-primary text-white mx-auto mb-3">
                                    <i class="fas fa-headset fa-2x"></i>
                                </div>
                                <h5>Butuh Bantuan?</h5>
                                <p class="text-muted small">Tim customer service kami siap membantu Anda</p>
                                <a href="https://wa.me/6281277449468" class="btn btn-success btn-sm w-100 mb-2">
                                    <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                                </a>
                                <a href="tel:+6281277449468" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-phone me-2"></i>Telepon Sekarang
                                </a>
                            </div>
                        </div>

                        <!-- Related Services -->
                        @if($relatedServices->count() > 0)
                        <div class="card shadow-sm">
                            <div class="card-header bg-light py-3">
                                <h6 class="mb-0">Layanan Lainnya</h6>
                            </div>
                            <div class="card-body p-3">
                                @foreach($relatedServices as $relatedService)
                                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80" 
                                         alt="{{ $relatedService->name }}" class="rounded me-3" width="50" height="50">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ Str::limit($relatedService->name, 30) }}</h6>
                                        <small class="text-primary fw-bold">Rp {{ number_format($relatedService->price_per_hour, 0, ',', '.') }}/jam</small>
                                    </div>
                                    <a href="{{ route('services.show', $relatedService->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--accent-teal) 0%, var(--primary-blue) 100%);">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">Siap Membersihkan Rumah Anda?</h3>
            <p class="mb-4">Pesan sekarang dan dapatkan kebersihan maksimal dengan harga terjangkau</p>
            @auth
                <a href="{{ route('orders.create', $service->id) }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-calendar-plus me-2"></i>Pesan Sekarang
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
            @endauth
            <a href="{{ route('services.index') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-broom me-2"></i>Lihat Layanan Lain
            </a>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .service-image-card {
        position: relative;
    }
    
    .service-image-card:after {
        content: '';
        position: absolute;
        top: 10px;
        left: 10px;
        right: -10px;
        bottom: -10px;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-teal) 100%);
        border-radius: 15px;
        z-index: -1;
        opacity: 0.1;
    }
    
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }
    
    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px var(--bs-primary);
    }
    
    .timeline-content {
        padding: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .sticky-top {
        position: sticky;
        z-index: 10;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a {
        text-decoration: none;
        color: var(--primary-blue);
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hoursInput = document.getElementById('hours');
        const totalPrice = document.getElementById('totalPrice');
        const pricePerHour = {{ $service->price_per_hour }};
        
        function updatePrice() {
            const hours = parseInt(hoursInput.value);
            const total = hours * pricePerHour;
            totalPrice.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
        
        hoursInput.addEventListener('input', updatePrice);
        
        // Initialize price
        updatePrice();
    });
</script>
@endsection