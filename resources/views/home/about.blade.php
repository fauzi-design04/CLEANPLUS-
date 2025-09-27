@extends('layouts.app')

@section('title', 'Tentang Kami - CleanPlus Jambi')

@section('content')
    <!-- Header Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold">Tentang CleanPlus Jambi</h1>
                    <p class="lead">Menjadi partner terpercaya dalam menjaga kebersihan rumah Anda di Kota Jambi</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-home fa-6x opacity-50"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Siapa Kami?</h2>
                    <p class="lead">CleanPlus Jambi adalah layanan kebersihan rumah profesional yang didedikasikan untuk memberikan solusi kebersihan terbaik bagi masyarakat Kota Jambi.</p>
                    <p>Dengan pengalaman lebih dari 5 tahun dalam industri kebersihan, kami telah melayani ratusan rumah tangga dan bisnis di seluruh Jambi. Tim kami terdiri dari profesional yang terlatih dan berpengalaman dalam memberikan layanan kebersihan berkualitas tinggi.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Tim CleanPlus Jambi" class="img-fluid rounded-3 shadow">
                </div>
            </div>

            <!-- Visi Misi -->
            <div class="row mb-5">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon mx-auto mb-3">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h4 class="fw-bold">Visi</h4>
                            <p class="mb-0">Menjadi penyedia layanan kebersihan rumah terdepan di Kota Jambi yang dikenal dengan kualitas, keandalan, dan kepuasan pelanggan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon mx-auto mb-3">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h4 class="fw-bold">Misi</h4>
                            <ul class="list-unstyled text-start">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Menyediakan layanan kebersihan berkualitas tinggi</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mengutamakan kepuasan pelanggan</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Menggunakan produk ramah lingkungan</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Memberikan harga yang kompetitif</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nilai Perusahaan -->
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-4">Nilai-Nilai Kami</h2>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="feature-icon mx-auto mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Terpercaya</h5>
                        <p class="small">Kepercayaan pelanggan adalah prioritas utama kami</p>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="feature-icon mx-auto mb-3">
                            <i class="fas fa-award"></i>
                        </div>
                        <h5>Berkualitas</h5>
                        <p class="small">Standar kualitas tinggi dalam setiap layanan</p>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="feature-icon mx-auto mb-3">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h5>Ramah Lingkungan</h5>
                        <p class="small">Menggunakan produk yang aman untuk lingkungan</p>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="feature-icon mx-auto mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Tepat Waktu</h5>
                        <p class="small">Selalu tepat waktu sesuai janji</p>
                    </div>
                </div>
            </div>

            <!-- Tim -->
            <div class="text-center">
                <h2 class="fw-bold mb-4">Tim Profesional Kami</h2>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <img src="{{ asset('img/alif.jpg') }}" 
                                     alt="Team Member" class="rounded-circle mb-3" width="100" height="100">
                                <h5>Alif Aghfa Dinata</h5>
                                <p class="text-muted">Team Leader</p>
                                <p class="small">Selalu mengambil tindakan tegas terhadap pekerja yang melanggar aturan perusahaan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <img src="{{ asset('img/ikhwan.jpg') }}"  
                                     alt="Team Member" class="rounded-circle mb-3" width="100" height="100">
                                <h5>Ikhwan Nulhakim</h5>
                                <p class="text-muted">Quality Control</p>
                                <p class="small">Memastikan setiap layanan dan pekerja memenuhi standar kualitas tertinggi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <img src="{{ asset('img/fauzi.jpg') }}" 
                                     alt="Team Member" class="rounded-circle mb-3" width="100" height="100">
                                <h5>M. Fauzi Gafar</h5>
                                <p class="text-muted">Web Developer</p>
                                <p class="small">Menjaga kenyamanan pengguna dalam mengakses web dan memesan layanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <img src="{{ asset('img/tegar.jpg') }}" 
                                     alt="Team Member" class="rounded-circle mb-3" width="100" height="100">
                                <h5>M. Tegar Sembiring</h5>
                                <p class="text-muted">Customer Service</p>
                                <p class="small">Memiliki kemampuan komunikasi yang sopan dan ramah untuk mewujudkan CRM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--accent-teal) 0%, var(--primary-blue) 100%);">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">Siap Bekerja Sama dengan Kami?</h3>
            <p class="mb-4">Percayakan kebersihan rumah Anda pada tim profesional CleanPlus Jambi</p>
            <a href="{{ route('services.index') }}" class="btn btn-light btn-lg me-3">
                <i class="fas fa-broom me-2"></i>Lihat Layanan
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-phone me-2"></i>Hubungi Kami
            </a>
        </div>
    </section>
@endsection