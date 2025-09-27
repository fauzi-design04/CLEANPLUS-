@extends('layouts.app')

@section('title', 'Layanan Kebersihan Rumah - CleanPlus Jambi')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Rumah Bersih, Hati Senang dengan CleanPlus</h1>
                    <p class="lead mb-4">Layanan kebersihan rumah profesional di Kota Jambi. Pesan sekarang dan rasakan kenyamanan rumah yang bersih dan sehat dengan CleanPlus Jambi.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('services.index') }}" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-broom me-2"></i>Pesan Layanan
                        </a>
                    </div>
                    <div class="mt-4">
                        <span class="clean-badge me-2"><i class="fas fa-shield-alt me-1"></i>Terpercaya</span>
                        <span class="clean-badge me-2"><i class="fas fa-clock me-1"></i>Tepat Waktu</span>
                        <span class="clean-badge"><i class="fas fa-star me-1"></i>Berkualitas</span>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Cleaning Service" class="img-fluid rounded-3" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih CleanPlus Jambi?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h4>Staff Terlatih</h4>
                        <p>Tim cleaning profesional CleanPlus Jambi yang sudah terlatih dan berpengalaman dalam bidang kebersihan rumah</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Tepat Waktu</h4>
                        <p>Pelayanan tepat waktu sesuai jadwal yang telah disepakati bersama pelanggan CleanPlus Jambi</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4>Ramah Lingkungan</h4>
                        <p>CleanPlus Jambi menggunakan bahan pembersih yang aman dan ramah lingkungan untuk keluarga</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5" style="background: var(--light-blue);">
        <div class="container">
            <h2 class="section-title">Layanan CleanPlus Jambi</h2>
            <div class="row">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-broom"></i>
                        </div>
                        <div class="card-body text-center p-4">
                            <h5 class="card-title fw-bold">{{ $service->name }}</h5>
                            <p class="card-text text-muted">{{ $service->description }}</p>
                            <div class="price-tag mb-3">
                                Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}/jam
                            </div>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary-custom btn-sm">
                                    <i class="fas fa-info-circle me-1"></i>Detail
                                </a>
                                @auth
                                <a href="{{ route('orders.create', $service->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-calendar-plus me-1"></i>Pesan
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login untuk Pesan
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-teal) 100%);">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold">500+</h2>
                    <p>Rumah Telah Dibersihkan oleh CleanPlus</p>
                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold">98%</h2>
                    <p>Kepuasan Pelanggan CleanPlus Jambi</p>
                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold">50+</h2>
                    <p>Staff Profesional CleanPlus</p>
                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold">24/7</h2>
                    <p>Layanan Pelanggan CleanPlus Jambi</p>
                </div>
            </div>
        </div>
    </section>
@endsection