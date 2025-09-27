@extends('layouts.app')

@section('title', 'Daftar - CleanPlus Jambi')

@section('styles')
<style>
    .register-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, var(--clean-white) 0%, var(--light-blue) 100%);
    }
    
    .register-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(30, 64, 175, 0.1);
        overflow: hidden;
    }
    
    .register-header {
        background: linear-gradient(135deg, var(--accent-teal) 0%, var(--primary-blue) 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    
    .register-logo {
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
</style>
@endsection

@section('content')
<section class="register-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card register-card">
                    <div class="register-header">
                        <div class="register-logo">
                            <i class="fas fa-user-plus fa-2x"></i>
                        </div>
                        <h4>Daftar Akun CleanPlus Jambi</h4>
                        <p class="mb-0">Bergabung dengan layanan kebersihan terpercaya</p>
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

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-user text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" 
                                                   id="name" name="name" 
                                                   value="{{ old('name') }}" 
                                                   placeholder="Nama lengkap" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-envelope text-primary"></i>
                                            </span>
                                            <input type="email" class="form-control border-start-0" 
                                                   id="email" name="email" 
                                                   value="{{ old('email') }}" 
                                                   placeholder="email@example.com" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-phone text-primary"></i>
                                            </span>
                                            <input type="tel" class="form-control border-start-0" 
                                                   id="phone" name="phone" 
                                                   value="{{ old('phone') }}" 
                                                   placeholder="081234567890" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat Lengkap *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" 
                                                   id="address" name="address" 
                                                   value="{{ old('address') }}" 
                                                   placeholder="Alamat lengkap" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-lock text-primary"></i>
                                            </span>
                                            <input type="password" class="form-control border-start-0" 
                                                   id="password" name="password" 
                                                   placeholder="Minimal 6 karakter" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-lock text-primary"></i>
                                            </span>
                                            <input type="password" class="form-control border-start-0" 
                                                   id="password_confirmation" name="password_confirmation" 
                                                   placeholder="Ulangi password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya menyetujui 
                                    <a href="#" class="text-primary text-decoration-none">Syarat dan Ketentuan</a>
                                    serta 
                                    <a href="#" class="text-primary text-decoration-none">Kebijakan Privasi</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                            </button>

                            <div class="text-center">
                                <p class="mb-0">Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                                        Login di sini
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection