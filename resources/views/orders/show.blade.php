@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id . ' - CleanPlus Jambi')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="py-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                <li class="breadcrumb-item active">Detail Pesanan #{{ $order->id }}</li>
            </ol>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="py-4 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">
                        <i class="fas fa-clipboard-list me-2"></i>Detail Pesanan
                    </h2>
                    <p class="mb-0">Informasi lengkap pesanan layanan kebersihan Anda</p>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge status-{{ $order->status }} fs-6 p-2">
                        <i class="fas 
                            @if($order->status === 'completed') fa-check-circle 
                            @elseif($order->status === 'confirmed') fa-check 
                            @elseif($order->status === 'in_progress') fa-spinner 
                            @elseif($order->status === 'cancelled') fa-times-circle 
                            @else fa-clock @endif me-1">
                        </i>
                        {{ strtoupper($order->status) }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Details -->
    <section class="py-5">
        <div class="container">
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

            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Order Status Timeline -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Status Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item {{ $order->status != 'pending' ? 'completed' : 'active' }}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">Pesanan Dibuat</h6>
                                        <p class="mb-1 text-muted small">Pesanan berhasil dibuat dan menunggu konfirmasi</p>
                                        <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                                
                                <div class="timeline-item {{ in_array($order->status, ['confirmed', 'in_progress', 'completed']) ? 'completed' : '' }} {{ $order->status == 'confirmed' ? 'active' : '' }}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">Pesanan Dikonfirmasi</h6>
                                        <p class="mb-1 text-muted small">Pesanan telah dikonfirmasi oleh sistem</p>
                                        @if($order->confirmed_at)
                                            <small class="text-muted">{{ $order->confirmed_at->format('d M Y H:i') }}</small>
                                        @else
                                            <small class="text-muted">Menunggu konfirmasi</small>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="timeline-item {{ in_array($order->status, ['in_progress', 'completed']) ? 'completed' : '' }} {{ $order->status == 'in_progress' ? 'active' : '' }}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">Proses Pembersihan</h6>
                                        <p class="mb-1 text-muted small">Tim sedang melakukan pembersihan di lokasi</p>
                                        <small class="text-muted">Akan dimulai sesuai jadwal</small>
                                    </div>
                                </div>
                                
                                <div class="timeline-item {{ $order->status == 'completed' ? 'completed active' : '' }}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">Selesai</h6>
                                        <p class="mb-1 text-muted small">Pembersihan telah selesai dilakukan</p>
                                        <small class="text-muted">Layanan telah selesai</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-broom me-2"></i>Informasi Layanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%" class="text-muted">ID Pesanan</th>
                                            <td class="fw-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Layanan</th>
                                            <td class="fw-bold text-primary">{{ $order->service->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Tanggal</th>
                                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Waktu</th>
                                            <td>{{ $order->order_time }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%" class="text-muted">Durasi</th>
                                            <td>{{ $order->duration }} jam</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Harga per Jam</th>
                                            <td>Rp {{ number_format($order->service->price_per_hour, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Subtotal</th>
                                            <td>Rp {{ number_format($order->service->price_per_hour * $order->duration, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="total-row">
                                            <th class="fw-bold">Total Biaya</th>
                                            <td class="fw-bold text-success fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Alamat Pemesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="fw-bold mb-2">Alamat Lengkap:</p>
                                    <p class="mb-3">{{ $order->address }}</p>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Kecamatan:</strong> {{ $order->kecamatan }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Kelurahan:</strong> {{ $order->kelurahan }}</p>
                                        </div>
                                    </div>
                                    <p class="mb-0"><strong>Telepon:</strong> {{ $order->phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="map-placeholder bg-light rounded text-center p-4">
                                        <i class="fas fa-map fa-2x text-muted mb-3"></i>
                                        <p class="small text-muted mb-0">Peta lokasi akan ditampilkan di sini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($order->special_instructions)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Instruksi Khusus</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $order->special_instructions }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Customer Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Customer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Nama:</strong> {{ $order->user->name }}</p>
                                    <p class="mb-2"><strong>Email:</strong> {{ $order->user->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Telepon:</strong> {{ $order->user->phone ?? $order->phone }}</p>
                                    <p class="mb-0"><strong>Member sejak:</strong> {{ $order->user->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <!-- Action Card -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Aksi</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <a href="{{ route('services.show', $order->service_id) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-broom me-2"></i>Lihat Layanan
                                    </a>
                                    <a href="{{ route('home') }}" class="btn btn-outline-info">
                                        <i class="fas fa-home me-2"></i>Beranda
                                    </a>
                                    
                                    @if($order->status === 'pending')
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="fas fa-times me-2"></i>Batalkan Pesanan
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Support Card -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-headset me-2"></i>Butuh Bantuan?</h5>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-3">Tim support kami siap membantu Anda</p>
                                
                                <div class="d-grid gap-2">
                                    <a href="https://wa.me/6281277449468?text=Halo,%20saya%20butuh%20bantuan%20untuk%20pesanan%20%23{{ $order->id }}" 
                                       class="btn btn-success btn-sm" target="_blank">
                                        <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                                    </a>
                                    <a href="tel:+6281277449468" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-phone me-2"></i>Telepon Sekarang
                                    </a>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="support-info">
                                    <p class="small mb-1"><strong>Jam Operasional:</strong></p>
                                    <p class="small text-muted mb-2">Senin - Minggu: 07:00 - 21:00 WIB</p>
                                    <p class="small mb-1"><strong>Email:</strong></p>
                                    <p class="small text-muted">info@cleanplusjambi.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Info -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Cepat</h5>
                            </div>
                            <div class="card-body">
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-clock text-primary me-2"></i>
                                        <small class="fw-bold">Durasi Layanan</small>
                                    </div>
                                    <p class="small text-muted mb-0">{{ $order->duration }} jam</p>
                                </div>
                                
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-users text-success me-2"></i>
                                        <small class="fw-bold">Jumlah Staff</small>
                                    </div>
                                    <p class="small text-muted mb-0">2-3 orang profesional</p>
                                </div>
                                
                                <div class="info-item">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-shield-alt text-warning me-2"></i>
                                        <small class="fw-bold">Garansi</small>
                                    </div>
                                    <p class="small text-muted mb-0">100% kepuasan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services Section -->
    @if($order->status === 'completed')
    <section class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center fw-bold mb-4">Layanan Lainnya yang Mungkin Anda Suka</h3>
            <div class="row g-4">
                @php
                    $relatedServices = \App\Models\Service::where('is_active', true)
                                                        ->where('id', '!=', $order->service_id)
                                                        ->inRandomOrder()
                                                        ->limit(3)
                                                        ->get();
                @endphp
                
                @foreach($relatedServices as $service)
                <div class="col-md-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-broom"></i>
                        </div>
                        <div class="card-body text-center p-4">
                            <h5 class="card-title fw-bold text-primary">{{ $service->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($service->description, 80) }}</p>
                            
                            <div class="price-tag mb-3">
                                Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}/jam
                            </div>
                            
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fas fa-info-circle me-1"></i>Detail
                                </a>
                                <a href="{{ route('orders.create', $service->id) }}" class="btn btn-primary btn-sm flex-fill">
                                    <i class="fas fa-calendar-plus me-1"></i>Pesan Lagi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@section('styles')
<style>
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
        background: #dee2e6;
        border: 3px solid white;
    }
    
    .timeline-item.active .timeline-marker {
        background: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }
    
    .timeline-item.completed .timeline-marker {
        background: var(--accent-teal);
    }
    
    .timeline-content h6 {
        margin-bottom: 5px;
        font-weight: 600;
    }
    
    .timeline-content small {
        color: #6c757d;
    }
    
    .total-row {
        border-top: 2px solid #dee2e6;
        padding-top: 10px;
    }
    
    .sticky-top {
        position: sticky;
        z-index: 10;
    }
    
    .map-placeholder {
        min-height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-confirmed { background: #d1fae5; color: #065f46; }
    .status-in_progress { background: #dbeafe; color: #1e40af; }
    .status-completed { background: #dcfce7; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #dc2626; }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a {
        text-decoration: none;
        color: var(--primary-blue);
    }
    
    .service-card {
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
</style>
@endsection