@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan - CleanPlus Jambi')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="py-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Layanan</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.show', $order->service_id) }}">{{ $order->service->name }}</a></li>
                <li class="breadcrumb-item active">Konfirmasi Pesanan</li>
            </ol>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="py-4 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2"><i class="fas fa-clipboard-check me-2"></i>Konfirmasi Pesanan</h2>
                    <p class="mb-0">Review dan konfirmasi pesanan Anda sebelum proses selanjutnya</p>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge bg-warning fs-6">
                        <i class="fas fa-clock me-1"></i>Menunggu Konfirmasi
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Confirmation Steps -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="steps">
                        <div class="step completed">
                            <div class="step-number">1</div>
                            <div class="step-label">Pilih Layanan</div>
                        </div>
                        <div class="step completed">
                            <div class="step-number">2</div>
                            <div class="step-label">Isi Data</div>
                        </div>
                        <div class="step active">
                            <div class="step-number">3</div>
                            <div class="step-label">Konfirmasi</div>
                        </div>
                        <div class="step">
                            <div class="step-number">4</div>
                            <div class="step-label">Selesai</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Confirmation Content -->
    <section class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Order Summary -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h6 class="fw-bold text-primary">Informasi Layanan</h6>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="40%" class="text-muted">Layanan</td>
                                                <td class="fw-bold">{{ $order->service->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Tanggal</td>
                                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Waktu</td>
                                                <td>{{ $order->order_time }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Durasi</td>
                                                <td>{{ $order->duration }} jam</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h6 class="fw-bold text-primary">Detail Biaya</h6>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="40%" class="text-muted">Harga/jam</td>
                                                <td>Rp {{ number_format($order->service->price_per_hour, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Durasi</td>
                                                <td>{{ $order->duration }} jam</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Subtotal</td>
                                                <td>Rp {{ number_format($order->service->price_per_hour * $order->duration, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="total-row">
                                                <td class="fw-bold">Total</td>
                                                <td class="fw-bold text-success fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Customer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%" class="text-muted">Nama</td>
                                            <td class="fw-bold">{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email</td>
                                            <td>{{ $order->user->email }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%" class="text-muted">Telepon</td>
                                            <td>{{ $order->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Pesanan ID</td>
                                            <td class="fw-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
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
                </div>

                <!-- Confirmation Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <!-- Confirmation Card -->
                        <div class="card shadow-lg border-primary">
                            <div class="card-header bg-primary text-white text-center py-3">
                                <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Konfirmasi Pesanan</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <i class="fas fa-clipboard-check fa-3x text-primary mb-3"></i>
                                    <h5>Review Pesanan Anda</h5>
                                    <p class="text-muted small">Pastikan semua data sudah benar sebelum konfirmasi</p>
                                </div>

                                <div class="terms-section mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                        <label class="form-check-label small" for="agreeTerms">
                                            Saya menyetujui <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">syarat dan ketentuan</a> yang berlaku
                                        </label>
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <form action="{{ route('orders.confirm.process', $order->id) }}" method="POST" id="confirmationForm">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-lg w-100 mb-3" id="confirmButton" disabled>
                                            <i class="fas fa-check me-2"></i>Konfirmasi Pesanan
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('orders.create', $order->service_id) }}" class="btn btn-outline-secondary btn-sm w-100 mb-2">
                                        <i class="fas fa-edit me-2"></i>Edit Pesanan
                                    </a>
                                    
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                            <i class="fas fa-times me-2"></i>Batalkan Pesanan
                                        </button>
                                    </form>
                                </div>

                                <hr class="my-4">

                                <div class="support-info text-center">
                                    <small class="text-muted">
                                        <i class="fas fa-headset me-1"></i>Butuh bantuan? 
                                        <a href="https://wa.me/6281277449468" class="text-decoration-none">Hubungi kami</a>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="card mt-4">
                            <div class="card-header bg-light py-3">
                                <h6 class="mb-0"><i class="fas fa-credit-card me-2"></i>Informasi Pembayaran</h6>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-3">Pembayaran dilakukan setelah layanan selesai dengan metode:</p>
                                
                                <div class="payment-methods">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <span class="small">Tunai (Cash)</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fab fa-whatsapp text-success me-2"></i>
                                        <span class="small">Transfer via WhatsApp</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-mobile-alt text-primary me-2"></i>
                                        <span class="small">E-Wallet (OVO, GoPay, Dana)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Syarat dan Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6>Ketentuan Layanan CleanPlus Jambi:</h6>
                    <ol class="small">
                        <li>Pesanan dapat dibatalkan maksimal 2 jam sebelum jadwal layanan</li>
                        <li>Pembayaran dilakukan setelah layanan selesai</li>
                        <li>Durasi layanan dapat berubah sesuai kondisi lapangan</li>
                        <li>Harga sudah termasuk bahan pembersih premium</li>
                        <li>Garansi kepuasan 100% untuk semua layanan</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mengerti</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .steps {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
    }
    
    .step::after {
        content: '';
        position: absolute;
        top: 20px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #dee2e6;
        z-index: 1;
    }
    
    .step:last-child::after {
        display: none;
    }
    
    .step.completed::after {
        background: var(--primary-blue);
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #dee2e6;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }
    
    .step.completed .step-number {
        background: var(--primary-blue);
        color: white;
    }
    
    .step.active .step-number {
        background: var(--accent-teal);
        color: white;
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.3);
    }
    
    .step-label {
        font-size: 0.9rem;
        font-weight: 500;
        text-align: center;
    }
    
    .step.completed .step-label {
        color: var(--primary-blue);
    }
    
    .step.active .step-label {
        color: var(--accent-teal);
        font-weight: 600;
    }
    
    .info-section {
        margin-bottom: 1.5rem;
    }
    
    .info-section:last-child {
        margin-bottom: 0;
    }
    
    .total-row {
        border-top: 2px solid #dee2e6;
        padding-top: 10px;
    }
    
    .sticky-top {
        position: sticky;
        z-index: 10;
    }
    
    .payment-methods i {
        width: 20px;
        text-align: center;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const agreeCheckbox = document.getElementById('agreeTerms');
        const confirmButton = document.getElementById('confirmButton');
        const confirmationForm = document.getElementById('confirmationForm');
        
        agreeCheckbox.addEventListener('change', function() {
            confirmButton.disabled = !this.checked;
        });
        
        confirmationForm.addEventListener('submit', function(e) {
            if (!agreeCheckbox.checked) {
                e.preventDefault();
                alert('Anda harus menyetujui syarat dan ketentuan terlebih dahulu.');
            }
        });
        
        // Smooth scroll untuk terms modal
        const termsLinks = document.querySelectorAll('a[href="#terms"]');
        termsLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
                termsModal.show();
            });
        });
    });
</script>
@endsection