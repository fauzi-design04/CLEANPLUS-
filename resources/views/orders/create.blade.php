@extends('layouts.app')

@section('title', 'Pesan Layanan - CleanPlus Jambi')

@section('styles')
<style>
    .order-steps {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .order-steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e2e8f0;
        z-index: 1;
    }
    
    .step {
        text-align: center;
        position: relative;
        z-index: 2;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        background: var(--light-blue);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        font-weight: bold;
        color: var(--primary-blue);
    }
    
    .step.active .step-number {
        background: var(--primary-blue);
        color: white;
    }
    
    .step-label {
        font-size: 0.9rem;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
    <!-- Order Header -->
    <section class="py-4 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">Pesan Layanan: {{ $service->name }}</h2>
                    <p class="mb-0">Isi form berikut untuk memesan layanan kebersihan rumah Anda</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="price-tag text-warning display-6">Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}/jam</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Steps -->
    <section class="py-4 bg-white">
        <div class="container">
            <div class="order-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-label">Detail Pesanan</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-label">Konfirmasi</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-label">Selesai</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Form -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Form Pemesanan</h4>
                        </div>
                        <div class="card-body p-4">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Tanggal Pemesanan *</label>
                                        <input type="date" name="order_date" class="form-control" 
                                               required min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               onchange="validateDate(this)">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Waktu *</label>
                                        <input type="time" name="order_time" class="form-control" 
                                               required min="07:00" max="21:00">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Durasi (jam) *</label>
                                    <input type="number" name="duration" class="form-control" 
                                           value="{{ $service->duration_hours }}" min="1" required
                                           onchange="updateTotalPrice()">
                                    <small class="text-muted">Minimal {{ $service->duration_hours }} jam</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Alamat Lengkap *</label>
                                    <textarea name="address" class="form-control" rows="3" required 
                                              placeholder="Contoh: Jl. Gatot Subroto No. 123, RT 01/RW 02"></textarea>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Kecamatan *</label>
                                        <select name="kecamatan" class="form-select" required>
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach($kecamatanList as $kecamatan)
                                                <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Kelurahan *</label>
                                        <input type="text" name="kelurahan" class="form-control" required
                                               placeholder="Contoh: Telanaipura">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nomor Telepon *</label>
                                    <input type="tel" name="phone" class="form-control" required
                                           placeholder="Contoh: 081234567890">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Instruksi Khusus (opsional)</label>
                                    <textarea name="special_instructions" class="form-control" rows="3" 
                                              placeholder="Contoh: Mohon fokus membersihkan kamar mandi dan dapur, ada area yang perlu perhatian khusus..."></textarea>
                                </div>

                                <div class="card bg-light border-0 p-4 mb-4">
                                    <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="mb-1">Layanan</p>
                                            <p class="mb-1">Durasi</p>
                                            <p class="mb-1">Harga per jam</p>
                                            <hr>
                                            <p class="fw-bold">Total Biaya</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="mb-1">{{ $service->name }}</p>
                                            <p class="mb-1"><span id="durationDisplay">{{ $service->duration_hours }}</span> jam</p>
                                            <p class="mb-1">Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}</p>
                                            <hr>
                                            <p class="fw-bold text-primary fs-5">Rp <span id="totalPrice">{{ number_format($service->price_per_hour * $service->duration_hours, 0, ',', '.') }}</span></p>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                                    <i class="fas fa-check-circle me-2"></i>Konfirmasi Pesanan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    const pricePerHour = {{ $service->price_per_hour }};
    
    function updateTotalPrice() {
        const durationInput = document.querySelector('input[name="duration"]');
        const durationDisplay = document.getElementById('durationDisplay');
        const totalPriceElement = document.getElementById('totalPrice');
        
        const duration = parseInt(durationInput.value) || {{ $service->duration_hours }};
        const totalPrice = pricePerHour * duration;
        
        durationDisplay.textContent = duration;
        totalPriceElement.textContent = totalPrice.toLocaleString('id-ID');
    }
    
    function validateDate(input) {
        const selectedDate = new Date(input.value);
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        if (selectedDate < tomorrow) {
            alert('Pemesanan harus dilakukan minimal H+1 dari hari ini');
            input.value = '';
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateTotalPrice();
    });
</script>
@endsection