@extends('layouts.app')

@section('title', 'Pesanan Saya - CleanPlus Jambi')

@section('styles')
<style>
    .success-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        z-index: 1050;
        max-width: 500px;
        width: 90%;
        display: none;
    }
    
    .success-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
        display: none;
    }
    
    .popup-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .celebrate {
        animation: celebrate 0.6s ease-in-out;
    }
    
    @keyframes celebrate {
        0% { transform: scale(0.5); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
@endsection

@section('content')
    <!-- Popup Success -->
    <div class="success-popup-overlay" id="successOverlay"></div>
    <div class="success-popup" id="successPopup">
        <div class="card border-0">
            <div class="card-body text-center p-5">
                <div class="popup-icon celebrate">
                    <i class="fas fa-check fa-2x text-white"></i>
                </div>
                <h4 class="fw-bold text-success mb-3">Pesanan Berhasil!</h4>
                <p class="text-muted mb-4">Pesanan Anda telah berhasil dibuat dan sedang menunggu konfirmasi dari tim kami.</p>
                
                <div class="mb-4 p-3 bg-light rounded">
                    <small class="text-muted d-block">ID Pesanan</small>
                    <strong class="text-primary">#@if(session('order_id')){{ session('order_id') }}@endif</strong>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary" onclick="closePopup()">
                        <i class="fas fa-clipboard-list me-2"></i>Lihat Pesanan Saya
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="closePopupAndNewOrder()">
                        <i class="fas fa-plus me-2"></i>Pesan Layanan Lain
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <section class="py-4 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2"><i class="fas fa-clipboard-list me-2"></i>Pesanan Saya</h2>
                    <p class="mb-0">Riwayat pemesanan layanan CleanPlus Jambi</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('services.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i>Pesan Layanan Baru
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Orders Section -->
    <section class="py-5 orders-section">
        <div class="container">
            @if(session('success') && !session('order_success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($orders->count() > 0)
                <div class="row">
                    @foreach($orders as $order)
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ $order->service->name }}</h5>
                                <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'primary') }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <small class="text-muted">Tanggal</small>
                                        <p class="mb-0 fw-bold">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Waktu</small>
                                        <p class="mb-0 fw-bold">{{ $order->order_time }}</p>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <small class="text-muted">Durasi</small>
                                        <p class="mb-0 fw-bold">{{ $order->duration }} jam</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Total Biaya</small>
                                        <p class="mb-0 fw-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">Alamat</small>
                                    <p class="mb-0 small">{{ $order->address }}, {{ $order->kelurahan }}, {{ $order->kecamatan }}</p>
                                </div>

                                @if($order->special_instructions)
                                <div class="mb-3">
                                    <small class="text-muted">Instruksi Khusus</small>
                                    <p class="mb-0 small">{{ Str::limit($order->special_instructions, 100) }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Dipesan: {{ $order->created_at->format('d M Y H:i') }}</small>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-clipboard-list fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted">Belum ada pesanan</h4>
                    <p class="text-muted">Silakan pesan layanan kebersihan pertama Anda</p>
                    <a href="{{ route('services.index') }}" class="btn btn-primary-custom">
                        <i class="fas fa-broom me-2"></i>Pesan Layanan Sekarang
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Tampilkan popup jika pesanan berhasil dibuat
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('order_success'))
            showSuccessPopup();
        @endif
    });

    function showSuccessPopup() {
        const popup = document.getElementById('successPopup');
        const overlay = document.getElementById('successOverlay');
        
        popup.style.display = 'block';
        overlay.style.display = 'block';
        
        // Tambahkan animasi
        popup.classList.add('celebrate');
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        const popup = document.getElementById('successPopup');
        const overlay = document.getElementById('successOverlay');
        
        popup.style.display = 'none';
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Scroll ke bagian pesanan
        document.querySelector('.orders-section').scrollIntoView({
            behavior: 'smooth'
        });
    }

    function closePopupAndNewOrder() {
        closePopup();
        setTimeout(() => {
            window.location.href = "{{ route('services.index') }}";
        }, 500);
    }

    document.getElementById('successOverlay').addEventListener('click', closePopup);
</script>
@endsection
