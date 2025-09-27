@extends('layouts.app')

@section('title', 'Login - CleanPlus Jambi')

@section('styles')
<style>
    .login-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, var(--clean-white) 0%, var(--light-blue) 100%);
    }
    
    .login-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(30, 64, 175, 0.1);
        overflow: hidden;
    }
    
    .login-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    
    .login-logo {
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
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card">
                    <div class="login-header">
                        <div class="login-logo">
                            <i class="fas fa-home fa-2x"></i>
                        </div>
                        <h4>Login ke CleanPlus Jambi</h4>
                        <p class="mb-0">Masuk ke akun Anda</p>
                    </div>
                    
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success-custom">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
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

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-primary"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0" 
                                           id="password" name="password" 
                                           placeholder="Masukkan password" required>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>

                            <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>

                            <div class="text-center">
                                <p class="mb-0">Belum punya akun? 
                                    <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                                        Daftar di sini
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