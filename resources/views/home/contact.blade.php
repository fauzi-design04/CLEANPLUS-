@extends('layouts.app')

@section('title', 'Kontak - CleanPlus Jambi')

@section('styles')
<style>
    .contact-info-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(30, 64, 175, 0.1);
        transition: transform 0.3s ease;
    }
    
    .contact-info-card:hover {
        transform: translateY(-5px);
    }
    
    .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--light-blue) 0%, var(--secondary-blue) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
</style>
@endsection

@section('content')
    <!-- Header Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold">Hubungi CleanPlus Jambi</h1>
                    <p class="lead">Kami siap membantu semua kebutuhan kebersihan rumah Anda di Kota Jambi</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-phone-alt fa-6x opacity-50"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
<div class="col-12 mb-4">
    <h3 class="fw-bold mb-4 text-center">Informasi Kontak</h3>
    
    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <div class="contact-info-card p-4 h-100 text-center">
                <div class="contact-icon mb-2">
                    <i class="fas fa-map-marker-alt fa-lg text-white"></i>
                </div>
                <h5>Alamat</h5>
                <p class="mb-0">Jl. Gatot Subroto No. 123<br>Kota Jambi, Jambi 36133</p>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="contact-info-card p-4 h-100 text-center">
                <div class="contact-icon mb-2">
                    <i class="fas fa-phone fa-lg text-white"></i>
                </div>
                <h5>Telepon</h5>
                <p class="mb-0">(0741) 123-456<br>0812-3456-7890</p>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="contact-info-card p-4 h-100 text-center">
                <div class="contact-icon mb-2">
                    <i class="fas fa-envelope fa-lg text-white"></i>
                </div>
                <h5>Email</h5>
                <p class="mb-0">info@cleanplusjambi.com<br>cs@cleanplusjambi.com</p>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="contact-info-card p-4 h-100 text-center">
                <div class="contact-icon mb-2">
                    <i class="fas fa-clock fa-lg text-white"></i>
                </div>
                <h5>Jam Operasional</h5>
                <p class="mb-0">Senin - Minggu<br>07:00 - 21:00 WIB</p>
            </div>
        </div>
    </div>
</div>



                <!-- Contact Form -->
                <!-- <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Kirim Pesan</h4>
                        </div> -->
                        <!-- <div class="card-body p-4">
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                </div>
                                 -->
                                <!-- <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Telepon</label>
                                        <input type="tel" class="form-control" id="phone">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="subject" class="form-label">Subjek *</label>
                                        <select class="form-select" id="subject" required>
                                            <option value="">Pilih Subjek</option>
                                            <option value="layanan">Informasi Layanan</option>
                                            <option value="booking">Pemesanan</option>
                                            <option value="komplain">Komplain</option>
                                            <option value="kerjasama">Kerjasama</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                 -->
                                <!-- <div class="mb-3">
                                    <label for="message" class="form-label">Pesan *</label>
                                    <textarea class="form-control" id="message" rows="5" required 
                                              placeholder="Tulis pesan Anda di sini..."></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary-custom w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </form> -->
                        </div>
                    </div>

                    <!-- Map -->
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Lokasi Kami</h5>
    </div>
    <div class="card-body p-0">
        <div class="ratio ratio-16x9">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15956.236148625936!2d103.607734!3d-1.609194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2588f5d036c76f%3A0x4069a68f4db3dd0!2sKota%20Jambi%2C%20Jambi!5e0!3m2!1sen!2sid!4v1640000000000!5m2!1sen!2sid" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Pertanyaan Umum</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Bagaimana cara memesan layanan?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda bisa memesan melalui website dengan memilih layanan, mengisi form pemesanan, atau menghubungi kami langsung via telepon/WhatsApp.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah tersedia layanan darurat?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, kami menyediakan layanan darurat untuk kondisi tertentu. Silakan hubungi customer service untuk informasi lebih lanjut.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Bagaimana sistem pembayaran?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pembayaran dapat dilakukan via transfer bank atau tunai setelah layanan selesai dilakukan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Terima kasih! Pesan Anda telah dikirim. Kami akan menghubungi Anda segera.');
        this.reset();
    });
</script>
@endsection